<?php
/**
 * Project: wp-query-builder
 * File: AbsPostPage.php
 * User: Panagiotis Vagenas <pan.vagenas@gmail.com>
 * Date: 14/11/2015
 * Time: 12:06 πμ
 * Since: TODO ${VERSION}
 * Copyright: 2015 Panagiotis Vagenas
 */

namespace Pan\QueryBuilder\Constraints;


/**
 * Class AbsPostPage
 *
 * @package Pan\QueryBuilder\Constraints
 * @author  Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @since   TODO ${VERSION}
 */
abstract class AbsPostPage extends AbsConstraint {
    /**
     * Return only top level entries
     */
    const POST_PARENT_TOP_LEVEL = 0;
    /**
     * use page id to return only child pages.
     * Set to {@link AbsPostPage::POST_PARENT_TOP_LEVEL} to return only top-level entries
     *
     * @var int
     */
    protected $post_parent = - 1;
    /**
     * use post ids. Specify posts whose parent is in an array. (available since Version 3.6)
     *
     * @var array
     */
    protected $post_parent__in = array();
    /**
     * use post ids. Specify posts whose parent is not in an array. (available since Version 3.6)
     *
     * @var array
     */
    protected $post_parent__not_in = array();
    /**
     * use post ids. Specify posts to retrieve.
     *
     * **ATTENTION** If you use sticky posts, they will be included (prepended!) in the posts you
     * retrieve whether you want it or not. To suppress this behaviour use {@link Pagination::$ignore_sticky_posts}.
     *
     * @var array
     */
    protected $post__in = array();
    /**
     * use post ids. Specify post **NOT** to retrieve
     *
     * @var array
     */
    protected $post__not_in = array();
    /**
     * use post slugs. Specify posts to retrieve. (Will be available in Version 4.4)
     *
     * @var array
     */
    protected $post_name__in = array();

    /**
     * @return int
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function getPostParent() {
        return $this->post_parent;
    }

    /**
     * @param int $post_parent
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function setPostParent( $post_parent ) {
        $this->post_parent = (int) $post_parent;

        return $this;
    }

    /**
     * @return array
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function getPostParentIn() {
        return $this->post_parent__in;
    }

    /**
     * @param array $post_parent__in
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function setPostParentIn( $post_parent__in ) {
        $this->post_parent__in = (array) $post_parent__in;

        return $this;
    }

    /**
     * @return array
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function getPostParentNotIn() {
        return $this->post_parent__not_in;
    }

    /**
     * @param array $post_parent__not_in
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function setPostParentNotIn( $post_parent__not_in ) {
        $this->post_parent__not_in = (array) $post_parent__not_in;

        return $this;
    }

    /**
     * @return array
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function getPostIn() {
        return $this->post__in;
    }

    /**
     * @param array $post__in
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function setPostIn( $post__in ) {
        $this->post__in = (array) $post__in;

        return $this;
    }

    /**
     * @return array
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function getPostNotIn() {
        return $this->post__not_in;
    }

    /**
     * @param array $post__not_in
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function setPostNotIn( $post__not_in ) {
        $this->post__not_in = (array) $post__not_in;

        return $this;
    }

    /**
     * @return array
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function getPostNameIn() {
        return $this->post_name__in;
    }

    /**
     * @param array $post_name__in
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function setPostNameIn( $post_name__in ) {
        $this->post_name__in = (array) $post_name__in;

        return $this;
    }

}