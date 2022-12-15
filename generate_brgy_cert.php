<?php include 'server/server.php' ?>
<?php 
    $id = $_GET['id'];
	$query = "SELECT * FROM tblresident WHERE id='$id'";
    $result = $conn->query($query);
    $resident = $result->fetch_assoc();

    $query1 = "SELECT * FROM tblofficials JOIN tblposition ON tblofficials.position=tblposition.id WHERE tblposition.position NOT IN ('SK Chairrman','Secretary','Treasurer')
                AND `status`='Active' ORDER BY `order` ASC";
    $result1 = $conn->query($query1);
    $officials = array();
	while($row = $result1->fetch_assoc()){
		$officials[] = $row; 
	}

    $c = "SELECT * FROM tblofficials JOIN tblposition ON tblofficials.position=tblposition.id WHERE tblposition.position='Captain'";
    $captain = $conn->query($c)->fetch_assoc();
    $s = "SELECT * FROM tblofficials JOIN tblposition ON tblofficials.position=tblposition.id WHERE tblposition.position='Secretary'";
    $sec = $conn->query($s)->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Barangay Certificate -  Barangay Management System</title>

    <style>
.bg-image {
  /* The image used */
  background-image: url("assets/img/logo.jpg");
  
  /* Add the blur effect */
  filter: blur(8px);
  -webkit-filter: blur(8px);
  
  /* Full height */
  height: 100%; 
  
  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
    </style>

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
				<div class="panel-header bg-primary-gradient">
					<div class="page-inner">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
								<h2 class="text-white fw-bold">Generate Certificate</h2>
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner">
					<div class="row mt--2">
						<div class="col-md-12">

                            <?php if(isset($_SESSION['message'])): ?>
                                <div class="alert alert-<?php echo $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
                                    <?php echo $_SESSION['message']; ?>
                                </div>
                            <?php unset($_SESSION['message']); ?>
                            <?php endif ?>

                            <div class="card">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title">Barangay Certificate</div>
										<div class="card-tools">
											<button class="btn btn-info btn-border btn-round btn-sm" onclick="printDiv('printThis')">
												<i class="fa fa-print"></i>
												Print Certificate
											</button>
										</div>
									</div>
								</div>
								<div class="card-body m-5" id="printThis">
                                    
                                <!--header-->
                                    <div class="row mt-3" style="border-bottom:1px solid black">
                                 
                                        <div class="col-md-4">
                                            <img src="assets/uploads/<?= $brgy_logo ?>" style="margin-bottom: 40px; margin-left: 55px;" class="img-fluid" width="200" />
										</div>
                                        <div class="col-md-3">
										    <div class="text-center" style="margin-left: 40px;">
                                                <h3 class="mb-0">Republic of the Philippines</h3>
                                                <h3 class="mb-0">Province of <?= ucwords($province) ?></h3>
											    <h3 class="mb-0"><?= ucwords($town) ?></h3>
											    <h1 class="fw-bold mb-0"><?= ucwords($brgy) ?></i></h2>
                                                <p><i>Mobile No. <?= $number ?></i></p>
                                                <p><i>fbaccount: barangay_bonbon@yahoo.com</i></p>
                                            </div>
										</div>   
                                        <div class="col-md-4">
                                            <div class="text-center" style="border:3px solid black; height: 200px; width: 200px; margin-left: 150px;">
                                                <img src="<?= preg_match('/data:image/i', $resident['picture']) ? $resident['picture'] : 'assets/uploads/resident_profile/'.$resident['picture'] ?>" 
                                                style="height: 200px; width: 200px;" alt="Resident Profile" class="img-fluid">
                                            </div>
										</div>                                        
									</div><!--endheader-->

                                    <!--barangayClearance-->
                                    <div class="text-center">
                                        <h1 style="color: red; font-size:80px; font-weight:bold;  -webkit-text-stroke-color: black;  -webkit-text-stroke-width: 2px;">BARANGAY CLEARANCE</h1>
                                    </div>
                                    <!--endbrgyclearance-->
                                    <div class="bg-image"></div>
                                    <!--body-->
                                    <div class="container" style="margin-top: 25px;">
                                        <div class="row mt-2" style="border-bottom:1px solid black;">
                                            <div class="col-md-5">
                                                <h1 class="fw-bold mb-0" style="font-size:40px; margin-left:50px;"><i><?= ucwords($resident['lastname']) ?></i></h1>
										    </div>
                                            <div class="col-md-4">
                                                <h2 class="fw-bold mb-0" style="font-size:40px;"><?= ucwords($resident['firstname']) ?></h2>
										    </div>   
                                            <div class="col-md-3">
                                                <h2 class="fw-bold mb-0" style="font-size:40px;"><?= ucwords($resident['middlename']) ?></h2>
										    </div>                                          
									    </div><!--endheader-->
                                        <div class="row mt-2">
                                            <div class="col-md-5">
                                                <h2 style="margin-left: 45px;">Lastname</h2>
										    </div>
                                            <div class="col-md-4">
                                                <h2>Firstname</h2>
										    </div>   
                                            <div class="col-md-3">
                                                <h2>Middlename</h2>
										    </div>                                          
									    </div><!--endheader--> 

                                        <div class="row">
                                            <div class="col-md-2">
                                                <h1 class="fw-bold mb-0" style="font-size:30px; ">Age: <i style="border-bottom:1px solid black; font-size:40px;"><?= ucwords($resident['age']) ?></i></h1>
										    </div>
                                            <div class="col-md-3">
                                                <h1 class="fw-bold mb-0" style="font-size:30px;">Status: <i style="border-bottom:1px solid black; font-size:40px;"> <?= ucwords($resident['civilstatus']) ?></i></h1>
										    </div>
                                            <div class="col-md-7">
                                                <h1 class="fw-bold mb-0" style="font-size:30px;">Birthdate: <i style="border-bottom:1px solid black; font-size:40px;"><?= date('F d, Y', strtotime($resident['birthdate'])) ?></i></h1>
										    </div>
                                        </div>
                                        
                                        <div class="container" style="margin-top: 25px;">
                                            <h1 style="font-size:30px; font-weight:bold;">Address: <i><i style="border-bottom:1px solid black; font-size:25px;"> <?= ucwords($resident['address']) ?></i></h1>
                                        </div>

                                        <div class="container" style="margin-top: 25px;">
                                            <h2 class="mt-3" style="text-indent: 40px;">This is to certify that the aboved-named person is a resident of 
                                                <span class="fw-bold" style="font-size:25px"><?= ucwords($brgy) ?></span> and has no pending Criminal/Civil case filed in this office as of issuance hereof.</h2>
                                                <h2 class="mt-3" style="text-indent: 40px;">This certification/clearance is hereby issued to the above-named person for whatever legal purpose it may serve him/her best.</h2>
                                            <div class="row">
                                            <div class="col-md-6">
                                                <h2 class="mt-5">Date Issued: <span style="border-bottom:1px solid black;" class="fw-bold" style="font-size:25px"><?= date('F d, Y') ?>.</span></h2>
                                             </div>
                                             <div class="col-md-6">
                                                <h2 class="mt-5">Validity Period: <span style="border-bottom:1px solid black;" class="fw-bold" style="font-size:25px"><?= date('F d, Y', strtotime('+ 6 months')) ?>.</span></h2>
                            </div>
                                            </div>

                                                <h2 class="text-uppercase" style="margin-top:50px;">NOT VALID WITHOUT SEAL:</h2>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="p-3 text-right mr-3">
                                                <h2 class="fw-bold mb-0 text-uppercase"><?= ucwords($captain['name']) ?></h2>
                                                <p class="mr-3">PUNONG BARANGAY</p>
                                            </div>
                                            <div class="p-3 text-left">
                                                <h2 class="fw-bold mb-0 text-uppercase"><?= empty($sec['name']) ? 'Please Create Official with Secretary Position' : ucwords($sec['name']) ?></h2>
                                                <p class="ml-2">BARANGAY SECRETARY</p>
                                            </div>
                                        </div>
                                        <div class="col-md-12 d-flex flex-wrap justify-content-end">
                                            <div class="p-3 text-center">
                                                <div class="border mb-3" style="height:150px;width:290px">
                                                    <p class="mt-5 mb-0 pt-5">Right Thumb Mark</p>
                                                </div>
                                                <h2 class="fw-bold mb-0"><?= ucwords($resident['firstname'].' '.$resident['middlename'].' '.$resident['lastname']) ?></h2>
                                                <p>Tax Payer's Signature</p>
                                            </div>
                                        </div>


                                    </div><!--endbody-->                             
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

            <!-- Modal -->
            <div class="modal fade" id="pment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create Payment</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/save_pment.php" >
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="number" class="form-control" name="amount" placeholder="Enter amount to pay" required>
                                </div>
                                <div class="form-group">
                                    <label>Date Issued</label>
                                    <input type="date" class="form-control" name="date" value="<?= date('Y-m-d') ?>">
                                </div>
                                <div class="form-group">
                                    <label>Payment Details(Optional)</label>
                                    <textarea class="form-control" placeholder="Enter Payment Details" name="details">Barangay Clearance Payment</textarea>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="name" value="<?= ucwords($resident['firstname'].' '.$resident['middlename'].' '.$resident['lastname']) ?>">
                            <button type="button" class="btn btn-secondary" onclick="goBack()">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

			<!-- Main Footer -->
			<?php include 'templates/main-footer.php' ?>
			<!-- End Main Footer -->
			<?php if(!isset($_GET['closeModal'])){ ?>
            
                <script>
                    setTimeout(function(){ openModal(); }, 1000);
                </script>
            <?php } ?>
		</div>
		
	</div>
	<?php include 'templates/footer.php' ?>
    <script>
            function openModal(){
                $('#pment').modal('show');
            }

            function printDiv(divName) {
                var printContents = document.getElementById(divName).innerHTML;
                var originalContents = document.body.innerHTML;

                document.body.innerHTML = printContents;

                window.print();

                document.body.innerHTML = originalContents;
            }
    </script>
</body>
</html>