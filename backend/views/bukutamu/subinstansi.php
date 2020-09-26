<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\web\View;
use common\models\Instansi;
$this->title = 'Data Sub Instansi';
?>

<div class="box">
    <div class="box-header">
        <i class="fa fa-database"></i>
        <span class="box-title">DATA SUBINSTANSI</span>
        <div class="box-tools">
            <?= Html::beginForm(['/bukutamu/subinstansi'], 'post') ?>
            <a href="<?= Url::to(['/bukutamu/subinstansiform']); ?>" class="btn btn-link" type="button">
                <i class="fa fa-plus"></i>
                <span class="hidden-x">Tambah Subinstansi</span>
            </a>
            <?= Html::hiddenInput('id', NULL, ['id' => 'id_input']) ?>
            <?= Html::submitButton('<i class="fa fa-pencil"></i>',
                                        ['class' => 'btn btn-link',
                                         'name' => 'method', 'value' => 'modify']);
            ?>
            <?= Html::submitButton('<i class="fa fa-trash"></i>',
                                        ['class' => 'btn btn-link',
                                         'name' => 'method', 'value' => 'delete']);
            ?>
            <?= Html::endForm(); ?>
        </div>
    </div>
    <div class="box-body">
        <table id="id_table_subinstansi" class="table table-bordered table-striped dataTable" role="grid">
            <thead>
            <tr>
                <th>#</th>
                <th>Nama Instansi</th>
                <th>Nama Subinstansi</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach ($model as $row) { ?>
                <tr>
                    <th><?= $row->ID ?></th>
                    <th><?= $row->instansi->NAMA_INSTANSI ?></th>
                    <th><?= $row->NAMA_SUB_INSTANSI ?></th>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- page script -->
<?php
// https://datatables.net/examples/api/select_single_row.html
$this->registerJs('$(function () {
    $.fn.dataTable.TableTools.defaults.aButtons = ["csv", "pdf"];
    var table = $("#id_table_subinstansi").DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "dom": \'T<"clear">lfrtip\',
            "tableTools": {
                "sSwfPath": "../../vendor/almasaeed2010/adminlte/plugins/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf"
            }
         });

    $("#id_table_subinstansi tbody").on("click", "tr",
        function () {
            if ($(this).hasClass("selected")) {
                $(this).removeClass("selected");
                document.getElementById("id_input").value = "";
            }
            else {
                table.$("tr.selected").removeClass("selected");
                $(this).addClass("selected");
                // API reference: https://datatables.net/reference/api/
                // Get selected row value (array)
                var row = table.row(".selected").data();
                document.getElementById("id_input").value = row[0];
            }
        });
} )');
?>
