<?php
/**
 * Created by Semen Kamenetskiy.
 * Date: 20/08/15
 */

namespace salatnik\backop\operation;


/**
 * Class Operation
 *
 * @package salatnik\backop\operation
 */
abstract class Operation
    implements OperationInterface
{
    /**
     * The operation is to be executed
     */
    const STATUS_READY = 0;

    /**
     * The operation was executed without errors
     */
    const STATUS_DONE = 1;

    /**
     * The operation was executed with errors
     */
    const STATUS_ERROR = 2;

    /**
     * Attributes container
     *
     * @var array
     */
    public $_attributes = [];

    /**
     * Sets an attribute
     *
     * @param $key
     * @param $value
     *
     * @return $this
     */
    public function setAttribute($key, $value)
    {
        $this->_attributes[$key] = $value;
        return $this;
    }

    /**
     * Returns an attribute
     *
     * @param $key
     *
     * @return null
     */
    public function getAttribute($key)
    {
        if ($this->hasAttribute($key)) {
            return $this->_attributes[$key];
        }
        return null;
    }

    /**
     * Checks if an attribute exists
     *
     * @param $key
     *
     * @return bool
     */
    public function hasAttribute($key)
    {
        return array_key_exists($key, $this->_attributes);
    }

    /**
     * Magic: $this->setAttribute
     *
     * @param $key
     * @param $value
     *
     * @return Operation
     */
    public function __set($key, $value)
    {
        return $this->setAttribute($key, $value);
    }

    /**
     * Magic: $this->getAttribute
     *
     * @param $key
     *
     * @return null
     */
    public function __get($key)
    {
        return $this->getAttribute($key);
    }

    /**
     * Magic: $this->hasAttribute
     *
     * @param $key
     *
     * @return bool
     */
    public function __isset($key)
    {
        return $this->hasAttribute($key);
    }
}

class simon extends Operation
{
    /**
     * Main operation objective.
     * This method is the only one that will be triggered upon execution. You can add your own methods to your custom
     * class if needed and trigger them from here. This method should always return bool.
     *
     * @return bool
     * @trows OperationException
     */
    public function run()
    {
        // TODO: Implement run() method.
    }
}


(new simon())->date_create = 123;