<?php

namespace Flarum\Composer;

use Composer\Installer\LibraryInstaller;
use Composer\Package\PackageInterface;

class Installer extends LibraryInstaller
{
    /**
     * {@inheritDoc}
     */
    public function getPackageBasePath(PackageInterface $package)
    {
        list($vendor, $name) = explode('/', $package->getPrettyName());

        $name = preg_replace('/^flarum-/', '', $name);

        return 'extensions/'.$vendor.'-'.$name;
    }

    /**
     * {@inheritDoc}
     */
    public function supports($packageType)
    {
        return 'flarum-extension' === $packageType;
    }
}
