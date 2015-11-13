<?php
/**
 * Project: wp-query-builder
 * File: AbsConstraintTest.php
 * User: Panagiotis Vagenas <pan.vagenas@gmail.com>
 * Date: 12/11/2015
 * Time: 11:59 μμ
 * Since: TODO ${VERSION}
 * Copyright: 2015 Panagiotis Vagenas
 */

namespace Pan\QueryBuilder\Tests\Constraints;

use Pan\QueryBuilder\Constraints\Category;
use Pan\QueryBuilder\Tests\QueryBuilderUnitTestCase;

class AbsConstraintTest extends QueryBuilderUnitTestCase {
    public function testGetDefault(){
        $constraintCat = new Category();

        $this->assertEquals(0, $constraintCat->getDefault('cat'));

        $constraintCat->setCat(1);

        $this->assertEquals(0, $constraintCat->getDefault('cat'));
        $this->assertInstanceOf('\WP_Error', $constraintCat->getDefault('missing'));
    }
}