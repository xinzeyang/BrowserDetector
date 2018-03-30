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

class SimvalleyFactory implements Factory\FactoryInterface
{
    /**
     * @var array
     */
    private $devices = [
        'spx-28'   => 'simvalley spx-28',
        'spx-5 3g' => 'simvalley spx-5 3g',
        'spx-5_3g' => 'simvalley spx-5 3g',
        'spx-5'    => 'simvalley spx-5',
    ];

    /**
     * @var string
     */
    private $genericDevice = 'general simvalley device';

    use Factory\DeviceFactoryTrait;
}
