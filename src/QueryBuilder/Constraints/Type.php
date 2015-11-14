<?php
/**
 * Project: wp-query-builder
 * File: Type.php
 * User: Panagiotis Vagenas <pan.vagenas@gmail.com>
 * Date: 9/11/2015
 * Time: 7:42 μμ
 * Since: TODO ${VERSION}
 * Copyright: 2015 Panagiotis Vagenas
 */

namespace Pan\QueryBuilder\Constraints;

use Pan\QueryBuilder\Constraints\Abs\Constraint;

/**
 * Show posts associated with certain type: {@link http://codex.wordpress.org/Post_Types}
 *
 * @package Pan\QueryBuilder\Constraints
 * @author  Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @since   TODO ${VERSION}
 */
class Type extends Constraint {
    /**
     * a post
     */
    const POST = 'post';
    /**
     * a page
     */
    const PAGE = 'page';
    /**
     * a revision
     */
    const REVISION = 'revision';
    /**
     * an attachment. Whilst the default {@link WP_Query} post_status is `publish`, attachments have a default
     * post_status of `inherit`. This means no attachments will be returned unless you also explicitly set
     * post_status to `inherit` or `any`
     */
    const ATTACHMENT = 'attachment';
    /**
     * retrieves any type except revisions and types with 'exclude_from_search' set to true
     */
    const ANY = 'ANY';
    /**
     * a navigation menu item
     */
    const NAV_MENU_ITEM = 'nav_menu_item';

    /**
     * Retrieves posts by Post Types, default value is {@link Type::POST}. If 'tax_query' is set for a query,
     * the default value becomes {@link Type::ANY}
     *
     * @var string|array
     */
    protected $post_type = self::POST;

    /**
     * @return mixed
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function getPostType() {
        return $this->post_type;
    }

    /**
     * @param string|array $post_type
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function setPostType( $post_type ) {
        if ( is_array( $post_type ) || is_string( $post_type ) ) {
            $this->post_type = $post_type;
        }

        return $this;
    }
}