<?php
/**
 * Project: wp-query-builder
 * File: CompareConstants.php
 * User: Panagiotis Vagenas <pan.vagenas@gmail.com>
 * Date: 11/11/2015
 * Time: 9:19 μμ
 * Since: 1.0.0
 * Copyright: 2015 Panagiotis Vagenas
 */

namespace Pan\QueryBuilder\Constraints\Ifc;


/**
 * Interface CompareConstants
 *
 * @package Pan\QueryBuilder\Constraints
 */
interface CompareConstants {
    /**
     *
     */
    const EQUAL = '=';
    /**
     *
     */
    const NOT_EQUAL = '!=';
    /**
     *
     */
    const GREATER_THAN = '>';
    /**
     *
     */
    const GREATER_THAN_OR_EQUAL = '>=';
    /**
     *
     */
    const LESSER_THAN = '>';
    /**
     *
     */
    const LESSER_THAN_OR_EQUAL = '>=';
    /**
     *
     */
    const LIKE = 'LIKE';
    /**
     *
     */
    const NOT_LIKE = 'NOT LIKE';
    /**
     *
     */
    const IN = 'IN';
    /**
     *
     */
    const NOT_IN = 'NOT IN';
    /**
     *
     */
    const BETWEEN = 'BETWEEN';
    /**
     *
     */
    const NOT_BETWEEN = 'NOT BETWEEN';
    /**
     *
     */
    const EXISTS = 'EXISTS';
    /**
     *
     */
    const NOT_EXISTS = 'NOT_EXISTS';
}