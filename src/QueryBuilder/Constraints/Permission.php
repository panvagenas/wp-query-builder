<?php
/**
 * Project: wp-query-builder
 * File: Permission.php
 * User: Panagiotis Vagenas <pan.vagenas@gmail.com>
 * Date: 9/11/2015
 * Time: 7:44 μμ
 * Since: TODO ${VERSION}
 * Copyright: 2015 Panagiotis Vagenas
 */

namespace Pan\QueryBuilder\Constraints;

use Pan\QueryBuilder\Constraints\Abs\Constraint;

/**
 * Display published and private posts, if the user has the appropriate capability
 *
 * @package Pan\QueryBuilder\Constraints
 * @author  Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @since   TODO ${VERSION}
 */
class Permission extends Constraint {
    /**
     * User permission
     *
     * @var string
     */
    protected $perm = 'readable';
}