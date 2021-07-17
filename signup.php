<?php
	include_once('./config/config.php');
	include_once('./includes/session.php');
	include_once('./includes/function.php');

	if(isset($_POST['submit'])){
		$username = $_POST['username'];
		$fullname = $_POST['fullname'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$password2 = $_POST['password2'];

		// Preventing SQL Injection
		$username = mysqli_real_escape_string($conn, $username);
		$fullname = mysqli_real_escape_string($conn, $fullname);
		$email = mysqli_real_escape_string($conn, $email);
		$password = mysqli_real_escape_string($conn, $password);
		$password2 = mysqli_real_escape_string($conn, $password2);

		// Form Validation
		if(empty($username) || empty($fullname) || empty($email) || empty($password) || empty($password2) ){
			$_SESSION['ErrorMessage'] = "All fields are required";
		}
		elseif($password != $password2 ){
			$_SESSION['ErrorMessage'] = "Both password provided do not match";
		}
		elseif(!preg_match("/^[a-z A-Z]*$/", $fullname)){ // Regular Expression for the full name field
			$_SESSION['ErrorMessage'] = "Only alphabets is allowed for the full name field";
		}
		elseif(!preg_match("/^[a-z A-Z]*$/", $username)){ // Regular Expression for the username field
			$_SESSION['ErrorMessage'] = "Only alphabets is allowed for the username field";
		}
		else{
			$sql = "SELECT * FROM tbluser WHERE username = '$username'";
			$query_result = mysqli_query($conn, $sql);
			$result = mysqli_num_rows($query_result);
			if($result > 0){
				$_SESSION['ErrorMessage'] = "Username is currently not available";
			}
			else{
				$sql = "SELECT * FROM tbluser WHERE email = '$email'";
				$query_result = mysqli_query($conn, $sql);
				$result = mysqli_num_rows($query_result);
				if($result > 0){
					$_SESSION['ErrorMessage'] = "Email address is already in use";
				}
				else{

					// Hashing the password provided by the user
					$pass = password_hash($password, PASSWORD_DEFAULT);

					$sql = "INSERT INTO tbluser (username,fullname,email,password,usertype) VALUES('$username','$fullname','$email','$pass','User')";
					$query_result = mysqli_query($conn, $sql);
					if($query_result){
						$_SESSION['SuccessMessage'] = "Account has been created successfully";
					}
					else{
						$_SESSION['SuccessMessage'] = "Failed to create account";
					}
				}
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
    <title>Sign Up</title>
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
                    	<h2 class="title text-center text-primary">Sign Up Page</h2>
                    	<p>Fill All Fields Correctly</p>
						<form action="signup.php" method="POST">
							<div class="form-group">
								<label>Username</label>
								<input type="text" name="username" placeholder="Username" class="form-control">
							</div>
							<div class="form-group">
								<label>Full Name</label>
								<input type="text" name="fullname" placeholder="Full Name" class="form-control">
							</div>
							<div class="form-group">
								<label>Email</label>
								<input type="email" name="email" placeholder="Email Address" class="form-control">
							</div>
							<div class="form-group">
								<label>Password</label>
								<input type="password" name="password" placeholder="Password" class="form-control">
							</div>
							<div class="form-group">
								<label>Retype Password</label>
								<input type="password" name="password2" placeholder="Retype Password" class="form-control">
							</div>
							<div class="form-group">
								<button type="submit" name="submit" class="btn btn-primary btn-lg">Submit</button>
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