<?php
/**
 * Project: wp-query-builder
 * File: Category.php
 * User: Panagiotis Vagenas <pan.vagenas@gmail.com>
 * Date: 9/11/2015
 * Time: 7:41 μμ
 * Since: TODO ${VERSION}
 * Copyright: 2015 Panagiotis Vagenas
 */

namespace Pan\QueryBuilder\Constraints;

/**
 * Show posts associated with certain categories
 *
 * @package Pan\QueryBuilder\Constraints
 * @author  Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @since   TODO ${VERSION}
 */
class Category extends ConstraintAbs
{
    /**
     * use category id
     *
     * @var int
     */
    protected $cat;

    /**
     * use category slug
     *
     * @var string
     */
    protected $category_name;

    /**
     * use category id
     *
     * @var array
     */
    protected $category__and;

    /**
     * use category id
     *
     * @var array
     */
    protected $category__in;

    /**
     * use category id
     *
     * @var array
     */
    protected $category__not_in;

    /**
     * @return int
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function getCat()
    {
        return $this->cat;
    }

    /**
     * @param int $cat
     *
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function setCat($cat)
    {
        $this->cat = (int)$cat;
    }

    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function getCategoryName()
    {
        return $this->category_name;
    }

    /**
     * @param string $category_name
     *
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function setCategoryName($category_name)
    {
        $this->category_name = (string)$category_name;
    }

    /**
     * @return array
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function getCategoryAnd()
    {
        return $this->category__and;
    }

    /**
     * @param array $category__and
     *
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function setCategoryAnd($category__and)
    {
        $this->category__and = (array)$category__and;
    }

    /**
     * @return array
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function getCategoryIn()
    {
        return $this->category__in;
    }

    /**
     * @param array $category__in
     *
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function setCategoryIn($category__in)
    {
        $this->category__in = (array)$category__in;
    }

    /**
     * @return array
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function getCategoryNotIn()
    {
        return $this->category__not_in;
    }

    /**
     * @param array $category__not_in
     *
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function setCategoryNotIn($category__not_in)
    {
        $this->category__not_in = (array)$category__not_in;
    }
}