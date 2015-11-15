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

        $wpQ = $post->crtAttachBuilder()->crtQuery()->getResult();

        $this->assertEquals(1, $wpQ->found_posts);
        $this->assertContains($wpPost->ID, wp_list_pluck($wpQ->posts, 'ID'));
    }

    public function testQueeringByName(){
        /** @var \WP_Post $wpPost */
        $wpPost = $this->factory()->post->create_and_get();
        $this->factory()->post->create_many(10);

        $post = new Post();
        $post->setName($wpPost->post_name);

        $wpQ = $post->crtAttachBuilder()->crtQuery()->getResult();

        $this->assertEquals(1, $wpQ->found_posts);
        $this->assertContains($wpPost->ID, wp_list_pluck($wpQ->posts, 'ID'));
    }
    public function testQueeringByParent(){
        /** @var \WP_Post $wpPost1 */
        $wpPost1 = $this->factory()->post->create_and_get();
        /** @var \WP_Post $wpPost1 */
        $wpPost2 = $this->factory()->post->create_and_get();

        $numOfPostWithParentP1 = 5;
        $post1Children = $this->factory()->post->create_many($numOfPostWithParentP1, array('post_parent' => $wpPost1->ID));

        $numOfPostWithParentP2 = 6;
        $post2Children = $this->factory()->post->create_many($numOfPostWithParentP2, array('post_parent' => $wpPost2->ID));

        $post = new Post();
        $post->setPostParent($wpPost1->ID);

        $q1 = $post->crtAttachBuilder()->crtQuery();
        $wpQ = $q1->getResult();
        $q1->sort($post1Children);

        $this->assertEquals($numOfPostWithParentP1, $wpQ->found_posts);
        $this->assertArraySubset($post1Children, wp_list_pluck($wpQ->posts, 'ID'));

        $post->setPostParent($wpPost2->ID);

        $q2 = $post->crtAttachBuilder()->crtQuery();
        $wpQ = $q2->getResult();
        $q2->sort($post2Children);

        $this->assertEquals($numOfPostWithParentP2, $wpQ->found_posts);
        $this->assertArraySubset($post2Children, wp_list_pluck($wpQ->posts, 'ID'));
    }
}
