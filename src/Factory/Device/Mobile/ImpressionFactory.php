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

class ImpressionFactory implements Factory\FactoryInterface
{
    /**
     * @var array
     */
    private $devices = [
        'impad 9708'    => 'impression impad 9708',
        'impad6213m_v2' => 'impression impad 6213m v2',
        'impad 0413'    => 'impression impad 0413',
    ];

    /**
     * @var string
     */
    private $genericDevice = 'general impression device';

    use Factory\DeviceFactoryTrait;
}
