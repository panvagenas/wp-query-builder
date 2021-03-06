<?php
/**
 * Project: wp-query-builder
 * File: ReturnFields.php
 * User: Panagiotis Vagenas <pan.vagenas@gmail.com>
 * Date: 9/11/2015
 * Time: 7:45 μμ
 * Since: 1.0.0
 * Copyright: 2015 Panagiotis Vagenas
 */

namespace Pan\QueryBuilder\Constraints;

use Pan\QueryBuilder\Constraints\Abs\Constraint;

/**
 * Set return values
 *
 * @package Pan\QueryBuilder\Constraints
 * @author  Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @since   1.0.0
 */
class ReturnFields extends Constraint {
    /**
     * Return an array of post IDs.
     */
    const RETURN_IDS = 'ids';
    /**
     * Return an array of stdClass objects with ID and post_parent properties
     */
    const RETURN_ID_PARENT = 'id=>parent';
    /**
     * Which fields to return. All fields are returned by default.
     * There are two other options:
     *
     * * {@link @ReturnFields::RETURN_IDS}
     * * {@link @ReturnFields::RETURN_ID_PARENT}
     *
     * @var string
     */
    protected $fields = '';

    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function getFields() {
        return $this->fields;
    }

    /**
     * @param string $fields Which fields to return
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     */
    public function setFields( $fields ) {
        $this->fields = (string) $fields;

        return $this;
    }
}