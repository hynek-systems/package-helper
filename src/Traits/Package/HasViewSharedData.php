<?php

namespace Hynek\PackageTools\Traits\Package;

trait HasViewSharedData
{
    public array $sharedViewData = [];

    public function sharesDataWithAllViews(string $name, $value): static
    {
        $this->sharedViewData[$name] = $value;

        return $this;
    }
}
