<?php
/**
 * Project: wp-query-builder
 * File: TypeConstantsIfc.php
 * User: Panagiotis Vagenas <pan.vagenas@gmail.com>
 * Date: 11/11/2015
 * Time: 9:30 μμ
 * Since: TODO ${VERSION}
 * Copyright: 2015 Panagiotis Vagenas
 */

namespace Pan\QueryBuilder\Constraints;


/**
 * Interface TypeConstantsIfc
 *
 * @package Pan\QueryBuilder\Constraints
 */
interface TypeConstantsIfc {
    /**
     *
     */
    const NUMERIC = 'NUMERIC';
    /**
     *
     */
    const BINARY = 'BINARY';
    /**
     *
     */
    const CHAR = 'CHAR';
    /**
     *
     */
    const DATE = 'DATE';
    /**
     *
     */
    const DATETIME = 'DATETIME';
    /**
     *
     */
    const DECIMAL = 'DECIMAL';
    /**
     *
     */
    const SIGNED = 'SIGNED';
    /**
     *
     */
    const TIME = 'TIME';
    /**
     *
     */
    const UNSIGNED = 'UNSIGNED';
}