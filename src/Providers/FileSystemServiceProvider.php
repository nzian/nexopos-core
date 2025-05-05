<?php
namespace Ns\Providers;

use Illuminate\Support\ServiceProvider;

class FileSystemServiceProvider extends ServiceProvider
{
    public function boot()
    {
        dump( 'bnopo' );
        $this->app->booted( function() {
            config()->set( 'filesystem.disks.ns',  [
                'driver' => 'local',
                'root' => base_path(),
            ]);
    
            config()->set( 'filesystem.disks.ns-modules',  [
                'driver' => 'local',
                'root' => base_path( 'modules' ),
            ]);
    
            config()->set( 'filesystem.disks.ns-modules-temp',  [
                'driver' => 'local',
                'root' => storage_path( 'temporary-files/modules' ),
            ]);
    
            config()->set( 'filesystem.disks.ns-temp',  [
                'driver' => 'local',
                'root' => storage_path( 'temporary-files' ),
            ]);
    
            config()->set( 'filesystem.disks.ns-public',  [
                'driver' => 'local',
                'root' => base_path( 'public' ),
            ]);
    
            config()->set( 'filesystem.disks.snapshots',  [
                'driver' => 'local',
                'root' => storage_path( 'snapshots' ),
            ]);
        });

        var_dump( 'fooobar' );
    }
}