<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
	<title>Statistik Kejahatan</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="assets/font-awesome-4.7.0/css/font-awesome.min.css">
	<!-- Ionicons -->
	
	<link rel="stylesheet" href="assets/ionicons-2.0.1/css/ionicons.min.css">
	<!-- jvectormap -->
	<link rel="stylesheet" href="assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">
	<!-- AdminLTE Skins. Choose a skin from the css/skins 
		folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="assets/dist/css/skins/_all-skins.min.css">
	<!-- iCheck -->
	<link rel="stylesheet" href="assets/plugins/iCheck/flat/blue.css">
	<!-- Morris chart -->
	<link rel="stylesheet" href="assets/plugins/morris/morris.css">
	<!-- jvectormap -->
	<link rel="stylesheet" href="assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
	<!-- Date Picker -->
	<link rel="stylesheet" href="assets/plugins/datepicker/datepicker3.css">
	<!-- Daterange picker -->
	<link rel="stylesheet" href="assets/plugins/daterangepicker/daterangepicker.css">
	<!-- bootstrap wysihtml5 - text editor -->
	<link rel="stylesheet" href="assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
	<link rel="stylesheet" href="assets/dist/css/skins/skin-blue.min.css">
	<!-- Morris charts -->
	<link rel="stylesheet" href="assets/plugins/morris/morris.css">
	<script src="assets/plugins/morris/morris.min.js"></script>
	
	
	<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.2.3 -->
<script src="assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="assets/plugins/chartjs/Chart.min.js"></script>
<!-- FastClick -->
<script src="assets/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="assets/dist/js/demo.js"></script>

