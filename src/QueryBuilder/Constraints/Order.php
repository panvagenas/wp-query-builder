<?php
/**
 * Project: wp-query-builder
 * File: Order.php
 * User: Panagiotis Vagenas <pan.vagenas@gmail.com>
 * Date: 9/11/2015
 * Time: 7:43 μμ
 * Since: TODO ${VERSION}
 * Copyright: 2015 Panagiotis Vagenas
 */

namespace Pan\QueryBuilder\Constraints;

use Pan\QueryBuilder\Constraints\Abs\Constraint;
use Pan\QueryBuilder\Constraints\Ifc\TypeConstants;

/**
 * Sort retrieved posts
 *
 * @package Pan\QueryBuilder\Constraints
 * @author  Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @since   TODO ${VERSION}
 */
class Order extends Constraint implements TypeConstants {
    /**
     * ascending order from lowest to highest values (1, 2, 3; a, b, c)
     */
    const ORDER_DESC = 'DESC';

    /**
     * descending order from highest to lowest values (3, 2, 1; c, b, a).
     */
    const ORDER_ASC = 'ASC';

    /**
     * No order (available since Version 2.8)
     */
    const ORDER_NONE = 'none';

    /**
     * Order by author
     */
    const ORDER_AUTHOR = 'author';

    /**
     * Order by post id. Note the capitalization
     */
    const ORDER_ID = 'ID';

    /**
     * Order by title
     */
    const ORDER_TITLE = 'title';

    /**
     * Order by post name (post slug).
     */
    const ORDER_NAME = 'name';

    /**
     * Order by post type (available since Version 4.0).
     */
    const ORDER_TYPE = 'type';

    /**
     * Order by date
     */
    const ORDER_DATE = 'date';

    /**
     * Order by last modified date
     */
    const ORDER_MODIFIED = 'modified';

    /**
     * Order by post/page parent id
     */
    const ORDER_PARENT = 'parent';

    /**
     * Random order
     */
    const ORDER_RAND = 'rand';

    /**
     * Order by number of comments (available since Version 2.9)
     */
    const ORDER_COMMENT_COUNT = 'comment_count';

    /**
     * Order by Page Order. Used most often for Pages (*Order* field in the Edit Page Attributes box)
     * and for Attachments (the integer fields in the Insert / Upload Media Gallery dialog),
     * but could be used for any post type with distinct `menu_order` values (they all default to 0).
     */
    const ORDER_MENU_ORDER = 'menu_order';

    /**
     * Note that a `meta_key=keyname` must also be present in the query.
     *
     * Note also that the sorting will be alphabetical which is fine for strings (i.e. words),
     * but can be unexpected for numbers (e.g. 1, 3, 34, 4, 56, 6, etc, rather than 1, 3, 4, 6, 34, 56
     * as you might naturally expect). Use `meta_value_num` instead for numeric values.
     *
     * You may also specify `meta_type` if you want to cast the meta value as a specific type.
     * Possible values are all in {@link TypeConstants}.
     */
    const ORDER_META_VALUE = 'meta_value';

    /**
     * Order by numeric meta value (available since Version 2.8). Also note that a `meta_key=keyname`
     * must also be present in the query. This value allows for numerical sorting as noted above in `meta_value`
     */
    const ORDER_META_VALUE_NUM = 'meta_value_num';

    /**
     * Preserve post ID order given in the `post__in` array (available since Version 3.5)
     */
    const ORDER_POST__IN = 'post__in';

    /**
     *
     */
    const META_TYPE = 'meta_type';

    /**
     * Valid values for {@link Order;:$orderby}
     *
     * @var array
     */
    protected static $__orderby__ = array(
        Order::ORDER_AUTHOR,
        Order::ORDER_COMMENT_COUNT,
        Order::ORDER_DATE,
        Order::ORDER_ID,
        Order::ORDER_MENU_ORDER,
        Order::ORDER_META_VALUE,
        Order::ORDER_META_VALUE_NUM,
        Order::ORDER_MODIFIED,
        Order::ORDER_NAME,
        Order::ORDER_NONE,
        Order::ORDER_PARENT,
        Order::ORDER_POST__IN,
        Order::ORDER_RAND,
        Order::ORDER_TITLE,
        Order::ORDER_TYPE,
    );
    /**
     * Valid values for {@link Order;:$order}
     *
     * @var array
     */
    protected static $__order__ = array(
        Order::ORDER_ASC,
        Order::ORDER_DESC,
    );
    /**
     * Designates the ascending or descending order of the `orderby` parameter. Defaults to `DESC`.
     * An array can be used for multiple order/orderby sets
     *
     * TODO WordPress codex don't actually explain how to use this as an array
     *
     * @var string | array
     */
    protected $order = Order::ORDER_DESC;
    /**
     * Sort retrieved posts by parameter. Defaults to 'date (post_date)'.
     * One or more options can be passed
     *
     * @var string
     */
    protected $orderby = '';

    /**
     * @return array|string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function getOrder() {
        return $this->order;
    }

    /**
     * FIXME For now we only make use if $order is a string due to luck of proper documentation from WordPress Codex
     *
     * @param array|string $order Designates the ascending or descending order of the `orderby` parameter. Defaults to
     *                            `DESC`. An array can be used for multiple order/orderby sets
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function setOrder( $order ) {
        if ( is_string( $order ) && in_array( $order, self::$__order__ ) ) {
            $this->order = $order;

            return $this;
        }

        trigger_error( 'Invalid $order value(s) in ' . __METHOD__ );

        return new \WP_Error( 'warning', 'Invalid $order value(s) in ' . __METHOD__ );
    }

    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function getOrderby() {
        return $this->orderby;
    }

    /**
     * @param string $orderby Sort retrieved posts by parameter. Defaults to `date` (post_date). One or more options
     *                        can be passed
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function setOrderby( $orderby ) {
        if ( is_string( $orderby ) && in_array( $orderby, self::$__orderby__ ) ) {
            $this->orderby = $orderby;

            return $this;
        }

        if ( is_array( $orderby ) ) {
            $orderByValid = array();

            foreach ( $orderby as $key => $order ) {
                if ( in_array( $key, self::$__orderby__ ) && in_array( $order, self::$__order__ ) ) {
                    $orderByValid[ $key ] = $order;
                }
            }
            $this->orderby = $orderByValid;

            return $this;
        }

        trigger_error( 'Invalid $orderby value(s) in ' . __METHOD__ );

        return new \WP_Error( 'warning', 'Invalid $orderby value(s) in ' . __METHOD__ );
    }
}