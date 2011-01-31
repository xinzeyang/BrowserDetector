<?php
declare(ENCODING = 'iso-8859-1');
namespace AppCore\Log\Writer;

/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    \Zend\Log\Logger
 * @subpackage Writer
 * @copyright  Copyright (c) 2005-2010 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: Db.php 30 2011-01-06 21:58:02Z tmu $
 */

/**
 * @category   Zend
 * @package    \Zend\Log\Logger
 * @subpackage Writer
 * @copyright  Copyright (c) 2005-2010 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: Db.php 30 2011-01-06 21:58:02Z tmu $
 */
class Db extends \Zend\Log\Writer\AbstractWriter
{
    /**
     * Create a new instance of \Zend\Log\Logger_Writer_Db
     *
     * @param  array|Zend_Config $config
     * @return \Zend\Log\Logger_Writer_Db
     * @throws \Zend\Log\Exception
     */
    static public function factory($config = array())
    {
        return new self();
    }

    /**
     * Formatting is not possible on this writer
     */
    public function setFormatter(\Zend\Log\Formatter $formatter)
    {
        throw new \Zend\Log\Exception(
            get_class($this) . ' does not support formatting'
        );
    }

    /**
     * Write a message to the log.
     *
     * @param  array  $event  event data
     * @return void
     */
    protected function _write($event)
    {//var_dump($event);exit;
        if (!isset($event['message'])
            || $event['message'] == ''
        ) {
            return;
        }

        if (is_object($event['message'])
            && (get_class($event['message']) == 'Exception'
            || is_subclass_of($event['message'], 'Exception'))
        ) {
            $exception = $event['message'];
            $priority  = 'Exception';
        } else {
            $exception = new \Zend\Exception($event['message']);
            $priority  = $event['priorityName'];
        }
        
        $request = new \Zend\Controller\Request\Http();

        $requestParams = array_merge(
            $request->getParams(),
            array('uri' => $request->getRequestUri())
        );

        /**/
        $model = new \Application\Model\Entities\Exceptions();
        $model->setMessage($exception->getMessage());
        $model->setTrace($exception->getTraceAsString());
        $model->setEnviroment(APPLICATION_ENV);
        //$model->setRequest(serialize($requestParams));
        $model->setLevel($level);
        /*
        $model->insertException(
            $exception,
            new \Zend\Controller\Request\Http(),
            $priority
        );
        */
    }
}
