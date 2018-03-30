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

class LavaFactory implements Factory\FactoryInterface
{
    /**
     * @var array
     */
    private $devices = [
        ' x17 '       => 'lava x17',
        'iris fuel60' => 'lava iris fuel60',
        'iris fuel50' => 'lava iris fuel50',
        'iris x8 l'   => 'lava iris x8l',
        'iris x1'     => 'lava iris x1',
        'iris700'     => 'lava iris 700',
        'pixel v2+'   => 'lava pixel v2+',
        'pixelv1'     => 'lava pixel v1',
        'iris x8s'    => 'lava iris x8s',
        'iris402+'    => 'lava iris 402+',
        'iris_349+'   => 'lava iris 349+',
        'iris349i'    => 'lava iris 349i',
        'x1 atom'     => 'lava iris x1 atom',
        'x1 selfie'   => 'lava iris x1 selfie',
        'x5 4g'       => 'lava iris x5 4g',
        'spark284'    => 'lava spark 284',
        'kkt20'       => 'lava kkt20',
    ];

    /**
     * @var string
     */
    private $genericDevice = 'general lava device';

    use Factory\DeviceFactoryTrait;
}
