<?php
/**
 * Project: wp-query-builder
 * File: AbsMetaConstraint.php
 * User: Panagiotis Vagenas <pan.vagenas@gmail.com>
 * Date: 12/11/2015
 * Time: 11:38 μμ
 * Since: TODO ${VERSION}
 * Copyright: 2015 Panagiotis Vagenas
 */

namespace Pan\QueryBuilder\Constraints;


/**
 * Class AbsMetaConstraint
 *
 * @package Pan\QueryBuilder\Constraints
 * @author  Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @since   TODO ${VERSION}
 */
class AbsMetaConstraint extends AbsConstraint {
    /**
     * @var string
     */
    protected static $_wrap = '';

    /**
     * @return mixed
     * @throws \Exception
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function getArrayCopy() {
        if ( isset( $this->{static::$_wrap} ) && static::$_wrap ) {
            return $this->{static::$_wrap};
        }
        throw new \Exception( 'Invalid implementation of ' . get_class( $this ) . ' class' );
    }

}