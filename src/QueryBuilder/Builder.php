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


use Pan\QueryBuilder\Constraints\AbsConstraint;

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
     * @param AbsConstraint $constraint
     *
     * @return $this|Builder
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function addConstraint( AbsConstraint $constraint ) {
        if ( $this->hasConstraint( $constraint->getName() ) ) {
            return $this->updateConstraint( $constraint );
        }
        $this->constraints[ $constraint->getName() ] = $constraint;

        return $this;
    }

    /**
     * @param $constraint
     *
     * @return bool
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function hasConstraint( $constraint ) {
        $name = $constraint instanceof AbsConstraint ? $constraint->getName() : (string) $constraint;

        return isset( $this->constraints[ $name ] );
    }

    /**
     * @param AbsConstraint $newConstraint
     *
     * @return $this|Builder
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function updateConstraint( AbsConstraint $newConstraint ) {
        if ( $oldConstraint = $this->getConstraint( $newConstraint->getName() ) ) {
            return $oldConstraint->exchangeArray( $newConstraint->getArrayCopy() );
        }

        return $this->addConstraint( $newConstraint );
    }

    /**
     * @param $constraint
     *
     * @return AbsConstraint|null
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function getConstraint( $constraint ) {
        $name = $constraint instanceof AbsConstraint ? $constraint->getName() : (string) $constraint;

        return $this->hasConstraint( $name ) ? $this->constraints[ $name ] : null;
    }

    /**
     * @param $constraint
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function removeConstraint( $constraint ) {
        $name = $constraint instanceof AbsConstraint ? $constraint->getName() : (string) $constraint;
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
            /* @var AbsConstraint $constraint */
            $args = array_merge( $args, $constraint->getArrayCopy() );
        }

        return $args;
    }
}