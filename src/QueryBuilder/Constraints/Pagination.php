<?php
/**
 * Project: wp-query-builder
 * File: Pagination.php
 * User: Panagiotis Vagenas <pan.vagenas@gmail.com>
 * Date: 9/11/2015
 * Time: 7:43 μμ
 * Since: 1.0.0
 * Copyright: 2015 Panagiotis Vagenas
 */

namespace Pan\QueryBuilder\Constraints;

use Pan\QueryBuilder\Constraints\Abs\Constraint;

/**
 * Class Pagination
 *
 * @package Pan\QueryBuilder\Constraints
 * @author  Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @since   1.0.0
 */
class Pagination extends Constraint {
    /**
     * Return all posts
     */
    const POSTS_PER_PAGE_ALL = - 1;

    /**
     * show all posts or use pagination. Default value is `false`, use paging
     *
     * @var bool
     */
    protected $nopaging = false;
    /**
     * number of post to show per page (available since Version 2.1, replaced showposts parameter).
     * Use `posts_per_page = {@link Pagination::POSTS_PER_PAGE_ALL}` to show all posts (the `offset`
     * parameter is ignored with a -1 value). Set the `paged` parameter if pagination is off after
     * using this parameter. Note: if the query is in a feed, wordpress overwrites this parameter with
     * the stored `posts_per_rss` option. To reimpose the limit, try using the `post_limits` filter,
     * or filter `pre_option_posts_per_rss` and return -1
     *
     * @var int
     */
    protected $posts_per_page = 10;
    /**
     * number of posts to show per page - on archive pages only.
     * Over-rides {@link Pagination::$posts_per_page} on pages where {@link is_archive()} or
     * {@link is_search()} would be true
     *
     * @var int
     */
    protected $posts_per_archive_page = 0;
    /**
     * number of post to displace or pass over.
     *
     * **Warning:** Setting the offset parameter overrides/ignores the paged parameter and breaks
     * pagination.
     *
     * The `offset` parameter is ignored when `posts_per_page = {@link Pagination::POSTS_PER_PAGE_ALL}` is used
     *
     * @var int
     * @see http://codex.wordpress.org/Making_Custom_Queries_using_Offset_and_Pagination
     */
    protected $offset = 0;
    /**
     * number of page. Show the posts that would normally show up just on page X when using the "Older Entries" link
     *
     * @var int
     */
    protected $paged = 0;
    /**
     * number of page for a static front page.
     * Show the posts that would normally show up just on page X of a Static Front Page
     *
     * @var int
     */
    protected $page = 0;
    /**
     * ignore post stickiness (available since Version 3.1).
     *
     * * `false`: (default): move sticky posts to the start of the set.
     * * `true`: do not move sticky posts to the start of the set
     *
     * @var bool
     */
    protected $ignore_sticky_posts = false;

    /**
     * @return boolean
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function isNopaging() {
        return $this->nopaging;
    }

    /**
     * @param boolean $nopaging show all posts or use pagination. Default value is `false`, use paging
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     */
    public function setNopaging( $nopaging ) {
        $this->nopaging = (bool) $nopaging;

        return $this;
    }

    /**
     * @return int
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function getPostsPerPage() {
        return $this->posts_per_page;
    }

    /**
     * @param int $posts_per_page Number of post to show per page
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     */
    public function setPostsPerPage( $posts_per_page ) {
        $this->posts_per_page = (int) $posts_per_page;

        return $this;
    }

    /**
     * @return int
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function getPostsPerArchivePage() {
        return $this->posts_per_archive_page;
    }

    /**
     * @param int $posts_per_archive_page Number of posts to show per page - on archive pages only
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     */
    public function setPostsPerArchivePage( $posts_per_archive_page ) {
        $this->posts_per_archive_page = (int) $posts_per_archive_page;

        return $this;
    }

    /**
     * @return int
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function getOffset() {
        return $this->offset;
    }

    /**
     * @param int $offset Number of post to displace or pass over
     *
     * @return $this
     * @see    Pagination::$offset
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     */
    public function setOffset( $offset ) {
        $this->offset = (int) $offset;

        return $this;
    }

    /**
     * @return int
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function getPaged() {
        return $this->paged;
    }

    /**
     * @param int $paged Number of page
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     */
    public function setPaged( $paged ) {
        $this->paged = (int) $paged;

        return $this;
    }

    /**
     * @return int
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function getPage() {
        return $this->page;
    }

    /**
     * @param int $page Number of page for a static front page
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     */
    public function setPage( $page ) {
        $this->page = (int) $page;

        return $this;
    }

    /**
     * @return boolean
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function isIgnoreStickyPosts() {
        return $this->ignore_sticky_posts;
    }

    /**
     * @param boolean $ignore_sticky_posts ignore post stickiness (available since Version 3.1).
     *                                     <ul>
     *                                     <li>`false`: (default): move sticky posts to the start of the set.</li>
     *                                     <li>`true`: do not move sticky posts to the start of the set</li>
     *                                     </ul>
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     */
    public function setIgnoreStickyPosts( $ignore_sticky_posts ) {
        $this->ignore_sticky_posts = (bool) $ignore_sticky_posts;

        return $this;
    }
}