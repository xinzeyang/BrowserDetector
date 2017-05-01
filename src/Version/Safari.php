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
namespace BrowserDetector\Version;

use BrowserDetector\Helper\Safari as SafariHelper;

/**
 * @category  BrowserDetector
 *
 * @copyright 2012-2017 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 */
class Safari implements VersionCacheFactoryInterface
{
    /**
     * returns the version of the operating system/platform
     *
     * @param string $useragent
     *
     * @return \BrowserDetector\Version\Version
     */
    public function detectVersion($useragent)
    {
        $safariHelper = new SafariHelper($useragent);

        $doMatch = preg_match('/Version\/([\d\.]+)/', $useragent, $matches);

        if ($doMatch) {
            return VersionFactory::set($safariHelper->mapSafariVersions($matches[1]));
        }

        $doMatch = preg_match(
            '/Safari\/([\d\.]+)/',
            $useragent,
            $matches
        );

        if ($doMatch) {
            return VersionFactory::set($safariHelper->mapSafariVersions($matches[1]));
        }

        return new Version(0);
    }
}
