<?php
	include_once('./config/config.php');
	include_once('./includes/session.php');
	include_once('./includes/function.php');

	if(isset($_SESSION['newemail'])){

		if(isset($_POST['change_password'])){
			$password = $_POST['password'];
			$password2 = $_POST['password2'];

			// Preventing SQL Injection
			//$password = mysqli_real_escape_string($conn, $password);
			$password2 = mysqli_real_escape_string($conn, $password2);

			// Form Validation
			if(empty($password) || empty($password2)){
				$_SESSION['ErrorMessage'] = "All field can't be empty";
			}
			elseif($password != $password2){ 
				$_SESSION['ErrorMessage'] = "Both password do not match.";
			}
			else{
				$pass = password_hash($password, PASSWORD_DEFAULT);

				$sql = "UPDATE tbluser SET password = '$pass' WHERE email = '{$_SESSION['newemail']}' AND usertype = 'User'";
				$query_result = mysqli_query($conn, $sql);
				if($query_result){
					$_SESSION['SuccessMessage'] = "Password has been reset successfully";
				}
				else{
					$_SESSION['ErrorMessage'] = "Failed to reset password";
				}
			}
		}
	}
	else{
		RedirectTo('index.php');
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Reset Password</title>
    <?php include_once('./links/css/css-links.php'); ?>
</head><!--/head-->

<body class="bg-default">
	
	<header id="header"><!--header-->
	    <nav class="navbar navbar-expand-md navbar-light title" style="background-color: #e3f2fd;font-size: 16px;">
			<ul class="navbar-nav" >
				<li class="nav-item" >
				    <a class="text-primary nav-link active" href="index.php">Home</a>
				</li>
				<li class="nav-item">
				    <a class="nav-link " href="signup.php">Sign Up</a>
				</li>
			</ul>
    	</nav>
	</header><!--/header-->

	<section class="mt-0"><!--section start-->
		<div class="row">
			<div class="col-sm-12">
				<div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-5">
                    	<?php
                    		echo SuccessMessage();
                    		echo ErrorMessage();
                    		echo WarningMessage();
                    	?>
                    	<h1 class="title text-center text-primary">Reset Password</h1>
						<form action="reset_password.php" method="POST">
							<div class="form-group">
								<label>New Password</label>
								<input type="password" name="password" placeholder="New Password" class="form-control">
							</div>
							<div class="form-group">
								<label>Retype New Password</label>
								<input type="password" name="password2" placeholder="Retype New Password" class="form-control">
							</div>
							<div class="form-group">
								<button type="submit" name="change_password" class="btn btn-primary btn-lg">Change Password</button>
								<a href="index.php" class="btn btn-danger btn-lg">Back</a>
							</div>
						</form>
                    </div>
                </div>
			</div>
		</div>
	</section><!--/section end-->
	
	
	<?php include_once('./includes/footer.php'); ?>

	<?php include_once('./links/js/js-links.php'); ?>
	
</body>
</html>