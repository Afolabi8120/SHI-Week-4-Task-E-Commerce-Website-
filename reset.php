<?php
	include_once('./config/config.php');
	include_once('./includes/session.php');
	include_once('./includes/function.php');

	if(isset($_POST['reset'])){
		$email = $_POST['email'];

		// Preventing SQL Injection
		$email = mysqli_real_escape_string($conn, $email);

		// Form Validation
		if(empty($email)){
			$_SESSION['ErrorMessage'] = "Field can't be empty";
		}
		else{
			$sql = "SELECT * FROM tbluser WHERE email = '$email' AND usertype = 'User'";
			$query_result = mysqli_query($conn, $sql);
			$result = mysqli_num_rows($query_result);
			if($result > 0){
				while($row = mysqli_fetch_array($query_result)){
					$_SESSION['newemail'] = $row['email'];
				}

				if(isset($_SESSION['newemail'])){
					RedirectTo('reset_password.php');
				}

			}
			else{
				$_SESSION['ErrorMessage'] = "Invalid details provided";
			}
			
		}
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
                    	<p>Please provide a valid details</p>
						<form action="reset.php" method="POST">
							<div class="form-group">
								<label>Email</label>
								<input type="email" name="email" placeholder="Email Address" class="form-control">
							</div>
							<div class="form-group">
								<button type="submit" name="reset" class="btn btn-primary btn-lg form-control">Submit</button>
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