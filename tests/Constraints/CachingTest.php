<?php
/**
 * Project: wp-query-builder
 * File: AuthorTest.php
 * User: Panagiotis Vagenas <pan.vagenas@gmail.com>
 * Date: 12/11/2015
 * Time: 11:59 μμ
 * Since: 1.0.0
 * Copyright: 2015 Panagiotis Vagenas
 */


namespace Pan\QueryBuilder\Tests\Constraints;

use Pan\QueryBuilder\Constraints\Caching;
use Pan\QueryBuilder\Tests\QueryBuilderUnitTestCase;

class CachingTest extends QueryBuilderUnitTestCase {
    public function testGettersSetters() {
        $constraint = new Caching();

        $this->assertEmpty( $constraint->getArrayCopy() );
        $this->assertTrue( $constraint->isCacheResults() );
        $this->assertTrue( $constraint->isUpdatePostMetaCache() );
        $this->assertTrue( $constraint->isUpdatePostTermCache() );

        $constraint->setCacheResults( false );
        $constraint->setUpdatePostMetaCache( false );
        $constraint->setUpdatePostTermCache( false );

        $this->assertFalse( $constraint->isCacheResults() );
        $this->assertFalse( $constraint->isUpdatePostMetaCache() );
        $this->assertFalse( $constraint->isUpdatePostTermCache() );
    }
}