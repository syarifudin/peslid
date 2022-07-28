<html>
  <head>
  <?php foreach($dl_po as $row); ?>
  <?php foreach($da as $d_a); ?>
  <?php foreach($tpa as $t_a); ?>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">


      // Load Charts and the corechart and barchart packages.
      google.charts.load('current', {'packages':['corechart']});

      // Draw the pie chart and bar chart when Charts is loaded.
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
//
	
	//  
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
          ['Customer PO', <?=$row['PURCHASE']-$row['DELIVERY']?>],
          ['Delivery', <?=$row['DELIVERY']?>]
        ]);

        var piechart_options = {title:'Sales Order',
                      pieSliceText:'value', is3D: true};
        var piechart = new google.visualization.PieChart(document.getElementById('piechart_div'));
        piechart.draw(data, piechart_options);
		//PO By DAte
		var dt = google.visualization.arrayToDataTable([
          ['Date', 'PO Amount', ],
		 
		  <?php foreach($PO_ as $p_){ 
		  echo "['". date('d',strtotime($p_['ORDER_DATE']))."'".",".$p_['AMOUNT']."]".",";
		  }
		  ?>
        ]);
        var options = {
          title: 'Daily PO',legend: 'none',
          hAxis: { minValue: 0, maxValue: 9 },
          curveType: 'function',colors: ['green'],
          pointSize: 15,width: 370,
          legend: { position: 'bottom' }
        };
		var chart = new google.visualization.LineChart(document.getElementById('curve_chart_1'));
        chart.draw(dt, options);
		//
		var data5 = google.visualization.arrayToDataTable([
        ["Element", "", { role: "style" } ],
        <?php foreach($tr as $rw){ 
		if($rw['FLOW_STATUS_CODE']=='1.SHIPPING'){$a= "'color: RED'";}
		ELSE IF($rw['FLOW_STATUS_CODE']=='3.TRANSMIT'){$a= "'color: BLUE'";}
		ELSE IF($rw['FLOW_STATUS_CODE']=='2.FULFILLMENT'){$a= "'color: pink'";}
		ELSE IF($rw['FLOW_STATUS_CODE']=='4.TRANSMITTED'){$a= "'color: green'";}
		echo "['".$rw['FLOW_STATUS_CODE']."'".",".$rw['JUMLAH'].",".$a."]".",";  }  ?>
      ]);
      var view = new google.visualization.DataView(data5);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },2]);
      var options = {
        title: "Transactions Progress",
        bar: {groupWidth: "55%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      chart.draw(view, options);
	  
       
	  //PO History
	   var po = google.visualization.arrayToDataTable([
          ['Date', 'Amount'],
           <?php foreach($PO as $p){ 
		  echo "['". date('M',strtotime($p['MONTH']))."'".",".$p['AMOUNT']."]".",";
		  }
		  ?>
        ]);
        var options = {
          title: 'PO History',
          legend: 'none',
           pointSize: 20,
           pointShape: { type: 'triangle' }
        };

        var chart = new google.visualization.ScatterChart(document.getElementById('chart_div'));
        chart.draw(po, options);
		//PO Amount And Delivery Amount
	  var data6 = google.visualization.arrayToDataTable([
        ["Element", "", { role: "style" } ],
        ['PO Amount', <?=$t_a['T_AMOUNT']?>, 'blue'],
		['Delivery Amount',<?=$d_a['AMOUNT']?>, 'green'],            // English color name
      ]);
      var view = new google.visualization.DataView(data6);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);
      var options = {
        title: "PO vs Delivery Amount",
        bar: {groupWidth: "55%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("amount_delivery"));
      chart.draw(view, options);
	  
	  //
	  }
	  
</script>
<body>
    <!--Table and divs that hold the pie charts-->
    <table class="columns">
      <tr>
        <td><div id="piechart_div" style="border: 1px solid #ccc"></div></td>
        <td><div id="columnchart_values" style="border: 1px solid #ccc"></div></td>
      </tr>
	  <tr>
	  <td><div id="chart_div" style="border: 1px solid #ccc"></div></td>
	  <td><div id="curve_chart_1" style="border: 1px solid #ccc"></div></td>
	  </tr> 
		<tr>
		<td><div id="amount_delivery" style="border: 1px solid #ccc"></div></td>
		</tr>
    </table>
  </body>
  <style>
  table.columns {
		margin-left: auto;
		margin-right: auto;
		margin-top: auto;
		margin-bottom: auto;
	}
	</style>
</html>
