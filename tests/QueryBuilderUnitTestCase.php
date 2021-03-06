<?php
/**
 * Project: wp-query-builder
 * File: QueryBuilderUnitTestCase.php
 * User: Panagiotis Vagenas <pan.vagenas@gmail.com>
 * Date: 10/11/2015
 * Time: 8:57 πμ
 * Since: 1.0.0
 * Copyright: 2015 Panagiotis Vagenas
 */

namespace Pan\QueryBuilder\Tests;


class QueryBuilderUnitTestCase extends \WP_UnitTestCase {
    /**
     * @return QueryBuilderUnitTestFactory
     * @static
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     */
    protected static function factory() {
        static $factory = null;
        if ( ! $factory ) {
            $factory = new QueryBuilderUnitTestFactory();
        }

        return $factory;
    }
}