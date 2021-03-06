<?php
/**
 * Project: wp-query-builder
 * File: Author.php
 * User: Panagiotis Vagenas <pan.vagenas@gmail.com>
 * Date: 9/11/2015
 * Time: 12:52 πμ
 * Since: 1.0.0
 * Copyright: 2015 Panagiotis Vagenas
 */

namespace Pan\QueryBuilder\Constraints;

use Pan\QueryBuilder\Constraints\Abs\Constraint;

/**
 * Show posts associated with certain author
 *
 * @package Pan\QueryBuilder\Constraints
 * @author  Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @since   1.0.0
 */
class Author extends Constraint {
    /**
     * use author id
     *
     * @var int
     */
    protected $author = 0;

    /**
     * use 'user_nicename' - NOT name
     *
     * @var string
     */
    protected $author_name = '';

    /**
     * use author id (available since WP Version 3.7)
     *
     * @var array
     */
    protected $author__in = array();

    /**
     * use author id (available since WP Version 3.7)
     *
     * @var array
     */
    protected $author__not_in = array();

    /**
     * @return int
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function getAuthor() {
        return $this->author;
    }

    /**
     * @param int $author Use author id
     *
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     */
    public function setAuthor( $author ) {
        $this->author = (int) $author;
    }

    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function getAuthorName() {
        return $this->author_name;
    }

    /**
     * @param string $author_name Use `user_nicename` - NOT name
     *
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     */
    public function setAuthorName( $author_name ) {
        $this->author_name = (string) $author_name;
    }

    /**
     * @return array
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function getAuthorIn() {
        return $this->author__in;
    }

    /**
     * @param array $author__in Use author id (available since WP Version 3.7)
     *
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     */
    public function setAuthorIn( $author__in ) {
        $this->author__in = (array) $author__in;
    }

    /**
     * @return array
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function getAuthorNotIn() {
        return $this->author__not_in;
    }

    /**
     * @param array $author__not_in Use author id (available since WP Version 3.7)
     *
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     */
    public function setAuthorNotIn( $author__not_in ) {
        $this->author__not_in = (array) $author__not_in;
    }
}