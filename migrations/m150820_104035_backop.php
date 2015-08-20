<?php
use yii\db\Schema;
use yii\db\Migration;

/**
 * Class m150820_104035_backop
 */
class m150820_104035_backop
    extends Migration
{
    /**
     * Table name
     */
    const table = '{{%backop}}';

    /**
     * Migrate up
     *
     * @return bool
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            static::table,
            [
                'id'           => Schema::TYPE_BIGPK,
                'date_create'  => Schema::TYPE_DATETIME,
                'date_execute' => Schema::TYPE_DATETIME,
                'status'       => Schema::TYPE_INTEGER . ' DEFAULT "0"',
                'data'         => Schema::TYPE_TEXT,
                'result'       => Schema::TYPE_BOOLEAN,
                'error'        => Schema::TYPE_TEXT,
            ],
            $tableOptions
        );
        return true;
    }

    /**
     * Migrate down
     *
     * @return bool
     */
    public function down()
    {
        $this->dropTable(static::table);
        return true;
    }
}
