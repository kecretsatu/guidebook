<?php

use yii\db\Migration;

class m160624_073630_subinstansi extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->drivername == 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('subinstansi', [
            'ID_INSTANSI' => $this->integer()->notNull(),
            'NAMA_SUB_INSTANSI' => $this->string(200)->notNull(),
            'ID' => $this->primaryKey(),
            ], $tableOptions);

        $this->addForeignKey('FK_INSTANSI', '{{%subinstansi}}', 'ID_INSTANSI', '{{%instansi}}', 'ID','CASCADE', 'CASCADE');

        $this->batchInsert('{{%subinstansi}}', ['ID_INSTANSI', 'NAMA_SUB_INSTANSI'], [
                [3, 'BIRO PERENCANAAN'],
                [3, 'BIRO KEPEGAWAIAN'],
                [3, 'BIRO ORGANISASI'],
                [3, 'BIRO HUKUM'],
                [3, 'BIRO UMUM'],
                [4, 'SEKRETARIAT DITJEN'],
                [4, 'DIREKTORAT BINA IDEOLOGI DAN WAWASAN KEBANGSAAN'],
                [4, 'DIREKTORAT KEWASPADAAN NASIONAL'],
                [4, 'DIREKTORAT KETAHANAN SENI, BUDAYA, AGAMA DAN KEMASYARAKATAN'],
                [4, 'DIREKTORAT POLITIK DALAM NEGERI'],
                [4, 'DIREKTORAT KETAHANAN EKONOMI'],
                [5, 'SEKRETARIAT DITJEN'],
                [5, 'DIREKTORAT DEKONSENTRASI DAN KERJASAMA'],
                [5, 'DIREKTORAT WILAYAH ADMINISTRASI DAN PERBATASAN'],
                [5, 'DIREKTORAT POLISI PAMONG PRAJA, DAN PERLINDUNGAN MASYARAKAT'],
                [5, 'DIREKTORAT KAWASAN DAN PERTAHANAN'],
                [5, 'DIREKTORAT PENCEGAHAN DAN PENANGGULANGAN BENCANA'],
                [6, 'SEKRETARIAT DITJEN'],
                [6, 'DIREKTORAT URUSAN PEMERINTAHAN DAERAH I'],
                [6, 'DIREKTORAT URUSAN PEMERINTAHAN DAERAH II'],
                [6, 'DIREKTORAT PENATAAN DAERAH, OTONOMI KHUSUS DAN DEWAN PERTIMBANGAN OTONOMI DAERAH'],
                [6, 'DIREKTORAT FASILITASI KEPALA DAERAH, DPRD DAN HUBUNGAN ANTAR LEMBAGA'],
                [6, 'DIREKTORAT PENINGKATAN KAPASITAS DAN EVALUASI KINERJA DAERAH'],
                [7, 'SEKRETARIAT DITJEN'],
                [7, 'DIREKTORAT PERENCANAAN PEMBANGUNAN DAERAH'],
                [7, 'DIREKTORAT PENGEMBANGAN WILAYAH'],
                [7, 'DIREKTORAT FASILITAS PENATAAN RUANG DAN LINGKUNGAN HIDUP'],
                [7, 'DIREKTORAT PENGEMBANGAN EKONOMI DAERAH'],
                [7, 'DIREKTORAT PENATAAN PERKOTAAN'],
                [8, 'SEKRETARIAT DITJEN'],
                [8, 'DIREKTORAT PEMERINTAAH DESA DAN KELURAHAN'],
                [8, 'DIREKTORAT KELEMBAGAAN DAN PELATIHAN MASYARAKAT'],
                [8, 'DIREKTORAT PEMBERDAYAAN ADAT DAN SOSIAL BUDAYA MASYARAKAT'],
                [8, 'DIREKTORAT USAHA EKONOMI MASYARAKAT'],
                [8, 'DIREKTORAT SUMBER DAYA ALAM DAN TEKNOLOGI TEPAT GUNA PERDESAAN'],
                [9, 'SEKRETARIAT DITJEN'],
                [9, 'DIREKTORAT PENDAFTARAN PENDUDUK'],
                [9, 'DIREKTORAT PENCATATAN SIPIL'],
                [9, 'DIREKTORAT PENGELOLAAN INFORMASI ADMINISTRASI KEPENDUDUKAN'],
                [9, 'DIREKTORAT PENGEMBANAGAN KEBIJAKAN KEPENDUDUKAN'],
                [9, 'DIREKTORAT PENYERASIAN KEBIJAKAN DAN PERENCANAAN KEPENDUDUKAN'],
                [10, 'SEKRETARIAT DITJEN'],
                [10, 'DIREKTORAT ANGGARAN DAERAH'],
                [10, 'DIREKTORAT PENDAPATAAN DAERAH DAN INVESTASI DAERAH'],
                [10, 'DIREKTORAT FASILITASI DANA PERIMBANGAN'],
                [10, 'DIREKTORAT PELAKSANAAN DAN PERTANGGUNG JAWABAN KEUANGAN DAERAH'],
                [2, 'SEKRETARIAT DITJEN'],
                [2, 'INSPEKTORAT WILAYAH I'],
                [2, 'INSPEKTORAT WILAYAH II'],
                [2, 'INSPEKTORAT WILAYAH III'],
                [2, 'INSPEKTORAT WILAYAH IV'],
                [2, 'INSPEKTORAT KHUSUS'],
                [11, 'SEKRETARIAT BADAN'],
                [11, 'PUSAT LITBANG KESBANGPOL DAN OTDA'],
                [11, 'PUSAT LITBANG PEMERINTAHAN UMUM DAN KEPENDUDUKAN'],
                [11, 'PUSAT LITBANG PEMERINTAHAN DESA DAN PEMBERDAYAAN MASYARAKAT'],
                [11, 'PUSAT LITBANG PEMBANGUNAN DAN KEUANGAN DAERAH'],
                [12, 'SEKRETARIAT BADAN'],
                [12, 'PUSAT DIKLAT MANAJEMEN DAN KEPEMIMPINAN PEMERINTAHAN DAERAH'],
                [12, 'PUSAT DIKLAT MANAJEMEN PEMBANGUNAN, KEPENDUDUKAN DAN KEUANGAN DAERAH'],
                [12, 'PUSAT DIKLAT STRUKTURAL DAN TEKNIS'],
                [12, 'PUSAT PEMBINAAN JABATAN FUNGSIONAL DAN STANDARDISASI DIKLAT'],
                [1, 'KANTOR KEMENTERIAN'],
                [3, 'PUSAT PENERANGAN'],
                [3, 'PUSAT DATA, INFORMASI, KOMUNIKASI DAN TELEKOMUNIKASI'],
                [3, 'PUSAT KAJIAN KEBIJAKAN STRATEGIK'],
                [3, 'PUSAT ADMINISTRASI KERJASAMA LUAR NEGERI'],
                [3, 'PUSAT ADMINISTRASI KEUANGAN DAN PENGELOLAAN ASET'],
            ]);
    }

    public function down()
    {
        $this->dropTable('subinstansi');

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
