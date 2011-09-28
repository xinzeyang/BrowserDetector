<?php
/**
 * Klasse zum Gruppieren der Statistik nach Stunden
 *
 * PHP version 5
 *
 * @category  CreditCalc
 * @package   Statistics
 * @author    Thomas Mueller <t_mueller_stolzenhain@yahoo.de>
 * @copyright 2007-2010 Unister GmbH
 * @version   SVN: $Id$
 */

/**
 * Klasse zum Gruppieren der Statistik nach Stunden
 *
 * @category  CreditCalc
 * @package   Statistics
 * @author    Thomas Mueller <t_mueller_stolzenhain@yahoo.de>
 * @copyright 2007-2010 Unister GmbH
 * @abstract
 */
class KreditAdmin_Class_Statistics_Groupset_Hour
    implements KreditAdmin_Class_Statistics_GroupsetInterface
{
    /**
     * Get DB Expression for the Group Statement
     *
     * @return \Zend\Db\Expr
     */
    public function getGroupExpression($tableAlias = 'se')
    {
        if (!is_string($tableAlias)
            || !in_array($tableAlias, array('la', 'se'))
        ) {
            $tableAlias = 'se';
        }

        if ('se' == $tableAlias) {
            $field = '`' . $tableAlias . '`.`datum`';
        } else {
            $field = '`' . $tableAlias . '`.`zeit`';
        }

        return new \Zend\Db\Expr(
            'DATE_FORMAT(' . $field . ", '%Y%m%d%H')"
        );
    }

    /**
     * Get Db Expression for the Select Statement
     *
     * @return \Zend\Db\Expr
     */
    public function getTimespanExpression($tableAlias = 'se')
    {
        if (!is_string($tableAlias)
            || !in_array($tableAlias, array('la', 'se'))
        ) {
            $tableAlias = 'se';
        }

        if ('se' == $tableAlias) {
            $field = '`' . $tableAlias . '`.`datum`';
        } else {
            $field = '`' . $tableAlias . '`.`zeit`';
        }

        return new \Zend\Db\Expr(
            'DATE_FORMAT(' . $field . ", '%Y-%m-%d %H') as `timespan`"
        );
    }

    /**
     * Compare if dateStart is Earlier as dateEnd
     *
     * @param \Zend\Date\Date $dateStart the start date
     * @param \Zend\Date\Date $dateEnd   the end date
     *
     * @return Boolean
     */
    public function compareFilterDates(\Zend\Date\Date $dateStart, \Zend\Date\Date $dateEnd)
    {
        return ($dateStart->isEarlier($dateEnd, \Zend\Date\Date::TIMESTAMP) ||
                $dateStart->equals($dateEnd, \Zend\Date\Date::TIMESTAMP));
    }

    /**
     * Sanitize Filter Dates user Input
     *
     * @param \Zend\Date\Date &$dateStart the start date
     * @param \Zend\Date\Date &$dateEnd   the end date
     *
     * @return void
     */
    public function sanitizeFilterDates(
        \Zend\Date\Date &$dateStart, \Zend\Date\Date &$dateEnd)
    {
        $dateStart->setHour(0);
        $dateEnd->setHour(23);
    }

    /**
     * Add a Step to a Date
     *
     * @param \Zend\Date\Date $date the date to add to
     *
     * @return \Zend\Date\Date
     */
    public function addDateStep(\Zend\Date\Date $date)
    {
        return $date->addHour(1);
    }

    /**
     * Get Display Format for Date
     *
     * @return String
     */
    public function getDateCompareFormat()
    {
        return 'yyyy-MM-dd HH';
    }

    /**
     * converts the date into a timestamp
     *
     * @param string $date the date (as string) to convert
     *
     * @return integer the timestamp
     */
    public function toTimestamp($date)
    {
        return (strtotime($date . ':00:00') * 1000);
    }

    /**
     * converts the given date into another date (depending on groupset)
     *
     * @param string $date the date (ISO format) to convert
     *
     * @return string
     */
    public function toDate($date)
    {
        return $date . ':00:00';
    }

    /**
     * converts the given date into another date
     *
     * the output format is the same as the input format and depends on
     * {@link getDateCompareFormat()}
     *
     * this function is an workaround for the week groupset for the case that
     * the database returns a week number "00"
     *
     * @param string $date the date (ISO format) to convert
     *
     * @return string
     */
    public function toCompare($date)
    {
        return $date;
    }

    /**
     * get the end date in the ISO format
     *
     * @param \Zend\Date\Date $date the date to convert
     *
     * @return string
     */
    public function getDateEndIso(\Zend\Date\Date $date)
    {
        $dateIntern = $this->addDateStep($date);
        return $dateIntern->toString('yyyy-MM-dd 00:00:00');
    }
}