<?php include 'server/server.php' ?>
<?php 

	$query = "SELECT * FROM tblresident WHERE resident_type=1";
    $result = $conn->query($query);
	$total = $result->num_rows;

	$query1 = "SELECT * FROM tblresident WHERE gender='Male' AND resident_type=1";
    $result1 = $conn->query($query1);
	$male = $result1->num_rows;

	$query2 = "SELECT * FROM tblresident WHERE gender='Female' AND resident_type=1";
    $result2 = $conn->query($query2);
	$female = $result2->num_rows;

	$query3 = "SELECT * FROM tblresident WHERE voterstatus='Yes' AND resident_type=1";
    $result3 = $conn->query($query3);
	$totalvoters = $result3->num_rows;

	$query4 = "SELECT * FROM tblresident WHERE voterstatus='No' AND resident_type=1";
	$non = $conn->query($query4)->num_rows;

	$query5 = "SELECT * FROM tblpurok";
	$purok = $conn->query($query5)->num_rows;

	$query6 = "SELECT * FROM tblprecinct";
	$precinct = $conn->query($query6)->num_rows;

	$query7 = "SELECT * FROM tblblotter";
	$blotter = $conn->query($query7)->num_rows;

	$date = date('Y-m-d'); 
	$query8 = "SELECT SUM(amounts) as am FROM tblpayments WHERE `date`='$date'";
	$revenue = $conn->query($query8)->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Dashboard -  Barangay Management System</title>
