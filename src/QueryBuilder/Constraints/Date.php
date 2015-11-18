<?php
/**
 * Project: wp-query-builder
 * File: Date.php
 * User: Panagiotis Vagenas <pan.vagenas@gmail.com>
 * Date: 9/11/2015
 * Time: 7:43 μμ
 * Since: 1.0.0
 * Copyright: 2015 Panagiotis Vagenas
 */

namespace Pan\QueryBuilder\Constraints;

use Pan\QueryBuilder\Constraints\Abs\Constraint;
use Pan\QueryBuilder\Constraints\Ifc\CompareConstants;
use Pan\QueryBuilder\Constraints\Ifc\RelationConstants;

/**
 * Show posts associated with a certain time and date period
 *
 * @package Pan\QueryBuilder\Constraints
 * @author  Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @since   1.0.0
 */
class Date extends Constraint implements RelationConstants, CompareConstants {
    protected static $_wrap = 'date_query';
    /**
     * @var array
     */
    protected static $__compare__ = array(
        self::EQUAL,
        self::NOT_EQUAL,
        self::GREATER_THAN,
        self::GREATER_THAN_OR_EQUAL,
        self::LESSER_THAN,
        self::LESSER_THAN_OR_EQUAL,
        self::LIKE,
        self::NOT_LIKE,
        self::IN,
        self::NOT_IN,
        self::BETWEEN,
        self::NOT_BETWEEN,
        self::EXISTS,
        self::NOT_EXISTS,
    );
    /**
     * 4 digit year (e.g. 2011)
     *
     * @var int
     */
    protected $year = 0;
    /**
     * Month number (from 1 to 12)
     *
     * @var int
     */
    protected $month = 0;
    /**
     * Week of the year (from 0 to 53)
     *
     * @var int
     */
    protected $week = - 1;
    /**
     * Day of the month (from 1 to 31)
     *
     * @var int
     */
    protected $day = 0;
    /**
     * Hour (from 0 to 23)
     *
     * @var int
     */
    protected $hour = - 1;
    /**
     * Minute (from 0 to 59)
     *
     * @var int
     */
    protected $minute = - 1;
    /**
     * Second (0 to 59)
     *
     * @var int
     */
    protected $second = - 1;
    /**
     * Date to retrieve posts after. Accepts {@link strtotime()}-compatible string, or array as follows:
     *
     * * year (string) Accepts any four-digit year. Default is empty
     * * month (string) The month of the year. Accepts numbers 1-12. Default: 12
     * * day (string) The day of the month. Accepts numbers 1-31. Default: last day of month
     *
     * @var string|array
     */
    protected $after = '';
    /**
     * Date to retrieve posts before. Accepts {@link strtotime()}-compatible string, or array as follows:
     *
     * * year (string) Accepts any four-digit year. Default is empty
     * * month (string) The month of the year. Accepts numbers 1-12. Default: 1
     * * day (string) The day of the month. Accepts numbers 1-31. Default: 1
     *
     * @var string|array
     */
    protected $before = '';
    /**
     * For after/before, whether exact value should be matched or not.
     * Default is true.
     *
     * @var bool
     */
    protected $inclusive = true;
    /**
     * See {@link CompareConstants}
     *
     * @var string
     */
    protected $compare = '';
    /**
     * Column to query against. Default: `post_date`.
     *
     * @var string
     */
    protected $column = '';
    /**
     * OR or AND, how the sub-arrays should be compared. Default: AND
     *
     * @var string
     */
    protected $relation = self::RELATION_AND;

    /**
     * @return int
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function getYear() {
        return $this->year;
    }

    /**
     * @param int $year 4 digit year (e.g. 2011)
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     */
    public function setYear( $year ) {
        $year = (string) $year;

        if ( $this->validateIntBetween( 1000, 9999, $year ) ) {
            $this->year = (int) $year;
        }

        return $this;
    }

    /**
     * @param int|float $start
     * @param int|float $end
     * @param int|float $subject
     * @param bool      $inclusive
     *
     * @return bool
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     */
    protected function validateIntBetween( $start, $end, $subject, $inclusive = true ) {
        if ( is_numeric( $subject ) ) {
            if ( $inclusive ) {
                return $subject >= $start && $subject <= $end;
            }

            return $subject > $start && $subject < $end;
        }

        return false;
    }

    /**
     * @return int
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     */
    public function getMonth() {
        return $this->month;
    }

    /**
     * @param int $month Month number (from 1 to 12)
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     */
    public function setMonth( $month ) {
        $month = (int) $month;

        if ( $this->validateIntBetween( 1, 12, $month ) ) {
            $this->month = $month;
        }

        return $this;
    }

    /**
     * @return int
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function getWeek() {
        return $this->week;
    }

    /**
     * @param int $week Week of the year (from 0 to 53)
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     */
    public function setWeek( $week ) {
        $week = (int) $week;

        if ( $this->validateIntBetween( 0, 53, $week ) ) {
            $this->week = $week;
        }

        return $this;
    }

    /**
     * @return int
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function getDay() {
        return $this->day;
    }

    /**
     * @param int $day Day of the month (from 1 to 31)
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     */
    public function setDay( $day ) {
        $day = (int) $day;

        if ( $this->validateIntBetween( 1, 31, $day ) ) {
            $this->day = $day;
        }

        return $this;
    }

