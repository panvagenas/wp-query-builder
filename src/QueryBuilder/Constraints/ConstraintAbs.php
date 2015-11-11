<?php
/**
 * ConstraintAbs.php description
 *
 * @author    Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @date      2015-11-11
 * @version   $Id$
 * @package   Pan\QueryBuilder\Constraints
 * @copyright Copyright (c) 2015 Panagiotis Vagenas
 */


namespace Pan\QueryBuilder\Constraints;

use Pan\QueryBuilder\ArrayObject;

/**
 * Class ConstraintAbs
 *
 * @package Pan\QueryBuilder\Constraints
 * @author  Panagiotis Vagenas <pan.vagenas@gmail.com>
 * @since   TODO ${VERSION}
 */
abstract class ConstraintAbs extends ArrayObject {
    /**
     * @var array
     */
    protected $_defaults = array();

    /**
     * ConstraintAbs constructor.
     *
     * @param array  $input
     * @param int    $flags
     * @param string $iterator_class
     *
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function __construct( array $input, $flags, $iterator_class ) {
        parent::__construct( $input, $flags, $iterator_class );
        $this->setDefaults();
    }

    /**
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    protected function setDefaults(){
        foreach ( $this as $propName => $propValue ) {
            if(strpos($propName, '_') === 0){
                continue;
            }
            $this->_defaults[$propName] = $propValue;
        }
    }

    /**
     * @return array
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function getArrayCopy() {
        $out = array();
        foreach ( $this->_defaults as $propName => $defValue ) {
            if($this[$propName] !== $defValue){
                $out[$propName] = $this[$propName];
            }
        }
        return $out;
    }

    /**
     * @return string
     * @author Panagiotis Vagenas <pan.vagenas@gmail.com>
     * @since  TODO ${VERSION}
     */
    public function getName() {
        return get_class( $this );
    }
}