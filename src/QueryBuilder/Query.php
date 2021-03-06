<?php
/**
 * Project: wp-query-builder
 * File: Query.php
 * User: Panagiotis Vagenas <pan.vagenas@gmail.com>
 * Date: 9/11/2015
 * Time: 12:41 πμ
 * Since: 1.0.0
 * Copyright: 2015 Panagiotis Vagenas
 */

namespace Pan\QueryBuilder;


class Query {
    /**
     * @var \WP_Query
     */
    protected $lastResult;
    /**
     * @var Builder
     */
    protected $builder;

    public function __construct( Builder $builder ) {
        $this->builder = $builder;
    }

    /**
     * @return \WP_Query
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     */
    public function getResult() {
        $this->lastResult = new \WP_Query( $this->builder->getQueryArgsArray() );

        return $this->lastResult;
    }

    /**
     * @param array $postIds
     *
     * @return \WP_Error|\WP_Query
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     */
    public function sort( array $postIds ) {
        if ( ! $this->lastResult || ! $this->lastResult->posts ) {
            trigger_error( 'No lastResult found in ' . __CLASS__ );

            return new \WP_Error( 'warning', 'No lastResult found in ' . __CLASS__ );
        }

        usort( $this->lastResult->posts,
            function ( $a, $b ) use ( $postIds ) {
                $aPos = array_search( $a->ID, $postIds );
                $bPos = array_search( $b->ID, $postIds );

                return ( $aPos < $bPos ) ? - 1 : 1;
            } );

        return $this->lastResult;
    }

    /**
     * @return array
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     */
    public function getLastResultPostIds() {
        $ids = $this->pluckLastResult( 'ID' );
        if ( is_wp_error( $ids ) ) {
            return array();
        }

        return $ids;
    }

    /**
     * @param $field
     *
     * @return array|\WP_Error
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     */
    public function pluckLastResult( $field ) {
        if ( ! $this->lastResult ) {
            trigger_error( 'No lastResult found in ' . __CLASS__ );

            return new \WP_Error( 'warning', 'No lastResult found in ' . __CLASS__ );
        }

        return wp_list_pluck( $this->lastResult->posts, $field );
    }

    /**
     * @return \WP_Query
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function getLastResult() {
        return $this->lastResult;
    }

    /**
     * @return Builder
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function getBuilder() {
        return $this->builder;
    }

    /**
     * @param Builder $builder
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     */
    public function setBuilder( Builder $builder ) {
        $this->builder = $builder;

        return $this;
    }
}