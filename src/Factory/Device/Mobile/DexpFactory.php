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

class DexpFactory implements Factory\FactoryInterface
{
    /**
     * @var array
     */
    private $devices = [
        'ixion es350'  => 'dexp ixion es350',
        'ixion_es255'  => 'dexp ixion es255',
        'ursus 9ev 3g' => 'dexp ursus 9ev 3g',
        'h135'         => 'dexp h135',
    ];

    /**
     * @var string
     */
    private $genericDevice = 'general dexp device';

    use Factory\DeviceFactoryTrait;
}
