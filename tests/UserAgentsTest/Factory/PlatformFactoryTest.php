<?php
/**
 * This file is part of the browser-detector package.
 *
 * Copyright (c) 2012-2018, Thomas Mueller <mimmi20@live.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);
namespace UserAgentsTest\Factory;

use BrowserDetector\Cache\Cache;
use BrowserDetector\Factory\PlatformFactory;
use PHPUnit\Framework\TestCase;
use Psr\Log\NullLogger;
use Symfony\Component\Cache\Simple\FilesystemCache;

class PlatformFactoryTest extends TestCase
{
    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     *
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * @throws \Seld\JsonLint\ParsingException
     *
     * @return void
     */
    protected function setUp(): void
    {
        $cache  = new FilesystemCache('', 0, 'cache/');
        $logger = new NullLogger();

        $this->object = new PlatformFactory(new Cache($cache), $logger);
    }

    use PlatformTestDetectTrait;

    /**
     * @return array[]
     */
    public function providerDetect(): array
    {
        $sourceDirectory = 'tests/data/factory/platform/';
        $iterator        = new \RecursiveDirectoryIterator($sourceDirectory);

        $tests = [];

        foreach (new \RecursiveIteratorIterator($iterator) as $file) {
            /* @var $file \SplFileInfo */
            if (!$file->isFile() || 'json' !== $file->getExtension()) {
                continue;
            }

            $subfileTests = json_decode(file_get_contents($file->getPathname()), true);

            foreach ($subfileTests as $subfileTest) {
                if ('this is a fake ua to trigger the fallback' === $subfileTest['ua']) {
                    continue;
                }

                $tests[$subfileTest['ua']] = $subfileTest;
            }
        }

        $fileTests = json_decode(file_get_contents('tests/data/factory/platform.json'), true);

        foreach ($fileTests as $fileTest) {
            if (array_key_exists($fileTest['ua'], $tests)) {
                continue;
            }

            $tests[$fileTest['ua']] = $fileTest;
        }

        return $tests;
    }
}
