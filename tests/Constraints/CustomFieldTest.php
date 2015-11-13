<?php
/**
 * Project: wp-query-builder
 * File: CustomFieldTest.php
 * User: Panagiotis Vagenas <pan.vagenas@gmail.com>
 * Date: 12/11/2015
 * Time: 11:59 μμ
 * Since: TODO ${VERSION}
 * Copyright: 2015 Panagiotis Vagenas
 */

namespace Pan\QueryBuilder\Tests\Constraints;

use Pan\QueryBuilder\Constraints\CustomField;
use Pan\QueryBuilder\Tests\QueryBuilderUnitTestCase;

class CustomFieldTest extends QueryBuilderUnitTestCase{
    public function testAddNew(){
        $customField = new CustomField();

        $this->assertEmpty($customField->getArrayCopy());

        $customField->setRelation(CustomField::RELATION_AND);

        $this->assertEmpty($customField->getArrayCopy());

        $customField->add('key', 'value');

        $this->assertNotEmpty($customField->getArrayCopy());
        $this->assertNotContains('relation', $customField->getArrayCopy());
    }
}