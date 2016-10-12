<?php

use yii\db\Migration;

class m161012_190705_add_date_to_menu extends Migration
{
    public function up()
    {
        $this->addColumn('content_menu', 'date_update', $this->dateTime());
    }

    public function down()
    {
        $this->dropColumn('content_menu', 'date_update');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
