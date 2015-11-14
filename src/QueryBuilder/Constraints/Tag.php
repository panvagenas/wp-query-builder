<?php
/**
 * Project: wp-query-builder
 * File: Tag.php
 * User: Panagiotis Vagenas <pan.vagenas@gmail.com>
 * Date: 9/11/2015
 * Time: 7:41 μμ
 * Since: TODO ${VERSION}
 * Copyright: 2015 Panagiotis Vagenas
 */

namespace Pan\QueryBuilder\Constraints;

/**
 * Show posts associated with certain tags
 *
 * @package Pan\QueryBuilder\Constraints
 * @author  Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @since   TODO ${VERSION}
 */
class Tag extends AbsConstraint {
    /**
     * use tag slug
     *
     * @var string
     */
    protected $tag = '';
    /**
     * use tag id
     *
     * @var int
     */
    protected $tag_id = 0;
    /**
     * use tag ids
     *
     * @var array
     */
    protected $tag__and = array();
    /**
     * use tag ids
     *
     * @var array
     */
    protected $tag__in = array();
    /**
     * use tag ids
     *
     * @var array
     */
    protected $tag__not_in = array();
    /**
     * use tag slugs
     *
     * @var array
     */
    protected $tag_slug__and = array();
    /**
     * use tag slugs
     *
     * @var array
     */
    protected $tag_slug__in = array();

    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function getTag() {
        return $this->tag;
    }

    /**
     * @param string $tag
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function setTag( $tag ) {
        $this->tag = (string) $tag;

        return $this;
    }

    /**
     * @return int
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function getTagId() {
        return $this->tag_id;
    }

    /**
     * @param int $tag_id
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function setTagId( $tag_id ) {
        $this->tag_id = (int) $tag_id;

        return $this;
    }

    /**
     * @return array
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function getTagAnd() {
        return $this->tag__and;
    }

    /**
     * @param array $tag__and
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function setTagAnd( $tag__and ) {
        $this->tag__and = (array) $tag__and;

        return $this;
    }

    /**
     * @return array
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function getTagIn() {
        return $this->tag__in;
    }

    /**
     * @param array $tag__in
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function setTagIn( $tag__in ) {
        $this->tag__in = (array) $tag__in;

        return $this;
    }

    /**
     * @return array
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function getTagNotIn() {
        return $this->tag__not_in;
    }

    /**
     * @param array $tag__not_in
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function setTagNotIn( $tag__not_in ) {
        $this->tag__not_in = (array) $tag__not_in;

        return $this;
    }

    /**
     * @return array
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function getTagSlugAnd() {
        return $this->tag_slug__and;
    }

    /**
     * @param array $tag_slug__and
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function setTagSlugAnd( $tag_slug__and ) {
        $this->tag_slug__and = (array) $tag_slug__and;

        return $this;
    }

    /**
     * @return array
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function getTagSlugIn() {
        return $this->tag_slug__in;
    }

    /**
     * @param array $tag_slug__in
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function setTagSlugIn( $tag_slug__in ) {
        $this->tag_slug__in = (array) $tag_slug__in;

        return $this;
    }
}