<?php
/**
 * Project: wp-query-builder
 * File: Page.php
 * User: Panagiotis Vagenas <pan.vagenas@gmail.com>
 * Date: 9/11/2015
 * Time: 7:42 μμ
 * Since: TODO ${VERSION}
 * Copyright: 2015 Panagiotis Vagenas
 */

namespace Pan\QueryBuilder\Constraints;

use Pan\QueryBuilder\Constraints\Abs\PostPage;

/**
 * {@inheritdoc}
 *
 * @package Pan\QueryBuilder\Constraints
 * @author  Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @since   TODO ${VERSION}
 */
class Page extends PostPage {
    /**
     * use page id
     *
     * @var int
     */
    protected $page_id = 0;
    /**
     * use page slug
     *
     * @var string
     */
    protected $pagename = '';

    /**
     * @return int
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function getPageId() {
        return $this->page_id;
    }

    /**
     * @param int $page_id use page id
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function setPageId( $page_id ) {
        $this->page_id = (int) $page_id;

        return $this;
    }

    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     * @codeCoverageIgnore
     */
    public function getPagename() {
        return $this->pagename;
    }

    /**
     * @param string $pagename use page slug
     *
     * @return $this
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function setPagename( $pagename ) {
        $this->pagename = (string) $pagename;

        return $this;
    }
}