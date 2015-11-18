<?php
/**
 * Project: wp-query-builder
 * File: BuilderTest.php
 * User: Panagiotis Vagenas <pan.vagenas@gmail.com>
 * Date: 12/11/2015
 * Time: 11:59 μμ
 * Since: 1.0.0
 * Copyright: 2015 Panagiotis Vagenas
 */

namespace Pan\QueryBuilder\Tests;

use Pan\QueryBuilder\Builder;
use Pan\QueryBuilder\Constraints\Author;
use Pan\QueryBuilder\Constraints\Caching;

class BuilderTest extends QueryBuilderUnitTestCase {

    public function testAddRemConstraints() {
        $constraintA = new Author();
        $constraintB = new Caching();
        $constraintC = new Author();
        $builder     = new Builder();

        $this->assertFalse( $builder->hasConstraint( $constraintA ) );
        $this->assertFalse( $builder->hasConstraint( $constraintB ) );

        $builder->addConstraint( $constraintA );

        $this->assertTrue( $builder->hasConstraint( $constraintA ) );
        $this->assertFalse( $builder->hasConstraint( $constraintB ) );

        $this->assertEmpty( $builder->getQueryArgsArray() );

        $builder->removeConstraint( $constraintA );

        $this->assertFalse( $builder->hasConstraint( $constraintA ) );
        $this->assertFalse( $builder->hasConstraint( $constraintB ) );

        $this->assertEmpty( $builder->getQueryArgsArray() );

        $this->assertNotContains( 1, $builder->getQueryArgsArray() );

        $constraintA->setAuthor( 1 );
        $builder->addConstraint( $constraintA );

        $this->assertContains( 1, $builder->getQueryArgsArray() );

        $constraintC->setAuthor( 2 );

        $this->assertNotContains( 2, $builder->getQueryArgsArray() );

        $builder->addConstraint( $constraintC );

        $this->assertNotContains( 1, $builder->getQueryArgsArray() );
        $this->assertContains( 2, $builder->getQueryArgsArray() );
    }

    public function testUpdateConstraint() {
        $constraintA = new Author();
        $constraintB = new Author();
        $constraintC = new Caching();

        $builder = new Builder();

        $constraintA->setAuthor( 1 );

        $builder->addConstraint( $constraintA );

        $this->assertArrayHasKey( 'author', $builder->getQueryArgsArray() );
        $this->assertContains( 1, $builder->getQueryArgsArray() );

        $constraintA->setAuthor( 2 );

        $this->assertArrayHasKey( 'author', $builder->getQueryArgsArray() );
        $this->assertContains( 2, $builder->getQueryArgsArray() );
        $this->assertNotContains( 1, $builder->getQueryArgsArray() );

        $constraintB->setAuthor( 3 );
        $builder->updateConstraint( $constraintB );

        $this->assertArrayHasKey( 'author', $builder->getQueryArgsArray() );
        $this->assertNotContains( 1, $builder->getQueryArgsArray() );
        $this->assertNotContains( 2, $builder->getQueryArgsArray() );
        $this->assertContains( 3, $builder->getQueryArgsArray() );

        $this->assertFalse( $builder->hasConstraint( $constraintC ) );

        $builder->updateConstraint( $constraintC );

        $this->assertTrue( $builder->hasConstraint( $constraintC ) );
    }
}