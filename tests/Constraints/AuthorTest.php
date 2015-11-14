<?php
/**
 * Project: wp-query-builder
 * File: AuthorTest.php
 * User: Panagiotis Vagenas <pan.vagenas@gmail.com>
 * Date: 12/11/2015
 * Time: 11:59 μμ
 * Since: TODO ${VERSION}
 * Copyright: 2015 Panagiotis Vagenas
 */

namespace Pan\QueryBuilder\Tests\Constraints;

use Pan\QueryBuilder\Builder;
use Pan\QueryBuilder\Constraints\Author;
use Pan\QueryBuilder\Query;
use Pan\QueryBuilder\Tests\QueryBuilderUnitTestCase;

class AuthorTest extends QueryBuilderUnitTestCase {
    public function testAddingValues() {
        $authorID    = mt_rand( 0, PHP_INT_MAX );
        $authorName  = rand_str();
        $authorIn    = array( 1, 2, 3 );
        $authorNotIn = array( 4 );

        $builder = new Builder();

        $authorConstraint = new Author();
        $authorConstraint->setAuthor( $authorID );

        $this->assertEquals( $authorID, $authorConstraint->getAuthor() );

        $builder->addConstraint( $authorConstraint );

        $args = $builder->getQueryArgsArray();

        $this->assertTrue( is_array( $args ) );
        $this->assertArrayHasKey( 'author', $args );
        $this->assertArraySubset( array( 'author' => $authorID ), $args );

        $authorConstraint->setAuthorName( $authorName );

        $this->assertEquals( $authorName, $authorConstraint->getAuthorName() );

        $this->assertArraySubset(
            array( 'author' => $authorID, 'author_name' => $authorName ),
            $builder->getQueryArgsArray()
        );


        $authorConstraint->setAuthorIn( $authorIn );

        $this->assertEquals( $authorIn, $authorConstraint->getAuthorIn() );

        $this->assertArrayHasKey( 'author__in', $builder->getQueryArgsArray() );
        $this->assertCount( 3, $builder->getQueryArgsArray() );

        $authorConstraint->setAuthorNotIn( $authorNotIn );

        $this->assertEquals( $authorNotIn, $authorConstraint->getAuthorNotIn() );

        $this->assertArrayHasKey( 'author__not_in', $builder->getQueryArgsArray() );
        $this->assertCount( 4, $builder->getQueryArgsArray() );

        $authorConstraint->setAuthorNotIn( $authorConstraint->getDefault( 'author__not_in' ) );

        $this->assertArrayNotHasKey( 'author__not_in', $builder->getQueryArgsArray() );
        $this->assertCount( 3, $builder->getQueryArgsArray() );

        $authorConstraint->reset();

        $this->assertCount( 0, $builder->getQueryArgsArray() );
    }

    public function testQueeringByAuthor() {
        /** @var \WP_User $user1 */
        $user1 = $this->factory()->user->create_and_get();
        /** @var \WP_User $user2 */
        $user2 = $this->factory()->user->create_and_get();

        $user1Posts = $this->factory()->post->create_many( 2, array( 'post_author' => $user1->ID ) );
        $user2Posts = $this->factory()->post->create_many( 3, array( 'post_author' => $user2->ID ) );

        $author  = new Author();
        $builder = new Builder();
        $q       = new Query( $builder );

        $author->setAuthor( $user1->ID );
        $builder->addConstraint( $author );

        $wpQ = $q->getResult();

        $this->assertEquals( 2, $wpQ->found_posts );

        $pluck = wp_list_pluck( $wpQ->posts, 'ID' );
        sort( $pluck );

        $this->assertArraySubset( $user1Posts, $pluck );

        $author->setAuthor( $user2->ID );

        $wpQ = $q->getResult();

        $this->assertEquals( 3, $wpQ->found_posts );

        $pluck = wp_list_pluck( $wpQ->posts, 'ID' );
        sort( $pluck );

        $this->assertArraySubset( $user2Posts, $pluck );

        $author->setAuthor( PHP_INT_MAX );

        $wpQ = $q->getResult();

        $this->assertEquals( 0, $wpQ->found_posts );
    }

    public function testQueeringByName() {
        /** @var \WP_User $user1 */
        $user1 = $this->factory()->user->create_and_get();
        /** @var \WP_User $user2 */
        $user2 = $this->factory()->user->create_and_get();

        $user1Posts = $this->factory()->post->create_many( 2, array( 'post_author' => $user1->ID ) );
        $user2Posts = $this->factory()->post->create_many( 3, array( 'post_author' => $user2->ID ) );

        $author  = new Author();
        $builder = new Builder();
        $q       = new Query( $builder );

        $author->setAuthorName( $user1->user_nicename );
        $builder->addConstraint( $author );

        $wpQ = $q->getResult();

        $this->assertEquals( 2, $wpQ->found_posts );

        $pluck = wp_list_pluck( $wpQ->posts, 'ID' );
        sort( $pluck );

        $this->assertArraySubset( $user1Posts, $pluck );

        $author->setAuthorName( $user2->user_nicename );

        $wpQ = $q->getResult();

        $this->assertEquals( 3, $wpQ->found_posts );

        $pluck = wp_list_pluck( $wpQ->posts, 'ID' );
        sort( $pluck );

        $this->assertArraySubset( $user2Posts, $pluck );

        $author->setAuthorName( rand_str() );

        $wpQ = $q->getResult();

        $this->assertEquals( 0, $wpQ->found_posts );
    }