<script>
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $("#areaChart").get(0).getContext("2d");
    // This will get the first returned node in the jQuery collection.
    var areaChart = new Chart(areaChartCanvas);
	//"January", "February", "March", "April", "May", "June", "July", "Agustus", "September", "Oktober"
    var areaChartData = {
      labels: [ <?php for($i=1; $i<=count($berita['kota']['kabupaten']) ; $i++) {
		  if($i != sizeof($berita['kota']['kabupaten'])){ ?>
			  "<?php echo $berita['kota']['kabupaten'][$i]; ?>",
		  <?php } else { ?>
			  "<?php echo $berita['kota']['kabupaten'][$i]; ?>"
		  <?php }
			}  ?> ],
      
	  //65, 59, 80, 81, 56, 55, 40
	  datasets: [
        {
          label: "Narkoba",
          fillColor: "rgba(245, 105, 84, 1)",
          strokeColor: "rgba(245, 105, 84, 1)",
          pointColor: "rgba(245, 105, 84, 1)",
          pointStrokeColor: "#f56954",
          pointHighlightFill: "#f56954",
          pointHighlightStroke: "rgba(220,220,220,1)",
          data: [ <?php for($i=1; $i<=count($berita['kota']['narkoba']); $i++){
			  if($i != count($berita['kota']['narkoba'])){
				  echo $berita['kota']['narkoba'][$i] . ",";
			  } else {
				echo $berita['kota']['narkoba'][$i];
			  }
		  }?> ]
        },
        {
			//20, 30, 31, 32, 33, 34, 35
          label: "Pencurian",
          fillColor: "rgba(0,166,90,0.7)",
          strokeColor: "rgba(0,166,90,0.8)",
          pointColor: "#00a65a",
          pointStrokeColor: "rgba(0,166,90,1)",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(0,166,90,1)",
          data: [ <?php for($i=1; $i<=count($berita['kota']['pencurian']); $i++){
			  if($i != count($berita['kota']['pencurian'])){
				  echo $berita['kota']['pencurian'][$i] . ",";
			  } else {
				echo $berita['kota']['pencurian'][$i];
			  }
		  }?> ]
        },
		{
			//22, 23, 24, 25, 26, 27, 28
          label: "Pembunuhan",
          fillColor: "rgba(243,156,18,0.7)",
          strokeColor: "rgba(243,156,18,0.8)",
          pointColor: "#f39c12",
          pointStrokeColor: "rgba(243,156,18,1)",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(243,156,18,1)",
          data: [ <?php for($i=1; $i<=count($berita['kota']['pembunuhan']); $i++){
			  if($i != count($berita['kota']['pembunuhan'])){
				  echo $berita['kota']['pembunuhan'][$i] . ",";
			  } else {
				echo $berita['kota']['pembunuhan'][$i];
			  }
		  }?> ]
        },
		{
			//15, 16, 17, 18, 19, 20, 21
          label: "Pemerkosaan",
          fillColor: "rgba(0,192,239,0.7)",
          strokeColor: "rgba(0,192,239,0.8)",
          pointColor: "#00c0ef",
          pointStrokeColor: "rgba(0,192,239,1)",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(0,192,239,1)",
          data: [ <?php for($i=1; $i<=count($berita['kota']['pemerkosaan']); $i++){
			  if($i != count($berita['kota']['pemerkosaan'])){
				  echo $berita['kota']['pemerkosaan'][$i] . ",";
			  } else {
				echo $berita['kota']['pemerkosaan'][$i];
			  }
		  }?> ]
        },
		{
			//8, 9, 10, 11, 12, 13, 14
          label: "Penipuan",
          fillColor: "rgba(97,84,245,0.6)",
          strokeColor: "rgba(97,84,245,0.5)",
          pointColor: "#6154f5",
          pointStrokeColor: "rgba(97,84,245,1)",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(97,84,245,1)",
          data: [ <?php for($i=1; $i<=count($berita['kota']['penipuan']); $i++){
			  if($i != count($berita['kota']['penipuan'])){
				  echo $berita['kota']['penipuan'][$i] . ",";
			  } else {
				echo $berita['kota']['penipuan'][$i];
			  }
		  }?> ]
        },
		{
			//1, 2, 3, 4, 5, 6, 7
          label: "Penganiayaan",
          fillColor: "rgba(166,149,0,0.7)",
          strokeColor: "rgba(166,149,0,0.8)",
          pointColor: "#a69500",
          pointStrokeColor: "rgba(166,149,0,1)",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(166,149,0,1)",
          data: [ <?php for($i=1; $i<=count($berita['kota']['penganiayaan']); $i++){
			  if($i != count($berita['kota']['penganiayaan'])){
				  echo $berita['kota']['penganiayaan'][$i] . ",";
			  } else {
				echo $berita['kota']['penganiayaan'][$i];
			  }
		  }?> ]
        },
		{
			//1, 2, 3, 4, 5, 6, 7
          label: "Pemerasan & Pengancaman",
          fillColor: "rgba(242,17,212,0.7)",
          strokeColor: "rgba(242,17,212,0.8)",
          pointColor: "#f211d4",
          pointStrokeColor: "rgba(242,17,212,1)",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(242,17,212,1)",
          data: [ <?php for($i=1; $i<=count($berita['kota']['pemerasan']); $i++){
			  if($i != count($berita['kota']['pemerasan'])){
				  echo $berita['kota']['pemerasan'][$i] . ",";
			  } else {
				echo $berita['kota']['pemerasan'][$i];
			  }
		  }?> ]
        }
		
      ]
    };

    var areaChartOptions = {
      //Boolean - If we should show the scale at all
      showScale: true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines: false,
      //String - Colour of the grid lines
      scaleGridLineColor: "rgba(0,0,0,.05)",
      //Number - Width of the grid lines
      scaleGridLineWidth: 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines: true,
      //Boolean - Whether the line is curved between points
      bezierCurve: true,
      //Number - Tension of the bezier curve between points
      bezierCurveTension: 0.3,
      //Boolean - Whether to show a dot for each point
      pointDot: false,
      //Number - Radius of each point dot in pixels
      pointDotRadius: 4,
      //Number - Pixel width of point dot stroke
      pointDotStrokeWidth: 1,
      //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
      pointHitDetectionRadius: 20,
      //Boolean - Whether to show a stroke for datasets
      datasetStroke: true,
      //Number - Pixel width of dataset stroke
      datasetStrokeWidth: 2,
      //Boolean - Whether to fill the dataset with a color
      datasetFill: true,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
      //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio: true,
      //Boolean - whether to make the chart responsive to window resizing
      responsive: true
    };

    //Create the line chart
    areaChart.Line(areaChartData, areaChartOptions);

    //-------------
    //- LINE CHART -
    //--------------
	
	//"January", "February", "March", "April", "May", "June", "July"  65, 59, 80, 81, 56, 55, 40    28, 48, 40, 19, 86, 27, 90
    var lineChartCanvas = $("#lineChart").get(0).getContext("2d");
    var lineChart = new Chart(lineChartCanvas);
	var lineChartData = {
      labels: [ <?php for($i=1; $i<=count($berita['umur']['kota']); $i++) {
		  if($i != count($berita['umur']['kota'])){ ?>
			"<?php echo $berita['umur']['kota'][$i]; ?>",
		<?php } else { ?>
			"<?php echo $berita['umur']['kota'][$i]; ?>"
		<?php }		
	  } ?> ],
      datasets: [
        {
          label: "Laki-laki",
          fillColor: "rgba(243,156,18, 1)",
          strokeColor: "rgba(243,156,18, 1)",
          pointColor: "rgba(243,156,18, 1)",
          pointStrokeColor: "#f39c12",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(243,156,18,1)",
          data: [ <?php for($i=1; $i<=count($berita['umur']['L']); $i++) {
				if($i != count($berita['umur']['L'])){ ?>
			  <?php echo $berita['umur']['L'][$i]; ?>,
			<?php } else { ?>
				<?php echo $berita['umur']['L'][$i]; ?>
			<?php }		
		  } ?> ]
        },
        {
          label: "Perempuan",
          fillColor: "rgba(60,141,188,0.9)",
          strokeColor: "rgba(60,141,188,0.8)",
          pointColor: "#3b8bba",
          pointStrokeColor: "rgba(60,141,188,1)",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(60,141,188,1)",
          data: [ <?php for($i=1; $i<=count($berita['umur']['P']); $i++) {
				if($i != count($berita['umur']['P'])){ ?>
			  <?php echo $berita['umur']['P'][$i]; ?>,
			<?php } else { ?>
				<?php echo $berita['umur']['P'][$i]; ?>
			<?php }		
		  } ?> ]
        }
      ]
    };
	
	
    var lineChartOptions = areaChartOptions;
    lineChartOptions.datasetFill = false;
    lineChart.Line(lineChartData, lineChartOptions);

    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
    var pieChart = new Chart(pieChartCanvas);
    var PieData = [
      {
        value: <?php echo $berita['diagramkejahatan']['jumlah'][1]; ?>,
        color: "#f56954",
        highlight: "#f56954",
        label: "<?php echo $berita['diagramkejahatan']['jenis'][1]; ?>"
      },
      {
        value: <?php echo $berita['diagramkejahatan']['jumlah'][2]; ?>,
        color: "#00a65a",
        highlight: "#00a65a",
        label: "<?php echo $berita['diagramkejahatan']['jenis'][2]; ?>"
      },
      {
        value: <?php echo $berita['diagramkejahatan']['jumlah'][3]; ?>,
        color: "#f39c12",
        highlight: "#f39c12",
        label: "<?php echo $berita['diagramkejahatan']['jenis'][3]; ?>"
      },
      {
        value: <?php echo $berita['diagramkejahatan']['jumlah'][4]; ?>,
        color: "#00c0ef",
        highlight: "#00c0ef",
        label: "<?php echo $berita['diagramkejahatan']['jenis'][4]; ?>"
      },
      {
        value: <?php echo $berita['diagramkejahatan']['jumlah'][5]; ?>,
        color: "#6154f5",
        highlight: "#6154f5",
        label: "<?php echo $berita['diagramkejahatan']['jenis'][5]; ?>"
      },
      {
        value: <?php echo $berita['diagramkejahatan']['jumlah'][6]; ?>,
        color: "#a69500",
        highlight: "#a69500",
        label: "<?php echo $berita['diagramkejahatan']['jenis'][6]; ?>"
      },
	  {
        value: <?php echo $berita['diagramkejahatan']['jumlah'][7]; ?>,
        color: "#f211d4",
        highlight: "#f211d4",
        label: "<?php echo $berita['diagramkejahatan']['jenis'][7]; ?>"
      }
    ];
    var pieOptions = {
      //Boolean - Whether we should show a stroke on each segment
      segmentShowStroke: true,
      //String - The colour of each segment stroke
      segmentStrokeColor: "#fff",
      //Number - The width of each segment stroke
      segmentStrokeWidth: 2,
      //Number - The percentage of the chart that we cut out of the middle
      percentageInnerCutout: 50, // This is 0 for Pie charts
      //Number - Amount of animation steps
      animationSteps: 100,
      //String - Animation easing effect
      animationEasing: "easeOutBounce",
      //Boolean - Whether we animate the rotation of the Doughnut
      animateRotate: true,
      //Boolean - Whether we animate scaling the Doughnut from the centre
      animateScale: false,
      //Boolean - whether to make the chart responsive to window resizing
      responsive: true,
      // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio: true,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
    };
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    pieChart.Doughnut(PieData, pieOptions);

    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $("#barChart").get(0).getContext("2d");
    var barChart = new Chart(barChartCanvas);
    //var barChartData = areaChartData;
	//"January", "February", "March", "April", "May", "June", "July"
	var barChartData = {
      labels: [<?php for($i=1;$i<=count($berita['umur']['kota']); $i++){
		  if($i !=count($berita['umur']['kota'])){?>
			  "<?php echo ($berita['umur']['kota'][$i]); ?>",
		  <?php } else { ?>
			  "<?php echo ($berita['umur']['kota'][$i]); ?>"
		  <?php } 
	  }
	  ?>],
      datasets: [
        {
          label: "1-10",
          fillColor: "rgba(245, 105, 84, 1)",
          strokeColor: "rgba(245, 105, 84, 1)",
          pointColor: "rgba(245, 105, 84, 1)",
          pointStrokeColor: "#f56954",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(245, 105, 84,1)",
          data: [<?php for($i=1;$i<=count($berita['umur']['a']); $i++){
			  if ($i != count($berita['umur']['a'])){
				  echo $berita['umur']['a'][$i].",";
			  } else {
				  echo $berita['umur']['a'][$i];
			  }
		  } ?>]
		  //65, 59, 80, 81, 56, 55, 40
        },
		{
          label: "11-20",
          fillColor: "rgba(0,166,90, 1)",
          strokeColor: "rgba(0,166,90, 1)",
          pointColor: "rgba(0,166,90, 1)",
          pointStrokeColor: "#00a65a",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(0,166,90,1)",
          data: [<?php for($i=1;$i<=count($berita['umur']['b']); $i++){
			  if ($i != count($berita['umur']['b'])){
				  echo $berita['umur']['b'][$i].",";
			  } else {
				  echo $berita['umur']['b'][$i];
			  }
		  } ?>]
        },
		{
          label: "21-30",
          fillColor: "rgba(243,156,18, 1)",
          strokeColor: "rgba(243,156,18, 1)",
          pointColor: "rgba(243,156,18, 1)",
          pointStrokeColor: "#f39c12",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(243,156,18,1)",
          data: [<?php for($i=1;$i<=count($berita['umur']['c']); $i++){
			  if ($i != count($berita['umur']['c'])){
				  echo $berita['umur']['c'][$i].",";
			  } else {
				  echo $berita['umur']['c'][$i];
			  }
		  } ?>]
        },
        {
          label: "31-40",
          fillColor: "rgba(0,192,239,0.9)",
          strokeColor: "rgba(0,192,239,0.8)",
          pointColor: "#00c0ef",
          pointStrokeColor: "rgba(0,192,239,1)",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(0,192,239,1)",
          data: [<?php for($i=1;$i<=count($berita['umur']['d']); $i++){
			  if ($i != count($berita['umur']['d'])){
				  echo $berita['umur']['d'][$i].",";
			  } else {
				  echo $berita['umur']['d'][$i];
			  }
		  } ?>]
        },
		{
          label: "41-50",
          fillColor: "rgba(97,84,245,0.9)",
          strokeColor: "rgba(97,84,245,0.8)",
          pointColor: "#6154f5",
          pointStrokeColor: "rgba(97,84,245,1)",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(97,84,245,1)",
          data: [<?php for($i=1;$i<=count($berita['umur']['a']); $i++){
			  if ($i != count($berita['umur']['e'])){
				  echo $berita['umur']['e'][$i].",";
			  } else {
				  echo $berita['umur']['e'][$i];
			  }
		  } ?>]
        },
		{
          label: "51-60",
          fillColor: "rgba(166,149,0,0.9)",
          strokeColor: "rgba(166,149,0,0.8)",
          pointColor: "#a69500",
          pointStrokeColor: "rgba(166,149,0,1)",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(166,149,0,1)",
          data: [<?php for($i=1;$i<=count($berita['umur']['f']); $i++){
			  if ($i != count($berita['umur']['f'])){
				  echo $berita['umur']['f'][$i].",";
			  } else {
				  echo $berita['umur']['f'][$i];
			  }
		  } ?>]
        },
		{
          label: "61-70",
          fillColor: "rgba(242,17,212,0.9)",
          strokeColor: "rgba(242,17,212,0.8)",
          pointColor: "#f211d4",
          pointStrokeColor: "rgba(242,17,212,1)",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(242,17,212,1)",
          data: [<?php for($i=1;$i<=count($berita['umur']['g']); $i++){
			  if ($i != count($berita['umur']['g'])){
				  echo $berita['umur']['g'][$i].",";
			  } else {
				  echo $berita['umur']['g'][$i];
			  }
		  } ?>]
        },
		{
          label: "71-80",
          fillColor: "rgba(242,235,17,0.9)",
          strokeColor: "rgba(242,235,17,0.8)",
          pointColor: "#f2eb11",
          pointStrokeColor: "rgba(242,235,17,1)",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(242,235,17,1)",
          data: [<?php for($i=1;$i<=count($berita['umur']['h']); $i++){
			  if ($i != count($berita['umur']['h'])){
				  echo $berita['umur']['h'][$i].",";
			  } else {
				  echo $berita['umur']['h'][$i];
			  }
		  } ?>]
        }
      ]
    };
	
	
    barChartData.datasets[1].fillColor = "#00a65a";
    barChartData.datasets[1].strokeColor = "#00a65a";
    barChartData.datasets[1].pointColor = "#00a65a";
    var barChartOptions = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero: true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines: true,
      //String - Colour of the grid lines
      scaleGridLineColor: "rgba(0,0,0,.05)",
      //Number - Width of the grid lines
      scaleGridLineWidth: 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines: true,
      //Boolean - If there is a stroke on each bar
      barShowStroke: true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth: 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing: 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing: 1,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
      //Boolean - whether to make the chart responsive
      responsive: true,
      maintainAspectRatio: true
    };

    barChartOptions.datasetFill = false;
    barChart.Bar(barChartData, barChartOptions);
  });
