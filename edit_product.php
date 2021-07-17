<?php
	include_once('./config/config.php');
	include_once('./includes/session.php');
	include_once('./includes/function.php');

	if(isset($_SESSION['username'])){

		if (isset($_GET['id'])) {
                    		
            $newid = $_GET['id'];

            //global $_id, $_name, $_price, $_category, $_description;

            $sql = "SELECT * FROM tblproduct WHERE id = '$newid'";
			$query_result = mysqli_query($conn, $sql);
			$result = mysqli_num_rows($query_result);
			if($result > 0){
				while($row = mysqli_fetch_array($query_result)){
					$id = $row['id'];
					$name = $row['name'];
					$price = $row['price'];
					$category = $row['category'];
					$description = $row['description'];
				}
			}
			else{

            }
		}elseif(isset($_POST['update'])){
			$id = $_POST['id'];
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

				$sql = "UPDATE tblproduct SET name='$name',price='$price',category='$category',description='$description',date='$date',time='$time',picture='$image_name' WHERE username = '{$_SESSION['username']}' AND id = '$id' ";
				$query_result = mysqli_query($conn, $sql);
				if($query_result){
					$_SESSION['SuccessMessage'] = "Product has been updated successfully";
				}
				else{
					$_SESSION['SuccessMessage'] = "Failed to add update";
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
                    	<h2 class="title text-center text-primary">Edit Products</h2>
						<form action="edit_product.php" method="POST">
							<div class="form-group">
								<label>Product Name</label>
								<input type="hidden" name="id" value="<?php echo $id; ?>">
								<input type="text" name="name" placeholder="Product Name" class="form-control" value="<?php echo $name; ?>">
							</div>
							<div class="form-group">
								<label>Price</label>
								<input type="text" name="price" placeholder="$0.00" class="form-control" value="<?php echo $price; ?>">
							</div>
							<div class="form-group">
								<label>Product Category</label>
								<select name="category" class="form-control">
									<option value="<?php echo $category; ?>"><?php echo $category; ?></option>
									<option value="Shoe">Shoe</option>
									<option value="Laptop">Laptop</option>
									<option value="Phone">Phone</option>
									<option value="Clipper">Clipper</option>
								</select>
							</div>
							<div class="form-group">
								<label>Description</label>
								<textarea type="text" name="description" placeholder="Description goes here" class="form-control" cols="5" rows="5"><?php echo $description; ?></textarea>
							</div>
							<div class="form-group">
								<button type="submit" name="update" class="btn btn-primary btn-lg">Update Product</button>
								<a href="my_products.php" class="btn btn-danger btn-lg">Back</a>
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