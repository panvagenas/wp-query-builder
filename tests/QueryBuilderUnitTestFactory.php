<?php
/**
 * Project: wp-query-builder
 * File: QueryBuilderUnitTestFactory.php
 * User: Panagiotis Vagenas <pan.vagenas@gmail.com>
 * Date: 10/11/2015
 * Time: 9:02 πμ
 * Since: TODO ${VERSION}
 * Copyright: 2015 Panagiotis Vagenas
 */

namespace Pan\QueryBuilder\Tests;


use Pan\QueryBuilder\Tests\Helpers\QueryBuilderCustomPostType;

class QueryBuilderUnitTestFactory extends \WP_UnitTest_Factory {
    /**
     * @var QueryBuilderCustomPostType
     */
    public $custom_post;

    public function __construct() {
        parent::__construct();
        $this->custom_post = new QueryBuilderCustomPostType( $this );
    }

}