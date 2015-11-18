<?php
/**
 * Project: wp-query-builder
 * File: Post.php
 * User: Panagiotis Vagenas <pan.vagenas@gmail.com>
 * Date: 9/11/2015
 * Time: 12:51 πμ
 * Since: 1.0.0
 * Copyright: 2015 Panagiotis Vagenas
 */

namespace Pan\QueryBuilder\Constraints;

use Pan\QueryBuilder\Constraints\Abs\PostPage;

/**
 * Display content based on post and page parameters.
 * Remember that default `post_type` is only set to display posts but not pages
 *
 * @package Pan\QueryBuilder\Constraints
 * @author  Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @since   1.0.0
 */
class Post extends PostPage {
    /**
     * use post id.
     *
     * @var int
     */
    protected $p = 0;
    /**
     * use post slug
     *
     * @var string
     */
    protected $name = '';

    /**
     * @return int
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function getP() {
        return $this->p;
    }

    /**
     * @param int $p Use post id
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     */
    public function setP( $p ) {
        $this->p = (int) $p;

        return $this;
    }

    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param string $name Use post slug
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     */
    public function setName( $name ) {
        $this->name = (string) $name;

        return $this;
    }
}