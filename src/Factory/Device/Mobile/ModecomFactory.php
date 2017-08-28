<?php
/**
 * This file is part of the browser-detector package.
 *
 * Copyright (c) 2012-2017, Thomas Mueller <mimmi20@live.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);
namespace BrowserDetector\Factory\Device\Mobile;

use BrowserDetector\Factory;
use BrowserDetector\Loader\LoaderInterface;
use Stringy\Stringy;

/**
 * @category  BrowserDetector
 *
 * @copyright 2012-2017 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 */
class ModecomFactory implements Factory\FactoryInterface
{
    /**
     * @var array
     */
    private $devices = [
        'freetab 9702 hd x4'      => 'modecom freetab 9702 hd x4',
        'freetab 9000 ips ic'     => 'modecom freetab 9000 ips ic',
        'freetab 8001 ips x2 3g+' => 'modecom freetab 8001 ips x2 3g+',
        'freetab 7800 ips ic'     => 'modecom freetab 7800 ips ic',
        'freetab 7001 hd ic'      => 'modecom freetab 7001 hd ic',
        'freetab 1014 ips x4 3g+' => 'modecom freetab 1014 ips x4 3g+',
        'freetab 1001'            => 'modecom freetab 1001',
    ];

    /**
     * @var \BrowserDetector\Loader\LoaderInterface|null
     */
    private $loader = null;

    /**
     * @param \BrowserDetector\Loader\LoaderInterface $loader
     */
    public function __construct(LoaderInterface $loader)
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
    public function detect(string $useragent, Stringy $s = null): array
    {
        foreach ($this->devices as $search => $key) {
            if ($s->contains($search, false)) {
                return $this->loader->load($key, $useragent);
            }
        }

        return $this->loader->load('general modecom device', $useragent);
    }
}
