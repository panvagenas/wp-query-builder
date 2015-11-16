<?php
/**
 * Constraint.php description
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-11
 * @version   $Id$
 * @package   Pan\QueryBuilder\Constraints
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */


namespace Pan\QueryBuilder\Constraints\Abs;

use Pan\QueryBuilder\AbsArrayObject;
use Pan\QueryBuilder\Builder;

/**
 * Class Constraint
 *
 * @package Pan\QueryBuilder\Constraints
 * @author  Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @since   TODO ${VERSION}
 */
abstract class Constraint extends AbsArrayObject {
    /**
     * @var array
     */
    protected $_defaults = array();
    /**
     * @var Builder
     */
    protected $_builder;

    /**
     * Constraint constructor.
     *
     * @param array  $input
     * @param int    $flags
     * @param string $iterator_class
     *
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function __construct( array $input = array(), $flags = 3, $iterator_class = "ArrayIterator" ) {
        parent::__construct( $input, $flags, $iterator_class );
        $this->setDefaults();
    }

    /**
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    protected function setDefaults() {
        if ( ! empty( $this->_defaults ) ) {
            return;
        }

        foreach ( get_object_vars( $this ) as $propName => $propValue ) {
            if ( strpos( $propName, '_' ) === 0 ) {
                continue;
            }
            $this->_defaults[ $propName ] = $propValue;
        }
    }

    /**
     * @return array
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function getArrayCopy() {
        $out = array();

        foreach ( $this->_defaults as $propName => $defValue ) {
            if ( isset( $this->{$propName} ) && $this->{$propName} !== $defValue ) {
                $out[ $propName ] = $this->{$propName};
            }
        }

        return $out;
    }

    /**
     * @param $propName
     *
     * @return \WP_Error|mixed
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function getDefault( $propName ) {
        if ( isset( $this->_defaults[ $propName ] ) ) {
            return $this->_defaults[ $propName ];
        }

        return new \WP_Error(
            'error',
            'Property not found',
            array( 'class' => $this->getName(), 'property' => $propName )
        );
    }

    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function getName() {
        return get_class( $this );
    }

    /**
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function reset() {
        foreach ( $this->_defaults as $index => $default ) {
            $this->{$index} = $default;
        }
    }

    /**
     * @return Builder
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function crtAttachBuilder() {
        if ( ! $this->_builder ) {
            $this->_builder = new Builder();

        }

        if ( ! $this->_builder->hasConstraint( $this ) ) {
            $this->_builder->addConstraint( $this );
        }

        return $this->_builder;
    }

    /**
     * @return Builder
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function getBuilder() {
        return $this->_builder;
    }
}