</script>
</head>
<body >


  <!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Statistik Kejahatan
        <small>Halaman ini berisi statistik kejahatan</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
		<div class="col-md-4 col-xs-6">
			<div class="small-box bg-yellow">
				<div class="inner">
					<h3><?php echo $berita['nama']; ?></h3>
					<p>Orang Terlibat</p>
				</div>
				<div class="icon">
					<i class="ion ion-person-add"></i>
				</div>
			</div>
		</div>
		<div class="col-md-4 col-xs-6">
			<div class="small-box bg-green">
				<div class="inner">
					<h3><?php echo $berita['berita']; ?></h3>
					<p>Berita</p>
				</div>
				<div class="icon">
					<i class="ion ion-ios-paper"></i>
				</div>
			</div>
		</div>
		<div class="col-md-4 col-xs-6">
			<div class="small-box bg-red">
				<div class="inner">
					<h3><?php echo $berita['kejahatan']; ?></h3>
					<p>Kejahatan</p>
				</div>
				<div class="icon">
					<i class="ion ion-android-warning"></i>
				</div>
			</div>
		</div>
	  </div>
	  <div class="row">
        <div class="col-md-6">
          <!-- AREA CHART -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Kota</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="areaChart" style="height:250px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- DONUT CHART -->
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Jumlah kejahatan</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <canvas id="pieChart" style="height:250px"></canvas>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col (LEFT) -->
        <div class="col-md-6">
          <!-- LINE CHART -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Jenis Kelamin yang terlibat</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="lineChart" style="height:250px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- BAR CHART -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Umur</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="barChart" style="height:230px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col (RIGHT) -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
<!-- ./wrapper -->

</body>
</html>
