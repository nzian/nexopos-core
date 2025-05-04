<?php
namespace Ns\Traits;

use Ns\Models\UserAddress;
use Ns\Models\UserBillingAddress;
use Ns\Models\UserShippingAddress;

trait NsUserAddress
{
    public function addresses()
    {
        return $this->hasMany(
            related: UserAddress::class,
            foreignKey: 'user_id',
            localKey: 'id'
        );
    }

    public function billing()
    {
        return $this->hasOne(
            related: UserBillingAddress::class,
            foreignKey: 'user_id',
            localKey: 'id'
        );
    }

    public function shipping()
    {
        return $this->hasOne(
            related: UserShippingAddress::class,
            foreignKey: 'user_id',
            localKey: 'id'
        );
    }
}