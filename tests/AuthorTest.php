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

namespace Pan\QueryBuilder\Tests;

use Pan\QueryBuilder\Builder;
use Pan\QueryBuilder\Constraints\Author;

/**
 * Class AuthorTest
 *
 * @author    Panagiotis Vagenas <Panagiotis.Vagenas@interactivedata.com>
 * @date      2015-11-13
 * @version   $Id$
 * @package   Pan
 * @copyright Copyright (c) 2015 Interactive Data Managed Solutions Ltd.
 */
class AuthorTest extends QueryBuilderUnitTestCase {
    public function testAddingValues() {
        $authorID   = mt_rand( 0, PHP_INT_MAX );
        $authorName = rand_str();
        $authorIn = array( 1, 2, 3 );
        $authorNotIn = array(4);

        $builder = new Builder();

        $authorConstraint = new Author();
        $authorConstraint->setAuthor( $authorID );

        $this->assertEquals($authorID, $authorConstraint->getAuthor());

        $builder->addConstraint( $authorConstraint );

        $args = $builder->getQueryArgsArray();

        $this->assertTrue( is_array( $args ) );
        $this->assertArrayHasKey( 'author', $args );
        $this->assertArraySubset( array( 'author' => $authorID ), $args );

        $authorConstraint->setAuthorName( $authorName );

        $this->assertEquals($authorName, $authorConstraint->getAuthorName());

        $this->assertArraySubset(
            array( 'author' => $authorID, 'author_name' => $authorName ),
            $builder->getQueryArgsArray()
        );


        $authorConstraint->setAuthorIn( $authorIn );

        $this->assertEquals($authorIn, $authorConstraint->getAuthorIn());

        $this->assertArrayHasKey( 'author__in', $builder->getQueryArgsArray() );
        $this->assertCount( 3, $builder->getQueryArgsArray() );

        $authorConstraint->setAuthorNotIn( $authorNotIn );

        $this->assertEquals($authorNotIn, $authorConstraint->getAuthorNotIn());

        $this->assertArrayHasKey( 'author__not_in', $builder->getQueryArgsArray() );
        $this->assertCount( 4, $builder->getQueryArgsArray() );

        $authorConstraint->setAuthorNotIn( $authorConstraint->getDefault( 'author__not_in' ) );

        $this->assertArrayNotHasKey( 'author__not_in', $builder->getQueryArgsArray() );
        $this->assertCount( 3, $builder->getQueryArgsArray() );

        $authorConstraint->reset();

        $this->assertCount(0, $builder->getQueryArgsArray());
    }
}