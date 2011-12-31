<?php
declare(ENCODING = 'utf-8');
namespace Browscap\Browser\Handlers;

/**
 * Copyright(c) 2011 ScientiaMobile, Inc.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or(at your option) any later version.
 *
 * Refer to the COPYING file distributed with this package.
 *
 * @category   WURFL
 * @package    WURFL_Handlers
 * @copyright  ScientiaMobile, Inc.
 * @license    GNU Affero General Public License
 * @version    $id$
 */

use Browscap\Browser\Handler as BrowserHandler;

/**
 * ChromeUserAgentHanlder
 *
 *
 * @category   WURFL
 * @package    WURFL_Handlers
 * @copyright  ScientiaMobile, Inc.
 * @license    GNU Affero General Public License
 * @version    $id$
 */
class Rockmelt extends BrowserHandler
{
    /**
     * Intercept all UAs Containing Chrome and are not mobile browsers
     *
     * @param string $userAgent
     * @return boolean
     */
    public function canHandle($userAgent)
    {
        if (!$this->utils->checkIfStartsWith($userAgent, 'Mozilla')) {
            return false;
        }
        
        if (!$this->utils->checkIfContainsAll($userAgent, array('AppleWebKit', 'Chrome', 'RockMelt'))) {
            return false;
        }
        
        if ($this->utils->isSpamOrCrawler($userAgent)) {
            return false;
        }
        
        $isNotReallyAnSafari = array(
            // using also the KHTML rendering engine
            'Chromium',
            'Flock',
            'Galeon',
            'Lunascape',
            'Iron',
            'Maemo',
            'PaleMoon',
            //Fakes
            'User Agent'
        );
        
        if ($this->utils->checkIfContainsAnyOf($userAgent, $isNotReallyAnSafari)) {
            return false;
        }
        
        return true;
    }
    
    /**
     * detects the browser name from the given user agent
     *
     * @param string $userAgent
     *
     * @return string
     */
    protected function detectBrowser($userAgent)
    {
        return 'Rockmelt';
    }
    
    /**
     * detects the browser version from the given user agent
     *
     * @param string $userAgent
     *
     * @return float
     */
    protected function detectVersion($userAgent)
    {
        $doMatch = preg_match('/Rockmelt\/([\d\.]+) /', $userAgent, $matches);
        
        if ($doMatch) {
            return $matches[1];
        }
        
        return 0;
    }
}