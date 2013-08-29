<?php
namespace Browscap\Detector\Os;

/**
 * PHP version 5.3
 *
 * LICENSE:
 *
 * Copyright (c) 2013, Thomas Mueller <t_mueller_stolzenhain@yahoo.de>
 *
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without 
 * modification, are permitted provided that the following conditions are met:
 *
 * * Redistributions of source code must retain the above copyright notice, 
 *   this list of conditions and the following disclaimer.
 * * Redistributions in binary form must reproduce the above copyright notice, 
 *   this list of conditions and the following disclaimer in the documentation 
 *   and/or other materials provided with the distribution.
 * * Neither the name of the authors nor the names of its contributors may be 
 *   used to endorse or promote products derived from this software without 
 *   specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" 
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE 
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE 
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE 
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR 
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF 
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS 
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN 
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) 
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE 
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @category  Browscap
 * @package   Browscap
 * @copyright Thomas Mueller <t_mueller_stolzenhain@yahoo.de>
 * @license   http://opensource.org/licenses/BSD-3-Clause New BSD License
 * @version   SVN: $Id$
 */

use \Browscap\Detector\OsHandler;
use \Browscap\Helper\Utils;
use \Browscap\Detector\MatcherInterface;
use \Browscap\Detector\MatcherInterface\OsInterface;
use \Browscap\Detector\BrowserHandler;
use \Browscap\Detector\EngineHandler;
use \Browscap\Detector\Version;
use \Browscap\Detector\Company;

/**
 * MSIEAgentHandler
 *
 *
 * @category  Browscap
 * @package   Browscap
 * @copyright Thomas Mueller <t_mueller_stolzenhain@yahoo.de>
 * @license   http://opensource.org/licenses/BSD-3-Clause New BSD License
 * @version   SVN: $Id$
 */
class Ios
    extends OsHandler
    implements MatcherInterface, OsInterface
{
    /**
     * the detected browser properties
     *
     * @var array
     */
    protected $properties = array();
    
    /**
     * Class Constructor
     *
     * @return OsHandler
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->properties = array(
            // os
            'device_os'              => 'iOS',
            'device_os_version'      => '',
            'device_os_bits'         => '', // not in wurfl
            'device_os_manufacturer' => new Company\Apple(), // not in wurfl
        );
    }
    
    /**
     * Returns true if this handler can handle the given $useragent
     *
     * @return bool
     */
    public function canHandle()
    {
        $ios = array(
            'IphoneOSX', 'iPhone OS', 'like Mac OS X', 'iPad', 'IPad', 'iPhone',
            'iPod', 'CPU OS', 'CPU iOS', 'IUC(U;iOS'
        );
        
        if (!$this->utils->checkIfContains($ios)) {
            return false;
        }
        
        if ($this->utils->checkIfContains('Darwin')) {
            return false;
        }
        
        return true;
    }
    
    /**
     * detects the browser version from the given user agent
     *
     * @param string $this->_useragent
     *
     * @return string
     */
    protected function _detectVersion()
    {
        $detector = new \Browscap\Detector\Version();
        $detector->setUserAgent($this->_useragent);
        
        $searches = array(
            'IphoneOSX', 'CPU OS\_', 'CPU OS', 'CPU iOS', 'CPU iPad OS',
            'iPhone OS', 'iPhone_OS', 'IUC\(U\;iOS'
        );
        
        $this->setCapability(
            'device_os_version', 
            $detector->detectVersion($searches)
        );
        
        $doMatch = preg_match('/CPU like Mac OS X/', $this->_useragent, $matches);
        
        if ($doMatch) {
            $this->setCapability(
                'device_os_version', $detector->setVersion('1.0')
            );
        }
    }
    
    /**
     * gets the weight of the handler, which is used for sorting
     *
     * @return integer
     */
    public function getWeight()
    {
        return 404;
    }
    
    /**
     * returns null, if the device does not have a specific Browser
     * returns the Browser Handler otherwise
     *
     * @return null|\Browscap\Os\Handler
     */
    public function detectBrowser()
    {
        $browsers = array(
            new \Browscap\Detector\Browser\Mobile\Safari(),
            new \Browscap\Detector\Browser\Mobile\Chrome(),
            new \Browscap\Detector\Browser\Mobile\OperaMobile(),
            new \Browscap\Detector\Browser\Mobile\OperaMini(),
            new \Browscap\Detector\Browser\Mobile\OnePassword(),
            new \Browscap\Detector\Browser\Mobile\Sleipnir(),
            new \Browscap\Detector\Browser\Mobile\DarwinBrowser(),
            new \Browscap\Detector\Browser\Mobile\FacebookApp(),
            new \Browscap\Detector\Browser\Mobile\Isource(),
            new \Browscap\Detector\Browser\Mobile\GooglePlus(),
            new \Browscap\Detector\Browser\Mobile\NetNewsWire(),
            new \Browscap\Detector\Browser\Mobile\Incredimail()
        );
        
        $chain = new \Browscap\Detector\Chain();
        $chain->setUserAgent($this->_useragent);
        $chain->setHandlers($browsers);
        $chain->setDefaultHandler(new \Browscap\Detector\Browser\Unknown());
        
        return $chain->detect();
    }
    
    /**
     * Returns the value of a given capability name
     * for the current device
     * 
     * @param string $capabilityName must be a valid capability name
     * @return string Capability value
     * @throws InvalidArgumentException
     */
    public function getCapability($capabilityName) 
    {
        $this->checkCapability($capabilityName);
        
        switch ($capabilityName) {
            case 'model_extra_info':
                return $this->properties['device_os_version']->getVersion(
                    Version::MAJORMINOR
                );
                break;
            default:
                return $this->properties[$capabilityName];
                break;
        }
    }
}