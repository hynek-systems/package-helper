<?php

namespace Hynek\PackageTools;

use Hynek\PackageTools\Traits\Package\HasAssets;
use Hynek\PackageTools\Traits\Package\HasBladeComponents;
use Hynek\PackageTools\Traits\Package\HasCommands;
use Hynek\PackageTools\Traits\Package\HasConfigs;
use Hynek\PackageTools\Traits\Package\HasInstallCommand;
use Hynek\PackageTools\Traits\Package\HasMigrations;
use Hynek\PackageTools\Traits\Package\HasRoutes;
use Hynek\PackageTools\Traits\Package\HasServiceProviders;
use Hynek\PackageTools\Traits\Package\HasTranslations;
use Hynek\PackageTools\Traits\Package\HasViewComposers;
use Hynek\PackageTools\Traits\Package\HasViews;
use Hynek\PackageTools\Traits\Package\HasViewSharedData;

class Package
{
    use HasAssets,
        HasBladeComponents,
        HasCommands,
        HasConfigs,
        HasInstallCommand,
        HasMigrations,
        HasRoutes,
        HasServiceProviders,
        HasTranslations,
        HasViewComposers,
        HasViewSharedData,
        HasViews;

    public string $name;

    public string $basePath;

    public function name(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function shortName()
    {
        return $this->name;
    }

    public function basePath(?string $directory = null): string
    {
        if ($directory === null) {
            return $this->basePath;
        }

        return $this->basePath.DIRECTORY_SEPARATOR.ltrim($directory, DIRECTORY_SEPARATOR);
    }

    public function setBasePath(string $path): static
    {
        $this->basePath = $path;

        return $this;
    }
}
