<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
	<title>Hasil Analisis</title>
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

</head>
<body >


  <!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Hasil Analisis <?php echo $this->session->userdata('berita'); ?>
        <small>Hasil dari berita kejahatan yang sudah di masukan ke dalam sistem</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-6">
          <!-- AREA CHART -->
		  <div class="small-box bg-yellow">
			<div class="small-box">
				<div class="inner">
					<span class="info-box-text">Nama yang terlibat</span>
					<?php for($i=1; $i <= count($berita['namaorang']); $i++){ 
						if ($berita['namaorang'][$i] != "N/A"){ ?>
						<span class="info-box-number"><?php echo $berita['namaorang'][$i] . " (".$berita['umur'][$i].") (".$berita['kelamin'][$i] .")"; ?></span>
					<?php } else { ?>
						<span class="info-box-number">(tidak ada orang yang terlibat)</span>
					<?php } } ?>
					<!--<span class="info-box-number">Aris Anggara (24) (L)</span>
					<span class="info-box-number">Gusti Mochamiqbal (21) (L)</span>
					<span class="info-box-number">Cindy Debora (22) (P)</span>
					<span class="info-box-number">Cindy Debora (22) (P)</span>
					<span class="info-box-number">Cindy Debora (22) (P)</span>
					<span class="info-box-number">Cindy Debora (22) (P)</span>
					<span class="info-box-number">Cindy Debora (22) (P)</span>
					<span class="info-box-number">Cindy Debora (22) (P)</span>-->
					<div class="icon"><i class="ion ion-person-add"></i></div>
				</div>
				<div class="small-box-footer"></div>
			</div>
		  </div>
          <!-- /.col (RIGHT) -->
      </div>
	  <div class="col-md-6">
		  <div class="small-box bg-aqua">
			<div class="small-box">
				<div class="inner">
					<span class="info-box-text">Tanggal Kejadian</span>
					<span class="info-box-number"><?php if($berita['tanggal'] == 0){
					echo "N/A";
					} else {
					echo $berita['tanggal'] . " " . $berita['bulan']; } ?></span>
					<!--<span class="info-box-number">30 Desember</span>-->
					<span class="info-box-text">Hari</span>
					<span class="info-box-number"><?php echo $berita['hari']; ?></span>
					<!--<span class="info-box-number">Senin</span>-->
				</div>
			</div>
			<div class="icon">
				<i class="ion ion-android-calendar"></i>
			</div>
			<div class="small-box-footer"></div>
		  </div>
		  <div class="small-box bg-red">
			<div class="small-box">
				<div class="inner">
					<span class="info-box-text">Jenis Kejahatan</span>
					<span class="info-box-number"><?php echo $berita['jenis']; ?></span>
					<!--<span class="info-box-number">Pemberian Harapan Palsu</span>-->
				</div>
			</div>
			<div class="icon">
				<i class="ion ion-android-warning"></i>
			</div>
			<div class="small-box-footer"></div>
		  </div>
		  <div class="small-box bg-blue">
			<div class="small-box">
				<div class="inner">
					<span class="info-box-text">Tempat Kejadian</span>
					<span class="info-box-number"><?php echo $berita['tempat']; ?></span>
					<!--<span class="info-box-number">Surabaya</span>-->
				</div>
			</div>
			<div class="icon">
				<i class="ion ion-location"></i>
			</div>
			<div class="small-box-footer"></div>
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
