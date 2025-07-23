<?php

namespace Hynek\PackageTools\Traits\Package;

trait HasAssets
{
    public bool $hasAssets = false;

    public function hasAssets(): static
    {
        $this->hasAssets = true;

        return $this;
    }
}
