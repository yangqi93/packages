<?php

use yii\db\Migration;

/**
 * Class m180918_063935_create_packages
 */
class m180918_063935_create_packages extends Migration
{
    const TABLE_NAME = 'packages';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(self::TABLE_NAME, [
            'id' => $this->primaryKey(),
            'company' => $this->tinyInteger('3')->notNull()->defaultValue(0)->comment('快递公司'),
            'sn' => $this->string(50)->notNull()->defaultValue(0)->comment('快递单号'),
            'phone' => $this->integer(11)->notNull()->defaultValue(0)->comment('收件人手机号'),
            'status' => $this->tinyInteger(1)->notNull()->defaultValue(0)->comment('状态'),
            'address' => $this->string(10)->notNull()->defaultValue('')->comment('库位'),
            'received_at' => $this->integer(11)->notNull()->defaultValue(0)->comment('入库时间'),
            'signing_at' => $this->integer(11)->notNull()->defaultValue(0)->comment('出库时间'),
            'created_at' => $this->integer(11)->notNull()->defaultValue(0),
            'updated_at' => $this->integer(11)->notNull()->defaultValue(0),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180918_063935_create_packages cannot be reverted.\n";

        return false;
    }
    */
}
