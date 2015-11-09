<?php
/**
 * Project: wp-query-builder
 * File: Caching.php
 * User: Panagiotis Vagenas <pan.vagenas@gmail.com>
 * Date: 9/11/2015
 * Time: 7:44 μμ
 * Since: TODO ${VERSION}
 * Copyright: 2015 Panagiotis Vagenas
 */

namespace Pan\QueryBuilder\Constraints;

use Pan\QueryBuilder\ArrayObject;

/**
 * Stop the data retrieved from being added to the cache
 *
 * @package Pan\QueryBuilder\Constraints
 * @author  Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @since   TODO ${VERSION}
 */
class Caching extends ArrayObject {
	/**
	 * Post information cache
	 *
	 * @var boolean
	 */
	protected $cache_results;
	/**
	 * Post meta information cache
	 *
	 * @var boolean
	 */
	protected $update_post_meta_cache;
	/**
	 * Post term information cache
	 *
	 * @var boolean
	 */
	protected $update_post_term_cache;

	/**
	 * @return boolean
	 * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
	 * @since  TODO ${VERSION}
	 */
	public function isCacheResults() {
		return $this->cache_results;
	}

	/**
	 * @param boolean $cache_results
	 *
	 * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
	 * @since  TODO ${VERSION}
	 */
	public function setCacheResults( $cache_results ) {
		$this->cache_results = (bool) $cache_results;
	}

	/**
	 * @return boolean
	 * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
	 * @since  TODO ${VERSION}
	 */
	public function isUpdatePostMetaCache() {
		return $this->update_post_meta_cache;
	}

	/**
	 * @param boolean $update_post_meta_cache
	 *
	 * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
	 * @since  TODO ${VERSION}
	 */
	public function setUpdatePostMetaCache( $update_post_meta_cache ) {
		$this->update_post_meta_cache = (bool) $update_post_meta_cache;
	}

	/**
	 * @return boolean
	 * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
	 * @since  TODO ${VERSION}
	 */
	public function isUpdatePostTermCache() {
		return $this->update_post_term_cache;
	}

	/**
	 * @param boolean $update_post_term_cache
	 *
	 * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
	 * @since  TODO ${VERSION}
	 */
	public function setUpdatePostTermCache( $update_post_term_cache ) {
		$this->update_post_term_cache = (bool) $update_post_term_cache;
	}
}