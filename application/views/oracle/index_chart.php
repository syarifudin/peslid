<html lang="en">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<script src="../js/jquery-1.9.1.js" type="text/javascript"></script>
<script src="../js/highcharts.js" type="text/javascript"></script>
<script type="text/javascript">
$(function () {
$('#container').highcharts({
chart: {
plotBackgroundColor: null,
plotBorderWidth: null,
plotShadow: false
},
title: {
text: 'MAY 2017'
},
tooltip: {
pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
},
plotOptions: {
pie: {
allowPointSelect: true,
cursor: 'pointer',
dataLabels: {
enabled: true,
format: '<b>{point.name}</b>: {point.percentage:.1f} %({point.y:,.0f})',
style: {
color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
}
}
}
},
series: [{
type: 'pie',
name: 'Persentase Sales',
data: [
<?php 
// data yang diambil dari database
if(count($graph)>0)
{
foreach ($graph as $data) {
echo "['" .$data->PARTY_NAME . "'," .$data->TOTAL ."],\n"; 
}
}
?>
]
}]
});
});

</script>
</head>
<body>
<div id="container"></div>
 
</body>
</html>