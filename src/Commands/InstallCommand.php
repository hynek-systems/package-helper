<?php

namespace Spatie\LaravelPackageTools\Commands;

use Hynek\PackageTools\Package;
use Hynek\PackageTools\Traits\InstallCommand\AskToRunMigrations;
use Hynek\PackageTools\Traits\InstallCommand\AskToStarRepoOnGitHub;
use Hynek\PackageTools\Traits\InstallCommand\PublishesResources;
use Hynek\PackageTools\Traits\InstallCommand\SupportsServiceProviderInApp;
use Hynek\PackageTools\Traits\InstallCommand\SupportsStartWithEndWith;
use Illuminate\Console\Command;

class InstallCommand extends Command
{
    use AskToRunMigrations;
    use AskToStarRepoOnGitHub;
    use PublishesResources;
    use SupportsServiceProviderInApp;
    use SupportsStartWithEndWith;

    protected Package $package;

    public function __construct(Package $package)
    {
        $this->signature = $package->shortName().':install';

        $this->description = 'Install '.$package->name;

        $this->package = $package;

        $this->hidden = true;

        parent::__construct();
    }

    public function handle()
    {
        $this
            ->processStartWith()
            ->processPublishes()
            ->processAskToRunMigrations()
            ->processCopyServiceProviderInApp()
            ->processStarRepo()
            ->processEndWith();

        $this->info("{$this->package->shortName()} has been installed!");
    }
}
