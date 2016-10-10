<?php
namespace Flarum\Composer\Tests;

use Flarum\Composer\Installer;
use Composer\Composer;
use Composer\Config;
use Composer\Package\Package;

class InstallerTest extends \PHPUnit_Framework_TestCase
{
    private $installer;

    public function setUp()
    {
        $composer = new Composer();
        $composer->setConfig(new Config());

        $io = $this->getMock('Composer\IO\IOInterface');

        $this->installer = new Installer($io, $composer);
    }

    /**
     * @dataProvider packageBasePathFormatProvider
     */
    public function testPackageBasePathFormat($type, $package, $basePath)
    {
        $package = new Package($package, '1.0.0', '1.0.0');
        $package->setType($type);

        $this->assertEquals($basePath, $this->installer->getPackageBasePath($package));
    }

    public function packageBasePathFormatProvider()
    {
        return [
            ['flarum-extension', 'test/foo', 'extensions/test-foo'],
            ['flarum-extension', 'test/flarum-foo-bar', 'extensions/test-foo-bar'],
        ];
    }

    public function testSupportsFlarumExtensionType()
    {
        $this->assertTrue($this->installer->supports('flarum-extension'));
    }
}
