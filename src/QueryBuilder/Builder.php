<?php
/**
 * Project: wp-query-builder
 * File: Builder.php
 * User: Panagiotis Vagenas <pan.vagenas@gmail.com>
 * Date: 9/11/2015
 * Time: 7:46 μμ
 * Since: TODO ${VERSION}
 * Copyright: 2015 Panagiotis Vagenas
 */

namespace Pan\QueryBuilder;


use Pan\QueryBuilder\Constraints\ConstraintAbs;

/**
 * Class Builder
 *
 * @package Pan\QueryBuilder
 * @author  Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @since   TODO ${VERSION}
 */
class Builder {
	/**
     * @var array
     */
    protected $constraints = array();

	/**
     * @param ConstraintAbs $constraint
     *
     * @return $this|Builder
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function addConstraint( ConstraintAbs $constraint ) {
        if ( $this->hasConstraint( $constraint->getName() ) ) {
            return $this->updateConstraint( $constraint );
        }
        $this->constraints[ $constraint->getName() ] = $constraint;

        return $this;
    }

	/**
     * @param $name
     *
     * @return bool
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function hasConstraint( $name ) {
        $name = (string) $name;

        return isset( $this->constraints[ $name ] );
    }

	/**
     * @param ConstraintAbs $newConstraint
     *
     * @return $this|Builder
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function updateConstraint( ConstraintAbs $newConstraint ) {
        if ( $oldConstraint = $this->getConstraint( $newConstraint->getName() ) ) {
            return $oldConstraint->exchangeArray( $newConstraint->getArrayCopy() );
        }

        return $this->addConstraint( $newConstraint );
    }

	/**
     * @param $name
     *
     * @return ConstraintAbs|null
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function getConstraint( $name ) {
        $name = (string) $name;

        return $this->hasConstraint( $name ) ? $this->constraints[ $name ] : null;
    }

	/**
     * @param $name
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function removeConstraint( $name ) {
        $name = (string) $name;
        unset( $this->constraints[ $name ] );

        return $this;
    }

	/**
     * @return array
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function getQueryArgsArray() {
        $args = array();

        foreach ( $this->constraints as $constraint ) {
            /* @var ConstraintAbs $constraint */
            $args = array_merge( $args, $constraint->getArrayCopy() );
        }

        return $args;
    }
}