<template>
    <div class="flex flex-auto flex-col mb-2 ns-date" :class="hasError ? 'has-error' : 'is-pristine'">
        <label :for="field.name" class="block leading-5 font-medium"><slot></slot></label>
        <div class="text-fontcolor-soft mt-1 mb-2 relative overflow-hidden border rounded-md focus:shadow-sm">
            <div v-if="leading" class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <span class="sm:text-sm sm:leading-5">
                {{ leading }}
                </span>
            </div>
            <input 
                :disabled="field.disabled" 
                v-model="field.value" 
                @blur="$emit( 'blur', this )" 
                @change="$emit( 'change', this )" 
                :id="field.name" type="date"
                :class="inputClass" class="form-input block w-full sm:text-sm sm:leading-5 h-10" :placeholder="placeholder" />
        </div>
        <ns-field-description :field="field"></ns-field-description>
    </div>
</template>
<script>
export default {
    data: () => {
        return {
        }
    },
    mounted() {
    },
    computed: {
        hasError() {
            if ( this.field.errors !== undefined && this.field.errors.length > 0 ) {
                return true;
            }
            return false;
        },
        disabledClass() {
            return this.field.disabled ? 'bg-input-edge cursor-not-allowed' : 'bg-transparent';
        },
        inputClass() {
            return this.disabledClass + ' ' + this.leadClass
        },
        leadClass() {
            return this.leading ? 'pl-8' : 'px-4';
        }
    },
    props: [ 'placeholder', 'leading', 'type', 'field' ],
}
</script>