<?php
declare(ENCODING = 'utf-8');
namespace Browscap\Os\Handlers;

/**
 * Copyright (c) 2012 ScientiaMobile, Inc.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or(at your option) any later version.
 *
 * Refer to the COPYING.txt file distributed with this package.
 *
 * @category   WURFL
 * @package    WURFL_Handlers
 * @copyright  ScientiaMobile, Inc.
 * @license    GNU Affero General Public License
 * @version    SVN: $Id$
 */

use Browscap\Os\Handler as OsHandler;

/**
 * MSIEAgentHandler
 *
 *
 * @category   WURFL
 * @package    WURFL_Handlers
 * @copyright  ScientiaMobile, Inc.
 * @license    GNU Affero General Public License
 * @version    SVN: $Id$
 */
class Windows extends OsHandler
{
    /**
     * @var string the detected platform
     */
    protected $_name = 'Windows';
    
    private $_windows = array(
        'Win8', 'Win7', 'WinVista', 'WinXP', 'Win2000', 'Win98', 'Win95',
        'WinNT', 'Win31', 'WinME', 'Windows NT', 'Windows 98', 'Windows 95',
        'Windows 3.1', 'win9x/NT 4.90', 'Windows'
    );
    
    /**
     * Returns true if this handler can handle the given $useragent
     *
     * @return bool
     */
    public function canHandle()
    {
        if (!$this->_utils->checkIfContainsAnyOf($this->_useragent, $this->_windows)
            && !$this->_utils->checkIfContainsAnyOf($this->_useragent, array('Trident', 'Microsoft', 'Outlook', 'MSOffice', 'ms-office'))
        ) {
            return false;
        }
        
        $isNotReallyAWindows = array(
            // other OS and Mobile Windows
            'Linux',
            'Macintosh',
            'Mac OS X',
            'Windows CE',
            'Windows Mobile',
            'Windows Phone OS',
            'IEMobile'
        );
        
        if ($this->_utils->checkIfContainsAnyOf($this->_useragent, $isNotReallyAWindows)) {
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
        $doMatch = preg_match('/Windows NT ([\d\.]+)/', $this->_useragent, $matches);
        
        if ($doMatch) {
            switch ($matches[1]) {
                case '6.2':
                    $version = '8';
                    break;
                case '6.1':
                    $version = '7';
                    break;
                case '6.0':
                    $version = 'Vista';
                    break;
                case '5.3':
                case '5.2':
                    $version = 'Server 2003';
                    if ('64' == $this->_detectBits()) {
                        $version = 'XP';
                    }
                    break;
                case '5.1':
                    $version = 'XP';
                    break;
                case '5.0':
                case '5.01':
                    $version = '2000';
                    break;
                case '4.0':
                default:
                    $version = 'NT';
                    break;
            }
            
            $this->_version = $version;
            return;
        }
        
        $doMatch = preg_match('/Windows ([\d\.a-zA-Z]+)/', $this->_useragent, $matches);
        
        if ($doMatch) {
            switch ($matches[1]) {
                case '6.2':
                    $version = '8';
                    break;
                case '6.1':
                case '7':
                    $version = '7';
                    break;
                case '6.0':
                    $version = 'Vista';
                    break;
                case '2003':
                    $version = 'Server 2003';
                    break;
                case '5.3':
                case '5.2':
                    $version = 'Server 2003';
                    if ('64' == $this->_detectBits()) {
                        $version = 'XP';
                    }
                    break;
                case '5.1':
                case 'XP':
                    $version = 'XP';
                    break;
                case '2000':
                case '5.0':
                case '5.01':
                    $version = '2000';
                    break;
                case '3.1':
                    $version = '3.1';
                    break;
                case '95':
                    $version = '95';
                    break;
                case '98':
                    $version = '98';
                    break;
                case '4.0':
                default:
                    $version = 'NT';
                    break;
            }
            
            $this->_version = $version;
            return;
        }
        
        if ($this->_utils->checkIfContainsAnyOf($this->_useragent, array('win9x/NT 4.90', 'Win 9x 4.90', 'Windows ME'))) {
            $this->_version = 'ME';
            return;
        }
        
        $version = '';
        
        foreach ($this->_windows as $winVersion) {
            if ($this->_utils->checkIfContains($this->_useragent, $winVersion)) {
                $version = substr($winVersion, 3);
                break;
            }
        }
        
        if ('dows NT' != $version) {
            $this->_version = $version;
            return;
        }
        
        $this->_version = '';
    }
    
    /**
     * gets the weight of the handler, which is used for sorting
     *
     * @return integer
     */
    public function getWeight()
    {
        return 92993;
    }
}