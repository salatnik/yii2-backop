<?php
/**
 * Created by Semen Kamenetskiy.
 * Date: 20/08/15
 */
namespace salatnik\backop\operation;

use yii\db\ActiveRecord;

/**
 * Class OperationRecord
 *
 * @package salatnik\backop\operation
 *
 * @property int    id
 * @property string date_create
 * @property string date_execute
 * @property bool   status
 * @property string data
 * @property bool   result
 */
class OperationRecord
    extends ActiveRecord
{

    /**
     * @param bool $runValidation
     * @param null $attributeNames
     *
     * @return bool|void
     */
    public function save($runValidation = true, $attributeNames = null)
    {
        if ($this->getIsNewRecord()) {
            $this->date_create = date('Y-m-d H:i:s');
        }
        if (is_null($this->date_execute)) {
            $this->date_execute = date('Y-m-d H:i:s');
        }
        return parent::save($runValidation, $attributeNames);
    }

}