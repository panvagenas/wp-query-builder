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

use Pan\QueryBuilder\Constraints\Category;
use Pan\QueryBuilder\Tests\QueryBuilderUnitTestCase;

class CategoryTest extends QueryBuilderUnitTestCase{
    public function testGettersSetters(){
        $constraint = new Category();

        $this->assertEmpty($constraint->getArrayCopy());

        $this->assertEquals(0, $constraint->getCat());
        $this->assertEquals('', $constraint->getCategoryName());
        $this->assertEquals(array(), $constraint->getCategoryIn());
        $this->assertEquals(array(), $constraint->getCategoryNotIn());

        $catId = mt_rand(0, 1000);
        $name = rand_str();
        $catIn = array(1,2,3);
        $catNotIn = array(4);
        $catAnd = array(5,6);

        $constraint->setCat($catId);
        $constraint->setCategoryName($name);
        $constraint->setCategoryIn($catIn);
        $constraint->setCategoryNotIn($catNotIn);
        $constraint->setCategoryAnd($catAnd);

        $this->assertEquals($catId, $constraint->getCat());
        $this->assertEquals($name, $constraint->getCategoryName());
        $this->assertEquals($catIn, $constraint->getCategoryIn());
        $this->assertEquals($catNotIn, $constraint->getCategoryNotIn());
        $this->assertEquals($catAnd, $constraint->getCategoryAnd());
    }
}