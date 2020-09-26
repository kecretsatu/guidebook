<?php

use yii\db\Migration;

class m160628_073259_propinsi extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%propinsi}}', [
            'NO_PROP' => $this->primaryKey(),
            'NAMA_PROP' => $this->string(180)->notNull(),
            'KET' => $this->string(900),
        ], $tableOptions);

        // intro: https://en.wikipedia.org/wiki/Provinces_of_Indonesia
        $this->batchInsert('{{%propinsi}}', ['NO_PROP', 'NAMA_PROP'], [
                ['11', 'ACEH'],
                ['12', 'SUMATERA UTARA'],
                ['13', 'SUMATERA BARAT'],
                ['14', 'RIAU'],
                ['15', 'JAMBI'],
                ['16', 'SUMATERA SELATAN'],
                ['17', 'BENGKULU'],
                ['18', 'LAMPUNG'],
                ['19', 'KEPULAUAN BANGKA BELITUNG'],
                ['21', 'KEPULAUAN RIAU'],
                ['31', 'DKI JAKARTA'],
                ['32', 'JAVA BARAT'],
                ['33', 'JAVA TENGAH'],
                ['34', 'DAERAH ISTIMEWA YOGYAKARTA'],
                ['35', 'JAWA TIMUR'],
                ['36', 'BANTEN'],
                ['51', 'BALI'],
                ['52', 'NUSA TENGARA BARAT'],
                ['53', 'NUSA TENGGARA TIMUR'],
                ['61', 'KALIMANTAN BARAT'],
                ['62', 'KALIMANTAN TENGAH'],
                ['63', 'KALIMANTAN SELATAN'],
                ['64', 'KALIMANTAN TIMUR'],
                ['65', 'KALIMANTAN UTARA'],
                ['71', 'SULAWESI UTARA'],
                ['72', 'SULAWESI TENGAH'],
                ['73', 'SULAWESI SELATAN'],
                ['74', 'SULAWESI TENGGARA'],
                ['75', 'SULAWESI TENGGARA'],
                ['76', 'GORONTALO'],
                ['81', 'MALUKU'],
                ['82', 'MALUKU UTARA'],
                ['91', 'PAPUA'],
                ['92', 'PAPUA BARAT'],
            ]);
    }

    public function down()
    {
        $this->dropTable('{{%propinsi}}');

        return true;
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
