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


use Pan\QueryBuilder\Constraints\Abs\Constraint;

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
     * @var Query
     */
    protected $query;

    /**
     * @param Constraint $constraint
     *
     * @return $this|Builder
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function addConstraint( Constraint $constraint ) {
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
        $name = $constraint instanceof Constraint ? $constraint->getName() : (string) $constraint;

        return isset( $this->constraints[ $name ] );
    }

    /**
     * @param Constraint $newConstraint
     *
     * @return $this|Builder
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function updateConstraint( Constraint $newConstraint ) {
        if ( $oldConstraint = $this->getConstraint( $newConstraint->getName() ) ) {
            return $oldConstraint->exchangeArray( $newConstraint->getArrayCopy() );
        }

        return $this->addConstraint( $newConstraint );
    }

    /**
     * @param $constraint
     *
     * @return Constraint|null
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function getConstraint( $constraint ) {
        $name = $constraint instanceof Constraint ? $constraint->getName() : (string) $constraint;

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
        $name = $constraint instanceof Constraint ? $constraint->getName() : (string) $constraint;
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
            /* @var Constraint $constraint */
            $args = array_merge( $args, $constraint->getArrayCopy() );
        }

        return $args;
    }

    /**
     * @return Query
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function crtAttachQuery() {
        if(!$this->query){
            $this->query = new Query($this);
        }

        return $this->query;
    }

    /**
     * @return Query
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function getQuery() {
        return $this->query;
    }
}