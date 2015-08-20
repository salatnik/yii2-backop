<?php
/**
 * Created by Semen Kamenetskiy.
 * Date: 20/08/15
 */

namespace salatnik\backop\operation;

/**
 * Class OperationException
 *
 * @package salatnik\backop\operation
 */
class OperationException
    extends \Exception
{

    /**
     * @param string     $message
     * @param int        $code
     * @param \Exception $previous
     */
    public function __construct($message = '', $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}