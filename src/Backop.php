<?php
/**
 * Created by Semen Kamenetskiy.
 * Date: 20/08/15
 */

namespace salatnik\backop;

use salatnik\backop\operation\Operation;
use salatnik\backop\operation\OperationException;
use salatnik\backop\operation\OperationRecord;

/**
 * Class Backop
 *
 * @package salatnik\backop
 */
class Backop
{

    /**
     * @var Backop|null
     */
    private static $instance = null;

    /**
     * @return Backop
     */
    private static function instance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new static;
        }
        return static::$instance;
    }

    /**
     * @param Operation $operation
     * @param null      $dateExecute
     *
     * @return bool|int
     */
    public static function add(Operation $operation, $dateExecute = null)
    {
        return static::instance()->addOperation($operation, $dateExecute);
    }

    public static function execute($id = null)
    {
        if (is_null($id)) {
            return static::instance()->executeAll();
        }
        return static::instance()->executeOne($id);
    }

    /**
     * Private for singleton
     */
    private function __construct()
    {
    }

    /**
     * Private for singleton
     */
    private function __clone()
    {
    }

    /**
     * Private for singleton
     */
    private function __sleep()
    {
    }

    /**
     * Private for singleton
     */
    private function __wakeup()
    {
    }

    /**
     * @param Operation $operation
     * @param null      $dateExecute
     *
     * @return bool|int
     */
    private function addOperation(Operation $operation, $dateExecute = null)
    {
        $record = new OperationRecord;
        $record->date_execute = is_null($dateExecute) ? date('Y-m-d H:i:s') : $dateExecute;
        $record->status = Operation::STATUS_READY;
        $record->data = serialize($operation);
        if ($record->save()) {
            return $record->id;
        }
        return false;
    }

    /**
     * @param OperationRecord $record
     *
     * @return bool|void
     */
    private function executeOperation(OperationRecord $record)
    {
        $operation = unserialize($record->data);
        if ($operation instanceof Operation) {
            try {
                $record->result = $operation->run();
                $record->status = Operation::STATUS_DONE;
            } catch (OperationException $error) {
                $record->status = Operation::STATUS_ERROR;
                $record->error = $error->getMessage();
            } catch (\Exception $error) {
            }
            return $record->save();
        }
        return false;
    }

    /**
     * Execute all operations
     *
     * @return bool
     */
    private function executeAll()
    {
        /** @var OperationRecord[] $records */
        $records = OperationRecord::findAll(
            [
                'status' => Operation::STATUS_READY,
                'date_execute < ' . date('Y-m-d H:i:s'),
            ]
        );
        if (sizeof($records) > 0) {
            foreach ($records as $record) {
                $this->executeOperation($record);
            }
        }
        return true;
    }

    /**
     * Execute an operation by id
     *
     * @param $id
     *
     * @return bool|void
     */
    private function executeOne($id)
    {
        /** @var OperationRecord $record */
        $record = OperationRecord::findOne(['id' => $id]);
        if ($record) {
            return $this->executeOperation($record);
        }
        return false;
    }

}
