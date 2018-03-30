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

class WexlerFactory implements Factory\FactoryInterface
{
    /**
     * @var array
     */
    private $devices = [
        'tab a742' => 'wexler tab a742',
        'tab-7t'   => 'wexler tab 7t',
        'tab7id'   => 'wexler tab7id',
    ];

    /**
     * @var string
     */
    private $genericDevice = 'general wexler device';

    use Factory\DeviceFactoryTrait;
}
