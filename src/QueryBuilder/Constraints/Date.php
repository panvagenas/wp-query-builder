<?php
/**
 * Project: wp-query-builder
 * File: Date.php
 * User: Panagiotis Vagenas <pan.vagenas@gmail.com>
 * Date: 9/11/2015
 * Time: 7:43 μμ
 * Since: TODO ${VERSION}
 * Copyright: 2015 Panagiotis Vagenas
 */

namespace Pan\QueryBuilder\Constraints;


/**
 * Show posts associated with a certain time and date period
 *
 * @package Pan\QueryBuilder\Constraints
 * @author  Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @since   TODO ${VERSION}
 */
class Date extends AbsConstraint implements IfcRelationConstants, IfcCompareConstants {
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
     * @var string
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
     * See {@link IfcCompareConstants}
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
     * @since  TODO ${VERSION}
     */
    public function getYear() {
        return $this->year;
    }

    /**
     * @param int $year
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
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
     * @since  TODO ${VERSION}
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
     * @since  TODO ${VERSION}
     */
    public function getMonth() {
        return $this->month;
    }

    /**
     * @param int $month
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
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
     * @since  TODO ${VERSION}
     */
    public function getWeek() {
        return $this->week;
    }

    /**
     * @param int $week
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
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
     * @since  TODO ${VERSION}
     */
    public function getDay() {
        return $this->day;
    }

    /**
     * @param int $day
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
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
     * @since  TODO ${VERSION}
     */
    public function getHour() {
        return $this->hour;
    }

    /**
     * @param int $hour
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
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
     * @since  TODO ${VERSION}
     */
    public function getMinute() {
        return $this->minute;
    }

    /**
     * @param int $minute
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
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
     * @since  TODO ${VERSION}
     */
    public function getSecond() {
        return $this->second;
    }

    /**
     * @param int $second
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
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
     * @since  TODO ${VERSION}
     */
    public function getAfter() {
        return $this->after;
    }

    /**
     * @param array|string $after
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function setAfter( $after ) {

        if ( is_string( $after ) && strtotime( $after ) ) {
            $this->after = $after;
        } elseif ( is_array( $after ) ) {
            $tmp = array();

            if ( isset( $after['year'] ) && $this->validateIntBetween( 1000, 9999, $after['year'] ) ) {
                $tmp['year'] = $after['year'];
            }

            $tmp['month'] = isset( $after['month'] ) && $this->validateIntBetween( 1,
                12,
                $after['month'] ) ? $after['month'] : 12;
            $tmp['day']   = isset( $after['day'] ) && $this->validateIntBetween( 1,
                12,
                $after['day'] ) ? $after['day'] : 31;

            $this->after = $tmp;
        }

        return $this;
    }

    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function getBefore() {
        return $this->before;
    }

    /**
     * @param string $before
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function setBefore( $before ) {
        if ( is_string( $before ) && strtotime( $before ) ) {
            $this->before = $before;
        } elseif ( is_array( $before ) ) {
            $tmp = array();

            if ( isset( $before['year'] ) && $this->validateIntBetween( 1000, 9999, $before['year'] ) ) {
                $tmp['year'] = $before['year'];
            }

            $tmp['month'] = isset( $before['month'] ) && $this->validateIntBetween( 1,
                12,
                $before['month'] ) ? $before['month'] : 1;
            $tmp['day']   = isset( $before['day'] ) && $this->validateIntBetween( 1,
                12,
                $before['day'] ) ? $before['day'] : 1;

            $this->before = $tmp;
        }

        return $this;
    }

    /**
     * @return boolean
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function isInclusive() {
        return $this->inclusive;
    }

    /**
     * @param boolean $inclusive
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function setInclusive( $inclusive ) {
        $this->inclusive = (bool) $inclusive;

        return $this;
    }

    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function getCompare() {
        return $this->compare;
    }

    /**
     * @param string $compare
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
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
     * @since  TODO ${VERSION}
     */
    public function getColumn() {
        return $this->column;
    }

    /**
     * @param string $column
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function setColumn( $column ) {
        $this->column = (string) $column;

        return $this;
    }

    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function getRelation() {
        return $this->relation;
    }

    /**
     * @param string $relation
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
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
     * @since  TODO ${VERSION}
     */
    public function getArrayCopy() {
        return array( self::$_wrap => parent::getArrayCopy() );
    }
}