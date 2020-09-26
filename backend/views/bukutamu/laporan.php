<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\web\View;
use yii\helpers\ArrayHelper;
use common\models\Bukutamu;
use common\models\Instansi;
use common\models\Subinstansi;
use yii\helpers\VarDumper;
$this->title = 'Laporan Data Pengunjung';
?>

<div class="modal fade" id="laporan_modal" tabindex="-1" role="dialog" aria-labelledby="laporan_modal_label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- form start -->
            <?= Html::beginForm(['/bukutamu/laporan', 'post']) ?>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title" name="laporan_modal_label">Pencarian Data Pengunjung</h4>
                </div>

                <div class="modal-body col-md-6">
                    <div class="from-group">
                        <label>NIK</label>
                        <?= Html::textInput('nik', NULL, ['placeHolder' => 'NIK', 'label' => 'UID', 'class' => 'form-control']) ?>
                    </div>
                </div>

                <div class="modal-body col-md-6">
                    <div class="from-group">
                        <label>Nama Lengkap</label>
                        <?= Html::textInput('nama_lgkp', NULL, ['placeHolder' => 'Nama LengKap', 'label' => 'UID', 'class' => 'form-control']) ?>
                    </div>
                </div>

                <div class="modal-body col-md-3">
                    <div class="from-group">
                        <label>Tujuan</label>
                        <?php
                            $arrays = ['0' => '-- PILIH --'] + ArrayHelper::map(Instansi::find()->all(), 'ID', 'NAMA_INSTANSI');
                            echo Html::dropDownList('instansi', NULL, $arrays,
                                                        ['id' => 'id_instansi',
                                                         'class' => 'form-control',
                                                         'onchange' => 'get_subinstansi($(this), "'.Url::to(['bukutamu/api', 'name' => 'subinstansi', 'id' => '']).'")']);
                        ?>
                    </div>
                </div>

                <div class="modal-body col-md-3">
                    <div class="from-group">
                        <label>Sub Tujuan</label>
                        <?= Html::dropDownList('sub_instansi', NULL, ['0' => '-- PILIH --'], ['id' => 'id_subinstansi', 'class' => 'form-control']) ?>
                    </div>
                </div>

                <div class="modal-body col-md-3">
                    <div class="from-group">
                        <label>Tanggal Masuk</label>
                        <?= Html::textInput('date_tap', NULL, ['placeHolder' => 'yyyy-mm-dd', 'class' => 'form-control', 'id' => 'id_tanggal_masuk']) ?>
                    </div>
                </div>

                <div class="modal-body col-md-3">
                    <div class="from-group">
                        <label>s/d Tanggal</label>
                        <?= Html::textInput('date_out', NULL, ['placeHolder' => 'yyyy-mm-dd', 'class' => 'form-control', 'id' => 'id_tanggal']) ?>
                    </div>
                </div>

                <br><br>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Tampilkan</button>
                    <button type="button" class="btn btn-primary" onclick="clear_form(this.form)">Reset</button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Tutup</button>
                </div>
            <?= Html::endForm() ?>
       </div>
    </div>
</div>

<div class="box">
    <div class="box-header">
        <i class="fa fa-database"></i>
        <span class="box-title">Laporan Data Pengunjung</span>
        <!-- Laporan Modal -->
        <button id="btnlaporan" class="btn btn-default pull-right">
            Pencarian
        </button>
    </div>
    <div class="box-body">
	<div class="table-responsive">
        <table id="id_table_bukutamu" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>No</th>
                <th>Photo</th>
                <th>Tanggal Masuk</th>
                <th>NIK</th>
                <th>Nama Lengkap</th>
                <th>Telp/HP</th>
                <th>Instansi</th>
                <th>Nama Instansi</th>
                <th>Tujuan</th>
                <th>Sub Tujuan</th>
                <th>Keperluan</th>
                <th>Tanggal Keluar</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach ($model as $row) { ?>
                <tr>
                    <th><?= $row->ID ?></th>
                    <th>
                        <?php
                            $image_path = Yii::getAlias("@frontend/web/images/".$row->NIK.".jpg");
                            if (file_exists($image_path))
                                echo '<image src="'.Url::to("http://localhost/bukutamu/frontend/web/images/".$row->NIK.".jpg") . '" class="image_responsive alt="" width="51" height="64">';
                            else
                                echo '<i class="fa fa-user">';
                        ?>
                    </th>
                    <th><?= $row->DATE_TAP ?></th>
                    <th><?= $row->NIK ?></th>
                    <th><?= $row->NAMA_LGKP ?></th>
                    <th><?= $row->NO_TELP ?></th>
                    <th><?php if ($row->INSTANSI == 'D') echo 'DINAS'; else echo 'PRIBADI'; ?></th>
                    <th><?= $row->NAMA_INSTANSI ?></th>
                    <th>
                        <?php if (isset($row->instansi)) echo $row->instansi->NAMA_INSTANSI ?>
                    </th>
                    <th>
                        <?php if (isset($row->subinstansi)) echo $row->subinstansi->NAMA_SUB_INSTANSI ?>
                    </th>
                    <th><?= $row->KEPERLUAN ?></th>
                    <th><?= $row->DATE_OUT ?></th>
                </tr>
                <?php } ?>
            </tbody>
        </table></div>
    </div>
</div>

<!-- page script -->
<?php
# JS to clear/reset the form
$this->registerJs('function clear_form(form) {
    var elements = form.elements;
    form.reset();
    for (i = 0; i < elements.length; i++) {
        switch (elements[i].type.toLowerCase()) {
        case "text":
        case "password":
        case "textarea":
        case "hidden":
            elements[i].value = "";
            break;
        case "radio":
        case "checkbox":
            if (elements[i].checked) {
                elements[i].checked = false;
            }
            break;
        case "select-one":
        case "select-multi":
            if (elements[i].id == "id_subinstansi") {
                elements[i].options.length = 0;
                elements[i].options.add(new Option("-- PILIH --", "0"));
            }
            elements[i].selectedIndex = 0;
            break;
        default:
            break;
        }
    }
}', View::POS_END);

$this->registerJs('function get_subinstansi(obj, url) {
    $("#id_subinstansi").html("<option value=0>Loading...</option>");
    $.get(url+obj.val(), function(data) { $("#id_subinstansi").html(data); });
}', View::POS_END);

$this->registerJs('
    $(function() {

        $("#id_table_bukutamu").DataTable({
            paging: true,
            lengthChange: true,
            searching: true,
            ordering: true,
            info: true,
            autoWidth: true,
            dom: "Bfrtip",
			colReorder: true,
			buttons: [
			{
                extend: "print",
				text: "<i class=\"fa fa-print\"></i> Print",
				className: "btn btn-success",
				autoPrint: false,
                title: "Laporan Data Pengunjung Dinas Dukcapil Provinsi Kalbar",
				customize: function ( win ) {
                    $(win.document.body).find( "table" )
                        .addClass( "compact" )
                        .css( "font-size", "inherit" );
                },
				exportOptions : {
        stripHtml: false,
		modifier: {
                    page: "all"
                }
						}
            },
			{
                extend: "colvis",
				text: "<i class=\"fa fa-check\"></i> Pilih Kolom",
			className: "btn btn-primary"}
		
        ]
        });
		

        $("#id_tanggal_masuk").inputmask("yyyy-mm-dd");
        $("#id_tanggal").inputmask("yyyy-mm-dd");
		
		$("#btnlaporan").on("click", function() {
		$("#laporan_modal").modal("show");
});
		
    })');

?>
