<?php

use yii\db\Schema;
use yii\db\Migration;

class m160205_224420_user_menu extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('user',[
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull(),
            'password' => $this->string()->notNull(),
            'auth_key' => $this->string()->notNull(),
            'token' => $this->string()->notNull(),
            'email' => $this->string()->notNull(),
        ],$tableOptions);
        $this->execute($this->addUserSql());
        $this->createTable('content_menu',[
            'id' => $this->primaryKey(),
//            'status' => $this->integer('11'),
            'status' => 'ENUM("on","off") NOT NULL',
            'content' => $this->text()->notNull(),
        ],$tableOptions);
        $this->insert('content_menu',['id' => '1','status' => 'on',]);
        $this->insert('content_menu',['id' => '2','status' => 'off',]);
        $this->insert('content_menu',['id' => '3','status' => 'off',]);
    }

    public function down()
    {
        $this->dropTable('user');
        $this->dropTable('content_menu');
//        echo "m160205_224420_user_menu cannot be reverted.\n";
//
//        return false;
    }

    private function addUserSql()
    {
        $password = Yii::$app->security->generatePasswordHash('sechythucin1');
        $auth_key = Yii::$app->security->generateRandomString();
        $token = Yii::$app->security->generateRandomString() . '_' . time();
        return "INSERT INTO {{%user}} (`username`, `email`, `password`, `auth_key`, `token`) VALUES ('admin', 'bistro39.ru@gmail.com', '$password', '$auth_key', '$token')";
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
