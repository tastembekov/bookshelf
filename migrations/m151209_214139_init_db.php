<?php

use yii\db\Schema;
use yii\db\Migration;

class m151209_214139_init_db extends Migration
{
    public function up()
    {
        $tableOptions_mysql = "CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB";

        $this->createTable('{{%users}}', [
            'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
            0 => 'PRIMARY KEY (`id`)',
            'username' => 'VARCHAR(255) NOT NULL',
            'password_hash' => 'VARCHAR(255) NOT NULL',
            'salt' => 'VARCHAR(255) NOT NULL',
        ], $tableOptions_mysql);

        $this->createTable('{{%authors}}', [
            'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
            0 => 'PRIMARY KEY (`id`)',
            'firstname' => 'VARCHAR(255) NOT NULL',
            'lastname' => 'VARCHAR(255) NOT NULL',
        ], $tableOptions_mysql);

        $this->createTable('{{%images}}', [
            'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
            0 => 'PRIMARY KEY (`id`)',
            'real_path' => 'VARCHAR(255) NOT NULL',
            'preview_path' => 'VARCHAR(255) NOT NULL',
        ], $tableOptions_mysql);

        $this->createTable('{{%books}}', [
            'id' => 'INT(11) NOT NULL AUTO_INCREMENT',
            0 => 'PRIMARY KEY (`id`)',
            'author_id' => 'INT(11) NOT NULL',
            'name' => 'VARCHAR(255) NOT NULL',
            'date_create' => 'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ',
            'date_update' => 'TIMESTAMP NULL',
            'image_id' => 'INT(11) NOT NULL',
            'date' => 'DATE NULL',
            'status' => 'INT(11) NOT NULL DEFAULT \'1\'',
        ], $tableOptions_mysql);


        $this->createIndex('idx_UNIQUE_username_65_00','bs_users','username',1);
        $this->createIndex('idx_author_id_6567_01','bs_books','author_id',0);
        $this->createIndex('idx_image_id_6567_02','bs_books','image_id',0);

        $this->execute('SET foreign_key_checks = 0');
        $this->addForeignKey('fk_bs_authors_6563_00','{{%books}}', 'author_id', '{{%authors}}', 'id', 'CASCADE', 'NO ACTION' );
        $this->addForeignKey('fk_bs_images_6563_01','{{%books}}', 'image_id', '{{%images}}', 'id', 'CASCADE', 'NO ACTION' );
        $this->execute('SET foreign_key_checks = 1;');

        $this->execute('SET foreign_key_checks = 0');
        $this->insert('{{%users}}',['id'=>'2','username'=>'guest','password_hash'=>'$2y$13$wxAGZJibDpH6lJFyxXGTguKo71/BvrnA1Op31X3/RsMpvks9hr0GS','salt'=>'617NhA04H8PG-JP1LPEiO4YmMngwbzOv']);
        $this->insert('{{%authors}}',['id'=>'1','firstname'=>'Борис','lastname'=>'Акунин']);
        $this->insert('{{%authors}}',['id'=>'2','firstname'=>'Айзек','lastname'=>'Азимов']);
        $this->insert('{{%images}}',['id'=>'1','real_path'=>'/covers/real/lica_epohi.jpg','preview_path'=>'/covers/preview/lica_epohi.jpg']);
        $this->insert('{{%images}}',['id'=>'2','real_path'=>'/covers/real/ordynskiy_period.jpg','preview_path'=>'/covers/preview/ordynskiy_period.jpg']);
        $this->insert('{{%books}}',['id'=>'1','author_id'=>'2','name'=>'Лица эпохи','date_create'=>'2015-12-10 01:06:38','date_update'=>'2015-12-10 03:01:09','image_id'=>'1','date'=>'2015-06-13','status'=>'1']);
        $this->insert('{{%books}}',['id'=>'2','author_id'=>'1','name'=>'Ордынский период','date_create'=>'2015-12-10 01:13:32','date_update'=>'2015-12-10 03:08:03','image_id'=>'2','date'=>'2015-05-27','status'=>'1']);
        $this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        echo "m151209_214139_init_db cannot be reverted.\n";

        return false;
    }
}
