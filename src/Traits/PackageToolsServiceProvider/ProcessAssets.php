<?php

namespace Hynek\PackageTools\Traits\PackageToolsServiceProvider;

trait ProcessAssets
{
    protected function bootPackageAssets(): static
    {
        if (!$this->package->hasAssets || !$this->app->runningInConsole()) {
            return $this;
        }

        $vendorAssets = $this->package->basePath('/../resources/dist');
        $appAssets = public_path("vendor/{$this->package->name()}");

        $this->publishes([$vendorAssets => $appAssets], "{$this->package->name()}-assets");

        return $this;
    }
}
