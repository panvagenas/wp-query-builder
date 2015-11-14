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

/**
 * {@inheritdoc}
 *
 * @package Pan\QueryBuilder\Constraints
 * @author  Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @since   TODO ${VERSION}
 */
class Page extends Post {
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
     */
    public function getPageId() {
        return $this->page_id;
    }

    /**
     * @param int $page_id
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
     */
    public function getPagename() {
        return $this->pagename;
    }

    /**
     * @param string $pagename
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