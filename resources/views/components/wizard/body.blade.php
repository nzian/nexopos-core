@extends( 'ns::layout.dashboard-blank' )

@section( 'layout.dashboard.body' )
<div id="wizard-wrapper">
    <NsWizard/>
</div>
@nsvite([ 'resources/ts/wizard.ts' ])
@endsection