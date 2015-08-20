<?php
/**
 * Created by Semen Kamenetskiy.
 * Date: 20/08/15
 */

namespace salatnik\backop\operation;

/**
 * Interface OperationInterface
 *
 * @package salatnik\backop\operation
 */
interface OperationInterface
{
    /**
     * Main operation objective.
     * This method is the only one that will be triggered upon execution. You can add your own methods to your custom
     * class if needed and trigger them from here. This method should always return bool.
     *
     * @return bool
     * @trows OperationException
     */
    public function run();
}