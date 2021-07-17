<?php
	include_once('./config/config.php');
	include_once('./includes/session.php');
	include_once('./includes/function.php');

	if(isset($_POST['login'])){
		$username = $_POST['username'];
		$password = $_POST['password'];

		// Preventing SQL Injection
		$username = mysqli_real_escape_string($conn, $username);
		$password = mysqli_real_escape_string($conn, $password);

		// Form Validation
		if(empty($username) || empty($password) ){
			$_SESSION['ErrorMessage'] = "All fields are required";
		}
		elseif(!preg_match("/^[a-z A-Z]*$/", $username)){ // Regular Expression for the username field
			$_SESSION['ErrorMessage'] = "Only alphabets is allowed for the username field";
		}
		else{
			$sql = "SELECT * FROM tbluser WHERE username = '$username' AND usertype = 'User'";
			$query_result = mysqli_query($conn, $sql);
			$result = mysqli_num_rows($query_result);
			if($result > 0){
				while($row = mysqli_fetch_array($query_result)){
					$_SESSION['username'] = $row['username'];
					$_SESSION['fullname'] = $row['fullname'];
					$_SESSION['email'] = $row['email'];
					$_SESSION['password'] = $row['password'];
					$_SESSION['usertype'] = $row['usertype'];

					$fetched_password = $row['password'];

				}

				if(password_verify($password, $fetched_password)){
						$_SESSION['SuccessMessage'] = "Login Successful";
						
						RedirectTo('dashboard.php');

					}else{
						$_SESSION['ErrorMessage'] = "Details Provided is Invalid";
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
    <title>Login</title>
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
                    	<h1 class="title text-center text-primary">Login Page</h1>
                    	<p>Fill All Fields Correctly</p>
						<form action="index.php" method="POST">
							<div class="form-group">
								<label>Username</label>
								<input type="text" name="username" placeholder="Username" class="form-control">
							</div>
							<div class="form-group">
								<label>Password</label>
								<input type="password" name="password" placeholder="Password" class="form-control">
							</div>
							<div class="form-group">
								<button type="submit" name="login" class="btn btn-primary btn-lg">Login</button>
							</div>
							<h4 class="text-center"><a href="reset.php">Reset Password</a></h4>
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