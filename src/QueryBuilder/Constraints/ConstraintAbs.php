<?php
/**
 * ConstraintAbs.php description
 *
 * @author    Panagiotis Vagenas <Panagiotis.Vagenas@interactivedata.com>
 * @date      2015-11-11
 * @version   $Id$
 * @package   Pan\QueryBuilder\Constraints
 * @copyright Copyright (c) 2015 Interactive Data Managed Solutions Ltd.
 */


namespace Pan\QueryBuilder\Constraints;

use Pan\QueryBuilder\ArrayObject;

/**
 * Class ConstraintAbs
 *
 * @author    Panagiotis Vagenas <Panagiotis.Vagenas@interactivedata.com>
 * @date      2015-11-11
 * @version   $Id$
 * @package   Pan\QueryBuilder\Constraints
 * @copyright Copyright (c) 2015 Interactive Data Managed Solutions Ltd.
 */
abstract class ConstraintAbs extends ArrayObject {
    public function getName(){
        return get_class($this);
    }
}