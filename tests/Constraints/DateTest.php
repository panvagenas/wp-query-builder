<?php
/**
 * Project: wp-query-builder
 * File: DateTest.php
 * User: Panagiotis Vagenas <pan.vagenas@gmail.com>
 * Date: 12/11/2015
 * Time: 11:59 μμ
 * Since: TODO ${VERSION}
 * Copyright: 2015 Panagiotis Vagenas
 */

namespace Pan\QueryBuilder\Tests\Constraints;

use Pan\QueryBuilder\Constraints\Date;
use Pan\QueryBuilder\Constraints\Post;
use Pan\QueryBuilder\Tests\QueryBuilderUnitTestCase;

class DateTest extends QueryBuilderUnitTestCase {
    protected $postIds = array();
    protected $dates = array(
        '2015-09-15',
        '2015-06-15',
        '2015-03-15',
        '2014-09-15',
        '2014-06-15',
    );

    public function setUp() {
        parent::setUp();

        foreach ( $this->dates as $date ) {
            $this->postIds[ $date ] =
                $this->factory()->post->create_many( 5, array( 'post_date' => $date ) );
        }
    }

    public function testAfter() {
        $date = new Date();

        $date->setAfter( array( 'year' => 2014 ) );
        $q = $date->crtAttachBuilder()->crtAttachQuery();
        $this->assertEquals( 15, $q->getResult()->found_posts );

        $date->setAfter( array( 'year' => 2015, 'month' => 3 ) );
        $this->assertEquals( 10, $q->getResult()->found_posts );

        $date->setAfter( array( 'year' => 2015, 'month' => 6, 'day' => 16 ) );
        $this->assertEquals( 5, $q->getResult()->found_posts );

        $date->setAfter( '2014' );
        $q = $date->crtAttachBuilder()->crtAttachQuery();
        $this->assertEquals( 15, $q->getResult()->found_posts );

        $date->setAfter( '2015-04' );
        $this->assertEquals( 10, $q->getResult()->found_posts );

        $date->setAfter( '2015-06-16' );
        $this->assertEquals( 5, $q->getResult()->found_posts );
    }
}