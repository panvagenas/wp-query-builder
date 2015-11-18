<?php
/**
 * Project: wp-query-builder
 * File: QueryTest.php
 * User: Panagiotis Vagenas <pan.vagenas@gmail.com>
 * Date: 14/11/2015
 * Time: 8:21 πμ
 * Since: 1.0.0
 * Copyright: 2015 Panagiotis Vagenas
 */

namespace Pan\QueryBuilder\Tests;


use Pan\QueryBuilder\Builder;
use Pan\QueryBuilder\Constraints\Post;
use Pan\QueryBuilder\Query;

class QueryTest extends QueryBuilderUnitTestCase {
    public function testGettersSetters() {
        $builder = new Builder();
        $query = new Query($builder);

        $this->assertSame($builder, $query->getBuilder());

        $this->assertWPError(@$query->sort(array()));

        $wpQ = $query->getResult();

        $this->assertSame($wpQ, $query->getLastResult());

        $this->assertWPError(@$query->sort(array()));

        $wpPost = $this->factory()->post->create_and_get();

        $post = new Post();
        $post->setP($wpPost->ID);

        $builder->addConstraint($post);

        $wpQ = $query->getResult();

        $this->assertSame($wpQ, $query->getLastResult());
        $this->assertSame($wpQ, $query->sort(array()));
}
}