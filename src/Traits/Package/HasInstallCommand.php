<?php

namespace Hynek\PackageTools\Traits\Package;

use Hynek\PackageTools\Commands\InstallCommand;

trait HasInstallCommand
{
    public function hasInstallCommand($callable): static
    {
        $installCommand = new InstallCommand($this);

        $callable($installCommand);

        $this->consoleCommands[] = $installCommand;

        return $this;
    }
}
