<?php 
	session_start(); 
	if(isset($_SESSION['username'])){
		header('Location: dashboard.php');
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'templates/header.php' ?>
	<title>Login -  Barangay Management System</title>

<body class="login" style="height: 100vh; background-color: Cornsilk;">


  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card"
         style="background-image: url('assets/img/loggin.png'); 
         border-radius: 1rem; 
   
         height: 600px;
         width: 1000px; ">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block align-items-center">
              <img src="assets/img/logo-brgy.png" alt="login form" class="img-fluid" 
              style="border-radius: 1rem 0 0 1rem; 
                    display: block; margin-top: 100px; 
                    margin-right: 20px; 
                    margin-left:20px;
                    margin-bottom: 20px;"/>
            </div>
                
            <!--form-->
                <div class="col-md-6 col-lg-7 d-flex align-items-center">
                  <div class="card-body p-4 p-lg-5 text-black" 
                  style="
                        background-color: whitesmoke; margin: 12px 12px 12px 12px;
                        background: rgba(255, 255, 255, 0.22);
                        border-radius: 16px;
                        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
                        backdrop-filter: blur(5px);
                        -webkit-backdrop-filter: blur(5px);
                        border: 6px solid rgba(255, 255, 255, 0.3);
                        box-shadow: 1px 9px 17px;
                        margin-top: 70px;
                        ">
                    <?php if(isset($_SESSION['message'])): ?> 
                      <div class="alert alert-<?= $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
                        <?= $_SESSION['message']; ?>
                      </div>
                        <?php unset($_SESSION['message']); ?>
                        <?php endif ?>
			                    <h3 class="text-center" 
                          style="font-family: Impact; 
                          font-size: 50px;
                          color: #55C9F0;
                          text-shadow: 2px 2px 5px #354259;">
                          
                          <i class="fas fa-users" style="color:#fff8dc;"></i></h3>
			                <div class="login-form">
                        <form method="POST" action="model/login.php">	
				              <div class="form-group">
                        
					                <input id="username" placeholder="USERNAME" name="username" type="text" style="color: white;" class="form-control input-border-bottom" required>
					            </div>
				                  <div class="form-group">
					                <input id="password" placeholder="PASSWORD" name="password" type="password" style="color: white;" class="form-control input-border-bottom" required>
					                <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password" style="color: white;"></span>
				                  </div>
				              <div class="form-action mb-3">
                        <button type="submit" class="btn btn-login">Login</button>
				              </div>
                        </form>
			          </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


	<?php include 'templates/footer.php' ?>
</body>
</html>