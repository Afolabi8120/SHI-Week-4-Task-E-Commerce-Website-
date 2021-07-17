<?php
        //Name: Afolabi Temidayo Timothy
    //Intern ID: SH-IT-48472
    //Stack: Web Development(Backend)
    //Program: Side Hustle Internship 3.0 


	include_once('./config/config.php');
	include_once('./includes/session.php');
	include_once('./includes/function.php');

	if(isset($_SESSION['username'])){

		if(isset($_POST['update'])){
			//$username = $_POST['username'];
			$fullname = $_POST['fullname'];
			//$email = $_POST['email'];

			// Preventing SQL Injection
			//$username = mysqli_real_escape_string($conn, $username);
			$fullname = mysqli_real_escape_string($conn, $fullname);
			//$email = mysqli_real_escape_string($conn, $email);

			// Form Validation
			if(empty($fullname)){
				$_SESSION['ErrorMessage'] = "Full name field can't be empty";
			}
			elseif(!preg_match("/^[a-z A-Z]*$/", $fullname)){ // Regular Expression for the full name field
				$_SESSION['ErrorMessage'] = "Only alphabets is allowed for the full name field";
			}
			else{
				$sql = "UPDATE tbluser SET fullname = '$fullname' WHERE username = '{$_SESSION['username']}' AND usertype = 'User'";
				$query_result = mysqli_query($conn, $sql);
				if($query_result){
					$_SESSION['SuccessMessage'] = "Account has been updated successfully";
				}
				else{
					$_SESSION['ErrorMessage'] = "Failed to update profile";
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
    <title>Profile</title>
    <?php include_once('./links/css/css-links.php'); ?>
</head><!--/head-->

<body class="bg-default">
	
	<?php include_once('./includes/header.php'); ?>

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
                    	<h2 class="title text-center text-primary">My Profile</h2>
                    	<?php
                    		$sql = "SELECT * FROM tbluser WHERE username = '{$_SESSION['username']}' AND usertype = 'User'";
							$query_result = mysqli_query($conn, $sql);
							$result = mysqli_num_rows($query_result);
							if($result > 0){
								while($row = mysqli_fetch_array($query_result)){
									$_username = $row['username'];
									$_fullname = $row['fullname'];
									$_email = $row['email'];
							
                    	?>
						<form action="profile.php" method="POST">
							<div class="form-group">
								<label>Username</label>
								<input type="text" name="username" class="form-control" value="<?php echo $_username; ?>" disabled >
							</div>
							<div class="form-group">
								<label>Full Name</label>
								<input type="text" name="fullname" class="form-control" value="<?php echo $_fullname; ?>">
							</div>
							<div class="form-group">
								<label>Email</label>
								<input type="email" name="email" class="form-control" value="<?php echo $_email; ?>" disabled>
							</div>
							<?php
								}
							}
							?>
							<div class="form-group">
								<button type="submit" name="update" class="btn btn-primary btn-lg">Update Account</button>
								<a href="dashboard.php" class="btn btn-danger btn-lg">Back</a>
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
