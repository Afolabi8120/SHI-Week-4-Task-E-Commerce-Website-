<?php
        //Name: Afolabi Temidayo Timothy
    //Intern ID: SH-IT-48472
    //Stack: Web Development(Backend)
    //Program: Side Hustle Internship 3.0 


	include_once('./config/config.php');
	include_once('./includes/session.php');
	include_once('./includes/function.php');

	if(isset($_SESSION['username'])){

		if(isset($_POST['save'])){
			$name = $_POST['name'];
			$price = $_POST['price'];
			$description = $_POST['description'];
			$category = $_POST['category'];

			// Preventing SQL Injection
			$name = mysqli_real_escape_string($conn, $name);
			$price = mysqli_real_escape_string($conn, $price);
			$description = mysqli_real_escape_string($conn, $description);
			$category = mysqli_real_escape_string($conn, $category);

			$date = date('Y/m/d');
	        $time = date('h:i:s a', time());

	        $image_name = getImageName($category);
	 
			// Form Validation
			if(empty($name) || empty($price) || empty($description)){
				$_SESSION['ErrorMessage'] = "All fields are required";
			}
			elseif (!preg_match("/^[\d]*$/", $price)) { // Regular Expression for Phone Number
	            $_SESSION['ErrorMessage'] = "Only numbers allowed for the price field!";
	        }
			elseif(!preg_match("/^[a-z A-Z]*$/", $name)){ // Regular Expression for the full name field
				$_SESSION['ErrorMessage'] = "Only alphabets is allowed for the product name field";
			}
			else{
			
					$sql = "INSERT INTO tblproduct (name,price,category,description,username,date,time,picture) VALUES('$name','$price','$category','$description','{$_SESSION['username']}','$date','$time','$image_name')";
						$query_result = mysqli_query($conn, $sql);
					if($query_result){
						$_SESSION['SuccessMessage'] = "Product has been added successfully";
					}
					else{
						$_SESSION['SuccessMessage'] = "Failed to add product";
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
    <title>Add Product</title>
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
                    	<h2 class="title text-center text-primary">Add Products</h2>
						<form action="add_products.php" method="POST">
							<div class="form-group">
								<label>Product Name</label>
								<input type="text" name="name" placeholder="Product Name" class="form-control">
							</div>
							<div class="form-group">
								<label>Price</label>
								<input type="text" name="price" placeholder="$0.00" class="form-control">
							</div>
							<div class="form-group">
								<label>Product Category</label>
								<select name="category" class="form-control">
									<option value="Shoe">Shoe</option>
									<option value="Laptop">Laptop</option>
									<option value="Phone">Phone</option>
									<option value="Clipper">Clipper</option>
								</select>
							</div>
							<div class="form-group">
								<label>Description</label>
								<textarea type="text" name="description" placeholder="Description goes here" class="form-control" cols="5" rows="5"></textarea>
							</div>
							<div class="form-group">
								<button type="submit" name="save" class="btn btn-primary btn-lg">Save</button>
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
