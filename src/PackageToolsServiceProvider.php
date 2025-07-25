<?php

namespace Hynek\PackageTools;

use Hynek\PackageTools\Exceptions\InvalidPackage;
use Hynek\PackageTools\Traits\PackageToolsServiceProvider\ProcessAssets;
use Hynek\PackageTools\Traits\PackageToolsServiceProvider\ProcessBladeComponents;
use Hynek\PackageTools\Traits\PackageToolsServiceProvider\ProcessCommands;
use Hynek\PackageTools\Traits\PackageToolsServiceProvider\ProcessConfigs;
use Hynek\PackageTools\Traits\PackageToolsServiceProvider\ProcessMigrations;
use Hynek\PackageTools\Traits\PackageToolsServiceProvider\ProcessRoutes;
use Hynek\PackageTools\Traits\PackageToolsServiceProvider\ProcessServiceProviders;
use Hynek\PackageTools\Traits\PackageToolsServiceProvider\ProcessTranslations;
use Hynek\PackageTools\Traits\PackageToolsServiceProvider\ProcessViewComposers;
use Hynek\PackageTools\Traits\PackageToolsServiceProvider\ProcessViews;
use Hynek\PackageTools\Traits\PackageToolsServiceProvider\ProcessViewSharedData;
use Illuminate\Support\ServiceProvider;
use ReflectionClass;

abstract class PackageToolsServiceProvider extends ServiceProvider
{
    use ProcessConfigs,
        ProcessAssets,
        ProcessBladeComponents,
        ProcessCommands,
        ProcessMigrations,
        ProcessRoutes,
        ProcessServiceProviders,
        ProcessTranslations,
        ProcessViewComposers,
        ProcessViewSharedData,
        ProcessViews;

    protected Package $package;

    public function register(): void
    {
        $this->registerPackage();

        $this->package = $this->newPackage();
        $this->package->setBasePath($this->getPackageBaseDir());

        $this->configurePackage($this->package);
        if (blank($this->package->name)) {
            throw  InvalidPackage::nameIsRequired();
        }

        $this->registerPackageConfigs();

        $this->packageRegistered();
    }

    private function registerPackage()
    {
    }

    public function newPackage(): Package
    {
        return new Package();
    }

    public function getPackageBaseDir(): string
    {
        $reflector = new ReflectionClass(get_class($this));

        return dirname($reflector->getFileName());
    }

    abstract public function configurePackage(Package $package): void;

    public function packageRegistered()
    {
    }

    public function boot(): void
    {
        $this->bootingPackage();

        $this
            ->bootPackageAssets()
            ->bootPackageBladeComponents()
            ->bootPackageCommands()
            ->bootPackageConsoleCommands()
            ->bootPackageConfigs()
            ->bootPackageMigrations()
            ->bootPackageRoutes()
            ->bootPackageServiceProviders()
            ->bootPackageTranslations()
            ->bootPackageViews()
            ->bootPackageViewComposers()
            ->bootPackageViewSharedData()
            ->packageBooted();
    }

    public function bootingPackage()
    {
    }

    public function packageBooted()
    {
    }

    /**
     * @throws \JsonException
     */
    public function getVersion()
    {
        $composer = json_decode(__DIR__.'/../composer.json', true, flags: JSON_THROW_ON_ERROR);

        return $composer['version'];
    }

    public function getPackageNamespace(): string
    {
        return new ReflectionClass(get_class($this))->getNamespaceName();
    }
}
