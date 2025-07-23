<?php

namespace Hynek\PackageTools\Traits\PackageToolsServiceProvider;

use Illuminate\Support\Facades\View;

trait ProcessViewSharedData
{
    protected function bootPackageViewSharedData(): self
    {
        if (empty($this->package->sharedViewData)) {
            return $this;
        }

        foreach ($this->package->sharedViewData as $name => $value) {
            View::share($name, $value);
        }

        return $this;
    }
}
