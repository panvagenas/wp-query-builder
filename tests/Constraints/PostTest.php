<?php
/**
 * Project: wp-query-builder
 * File: PostTest.php
 * User: Panagiotis Vagenas <pan.vagenas@gmail.com>
 * Date: 14/11/2015
 * Time: 9:42 μμ
 * Since: TODO ${VERSION}
 * Copyright: 2015 Panagiotis Vagenas
 */

namespace Pan\QueryBuilder\Tests\Constraints;


use Pan\QueryBuilder\Constraints\Post;
use Pan\QueryBuilder\Tests\QueryBuilderUnitTestCase;

class PostTest extends QueryBuilderUnitTestCase {
    public function testQueeringByP(){
        /** @var \WP_Post $wpPost */
        $wpPost = $this->factory()->post->create_and_get();
        $this->factory()->post->create_many(10);

        $post = new Post();
        $post->setP($wpPost->ID);

        $wpQ = $post->crtAndAddBuilder()->crtQuery()->getResult();

        $this->assertEquals(1, $wpQ->found_posts);
        $this->assertContains($wpPost->ID, wp_list_pluck($wpQ->posts, 'ID'));
    }

    public function testQueeringByName(){
        /** @var \WP_Post $wpPost */
        $wpPost = $this->factory()->post->create_and_get();
        $this->factory()->post->create_many(10);

        $post = new Post();
        $post->setName($wpPost->post_name);

        $wpQ = $post->crtAndAddBuilder()->crtQuery()->getResult();

        $this->assertEquals(1, $wpQ->found_posts);
        $this->assertContains($wpPost->ID, wp_list_pluck($wpQ->posts, 'ID'));
    }
}
