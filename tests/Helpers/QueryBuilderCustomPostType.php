<?php
/**
 * Project: wp-query-builder
 * File: QueryBuilderCustomPostType.php
 * User: Panagiotis Vagenas <pan.vagenas@gmail.com>
 * Date: 10/11/2015
 * Time: 8:48 πμ
 * Since: TODO ${VERSION}
 * Copyright: 2015 Panagiotis Vagenas
 */

namespace Pan\QueryBuilder\Tests\Helpers;


class QueryBuilderCustomPostType extends \WP_UnitTest_Factory_For_Post{
	public function __construct( $factory ) {
		parent::__construct( $factory );
		$this->default_generation_definitions['post_type'] = 'custom_post_type';
	}

}