<?php

use Ns\Models\UserAddress;
use Ns\Services\UsersService;
use Illuminate\Support\Facades\Auth;

/**
 * @var UsersService
 */
$usersService = app()->make( UsersService::class );

return [
    'label' => __( 'Shipping' ),
    'fields' => $usersService->getAddressFields( UserAddress::from( Auth::id(), 'shipping' )->first() ),
];
