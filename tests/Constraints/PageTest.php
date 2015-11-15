<?php
/**
 * Project: wp-query-builder
 * File: PageTest.php
 * User: Panagiotis Vagenas <pan.vagenas@gmail.com>
 * Date: 15/11/2015
 * Time: 7:09 μμ
 * Since: TODO ${VERSION}
 * Copyright: 2015 Panagiotis Vagenas
 */

namespace Pan\QueryBuilder\Tests\Constraints;


use Pan\QueryBuilder\Constraints\Page;
use Pan\QueryBuilder\Tests\QueryBuilderUnitTestCase;

class PageTest extends QueryBuilderUnitTestCase{
    public function testQueeringByPageId(){
        /** @var \WP_Post $wpPage */
        $wpPage = $this->factory()->post->create_and_get(array('post_type' => 'page'));
        $this->factory()->post->create_many(10);

        $post = new Page();
        $post->setPageId($wpPage->ID);

        $wpQ = $post->crtAttachBuilder()->crtAttachQuery()->getResult();

        $this->assertEquals(1, $wpQ->found_posts);
        $this->assertContains($wpPage->ID, wp_list_pluck($wpQ->posts, 'ID'));
    }
    public function testQueeringByName(){
        /** @var \WP_Post $wpPage */
        $wpPage = $this->factory()->post->create_and_get(array('post_type' => 'page'));
        $this->factory()->post->create_many(10);

        $post = new Page();
        $post->setPagename($wpPage->post_name);

        $wpQ = $post->crtAttachBuilder()->crtAttachQuery()->getResult();

        $this->assertEquals(1, $wpQ->found_posts);
        $this->assertContains($wpPage->ID, wp_list_pluck($wpQ->posts, 'ID'));
    }
}