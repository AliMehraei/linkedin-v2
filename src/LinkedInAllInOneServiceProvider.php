<?php

namespace alimehraei\LinkedInAllInOne;

use Illuminate\Support\Facades\Route;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use alimehraei\LinkedInAllInOne\Commands\LinkedInAllInOneCommand;

class LinkedInAllInOneServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         */
        $package
            ->name('linkedin-v2')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigrations('create_linkedin_v2_table')
            ->hasCommand(LinkedInAllInOneCommand::class);
    }

    public function packageBooted()
    {
        $this->configureRoutes();

    }

    protected function configureRoutes()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/routes.php');
    }

}