</head>
<body>
	<?php include 'templates/loading_screen.php' ?>

	<div class="wrapper">
		<!-- Main Header -->
		<?php include 'templates/main-header.php' ?>
		<!-- End Main Header -->

		<!-- Sidebar -->
		<?php include 'templates/sidebar.php' ?>
		<!-- End Sidebar -->

		<div class="main-panel">
			<div class="content">
				<div class="panel-header" style="background-color: #5E454B;">
					<div class="page-inner">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>	
								<h2 style="font-style: Century-gothic; color: white;">Dashboard</h2>
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner mt--2">
					<?php if(isset($_SESSION['message'])): ?>
							<div class="alert alert-<?= $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
								<?php echo $_SESSION['message']; ?>
							</div>
						<?php unset($_SESSION['message']); ?>
						<?php endif ?>
					<div class="row">
						<div class="col-md-4">
							<div class="card card-stats card-round" 
							style="background: linear-gradient(45deg,#AF7AB3,#E4D192);
								   box-shadow: 2px 2px 5px;">
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center" style="color:white; text-shadow: 2px 2px 5px #354259;">
												<i class="flaticon-users"></i>
											</div>
										</div>
										<div class="col-3 col-stats">
										</div>
										<div class="col-6 col-stats">
											<div class="numbers mt-4">
												<h2 class="fw-bold text-uppercase" style="color:white; text-shadow: 2px 2px 5px #354259;">Population</h2>
												<h3 class="fw-bold text-uppercase" style="text-shadow: 2px 2px 5px lightblue;"><?= number_format($total) ?></h3>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									<a href="resident_info.php?state=all" class="card-link text-light">Total Population </a>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card card-stats card-round" 
							style="background: linear-gradient(45deg,#E9DAC1,#9ED2C6);
								   border-bottom-color: green;
								   box-shadow: 2px 2px 5px;">
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center" style="color:white; text-shadow: 2px 2px 5px #354259;">
												<i class="flaticon-user"></i>
											</div>
										</div>
										<div class="col-3 col-stats">
										</div>
										<div class="col-6 col-stats">
											<div class="numbers mt-4">
												<h2 class="fw-bold text-uppercase" style="color:white; text-shadow: 2px 2px 5px #354259;">Male</h2>
												<h3 class="fw-bold" style="text-shadow: 2px 2px 5px #EEEEEE;"><?= number_format($male) ?></h3>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									<a href="resident_info.php?state=male" class="card-link text-light" style="text-shadow: 2px 2px 5px #665A48;">Total Male </a>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card card-stats card-round" 
							style="background: linear-gradient(45deg,#FFE3E1,#FF9494);
								   border-bottom-color: green;
								   box-shadow: 2px 2px 5px;">
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center" style="color:white; text-shadow: 2px 2px 5px #354259;">
												<i class="icon-user-female"></i>
											</div>
										</div>
										<div class="col-3 col-stats">
										</div>
										<div class="col-6 col-stats">
											<div class="numbers mt-4">
												<h2 class="fw-bold text-uppercase" style="color:white; text-shadow: 2px 2px 5px #354259;">Female</h2>
												<h3 class="fw-bold text-uppercase" style="text-shadow: 2px 2px 5px #EEEEEE;"><?= number_format($female) ?></h3>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									<a href="resident_info.php?state=female" class="card-link text-light" style="text-shadow: 2px 2px 5px #354259;">Total Female </a>
								</div>
							</div>
						</div>
					</div>
					<?php if(isset($_SESSION['username']) && $_SESSION['role']=='administrator'):?>
					<div class="row">
						<div class="col-md-4">
							<div class="card card-stats card-round"
							style="background: linear-gradient(45deg,#789395,#B4CFB0);
								   border-bottom-color: green;
								   box-shadow: 2px 2px 5px;">
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center" style="color:white; text-shadow: 2px 2px 5px #354259;">
												<i class="fas fa-fingerprint"></i>
											</div>
										</div>
										<div class="col-3 col-stats">
										</div>
										<div class="col-6 col-stats">
											<div class="numbers mt-4">
												<h2 class="fw-bold text-uppercase" style="color:white; text-shadow: 2px 2px 5px #354259;">Voters</h2>
												<h3 class="fw-bold text-uppercase"><?= number_format($totalvoters) ?></h3>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									<a href="resident_info.php?state=voters" class="card-link text-light">Total Voters </a>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card card-stats card-round"
							style="background: linear-gradient(45deg,#9AD0EC,#1572A1);
								   border-bottom-color: green;
								   box-shadow: 2px 2px 5px;">
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center" style="color:white; text-shadow: 2px 2px 5px #354259;">
												<i class="flaticon-users"></i>
											</div>
										</div>
										<div class="col-3 col-stats">
										</div>
										<div class="col-6 col-stats">
											<div class="numbers mt-4">
												<h2 class="fw-bold text-uppercase" style="color:white; text-shadow: 2px 2px 5px #354259;">Non Voters</h2>
												<h3 class="fw-bold text-uppercase"><?= number_format($non) ?></h3>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									<a href="resident_info.php?state=non_voters" class="card-link text-light">Total Non Voters </a>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card card-stats card-round" 
							style="background: linear-gradient(45deg,#E4D1B9,#BE8C63);
								   border-bottom-color: green;
								   box-shadow: 2px 2px 5px;">
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center" style="color:white; text-shadow: 2px 2px 5px #354259;">
												<i class="fas fa-list"></i>
											</div>
										</div>
										<div class="col-3 col-stats">
										</div>
										<div class="col-6 col-stats">
											<div class="numbers mt-4">
												<h2 class="fw-bold text-uppercase" style="color:white; text-shadow: 2px 2px 5px #354259;">Precinct Number</h2>
												<h3 class="fw-bold"><?= number_format($precinct) ?></h3>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									<a href="purok_info.php?state=precinct" class="card-link text-light" style="color:white; text-shadow: 2px 2px 5px #354259;">Precint Information</a>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card card-stats card-round"
							style="background: linear-gradient(45deg,#BF8B67,#632626);
								   border-bottom-color: green;
								   box-shadow: 2px 2px 5px;">
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center" style="color:white; text-shadow: 2px 2px 5px #354259;">
												<i class="icon-direction"></i>
											</div>
										</div>
										<div class="col-3 col-stats">
										</div>
										<div class="col-6 col-stats">
											<div class="numbers mt-4">
												<h2 class="fw-bold text-uppercase" style="color:white; text-shadow: 2px 2px 5px #354259;">Purok Number</h2>
												<h3 class="fw-bold text-uppercase" style="color:white; text-shadow: 2px 2px 5px #354259;"><?= number_format($purok) ?></h3>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									<a href="purok_info.php?state=purok" class="card-link text-light">Purok Information</a>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card card-stats card-round" 
							style="background: linear-gradient(45deg,#B97A95,#716F81);
								   border-bottom-color: green;
								   box-shadow: 2px 2px 5px;">
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center" style="color:white; text-shadow: 2px 2px 5px #354259;">
												<i class="fas fa-dollar-sign"></i>
											</div>
										</div>
										<div class="col-3 col-stats">
										</div>
										<div class="col-6 col-stats">
											<div class="numbers mt-4">
												<h2 class="fw-bold text-uppercase" style="color:white; text-shadow: 2px 2px 5px #354259;">Revenue - by day</h2>
												<h3 class="fw-bold text-uppercase" style="color:white; text-shadow: 2px 2px 5px #354259;">P <?= number_format($revenue['am'],2) ?></h3>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									<a href="revenue.php" class="card-link text-light" style="color:white; text-shadow: 2px 2px 5px #354259;">All Revenues</a>
								</div>
							</div>
						</div>
					</div>
					<?php endif ?>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title fw-bold">LGU Mission Statement</div>
									</div>
								</div>
								<div class="card-body">
									<p><?= !empty($db_txt) ? $db_txt : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque in ipsum id orci porta dapibus. Donec rutrum congue leo eget malesuada. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Quisque velit nisi, pretium ut lacinia in, elementum id enim.' ?></p>
									<div class="text-center">
										<img class="img-fluid" src="<?= !empty($db_img) ? 'assets/uploads/'.$db_img : 'assets/img/bg-abstract.png' ?>" />
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Main Footer -->
			<?php include 'templates/main-footer.php' ?>
			<!-- End Main Footer -->
			
		</div>
		
	</div>
	<?php include 'templates/footer.php' ?>
</body>
</html>