<?php
/**
 * Project: wp-query-builder
 * File: MetaConstraint.php
 * User: Panagiotis Vagenas <pan.vagenas@gmail.com>
 * Date: 12/11/2015
 * Time: 11:38 μμ
 * Since: TODO ${VERSION}
 * Copyright: 2015 Panagiotis Vagenas
 */

namespace Pan\QueryBuilder\Constraints\Abs;

/**
 * Class MetaConstraint
 *
 * @package Pan\QueryBuilder\Constraints
 * @author  Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @since   TODO ${VERSION}
 */
class MetaConstraint extends Constraint {
    /**
     * @var string
     */
    protected static $_wrap = '';

    /**
     * @return array
     * @throws \Exception
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function getArrayCopy() {
        if ( isset( $this->{static::$_wrap} ) && static::$_wrap ) {
            return $this->{static::$_wrap};
        }
        throw new \Exception( 'Invalid implementation of ' . get_class( $this ) . ' class' ); // @codeCoverageIgnore
    }
}