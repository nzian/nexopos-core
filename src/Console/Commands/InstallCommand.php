<?php
namespace Ns\Console\Commands;

use Illuminate\Console\Command;
use Ns\Services\SetupService;

class InstallCommand extends Command
{
    protected $signature = 'ns:install {--force} {--filesystem} {--views}';

    protected $description = 'Install NexoPOS required files and configurations.';

    public function handle()
    {
        $setupService   =   app()->make( SetupService::class );

        if ( $this->option( 'filesystem' ) ) {
            $setupService->clearRegisteredFileSystem();
            
            $setupService->registerFileSystem( 
                key: 'ns', 
                function: 'base_path',
                path: ''
            );

            $setupService->registerFileSystem( 
                key: 'ns-modules', 
                function: 'base_path',
                path: 'modules'
            );

            $setupService->registerFileSystem( 
                key: 'ns-modules-temp', 
                function: 'storage_path',
                path: 'temporary-files/modules'
            );

            $setupService->registerFileSystem( 
                key: 'ns-temp', 
                function: 'storage_path',
                path: 'temporary-files'
            );

            $setupService->registerFileSystem( 
                key: 'ns-public', 
                function: 'base_path',
                path: 'public'
            );

            $setupService->registerFileSystem( 
                key: 'snapshots', 
                function: 'storage_path',
                path: 'snapshots'
            );

            $this->info( 'Filesystem registered' );
        }
    }
}