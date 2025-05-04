<?php

namespace Ns\Events;

use Ns\Fields\ProcurementFields;
use Ns\Fields\UnitsFields;
use Ns\Fields\UnitsGroupsFields;
use Ns\Services\Validation;

class ValidationEvent
{
    public function __construct( public Validation $validation )
    {
        // ...
    }

    /**
     * Extract the unit validation
     * fields
     *
     * @param void
     * @return array of validation
     */
    public function unitsGroups()
    {
        return $this->validation->from( UnitsGroupsFields::class )
            ->extract( 'get' );
    }

    public function unitValidation()
    {
        return $this->validation->from( UnitsFields::class )
            ->extract( 'get' );
    }

    public function procurementValidation()
    {
        return $this->validation->from( ProcurementFields::class )
            ->extract( 'get' );
    }
}
