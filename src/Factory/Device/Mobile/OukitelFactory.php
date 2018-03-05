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
namespace BrowserDetector\Factory\Device\Mobile;

use BrowserDetector\Factory;
use BrowserDetector\Loader\ExtendedLoaderInterface;
use Stringy\Stringy;

class OukitelFactory implements Factory\FactoryInterface
{
    /**
     * @var array
     */
    private $devices = [
        'universetap' => 'oukitel universetap',
        'u16 max'     => 'oukitel u16 max',
        'u10'         => 'oukitel u10',
        'u7 plus'     => 'oukitel u7 plus',
        'k10000'      => 'oukitel k10000',
        'k6000 plus'  => 'oukitel k6000 plus',
        'k6000 pro'   => 'oukitel k6000 pro',
        'k4000'       => 'oukitel k4000',
    ];

    /**
     * @var \BrowserDetector\Loader\ExtendedLoaderInterface
     */
    private $loader;

    /**
     * @param \BrowserDetector\Loader\ExtendedLoaderInterface $loader
     */
    public function __construct(ExtendedLoaderInterface $loader)
    {
        $this->loader = $loader;
    }

    /**
     * detects the device name from the given user agent
     *
     * @param string           $useragent
     * @param \Stringy\Stringy $s
     *
     * @return array
     */
    public function detect(string $useragent, Stringy $s): array
    {
        foreach ($this->devices as $search => $key) {
            if ($s->contains($search, false)) {
                return $this->loader->load($key, $useragent);
            }
        }

        return $this->loader->load('general oukitel device', $useragent);
    }
}