    public function testQueeringByName22() {
        /** @var \WP_User $user1 */
        $user1 = $this->factory()->user->create_and_get();
        /** @var \WP_User $user2 */
        $user2 = $this->factory()->user->create_and_get();

        $user1Posts = $this->factory()->post->create_many( 2, array( 'post_author' => $user1->ID ) );
        $user2Posts = $this->factory()->post->create_many( 3, array( 'post_author' => $user2->ID ) );

        $author  = new Author();
        $builder = new Builder();
        $q       = new Query( $builder );

        $author->setAuthorName( $user1->user_nicename );
        $builder->addConstraint( $author );

        $wpQ = $q->getResult();
        $q->sort( $user1Posts );

        $this->assertEquals( 2, $wpQ->found_posts );

        $pluck = wp_list_pluck( $wpQ->posts, 'ID' );

        $this->assertArraySubset( $user1Posts, $pluck );

        $author->setAuthorName( $user2->user_nicename );

        $wpQ = $q->getResult();
        $q->sort( $user2Posts );

        $this->assertEquals( 3, $wpQ->found_posts );

        $pluck = wp_list_pluck( $wpQ->posts, 'ID' );

        $this->assertArraySubset( $user2Posts, $pluck );

        $author->setAuthorName( rand_str() );

        $wpQ = $q->getResult();

        $this->assertEquals( 0, $wpQ->found_posts );
    }

    public function testQueeringByAuthorIn() {
        /** @var \WP_User $user1 */
        $user1 = $this->factory()->user->create_and_get();
        /** @var \WP_User $user2 */
        $user2 = $this->factory()->user->create_and_get();

        $user1Posts = $this->factory()->post->create_many( 2, array( 'post_author' => $user1->ID ) );
        $user2Posts = $this->factory()->post->create_many( 3, array( 'post_author' => $user2->ID ) );
        sort( $user1Posts );
        sort( $user2Posts );

        $author  = new Author();
        $builder = new Builder();
        $q       = new Query( $builder );

        $author->setAuthorIn( array( $user1->ID ) );
        $builder->addConstraint( $author );

        $wpQ = $q->getResult();

        $this->assertEquals( 2, $wpQ->found_posts );

        $pluck = wp_list_pluck( $wpQ->posts, 'ID' );
        sort( $pluck );

        $this->assertArraySubset( $user1Posts, $pluck );

        $author->setAuthorIn( array( $user2->ID ) );

        $wpQ = $q->getResult();

        $this->assertEquals( 3, $wpQ->found_posts );

        $pluck = wp_list_pluck( $wpQ->posts, 'ID' );
        sort( $pluck );

        $this->assertArraySubset( $user2Posts, $pluck );

        $author->setAuthorIn( array( $user1->ID, $user2->ID ) );

        $wpQ = $q->getResult();

        $this->assertEquals( 5, $wpQ->found_posts );

        $pluck = wp_list_pluck( $wpQ->posts, 'ID' );
        sort( $pluck );

        $this->assertArraySubset( array_merge( $user1Posts, $user2Posts ), $pluck );

        $author->setAuthorIn( array( PHP_INT_MAX ) );

        $wpQ = $q->getResult();

        $this->assertEquals( 0, $wpQ->found_posts );
    }

    public function testQueeringByAuthorNotIn() {
        /** @var \WP_User $user1 */
        $user1 = $this->factory()->user->create_and_get();
        /** @var \WP_User $user2 */
        $user2 = $this->factory()->user->create_and_get();

        $user1Posts = $this->factory()->post->create_many( 2, array( 'post_author' => $user1->ID ) );
        $user2Posts = $this->factory()->post->create_many( 3, array( 'post_author' => $user2->ID ) );
        sort( $user1Posts );
        sort( $user2Posts );

        $author  = new Author();
        $builder = new Builder();
        $q       = new Query( $builder );

        $author->setAuthorNotIn( array( $user1->ID ) );
        $builder->addConstraint( $author );

        $wpQ = $q->getResult();

        $pluck = wp_list_pluck( $wpQ->posts, 'ID' );

        foreach ( $user1Posts as $user1Post ) {
            $this->assertNotContains( $user1Post, $pluck );
        }

        $author->setAuthorNotIn( array( $user2->ID ) );

        $wpQ = $q->getResult();

        $pluck = wp_list_pluck( $wpQ->posts, 'ID' );

        foreach ( $user2Posts as $user2Post ) {
            $this->assertNotContains( $user2Post, $pluck );
        }

        $author->setAuthorNotIn( array( $user1->ID, $user2->ID ) );

        $wpQ = $q->getResult();

        $pluck = wp_list_pluck( $wpQ->posts, 'ID' );

        foreach ( array_merge( $user1Posts, $user2Posts ) as $userPost ) {
            $this->assertNotContains( $userPost, $pluck );
        }
    }
}