<?php
/**
 * Project: wp-query-builder
 * File: Taxonomy.php
 * User: Panagiotis Vagenas <pan.vagenas@gmail.com>
 * Date: 10/11/2015
 * Time: 12:32 πμ
 * Since: TODO ${VERSION}
 * Copyright: 2015 Panagiotis Vagenas
 */

namespace Pan\QueryBuilder\Constraints;

/**
 * Show posts associated with certain taxonomy: {@link http://codex.wordpress.org/Taxonomies}
 *
 * @package Pan\QueryBuilder\Constraints
 * @author  Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @since   TODO ${VERSION}
 */
class Taxonomy extends AbsMetaConstraint implements IfcRelationConstants, IfcCompareConstants {
    /**
     * Term ID
     */
    const FIELD_TERM_ID = 'term_id';
    /**
     * Term name
     */
    const FIELD_NAME = 'name';
    /**
     * Term slug
     */
    const FIELD_SLUG = 'slug';
    /**
     * @var string
     */
    protected static $_wrap = 'tax_query';
    /**
     * Valid values for $field
     *
     * @var array
     */
    protected static $__field__ = array(
        self::FIELD_TERM_ID,
        self::FIELD_SLUG,
        self::FIELD_NAME,
    );
    /**
     * Valid values for $operator
     *
     * @var array
     */
    protected static $__operator__ = array(
        self::IN,
        self::NOT_IN,
        self::RELATION_AND,
        self::EXISTS,
        self::NOT_EXISTS
    );
    /**
     * Valid values for relation
     *
     * @var array
     */
    protected static $__relation__ = array(
        self::RELATION_AND,
        self::RELATION_AND,
    );
    /**
     * use taxonomy parameters
     *
     * @var array
     */
    protected $tax_query = array();
    /**
     * The logical relationship between each inner taxonomy array when there is more than one.
     * Possible values are {@link IfcRelationConstants::RELATION_AND}, {@link IfcRelationConstants::RELATION_OR}.
     * Do not use with a single inner taxonomy array
     *
     * @var string
     */
    protected $_relation = '';

    /**
     * @return array
     * @throws \Exception
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function getArrayCopy() {
        $out = parent::getArrayCopy();
        if ( count( $out ) > 1 && $this->_relation ) {
            $out['relation'] = $this->_relation;
        }

        return $out;
    }

    /**
     * @param array $data
     *
     * @return array
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function exchangeArray( $data ) {
        $this->tax_query = array();

        foreach ( $data as $index => $item ) {
            if ( $index === 'relation' ) {
                $this->setRelation( $item );
            }

            if ( is_array( $index ) && isset( $index['taxonomy'] ) && isset( $index['terms'] ) ) {
                $taxonomy         = $item['taxonomy'];
                $terms            = $item['terms'];
                $field            = isset( $item['field'] ) ? $item['field'] : self::FIELD_TERM_ID;
                $include_children = isset( $item['include_children'] ) ? $item['include_children'] : true;
                $operator         = isset( $item['operator'] ) ? $item['operator'] : self::IN;

                $this->add( $taxonomy, $terms, $field, $include_children, $operator );
            }
        }

        return $this->tax_query;
    }

    /**
     * @param $relation
     *
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function setRelation( $relation ) {
        if ( ! $this->isValidRelation( $relation ) ) {
            throw new \InvalidArgumentException( 'Wrong meta query relation definition' );
        }
        $this->_relation = $relation;
    }

    /**
     * @param $relation
     *
     * @return bool
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function isValidRelation( $relation ) {
        return in_array( $relation, static::$__relation__, true );
    }

    /**
     * @param string           $taxonomy         Taxonomy
     * @param int|string|array $terms            Taxonomy term(s).
     * @param string           $field            Select taxonomy term by. Possible values are
     *                                           {@link Taxonomy::FIELD_TERM_ID},
     *                                           {@link Taxonomy::FIELD_NAME} and {@link Taxonomy::FIELD_SLUG}.
     *                                           Default value is {@link Taxonomy::FIELD_TERM_ID}
     * @param bool|true        $include_children Whether or not to include children for hierarchical taxonomies.
     *                                           Defaults to true
     * @param string           $operator         Operator to test. Possible values are {@link Taxonomy::IN},
     *                                           {@link Taxonomy::NOT_IN}, {@link Taxonomy::RELATION_AND},
     *                                           {@link Taxonomy::EXISTS} and {@link Taxonomy::NOT_EXISTS}.
     *                                           Default value is {@link Taxonomy::IN}.
     *
     * @return array
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function add(
        $taxonomy,
        $terms,
        $field = self::FIELD_TERM_ID,
        $include_children = true,
        $operator = self::IN
    ) {
        if ( ! $this->validateAddValues( $taxonomy, $terms, $field, $operator ) ) {
            return array();
        }

        $compose = array(
            'taxonomy' => $taxonomy,
            'terms'    => $terms
        );

        if ( $field !== self::FIELD_TERM_ID ) {
            $compose['field'] = $field;
        }

        if ( ! $include_children ) {
            $compose['include_children'] = false;
        }

        if ( $operator !== self::IN ) {
            $compose['operator'] = $operator;
        }

        $this->tax_query[] = $compose;

        return $this->tax_query;
    }

    /**
     * @see    {@link Taxonomy::exchangeArray()}
     *
     * @param        $taxonomy
     * @param        $terms
     * @param string $field
     * @param string $operator
     *
     * @return bool
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function validateAddValues( $taxonomy, $terms, $field = self::FIELD_TERM_ID, $operator = self::IN ) {
        $invalid = array();

        if ( ! is_string( $taxonomy ) || empty( $taxonomy ) ) {
            $invalid[] = '$taxonomy';
        }

        if ( ! ( is_array( $terms ) || is_string( $terms ) || is_int( $terms ) ) ) {
            $invalid[] = '$terms';
        }

        if ( ! in_array( $field, static::$__field__ ) ) {
            $invalid[] = '$field';
        }

        if ( ! in_array( $operator, static::$__operator__ ) ) {
            $invalid[] = '$operator';
        }

        if ( ! empty( $invalid ) ) {
            trigger_error( 'Invalid value for values ' . implode( ', ', $invalid ) . ' in ' . __METHOD__ );

            return false;
        }

        return true;
    }
}