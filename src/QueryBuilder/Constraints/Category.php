<?php
/**
 * Project: wp-query-builder
 * File: Category.php
 * User: Panagiotis Vagenas <pan.vagenas@gmail.com>
 * Date: 9/11/2015
 * Time: 7:41 μμ
 * Since: 1.0.0
 * Copyright: 2015 Panagiotis Vagenas
 */

namespace Pan\QueryBuilder\Constraints;

use Pan\QueryBuilder\Constraints\Abs\Constraint;

/**
 * Show posts associated with certain categories
 *
 * @package Pan\QueryBuilder\Constraints
 * @author  Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @since   1.0.0
 */
class Category extends Constraint {
    /**
     * use category id
     *
     * @var int
     */
    protected $cat = 0;

    /**
     * use category slug
     *
     * @var string
     */
    protected $category_name = '';

    /**
     * use category id
     *
     * @var array
     */
    protected $category__and = array();

    /**
     * use category id
     *
     * @var array
     */
    protected $category__in = array();

    /**
     * use category id
     *
     * @var array
     */
    protected $category__not_in = array();

    /**
     * @return int
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function getCat() {
        return $this->cat;
    }

    /**
     * @param int $cat Use category id
     *
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     */
    public function setCat( $cat ) {
        $this->cat = (int) $cat;
    }

    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function getCategoryName() {
        return $this->category_name;
    }

    /**
     * @param string $category_name Use category slug
     *
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     */
    public function setCategoryName( $category_name ) {
        $this->category_name = (string) $category_name;
    }

    /**
     * @return array
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function getCategoryAnd() {
        return $this->category__and;
    }

    /**
     * @param array $category__and
     *
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     */
    public function setCategoryAnd( $category__and ) {
        $this->category__and = (array) $category__and;
    }

    /**
     * @return array
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function getCategoryIn() {
        return $this->category__in;
    }

    /**
     * @param array $category__in Use category id
     *
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     */
    public function setCategoryIn( $category__in ) {
        $this->category__in = (array) $category__in;
    }

    /**
     * @return array
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function getCategoryNotIn() {
        return $this->category__not_in;
    }

    /**
     * @param array $category__not_in Use category id
     *
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     */
    public function setCategoryNotIn( $category__not_in ) {
        $this->category__not_in = (array) $category__not_in;
    }
}