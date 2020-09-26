<?php

/* @var $this yii\web\View */
//use yii\helpers\VarDumper;
$this->title = 'Aplikasi Buku Tamu';

 $connection=Yii::$app->db;
 $sql="SELECT SUM(CASE WHEN date(date_tap) = CURDATE() THEN 1 ELSE 0 END) hari, SUM(CASE WHEN date(date_tap)  between date_sub(now(),INTERVAL 1 WEEK) and CURDATE() THEN 1 ELSE 0 END) minggu, SUM(CASE WHEN DATE_FORMAT(date_tap, '%Y%m') = DATE_FORMAT(CURDATE(), '%Y%m') THEN 1 ELSE 0 END) bulan, COUNT(*) total FROM bukutamu";
 
 $data=$connection->createCommand($sql)->query();
 $data->bindColumn(1,$hari);
 $data->bindColumn(2,$minggu);
 $data->bindColumn(3,$bulan);
 $data->bindColumn(4,$total);
 $data->read();
 
 $query="SELECT SUM(case when month(date_tap)=1 THEN 1 ELSE 0 END) As Jan, SUM(case when month(date_tap)=2 THEN 1 ELSE 0 END) As Feb, SUM(case when month(date_tap)=3 THEN 1 ELSE 0 END) As Mar, SUM(case when month(date_tap)=4 THEN 1 ELSE 0 END) As Apr, SUM(case when month(date_tap)=5 THEN 1 ELSE 0 END) As Mei, SUM(case when month(date_tap)=6 THEN 1 ELSE 0 END) As Jun, SUM(case when month(date_tap)=7 THEN 1 ELSE 0 END) As Jul, SUM(case when month(date_tap)=8 THEN 1 ELSE 0 END) As Agu, SUM(case when month(date_tap)=9 THEN 1 ELSE 0 END) As Sep, SUM(case when month(date_tap)=10 THEN 1 ELSE 0 END) As Okt, SUM(case when month(date_tap)=11 THEN 1 ELSE 0 END) As Nov, SUM(case when month(date_tap)=12 THEN 1 ELSE 0 END) As Des FROM bukutamu GROUP BY Year(date_tap)";
 
 $databln=$connection->createCommand($query)->query();
 $databln->bindColumn(1,$jan);
 $databln->bindColumn(2,$feb);
 $databln->bindColumn(3,$mar);
 $databln->bindColumn(4,$apr);
 $databln->bindColumn(5,$mei);
 $databln->bindColumn(6,$jun);
 $databln->bindColumn(7,$jul);
 $databln->bindColumn(8,$agu);
 $databln->bindColumn(9,$sep);
 $databln->bindColumn(10,$okt);
 $databln->bindColumn(11,$nov);
 $databln->bindColumn(12,$des);
 $databln->read();
 
$qhari="SELECT DATE_FORMAT(date_tap, '%d-%m-%Y ')tanggal, count(*)jumlah FROM bukutamu WHERE  DATE_FORMAT(date_tap, '%Y%m') = DATE_FORMAT(CURDATE(), '%Y%m') GROUP BY DATE_FORMAT(date_tap, '%Y-%m-%d ')";
$datahari=$connection->createCommand($qhari)->query();
$datahari->bindColumn(1,$tanggal);
$datahari->bindColumn(2,$jumlah);
$dataperhari = '';
while($datahari->read()!==false)
{ 
$dataperhari .= '["'.$tanggal.'",'.$jumlah.'],';
}
?>

<div class="site-index">

    <div class="body-content">
<div class="row">
<div class="col-md-12">
          <div class="box-footer">
                    <div class="row">
                        <div class="col-sm-3 col-xs-6">
                            <div class="description-block border-right">
                                <h5 class="description-header"><?= $hari; ?></h5>
                                <span class="description-text">PENGUNJUNG HARI INI</span>
                            </div><!-- /.description-block -->
                        </div><!-- /.col -->
                        <div class="col-sm-3 col-xs-6">
                            <div class="description-block border-right">
                                <h5 class="description-header"><?= $minggu; ?></h5>
                                <span class="description-text">PENGUNJUNG MINGGU INI</span>
                            </div><!-- /.description-block -->
                        </div><!-- /.col -->
                        <div class="col-sm-3 col-xs-6">
                            <div class="description-block border-right">
                                <h5 class="description-header"><?= $bulan; ?></h5>
                                <span class="description-text">PENGUNJUNG BULAN INI</span>
                            </div><!-- /.description-block -->
                        </div><!-- /.col -->
                        <div class="col-sm-3 col-xs-6">
                            <div class="description-block">
                                <h5 class="description-header"><?= $total; ?></h5>
                                <span class="description-text">TOTAL PENGUNJUNG</span>
                            </div><!-- /.description-block -->
                        </div>
                    </div><!-- /.row -->
        </div><!-- ./col -->
		</div>
    </div><!-- /.row -->
        <div class="row">
		
        <div class="col-md-12">
		<!-- /.box-footer -->
            <div class="box">
                <div id="grafikhari"></div>
			</div>
			<div class="box">
                <div id="grafikbulan"></div>
            </div>
		
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div>

    </div>
</div>



<?php
use common\models\Preference;
$pre = new Preference();
$pre->loadfromfile();
$deptname =$pre->getDisplayName();

$this->registerJs('

$(function () {
	Highcharts.chart("grafikhari", {
		chart: {
            type: "spline"
        },
        title: {
            text: "Grafik Data Pengunjung Per Hari",
            x: -20 //center
        },
        subtitle: {
            text: "'.$deptname.'",
            x: -20
        },
        xAxis: {
          type: "category",
          labels: {
          rotation: -45,
          style: {
            fontSize: "13px",
            fontFamily: "Verdana, sans-serif"
            }
          }
        },
        yAxis: {
            title: {
                text: "Jumlah Pengunjung"
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: "#808080"
            }]
        },
        tooltip: {
            valueSuffix: " Orang"
        },
        legend: {
            layout: "vertical",
            align: "right",
            verticalAlign: "middle",
            borderWidth: 0
        },
        series: [{
			name: "Pengunjung",
            data: ['.$dataperhari.']
        }],
		credits: { enabled: false},
		legend: { enabled: false},
		plotOptions: {
            spline: {
                dataLabels: {
                    enabled: true
                }
            }
        }
    });
	
    Highcharts.chart("grafikbulan", {
		chart: {
            type: "spline"
        },
        title: {
            text: "Grafik Data Pengunjung Per Bulan",
            x: -20 //center
        },
        subtitle: {
            text: "'.$deptname.'",
            x: -20
        },
        xAxis: {
            categories: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"]
        },
        yAxis: {
            title: {
                text: "Jumlah Pengunjung"
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: "#808080"
            }]
        },
        tooltip: {
            valueSuffix: " Orang"
        },
        legend: {
            layout: "vertical",
            align: "right",
            verticalAlign: "middle",
            borderWidth: 0
        },
        series: [{
			name: "Pengunjung",
            data: ['.$jan.', '.$feb.', '.$mar.', '.$apr.', '.$mei.', '.$jun.', '.$jul.', '.$agu.', '.$sep.', '.$okt.', '.$nov.', '.$des.']
        }],
		credits: { enabled: false},
		legend: { enabled: false},
		plotOptions: {
            spline: {
                dataLabels: {
                    enabled: true
                }
            }
        }
    });
	
    })');
?>