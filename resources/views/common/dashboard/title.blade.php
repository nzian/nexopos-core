<?php

use Ns\Classes\Hook;
use Ns\Classes\Output;
use Ns\Events\AfterDashboardTitleEvent;
use Ns\Events\BeforeDashboardTitleEvent;

?>
<?php echo Output::dispatch( BeforeDashboardTitleEvent::class ); ?>

<div class="page-inner-header mb-4">
    <h3 class="text-3xl text-fontcolor font-bold">{!! $title ?? __( 'Unnamed Page' ) !!}</h3>
    <p class="text-fontcolor-soft">{{ $description ?? __( 'No description' ) }}</p>
</div>
@include( 'ns::components.session-message' )

<?php echo Output::dispatch( AfterDashboardTitleEvent::class ); ?>