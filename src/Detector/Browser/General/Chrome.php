<?php
/**
 * Copyright (c) 2012-2014, Thomas Mueller <t_mueller_stolzenhain@yahoo.de>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a
 * copy of this software and associated documentation files (the "Software"),
 * to deal in the Software without restriction, including without limitation
 * the rights to use, copy, modify, merge, publish, distribute, sublicense,
 * and/or sell copies of the Software, and to permit persons to whom the
 * Software is furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included
 * in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
 * OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @category  BrowserDetector
 * @package   BrowserDetector
 * @author    Thomas Mueller <t_mueller_stolzenhain@yahoo.de>
 * @copyright 2012-2014 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 * @link      https://github.com/mimmi20/BrowserDetector
 */

namespace BrowserDetector\Detector\Browser\General;

use BrowserDetector\Detector\BrowserHandler;
use BrowserDetector\Detector\Company;
use BrowserDetector\Detector\DeviceHandler;
use BrowserDetector\Detector\Engine\Blink;
use BrowserDetector\Detector\Engine\Webkit;
use BrowserDetector\Detector\EngineHandler;
use BrowserDetector\Detector\OsHandler;
use BrowserDetector\Detector\Type\Browser as BrowserType;
use BrowserDetector\Detector\Version;

/**
 * @category  BrowserDetector
 * @package   BrowserDetector
 * @copyright 2012-2014 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 */
class Chrome
    extends BrowserHandler
{
    /**
     * the detected browser properties
     *
     * @var array
     */
    protected $properties = array(
        // browser
        'mobile_browser_modus'         => null, // not in wurfl

        // product info
        'can_skip_aligned_link_row'    => true,
        'device_claims_web_support'    => true,

        // pdf
        'pdf_support'                  => true,

        // bugs
        'empty_option_value_support'   => true,
        'basic_authentication_support' => true,
        'post_method_support'          => true,

        // rss
        'rss_support'                  => false,
    );

    /**
     * Returns true if this handler can handle the given user agent
     *
     * @return bool
     */
    public function canHandle()
    {
        if (!$this->utils->checkIfContains(array('Mozilla/', 'Chrome/', 'CrMo/', 'CriOS/'))) {
            return false;
        }

        if (!$this->utils->checkIfContains(array('Chrome', 'CrMo', 'CriOS'))) {
            return false;
        }

        if ($this->utils->checkIfContains(array('Version/'))) {
            return false;
        }

        $isNotReallyAnChrome = array(
            // using also the KHTML rendering engine
            'Arora',
            'Chromium',
            'Comodo Dragon',
            'Dragon',
            'Flock',
            'Galeon',
            'Google Earth',
            'Iron',
            'Lunascape',
            'Maemo',
            'Maxthon',
            'Midori',
            'OPR',
            'PaleMoon',
            'RockMelt',
            'Silk',
            'YaBrowser',
            'Firefox',
            'Iceweasel',
            // Bots trying to be a Chrome
            'PagePeeker',
            'Google Web Preview',
            'Google Wireless Transcoder',
            'Google Page Speed',
            'HubSpot Webcrawler',
            'GomezAgent',
            'TagInspector',
            // Fakes
            'Mac; Mac OS '
        );

        if ($this->utils->checkIfContains($isNotReallyAnChrome)) {
            return false;
        }

        $detector = new Version();
        $detector->setUserAgent($this->useragent);
        $detector->detectVersion(array('Chrome'));

        if (0 != $detector->getVersion(Version::MINORONLY)) {
            return false;
        }

        return true;
    }

    /**
     * gets the name of the browser
     *
     * @return string
     */
    public function getName()
    {
        return 'Chrome';
    }

    /**
     * gets the maker of the browser
     *
     * @return \BrowserDetector\Detector\Company\CompanyInterface
     */
    public function getManufacturer()
    {
        return new Company\Google();
    }

    /**
     * returns the type of the current device
     *
     * @return \BrowserDetector\Detector\Type\Device\TypeInterface
     */
    public function getBrowserType()
    {
        return new BrowserType\Browser();
    }

    /**
     * detects the browser version from the given user agent
     *
     * @return \BrowserDetector\Detector\Version
     */
    public function detectVersion()
    {
        $detector = new Version();
        $detector->setUserAgent($this->useragent);
        $detector->setMode(Version::COMPLETE | Version::IGNORE_MICRO);

        $searches = array('Chrome', 'CrMo', 'CriOS');

        return $detector->detectVersion($searches);
    }

    /**
     * gets the weight of the handler, which is used for sorting
     *
     * @return integer
     */
    public function getWeight()
    {
        return 116398328;
    }

    /**
     * returns null, if the browser does not have a specific rendering engine
     * returns the Engine Handler otherwise
     *
     * @return \BrowserDetector\Detector\MatcherInterface\EngineInterface
     */
    public function detectEngine()
    {
        $version = $this->detectVersion()->getVersion(Version::MAJORONLY);

        if ($version >= 28) {
            $engine = new Blink();
        } else {
            $engine = new Webkit();
        }

        $engine->setUseragent($this->useragent);
        return $engine;
    }

    /**
     * detects properties who are depending on the browser, the rendering engine
     * or the operating system
     *
     * @param \BrowserDetector\Detector\EngineHandler $engine
     * @param \BrowserDetector\Detector\OsHandler     $os
     * @param \BrowserDetector\Detector\DeviceHandler $device
     *
     * @return \BrowserDetector\Detector\Browser\General\Chrome
     */
    public function detectDependProperties(
        EngineHandler $engine, OsHandler $os, DeviceHandler $device
    ) {
        parent::detectDependProperties($engine, $os, $device);

        $osname = $os->getName();

        if ('iOS' === $osname) {
            $engine->setCapability('xhtml_format_as_css_property', true);
            $this->setCapability('rss_support', true);
        }

        if ('Android' === $osname) {
            $engine->setCapability('html_wi_imode_compact_generic', false);
            $engine->setCapability('xhtml_avoid_accesskeys', true);
            $engine->setCapability('xhtml_supports_forms_in_table', true);
            $engine->setCapability('xhtml_file_upload', 'supported');
            $engine->setCapability('xhtml_allows_disabled_form_elements', true);
            $engine->setCapability('xhtml_readable_background_color1', '#FFFFFF');
        }
        
        $version = $this->detectVersion()->getVersion(Version::MAJORONLY);
        
        if ($version >= 22) {
            $engine->setCapability('css_gradient', 'webkit');
            $engine->setCapability('xhtml_make_phone_call_string', 'none');
            $engine->setCapability('xhtml_table_support', false);
            $engine->setCapability('css_gradient_linear', 'none');
            $engine->setCapability('css_border_image', 'none');
            $engine->setCapability('css_rounded_corners', 'none');
        });
        
        if ($version >= 38) {
            $engine->setCapability('xhtml_can_embed_video', 'play_and_stop');
            $engine->setCapability('css_gradient', 'css3');
            $engine->setCapability('css_gradient_linear', 'css3');
            $engine->setCapability('css_border_image', 'css3');
            $engine->setCapability('css_rounded_corners', 'css3');
        }

        return $this;
    }
}
