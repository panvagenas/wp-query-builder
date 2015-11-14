<?php
/**
 * Project: wp-query-builder
 * File: Status.php
 * User: Panagiotis Vagenas <pan.vagenas@gmail.com>
 * Date: 9/11/2015
 * Time: 7:43 μμ
 * Since: TODO ${VERSION}
 * Copyright: 2015 Panagiotis Vagenas
 */

namespace Pan\QueryBuilder\Constraints;

/**
 * Show posts associated with certain status:{@link http://codex.wordpress.org/Post_Status}
 *
 * @package Pan\QueryBuilder\Constraints
 * @author  Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @since   TODO ${VERSION}
 */
class Status extends AbsConstraint {
    /**
     * a published post or page
     */
    const PUBLISH = 'publish';
    /**
     * post is pending review
     */
    const PENDING = 'pending';
    /**
     * a post in draft status
     */
    const DRAFT = 'draft';
    /**
     * a newly created post, with no content
     */
    const AUTO_DRAFT = 'auto-draft';
    /**
     * a post to publish in the future
     */
    const FUTURE = 'future';
    /**
     * not visible to users who are not logged in
     */
    const PRIVATE_ = 'private';
    /**
     * a revision
     */
    const INHERIT = 'inherit';
    /**
     * post is in trashbin
     */
    const TRASH = 'trash';
    /**
     * retrieves any status except those from post statuses with
     * `exclude_from_search` set to true (i.e. trash and auto-draft)
     */
    const ANY = 'any';
    /**
     * Retrieves posts by Post Status.
     *
     * Default value is `publish`, but if the user is logged in,
     * `private` is added. And if the query is run in an admin context (administration area or AJAX call),
     * protected statuses are added too.
     *
     * By default protected statuses are `future`, `draft` and `pending`.
     *
     * @var string|array
     */
    protected $post_status = '';

    /**
     * @return array|string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function getPostStatus() {
        return $this->post_status;
    }

    /**
     * @param array|string $post_status
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function setPostStatus( $post_status ) {
        if ( is_array( $post_status ) || is_string( $post_status ) ) {
            $this->post_status = $post_status;
        }

        return $this;
    }
}