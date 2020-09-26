<?php

use yii\db\Migration;

class m160622_070227_bukutamu extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->drivername == 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('bukutamu', [
            'ID' => $this->primaryKey(),
            'CHIP_ID' => $this->string(20)->notNull(),
            'NIK' => $this->string(20)->notNull(),
            'NAMA_LGKP' => $this->string(100)->notNull(),
            'TMPT_LHR' => $this->string(100)->notNull(),
            'TGL_LHR' => $this->date()->notNull(),
            'JENIS_KLMIN' => $this->string(20)->notNull(),
            'ALAMAT' => $this->string(200)->notNull(),
            'RT' => $this->string(3)->notNull(),
            'RW' => $this->string(3)->notNull(),
            'KELURAHAN' => $this->string(100)->notNull(),
            'KECAMATAN' => $this->string(100)->notNull(),
            'KABUPATEN' => $this->string(100)->notNull(),
            'PROPINSI' => $this->string(100)->notNull(),
            'AGAMA' => $this->string(20)->notNull(),
            'STATUS_KAWIN' => $this->string(20)->notNull(),
            'PEKERJAAN' => $this->string(100)->notNull(),
            'NO_TELP' => $this->string(20),
            'INSTANSI' => $this->char(1)->notNull(),
            'TUJUAN' => $this->integer()->notNull(),
            'KEPERLUAN' => $this->string(200)->notNull(),
            'DATE_TAP' => $this->datetime()->notNull(),
            'DATE_OUT' => $this->datetime(),
            'ID_INSTANSI' => $this->integer()->notNull(),
            'NAMA_INSTANSI' => $this->string(200)->notNull(),
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('bukutamu');

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
