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

class LingwinFactory implements Factory\FactoryInterface
{
    /**
     * @var array
     */
    private $devices = [
        ' k5'   => 'lingwin k5',
        ' k1'   => 'lingwin k1',
        't620'  => 'lingwin t620',
        'u880'  => 'lingwin u880',
        'u820s' => 'lingwin u820s',
    ];

    /**
     * @var string
     */
    private $genericDevice = 'general lingwin device';

    use Factory\DeviceFactoryTrait;
}
