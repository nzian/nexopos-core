<template>
    <div class="flex flex-col flex-auto ns-select" v-if="field" :class="( hasError ? 'has-error' : 'is-pristine' )" :disabled="field.disabled">
        <label :for="field.name" class="block leading-5 font-medium"><slot></slot></label>
        <div :class="( field.disabled ? 'cursor-not-allowed' : 'cursor-default' ) + ' ' + ( showResults ? 'rounded-t-md' : 'rounded-md')" 
            class="border mt-1 relative shadow-sm mb-1 flex overflow-hidden">
            <div @click="! field.disabled && (showResults = ! showResults)"
                class="placeholder flex-auto h-10 sm:leading-5 py-2 px-4 flex items-center">
                <span class="text-fontcolor text-sm">{{ selectedOptionLabel }}</span>
            </div>
            <button v-if="hasSelectedValues( field ) && ! field.disabled" @click="resetSelectedInput( field )" class="flex items-center justify-center w-10 border-l hover:cursor-pointer hover:bg-error-tertiary hover:text-white border-input-edge">
                <i class="las la-times"></i>
            </button>
            <button v-if="field.component && ! field.disabled" @click="triggerDynamicComponent( field )" class="flex items-center justify-center w-10 hover:cursor-pointer border-l">
                <i class="las la-plus"></i>
            </button>
            <button v-if="field.about" @click="triggerFieldAbout( field )" class="flex items-center justify-center w-10 hover:cursor-pointer border-l">
                <i class="las la-question-circle text-2xl text-font"></i>
            </button>
        </div>
        <div class="relative" v-if="showResults">
            <div class="w-full overflow-hidden -top-[5px] ns-select-results border rounded-b-md shadow z-10 absolute">
                <div class="border-b border-dashed p-2 filter-input-wrapper">
                    <input @keypress.enter="selectFirstOption()" ref="searchInputField" v-model="searchField" type="text" :placeholder="__( 'Search result' )">
                </div>
                <div class="h-60 overflow-y-auto">
                    <ul>
                        <li @click="selectOption( option )" v-for="option of filtredOptions" class="py-1 px-2 hover:bg-info-primary cursor-pointer text-font">{{ option.label }}</li>
                    </ul>
                </div>
            </div>
        </div>
        <ns-field-description :field="field"></ns-field-description>
    </div>
</template>
<script lang="ts">
import { nsSnackBar } from '~/bootstrap';
import { __ } from '~/libraries/lang';
import { Popup } from '~/libraries/popup';

declare const nsExtraComponents: any;
declare const nsComponents: any;
declare const nsNotice: any;

export default {
    data: () => {
        return {
            searchField: '',
            showResults: false,
            subscription: null,
        }
    },
    name: 'ns-search-select',
    emits: [ 'saved', 'change' ],
    props: [ 'name', 'placeholder', 'field', 'leading' ],
    computed: {
        selectedOptionLabel() {
            if ( this.field.value === null || this.field.value === undefined ) {
                return __( 'Choose...' );
            }

            const options   =   this.field.options.filter( option => option.value === this.field.value );

            if ( options.length > 0 ) {
                return options[0].label;
            }

            return __( 'Choose...' );
        },
        filtredOptions() {
            if ( this.searchField.length > 0 ) {
                return this.field.options.filter( option => {
                    const expression    =   ( new RegExp( this.searchField, 'i' ) );
                    
                    return expression.test( option.label );
                }).splice(0,10);
            } else {
                return this.field.options;
            }
        },
        hasError() {
            if ( this.field.errors !== undefined && this.field.errors.length > 0 ) {
                return true;
            }
            return false;
        },
        disabledClass() {
            return this.field.disabled ? 'ns-disabled cursor-not-allowed' : '';
        },
        inputClass() {
            return this.disabledClass + ' ' + this.leadClass
        },
        leadClass() {
            return this.leading ? 'pl-8' : 'px-4';
        }
    },
    watch: {
        showResults() {
            if ( this.showResults === true ) {
                setTimeout( () => {
                    this.$refs.searchInputField.select();
                }, 50 );
            }
        }
    },
    mounted() {
        const options   =   this.field.options.filter( op => op.value === this.field.value );

        if ( options.length > 0 && [ null, undefined ].includes( this.field.value ) ) {
            this.selectOption( options[0] );
        }

        /**
         * if the field provide a "subject" object, this means
         * it's likely to automatically refresh in case other field value change
         * only if the "refresh" property is provided to the watching field
         */
        if ( this.field.subject ) {
            this.subscription = this.field.subject.subscribe( ({ field, fields }) => {
                if ( field && fields && this.field.refresh && field.name === this.field.refresh.watch ) {
                    const url =  this.field.refresh.url;
                    const data = this.field.refresh.data;
                    const form = { identifier: field.value, ...data };

                    nsHttpClient.post( url, form ).subscribe({
                        next: options => {
                            this.field.options    =   options;
                        },
                        error: error => {
                            console.error( error );
                        }
                    });
                }
            });
        }

        document.addEventListener( 'click', ( event ) => {
            if ( this.$el.contains( event.target ) === false ) {
                this.showResults    =   false;
            }
        });
    },
    destroyed() {
        if ( this.subscription ) {
            this.subscription.unsubscribe();
        }
    },
    methods: { 
        __,
        hasSelectedValues( field ) {
            const values    =   field.options.map( option => option.value );

            return values.includes( field.value );
        },
        resetSelectedInput( field ) {
            if ( field.disabled ) {
                return;
            }
            
            field.value = null;
            this.$emit( 'change', null );
            this.showResults    =   false;
            this.searchField    =   '';
        },
        selectFirstOption() {
            if ( this.filtredOptions.length > 0 ) {
                this.selectOption( this.filtredOptions[0] );
            }
        },
        selectOption( option ) {
            this.field.value    =   option.value;
            this.$emit( 'change', option.value );
            this.searchField    =   '';
            this.showResults    =   false;
        },
        async triggerDynamicComponent( field ) {
            try {
                this.showResults    =   false;
                const component =   nsExtraComponents[ field.component ] || nsComponents[ field.component];

                if ( component === undefined ) {
                    nsSnackBar.error( __( `The component ${field.component} cannot be loaded. Make sure it's injected on nsExtraComponents object.` ) );
                }

                const result = await new Promise( ( resolve, reject ) => {
                    const response  =   Popup.show( component, { ...( field.props || {}), field: this.field, resolve, reject } );
                });

                this.$emit( 'saved', result );
            } catch ( error ) {
                // probably the popup is closed
            }
        },
        triggerFieldAbout( field ) {
            nsNotice.info( __( 'About this field' ), field.about, {
                duration: 5000
            });
        }
    },
}
</script>