<?php
/**
 * Project: wp-query-builder
 * File: CustomField.php
 * User: Panagiotis Vagenas <pan.vagenas@gmail.com>
 * Date: 9/11/2015
 * Time: 7:43 μμ
 * Since: TODO ${VERSION}
 * Copyright: 2015 Panagiotis Vagenas
 */

namespace Pan\QueryBuilder\Constraints;

/**
 * Show posts associated with a certain custom field.
 * (aka meta query)
 *
 * @package Pan\QueryBuilder\Constraints
 * @author  Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @since   TODO ${VERSION}
 */
class CustomField extends AbsMetaConstraint implements IfcCompareConstants, IfcRelationConstants, IfcTypeConstants {
    /**
     * @var array
     */
    protected static $__relation__ = array(
        self::RELATION_AND,
        self::RELATION_AND,
    );
    /**
     * @var array
     */
    protected static $__valueCompare__ = array(
        self::IN,
        self::NOT_IN,
        self::BETWEEN,
        self::NOT_BETWEEN,
    );
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
     * @var array
     */
    protected static $__type__ = array(
        self::NUMERIC,
        self::BINARY,
        self::CHAR,
        self::DATE,
        self::DATETIME,
        self::DECIMAL,
        self::SIGNED,
        self::TIME,
        self::UNSIGNED,
    );
    /**
     * @var string
     */
    protected static $_wrap = 'meta_query';
    /**
     * @var array
     */
    protected $meta_query = array();
    /**
     * @var string
     */
    protected $_relation = '';

    /**
     * @param string       $key
     * @param string|array $value
     * @param string       $compare
     * @param string       $type
     *
     * @return bool
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function add( $key, $value = '', $compare = '', $type = '' ) {
        $value = (array) $value;

        if ( ! $this->validateAddValues( $key, $value, $compare, $type ) ) {
            return false;
        }

        $add = array(
            'key' => $key
        );
        if ( ! empty( $value ) ) {
            $add['value'] = $value;
        }
        if ( ! empty( $compare ) ) {
            $add['compare'] = $compare;
        }
        if ( ! empty( $type ) ) {
            $add['type'] = $type;
        }

        $this->meta_query[] = $add;

        return true;
    }

    /**
     * @param string       $key
     * @param string|array $value
     * @param string       $compare
     * @param string       $type
     *
     * @return bool
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    protected function validateAddValues( $key, $value, $compare, $type ) {
        $value = (array) $value;
        if ( ! is_string( $key ) ) {
            trigger_error( 'Invalid key in ' . __METHOD__ );

            return false;
        }
        if ( ! is_array( $value ) || ( empty( $value ) && ! in_array( $compare, static::$__valueCompare__ ) ) ) {
            trigger_error( 'Invalid value in ' . __METHOD__ );

            return false;
        }
        if ( ! empty( $compare ) && ! $this->isValidCompare( $compare ) ) {
            trigger_error( 'Invalid compare in ' . __METHOD__ );

            return false;
        }
        if ( ! empty( $type ) && ! $this->isValidType( $type ) ) {
            trigger_error( 'Invalid type in ' . __METHOD__ );

            return false;
        }

        return true;
    }

    /**
     * @param $relation
     *
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function setRelation( $relation ) {
        if ( ! $this->isValidRelation( $relation ) ) {
            throw new \InvalidArgumentException( 'Wrong meta query relation definition' );
        }
        $this->_relation = $relation;
    }

    /**
     * @param array $data
     *
     * @return array
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function exchangeArray( $data ) {
        $this->meta_query = array();

        foreach ( $data as $index => $item ) {
            if ( $index === 'relation' ) {
                $this->setRelation( $item );
            }

            if ( is_array( $index ) && isset( $index['key'] ) ) {
                $key     = $item['key'];
                $value   = isset( $item['value'] ) ?: '';
                $compare = isset( $item['compare'] ) ?: '';
                $type    = isset( $item['type'] ) ?: '';

                if ( $this->validateAddValues( $key, $value, $compare, $type ) ) {
                    $this->add( $key, $value, $compare, $type );
                }
                unset($key, $value, $compare, $type);
            }
        }

        return $this->meta_query;
    }

    /**
     * @param $relation
     *
     * @return bool
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function isValidRelation( $relation ) {
        return in_array( $relation, static::$__relation__, true );
    }

    /**
     * @param $type
     *
     * @return bool
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function isValidType( $type ) {
        return in_array( $type, static::$__type__, true );
    }

    /**
     * @param $compare
     *
     * @return bool
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function isValidCompare( $compare ) {
        return in_array( $compare, static::$__compare__, true );
    }
}