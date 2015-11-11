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

class Builder {
    protected $constraints = array();

    public function addConstraint( ConstraintAbs $constraint ) {
        if ( $this->hasConstraint( $constraint->getName() ) ) {
            return $this->updateConstraint( $constraint );
        }
        $this->constraints[ $constraint->getName() ] = $constraint;

        return $this;
    }

    public function hasConstraint( $name ) {
        $name = (string) $name;

        return isset( $this->constraints[ $name ] );
    }

    public function updateConstraint( ConstraintAbs $newConstraint ) {
        if ( $oldConstraint = $this->getConstraint( $newConstraint->getName() ) ) {
            return $oldConstraint->exchangeArray( $newConstraint->getArrayCopy() );
        }

        return $this->addConstraint( $newConstraint );
    }

    public function getConstraint( $name ) {
        $name = (string) $name;

        return $this->hasConstraint( $name ) ? $this->constraints[ $name ] : null;
    }

    public function removeConstraint( $name ) {
        $name = (string) $name;
        unset( $this->constraints[ $name ] );

        return $this;
    }

    public function getQueryArgsArray() {
        $args = array();

        foreach ( $this->constraints as $constraint ) {
            /* @var ConstraintAbs $constraint */
            $args = array_merge( $args, $constraint->getArrayCopy() );
        }

        return $args;
    }
}