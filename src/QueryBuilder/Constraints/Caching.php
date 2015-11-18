<?php
/**
 * Project: wp-query-builder
 * File: Caching.php
 * User: Panagiotis Vagenas <pan.vagenas@gmail.com>
 * Date: 9/11/2015
 * Time: 7:44 μμ
 * Since: 1.0.0
 * Copyright: 2015 Panagiotis Vagenas
 */

namespace Pan\QueryBuilder\Constraints;

use Pan\QueryBuilder\Constraints\Abs\Constraint;

/**
 * Stop the data retrieved from being added to the cache
 *
 * @package Pan\QueryBuilder\Constraints
 * @author  Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @since   1.0.0
 */
class Caching extends Constraint {
    /**
     * Post information cache
     *
     * @var boolean
     */
    protected $cache_results = true;

    /**
     * Post meta information cache
     *
     * @var boolean
     */
    protected $update_post_meta_cache = true;

    /**
     * Post term information cache
     *
     * @var boolean
     */
    protected $update_post_term_cache = true;

    /**
     * @return boolean
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function isCacheResults() {
        return $this->cache_results;
    }

    /**
     * Post information cache
     *
     * @param boolean $cache_results
     *
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     */
    public function setCacheResults( $cache_results ) {
        $this->cache_results = (bool) $cache_results;
    }

    /**
     * @return boolean
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function isUpdatePostMetaCache() {
        return $this->update_post_meta_cache;
    }

    /**
     * Post meta information cache
     *
     * @param boolean $update_post_meta_cache
     *
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     */
    public function setUpdatePostMetaCache( $update_post_meta_cache ) {
        $this->update_post_meta_cache = (bool) $update_post_meta_cache;
    }

    /**
     * @return boolean
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     * @codeCoverageIgnore
     */
    public function isUpdatePostTermCache() {
        return $this->update_post_term_cache;
    }

    /**
     * Post term information cache
     *
     * @param boolean $update_post_term_cache
     *
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  1.0.0
     */
    public function setUpdatePostTermCache( $update_post_term_cache ) {
        $this->update_post_term_cache = (bool) $update_post_term_cache;
    }
}