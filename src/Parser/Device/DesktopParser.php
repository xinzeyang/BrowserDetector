<?php
/**
 * This file is part of the browser-detector package.
 *
 * Copyright (c) 2012-2020, Thomas Mueller <mimmi20@live.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);
namespace BrowserDetector\Parser\Device;

use BrowserDetector\Loader\DeviceLoaderFactoryInterface;
use BrowserDetector\Loader\DeviceLoaderInterface;
use BrowserDetector\Parser\Helper\RulefileParserInterface;

final class DesktopParser implements DesktopParserInterface
{
    /** @var \BrowserDetector\Loader\DeviceLoaderFactoryInterface */
    private $loaderFactory;

    /** @var \BrowserDetector\Parser\Helper\RulefileParserInterface */
    private $fileParser;

    private const GENERIC_FILE  = __DIR__ . '/../../../data/factories/devices/desktop.json';
    private const SPECIFIC_FILE = __DIR__ . '/../../../data/factories/devices/desktop/%s.json';

    /**
     * @param \BrowserDetector\Parser\Helper\RulefileParserInterface $fileParser
     * @param \BrowserDetector\Loader\DeviceLoaderFactoryInterface   $loaderFactory
     */
    public function __construct(RulefileParserInterface $fileParser, DeviceLoaderFactoryInterface $loaderFactory)
    {
        $this->loaderFactory = $loaderFactory;
        $this->fileParser    = $fileParser;
    }

    /**
     * Gets the information about the browser by User Agent
     *
     * @param string $useragent
     *
     * @throws \BrowserDetector\Loader\NotFoundException
     * @throws \UnexpectedValueException
     *
     * @return array
     */
    public function parse(string $useragent): array
    {
        $mode = $this->fileParser->parseFile(
            new \SplFileInfo(self::GENERIC_FILE),
            $useragent,
            'unknown'
        );

        $key = $this->fileParser->parseFile(
            new \SplFileInfo(sprintf(self::SPECIFIC_FILE, $mode)),
            $useragent,
            'unknown'
        );

        return $this->load($mode, $key, $useragent);
    }

    /**
     * @param string $company
     * @param string $key
     * @param string $useragent
     *
     * @throws \BrowserDetector\Loader\NotFoundException
     * @throws \UnexpectedValueException
     *
     * @return array
     */
    public function load(string $company, string $key, string $useragent = ''): array
    {
        $loaderFactory = $this->loaderFactory;

        $loader = $loaderFactory($company);
        \assert($loader instanceof DeviceLoaderInterface, sprintf('$loader should be an instance of %s, but is %s', DeviceLoaderInterface::class, get_class($loader)));

        return $loader->load($key, $useragent);
    }
}