    /**
     * @return int
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function getHour() {
        return $this->hour;
    }

    /**
     * @param int $hour Hour (from 0 to 23)
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     */
    public function setHour( $hour ) {
        $hour = (int) $hour;

        if ( $this->validateIntBetween( 0, 23, $hour ) ) {
            $this->hour = $hour;
        }

        return $this;
    }

    /**
     * @return int
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     * @codeCoverageIgnore
     * @codeCoverageIgnore
     */
    public function getMinute() {
        return $this->minute;
    }

    /**
     * @param int $minute Minute (from 0 to 59)
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     */
    public function setMinute( $minute ) {
        $minute = (int) $minute;

        if ( $this->validateIntBetween( 0, 59, $minute ) ) {
            $this->minute = $minute;
        }

        return $this;
    }

    /**
     * @return int
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function getSecond() {
        return $this->second;
    }

    /**
     * @param int $second Second (0 to 59)
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     */
    public function setSecond( $second ) {
        $second = (int) $second;

        if ( $this->validateIntBetween( 0, 59, $second ) ) {
            $this->second = $second;
        }

        return $this;
    }

    /**
     * @return array|string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function getAfter() {
        return $this->after;
    }

    /**
     * @param array|string $after Date to retrieve posts after. Accepts {@link strtotime()}-compatible string, or array
     *                            as follows:
     *  <ul>
     *      <li>year (string) Accepts any four-digit year. Default is empty</li>
     *      <li>month (string) The month of the year. Accepts numbers 1-12. Default: 12</li>
     *      <li>day (string) The day of the month. Accepts numbers 1-31. Default: last day of month</li>
     *  </ul>
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     */
    public function setAfter( $after ) {

        if ( ( is_string( $after ) || is_numeric( $after ) ) && strtotime( $after ) ) {
            $this->after = $after;
        } elseif ( is_array( $after ) ) {
            $tmp = array();

            if ( isset( $after['year'] ) && $this->validateIntBetween( 1000, 9999, $after['year'] ) ) {
                $tmp['year'] = $after['year'];
            }

            $tmp['month'] = isset( $after['month'] ) && $this->validateIntBetween( 1, 12, $after['month'] )
                ? $after['month'] : 12;

            if ( isset( $after['day'] ) && isset( $tmp['month'] ) ) {
                $year  = isset( $tmp['year'] ) ? $tmp['year'] : date( 'Y' );
                $month = $tmp['month'];

                $timeStamp = strtotime( "$year-$month" );

                if ( $timeStamp && $this->validateIntBetween( 1, date( 't', $timeStamp ), $after['day'] ) ) {
                    $tmp['day'] = $after['day'];
                }
            }

            if ( ! $tmp ) {
                return $this;
            }

            $this->after = $tmp;
        }

        return $this;
    }

    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function getBefore() {
        return $this->before;
    }

    /**
     * @param string $before Date to retrieve posts before. Accepts {@link strtotime()}-compatible string, or array as
     *                       follows:
     *  <ul>
     *      <li>year (string) Accepts any four-digit year. Default is empty</li>
     *      <li>month (string) The month of the year. Accepts numbers 1-12. Default: 1</li>
     *      <li>day (string) The day of the month. Accepts numbers 1-31. Default: 1</li>
     *  </ul>
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     */
    public function setBefore( $before ) {
        if ( is_string( $before ) && strtotime( $before ) ) {
            $this->before = $before;
        } elseif ( is_array( $before ) ) {
            $tmp = array();

            $tmp['year'] = isset( $before['year'] )
                           && $this->validateIntBetween( 1000, 9999, $before['year'] )
                ? $before['year'] : date( 'Y' );

            $tmp['month'] = isset( $before['month'] )
                            && $this->validateIntBetween( 1, 12, $before['month'] )
                ? $before['month'] : 1;

            $timeStamp = strtotime( "{$tmp['year']}-{$tmp['month']}" );

            $tmp['day'] = isset( $before['day'] )
                          && $this->validateIntBetween( 1, date( 't', $timeStamp ), $before['day'] )
                ? $before['day'] : 1;

            $this->before = $tmp;
        }

        return $this;
    }

    /**
     * @return boolean
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function isInclusive() {
        return $this->inclusive;
    }

    /**
     * @param boolean $inclusive For after/before, whether exact value should be matched or not. Default is true.
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     */
    public function setInclusive( $inclusive ) {
        $this->inclusive = (bool) $inclusive;

        return $this;
    }

    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function getCompare() {
        return $this->compare;
    }

    /**
     * @param string $compare Use {@link CompareConstants} constants
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     */
    public function setCompare( $compare ) {

        if ( in_array( $compare, static::$__compare__, true ) ) {
            $this->compare = $compare;
        }

        return $this;
    }

    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function getColumn() {
        return $this->column;
    }

    /**
     * @param string $column Column to query against. Default: `post_date`
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     */
    public function setColumn( $column ) {
        $this->column = (string) $column;

        return $this;
    }

    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function getRelation() {
        return $this->relation;
    }

    /**
     * @param string $relation OR or AND, how the sub-arrays should be compared. Default: AND
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     */
    public function setRelation( $relation ) {
        if ( in_array( $relation, static::$__relation__, true ) ) {
            $this->relation = $relation;
        }

        return $this;
    }

    /**
     * @return array
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     */
    public function getArrayCopy() {
        return array( self::$_wrap => parent::getArrayCopy() );
    }
}