<?php

use yii\db\Migration;

class m160624_073621_instansi extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->drivername == 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('instansi', [
            'ID' => $this->primaryKey(),
            'NAMA_INSTANSI' => $this->string()->unique()->notNull(),
            'NO_PROP' => $this->integer()->notNull(),
            'NO_KAB' => $this->integer()->notNull(),
            ], $tableOptions);

        $this->batchInsert('{{%instansi}}', ['NAMA_INSTANSI', 'NO_PROP', 'NO_KAB'], [
                ['MENTERI', 31, 71],
                ['INSPEKTUR JENDRAL',31,71],
                ['SEKRETARIAT JENDERAL',31,71],
                ['DITJEN KESATUAN BANGSA DAN POLITIK',31,71],
                ['DITJEN PEMERINTAHAN',31,71],
                ['DITJEN OTONOMI DAERAH',31,71],
                ['DITJEN BINA PEMBANGUNAN DAERAH',31,71],
                ['DITJEN PEMBERDAYAAN MASYARAKAT DAN DESA',31,71],
                ['DITJEN KEPENDUDUKAN DAN PENCATATAN SIPIL',31,71],
                ['DITJEN KEUANGAN DAERAH',31,71],
                ['BADAN PENELITIAN DAN PENGEMBANGAN',31,71],
                ['BADAN PENDIDIKAN PELATIHAN',31,71],
                ['STAF AHLI MENTERI BIDANG HUKUM, POLITIK DAN HUBUNGAN ANTAR LEMBAGA',31,71],
                ['STAF AHLI MENTERI BIDANG PEMERINTAHAN',31,71],
                ['STAF AHLI MENTERI BIDANG PEMBANGUNAN DAN KEMASYARAKATAN',31,71],
                ['STAF AHLI MENTERI BIDANG SUMBER DAYA MANUSIA DAN KEPENDUDUKAN.',31,71],
                ['STAF AHLI MENTERI BIDANG EKONOMI DAN KEUANGAN',31,71],
        ]);
    }

    public function down()
    {
        $this->dropTable('instansi');

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
