<?php
/**
 * Project: wp-query-builder
 * File: Author.php
 * User: Panagiotis Vagenas <pan.vagenas@gmail.com>
 * Date: 9/11/2015
 * Time: 12:52 πμ
 * Since: TODO ${VERSION}
 * Copyright: 2015 Panagiotis Vagenas
 */

namespace Pan\QueryBuilder\Constraints;

/**
 * Show posts associated with certain author
 *
 * @package Pan\QueryBuilder\Constraints
 * @author  Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @since   TODO ${VERSION}
 */
class Author extends ConstraintAbs {
    /**
     * use author id
     *
     * @var int
     */
    protected $author;

    /**
     * use 'user_nicename' - NOT name
     *
     * @var string
     */
    protected $author_name;

    /**
     * use author id (available since WP Version 3.7)
     *
     * @var array
     */
    protected $author__in;

    /**
     * use author id (available since WP Version 3.7)
     *
     * @var array
     */
    protected $author__not_in;

    /**
     * @return int
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function getAuthor() {
        return $this->author;
    }

    /**
     * @param int $author
     *
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function setAuthor( $author ) {
        $this->author = (int) $author;
    }

    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function getAuthorName() {
        return $this->author_name;
    }

    /**
     * @param string $author_name
     *
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function setAuthorName( $author_name ) {
        $this->author_name = (string) $author_name;
    }

    /**
     * @return array
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function getAuthorIn() {
        return $this->author__in;
    }

    /**
     * @param array $author__in
     *
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function setAuthorIn( $author__in ) {
        $this->author__in = (array) $author__in;
    }

    /**
     * @return array
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function getAuthorNotIn() {
        return $this->author__not_in;
    }

    /**
     * @param array $author__not_in
     *
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function setAuthorNotIn( $author__not_in ) {
        $this->author__not_in = (array) $author__not_in;
    }
}