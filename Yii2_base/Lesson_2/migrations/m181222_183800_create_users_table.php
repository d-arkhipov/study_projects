<?php

use yii\db\Migration;

/**
 * Handles the creation of table `users`.
 */
class m181222_183800_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'username' => $this->string(16)->notNull(),
            'password' => $this->string(32)->notNull(),
            'authKey' => $this->string(32)->notNull(),
            'accessToken' => $this->string(32)->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('users');
    }
}
