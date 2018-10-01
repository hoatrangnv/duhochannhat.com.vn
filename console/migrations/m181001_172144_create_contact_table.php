<?php

use yii\db\Migration;

/**
 * Handles the creation of table `contact`.
 * Has foreign keys to the tables:
 *
 * - `user`
 */
class m181001_172144_create_contact_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('contact', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'message' => $this->string(1023),
            'customer_name' => $this->string()->notNull(),
            'customer_phone' => $this->string()->notNull(),
            'customer_email' => $this->string(),
            'status' => $this->smallInteger()->notNull(),
            'type' => $this->smallInteger()->notNull(),
            'updated_user_id' => $this->integer(),
            'created_time' => $this->dateTime()->notNull(),
            'updated_time' => $this->dateTime()->notNull(),
        ], $tableOptions);

        // creates index for column `updated_user_id`
        $this->createIndex(
            'idx-contact-updated_user_id',
            'contact',
            'updated_user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-contact-updated_user_id',
            'contact',
            'updated_user_id',
            'user',
            'id',
            'RESTRICT'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-contact-updated_user_id',
            'contact'
        );

        // drops index for column `updated_user_id`
        $this->dropIndex(
            'idx-contact-updated_user_id',
            'contact'
        );

        $this->dropTable('contact');
    }
}
