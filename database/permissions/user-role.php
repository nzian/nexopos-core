<?php

use Ns\Models\Permission;
use Ns\Models\Role;
use Ns\Widgets\ProfileWidget;

$user = Role::firstOrNew( [ 'namespace' => 'user' ] );
$user->name = __( 'User' );
$user->namespace = 'user';
$user->locked = true;
$user->description = __( 'Basic user role.' );
$user->save();
$user->addPermissions( [
    'manage.profile',
] );
$user->addPermissions( Permission::whereIn( 'namespace', [
    ( new ProfileWidget )->getPermission(),
] )->get()->map( fn( $permission ) => $permission->namespace ) );
