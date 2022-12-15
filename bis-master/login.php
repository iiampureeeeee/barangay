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
<style>
  body{
    background-image: url('assets/img/loginback.jpg'); 
  }
  .form-container{
    background: linear-gradient(#E9374C,#D31128);
    font-family: 'Roboto', sans-serif;
    font-size: 0;
    padding: 0 15px;
    border: 1px solid #DC2036;
    border-radius: 15px;
    box-shadow: 0 0 20px rgba(0,0,0,0.2);
}
.form-container .form-icon{
    color: #fff;
    font-size: 13px;
    text-align: center;
    text-shadow: 0 0 20px rgba(0,0,0,0.2);
    width: 50%;
    padding: 70px 0;
    vertical-align: top;
    display: inline-block;
}
.form-container .form-icon i{
    font-size: 124px;
    margin: 0 0 15px;
    display: block;
}
.form-container .form-icon .signup a{
    color: #fff;
    text-transform: capitalize;
    transition: all 0.3s ease;
}
.form-container .form-icon .signup a:hover{ text-decoration: underline; }
.form-container .form-horizontal{
    background: rgba(255,255,255,0.99);
    width: 50%;
    padding: 60px 30px;
    margin: -20px 0;
    border-radius: 15px;
    box-shadow: 0 0 20px rgba(0,0,0,0.2);
    display: inline-block;
}
.form-container .title{
    color: #454545;
    font-size: 23px;
    font-weight: 900;
    text-align: center;
    text-transform: capitalize;
    letter-spacing: 0.5px;
    margin: 0 0 30px 0;
}
.form-horizontal .form-group{
    background-color: rgba(255,255,255,0.15);
    margin: 0 0 15px;
    border: 1px solid #b5b5b5;
    border-radius: 20px;
}
.form-horizontal .input-icon{
    color: #b5b5b5;
    font-size: 15px;
    text-align: center;
    line-height: 38px;
    height: 35px;
    width: 40px;
    vertical-align: top;
    display: inline-block;
}
.form-horizontal .form-control{
    color: #b5b5b5;
    background-color: transparent;
    font-size: 14px;
    letter-spacing: 1px;
    width: calc(100% - 55px);
    height: 33px;
    padding: 2px 10px 0 0;
    box-shadow: none;
    border: none;
    border-radius: 0;
    display: inline-block;
    transition: all 0.3s;
}
.form-horizontal .form-control:focus{
    box-shadow: none;
    border: none;
}
.form-horizontal .form-control::placeholder{
    color: #b5b5b5;
    font-size: 13px;
    text-transform: capitalize;
}
.form-horizontal .btn{
    color: rgba(255,255,255,0.8);
    background: #E9374C;
    font-size: 15px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 1px;
    width: 100%;
    margin: 0 0 10px 0;
    border: none;
    border-radius: 20px;
    transition: all 0.3s ease;
}
.form-horizontal .btn:hover,
.form-horizontal .btn:focus{
    color: #fff;
    background-color: #D31128;
    box-shadow: 0 0 5px rgba(0,0,0,0.5);
}
.form-horizontal .forgot-pass{
    font-size: 12px;
    text-align: center;
    display: block;
}
.form-horizontal .forgot-pass a{
    color: #999;
    transition: all 0.3s ease;
}
.form-horizontal .forgot-pass a:hover{
    color: #777;
    text-decoration: underline;
}
@media only screen and (max-width:576px){
    .form-container{ padding-bottom: 15px; }
    .form-container .form-icon{
        width: 100%;
        padding: 20px 0;
    }
    .form-container .form-horizontal{
        width: 100%;
        margin: 0;
    }
}
</style>

<body>
  <div class="row g-0">
    <div class="col-md-6 col-lg-5 d-none d-md-block align-items-center">
      <img src="assets/img/logo-brgy.png" alt="login form" class="img-fluid" 
      style="border-radius: 1rem 0 0 1rem; 
            margin-top: 20px;  
            margin-right: 20px; 
            margin-left:20px; 
            margin-bottom: 20px;
            height: 12px;"
            />
            </div>
                <div class="col-md-6 col-lg-7 d-flex align-items-center">
                  <div class="card-body p-4 p-lg-5 text-black" 
                  style="background-color: #C1CFC0; margin: 12px 12px 12px 12px;
                        background: rgba(255, 255, 255, 0.22);
                        border-radius: 16px;
                        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
                        backdrop-filter: blur(5px);
                        -webkit-backdrop-filter: blur(5px);
                        border: 1px solid rgba(255, 255, 255, 0.3);
                        box-shadow: 2px 2px 5px;
                        ">
                    <?php if(isset($_SESSION['message'])): ?> 
                      <div class="alert alert-<?= $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
                        <?= $_SESSION['message']; ?>
                      </div>
                        <?php unset($_SESSION['message']); ?>
                        <?php endif ?>
			                    <h3 class="text-center" 
                          style="font-family: Impact; 
                          font-size: 30px;
                          color: #D1E8E4;
                          text-shadow: 2px 2px 5px #354259;">
                          
                          SIGN IN HERE</h3>
			                <div class="login-form">
                        <form method="POST" action="model/login.php">	
				              <div class="form-group">
                        <label for="username" class="placeholder" style="color: #B5EAEA;">Username</label>
					                <input id="username" name="username" type="text" class="form-control input-border-bottom" required>
					            </div>
				                  <div class="form-group"><label for="password" class="placeholder">Password</label>
					                <input id="password" name="password" type="password" class="form-control input-border-bottom" required>
					                <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
				                  </div>
				              <div class="form-action mb-3">
                        <button type="submit" class="btn btn-primary btn-rounded btn-login">Sign In</button>
				              </div>
                        </form>
			          </div>
              </div>
            </div>
          </div>
        
	<?php include 'templates/footer.php' ?>
</body>
</html>