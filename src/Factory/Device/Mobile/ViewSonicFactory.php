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

class ViewSonicFactory implements Factory\FactoryInterface
{
    /**
     * @var array
     */
    private $devices = [
        'viewpad 10s'    => 'viewsonic viewpad 10s',
        'viewpad 10e'    => 'viewsonic viewpad 10e',
        'viewpad 7q'     => 'viewsonic viewpad 7q',
        'viewpad7e'      => 'viewsonic viewpad 7e',
        'viewpad7'       => 'viewsonic viewpad7',
        'viewpad-7'      => 'viewsonic viewpad7',
        'viewsonic-v350' => 'viewsonic v350',
        'vsd220'         => 'viewsonic vsd220',
    ];

    /**
     * @var string
     */
    private $genericDevice = 'general viewsonic device';

    use Factory\DeviceFactoryTrait;
}
