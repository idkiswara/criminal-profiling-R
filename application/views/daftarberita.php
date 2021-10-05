<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
	<title>Lihat Berita</title>
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
	
	<link rel="stylesheet" href="assets/plugins/datatables/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href='assets/plugins/datatables/dataTables.bootstrap.css'>
	

	<!-- REQUIRED JS SCRIPTS -->

<!-- DataTables -->
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>


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
        Hasil Analisis
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
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Data Berita</h3>
					</div>
					<div class="box-body">
						<table id="tabel" class="table table-bordered table-striped">
							<tbody>
								<tr>
									<th>id</th>
									<th>isi berita</th>
									<th>lihat isi</th>
								</tr>
								<?php for($i=1; $i<=count($berita['id']); $i++) { ?>
								<tr>
									<td><?php echo $berita['id'][$i]; ?> </td>
									<td><?php echo $berita['berita'][$i]; ?>... </td>
									<?php if($i%2 == 1){ ?>
									<td><a href="<?php echo base_url(); ?>textmining/lihatdetail/<?php echo $berita['id'][$i]; ?>" class="btn bg-maroon btn-flat margin" type="button" >Lihat detail</a></td>
									<?php } else { ?>
									<td><a href="<?php echo base_url(); ?>textmining/lihatdetail/<?php echo $berita['id'][$i]; ?>" class="btn bg-purple btn-flat margin" type="button">Lihat detail</a></td>
									<?php } ?>
								</tr>
								<?php } ?>								
							</tbody>
						</table>
					</div>
				</div>
			</div>
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

<script>
  $(document).ready(function() {
    $('#tabel').DataTable();
  });
</script>

</body>
</html>

<?php /*foreach($berita as $d){ ?>
								<tr>
									<td><?php echo $d->idberita; ?></td>
									<td><?php echo $d->isiberita; ?>...</td>
									<?php if($d->idberita%2 == 0){ ?>
									<td><a href="<?php echo base_url(); ?>textmining/lihatdetail/<?php echo $d->idberita; ?>" class="btn bg-maroon btn-flat margin" type="button" >tes</a></td>
									<?php } else { ?>
									<td><a href="<?php echo base_url(); ?>textmining/lihatdetail/<?php echo $d->idberita; ?>" class="btn bg-purple btn-flat margin" type="button">tes</a></td>
									<?php } ?>
								</tr>
								<?php } ?>
								*/