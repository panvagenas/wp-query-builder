<?php
/**
 * Project: wp-query-builder
 * File: AbsArrayObject.php
 * User: Panagiotis Vagenas <pan.vagenas@gmail.com>
 * Date: 10/11/2015
 * Time: 12:21 πμ
 * Since: TODO ${VERSION}
 * Copyright: 2015 Panagiotis Vagenas
 */

namespace Pan\QueryBuilder;


/**
 * Class AbsArrayObject
 *
 * @package Pan\QueryBuilder
 * @author  Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @since   TODO ${VERSION}
 */
abstract class AbsArrayObject extends \ArrayObject {
    /**
     * AbsArrayObject constructor.
     *
     * @param array  $input
     * @param int    $flags
     * @param string $iterator_class
     *
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function __construct( $input = array(), $flags = 3, $iterator_class = "ArrayIterator" ) {
        parent::__construct( $input, $flags, $iterator_class );
    }

    /**
     * {@inheritdoc}
     *
     * @param mixed $data
     *
     * @return array
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function exchangeArray( $data ) {
        foreach ( $this->getArrayCopy() as $index => $item ) {
            if ( isset( $data[ $index ] ) ) {
                $this->{$index} = $data[ $index ];
            }
        }

        return $this->getArrayCopy();
    }

    /**
     * @return array
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function getArrayCopy() {
        return get_object_vars( $this );
    }
}