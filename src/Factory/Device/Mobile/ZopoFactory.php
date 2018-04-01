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

class ZopoFactory implements Factory\FactoryInterface
{
    /**
     * @var array
     */
    private $devices = [
        '9xxquad' => 'zopo 9xxquad',
        'zp998'   => 'zopo zp998',
        'zp990+'  => 'zopo zp990+',
        'zp980'   => 'zopo zp980',
        'zp960'   => 'zopo zp960',
        ' c2 '    => 'zopo zp960',
        'zp952'   => 'zopo zp952',
        'zp950+'  => 'zopo zp950+',
        'zp950'   => 'zopo zp950',
        'zp910'   => 'zopo zp910',
        'zp900h'  => 'zopo zp910',
        'zp900'   => 'zopo zp900',
        'zp810'   => 'zopo zp810',
        'zp800h'  => 'zopo zp810',
        'zp700'   => 'zopo zp700',
        'zp500+'  => 'zopo zp500+',
        'zp500'   => 'zopo zp500',
        'zp300'   => 'zopo zp300',
        'zp200+'  => 'zopo zp200+',
        'zp200'   => 'zopo zp200',
        'zp100'   => 'zopo zp100',
    ];

    /**
     * @var string
     */
    private $genericDevice = 'general zopo device';

    use Factory\DeviceFactoryTrait;
}
