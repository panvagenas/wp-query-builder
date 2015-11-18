<?php
/**
 * Project: wp-query-builder
 * File: Search.php
 * User: Panagiotis Vagenas <pan.vagenas@gmail.com>
 * Date: 10/11/2015
 * Time: 12:33 πμ
 * Since: 1.0.0
 * Copyright: 2015 Panagiotis Vagenas
 */

namespace Pan\QueryBuilder\Constraints;

use Pan\QueryBuilder\Constraints\Abs\Constraint;

/**
 * Show posts based on a keyword search
 *
 * @package Pan\QueryBuilder\Constraints
 * @author  Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @since   1.0.0
 */
class Search extends Constraint {
    /**
     * Search keyword
     *
     * @var string
     */
    protected $s = '';

    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function getS() {
        return $this->s;
    }

    /**
     * @param string $s Search keyword
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     */
    public function setS( $s ) {
        $this->s = (string) $s;

        return $this;
    }
}