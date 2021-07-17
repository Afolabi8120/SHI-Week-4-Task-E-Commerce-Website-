<?php
        //Name: Afolabi Temidayo Timothy
    //Intern ID: SH-IT-48472
    //Stack: Web Development(Backend)
    //Program: Side Hustle Internship 3.0 


	include_once('./config/config.php');
	include_once('./includes/session.php');
	include_once('./includes/function.php');

	if(isset($_SESSION['username'])){
		if(isset($_POST['delete'])){
			$_id = $_POST['id'];

			$sql = "DELETE FROM tblproduct WHERE username = '{$_SESSION['username']}' AND id = '$_id' ";
			$query_result = mysqli_query($conn, $sql);
			if($query_result){
				$_SESSION['SuccessMessage'] = "Product has been removed successfully";
			}
			else{
				$_SESSION['SuccessMessage'] = "Failed to remove product";
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
    <title>My Product</title>
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
                    	<h2 class="title text-center text-primary">My Products</h2>
						<table class="table table-info">
							<thead class="text-center">
								<tr>
									<th>S/N</th>
									<th>Product Image</th>
									<th>Product Name</th>
									<th>Price</th>
									<th>Category</th>
									<th>Description</th>
									<th>Action</th>
								</tr>
							</thead>
							<?php
								$i = 0;
								$sql = "SELECT * FROM tblproduct WHERE username = '{$_SESSION['username']}' ORDER BY date ASC";
								$query_result = mysqli_query($conn, $sql);
								$result = mysqli_num_rows($query_result);
								if($result > 0){
									while($row = mysqli_fetch_array($query_result)){
										$i++;
										$id = $row['id'];
										$name = $row['name'];
										$price = $row['price'];
										$category = $row['category'];
										$description = $row['description'];
										$picture = $row['picture'];
							?>
							<tbody class="text-center">
								<tr>
									<td><?php echo $i; ?></td>
									<td><img src="./uploads/<?php echo $picture; ?>" class="img-profile rounded-circle" height="50px" width="50px"> </td>
									<td><?php echo $name; ?></td>
									<td><?php echo $price; ?></td>
									<td><?php echo $category; ?></td>
									<td><?php echo $description; ?></td>
									<td>
										<form action="edit_product.php?id=<?php echo $id; ?>" method="POST">
											<button type="submit" name="delete" class="btn btn-warning btn-sm">Edit</button>
										</form>
										<form action="my_products.php" method="POST">
											<input type="hidden" name="id" value="<?php echo $id; ?>">
											<button type="submit" name="delete" class="btn btn-danger btn-sm">Delete</button>
										</form>
									</td>
								</tr>
							</tbody>
							<?php
									}
								}
							?>
						</table>
                    </div>
                </div>
			</div>
		</div>
	</section><!--/section end-->
	
	
	<?php include_once('./includes/footer.php'); ?>

	<?php include_once('./links/js/js-links.php'); ?>
	
</body>
</html>
