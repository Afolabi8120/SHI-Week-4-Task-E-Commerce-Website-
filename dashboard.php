<?php
        //Name: Afolabi Temidayo Timothy
    //Intern ID: SH-IT-48472
    //Stack: Web Development(Backend)
    //Program: Side Hustle Internship 3.0 



	include_once('./config/config.php');
	include_once('./includes/session.php');
	include_once('./includes/function.php');

	if(isset($_SESSION['username'])){

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
    <title>Dashboard</title>
    <?php include_once('./links/css/css-links.php'); ?>
</head><!--/head-->

<body>
	
	<?php include_once('./includes/header.php'); ?>

	<div class="container">
		<section class="mt-5"><!--section start-->
		<div class="row bg-grey">

            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2 bg-primary text-white">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                           	<div class="col mr-2">
                                    <div class="display-3 text-left mb-1">
                                                Dashboard
                                    </div>
                                    <div class="display-6 mb-0 text-left py-3 mt-3">
                                    	<?php echo 'Welcome, '. $_SESSION['fullname']; ?>
                               		</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2 bg-info text-white">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                           	<div class="col mr-2">
                                    <div class="display-3 text-center mb-1">
                                                Total Products
                                    </div>
                                    <div class="display-6 mb-0 fw-bold text-center py-3 mt-3">
                                    <?php
                                        $sql = "SELECT * FROM tblproduct WHERE username = '{$_SESSION['username']}'";
                                        $query_result = mysqli_query($conn, $sql);
                                        $row = mysqli_num_rows($query_result);
                                        echo "$row";
                                    ?>
                               	</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

			<div class="col-sm-9 col-md-12">
				<?php
                    echo SuccessMessage();
                    echo ErrorMessage();
                    echo WarningMessage();
                ?>
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center text-primary">Features Items</h2>
							<?php
								$sql = "SELECT * FROM tblproduct ORDER BY date DESC";
								$query_result = mysqli_query($conn, $sql);
								$result = mysqli_num_rows($query_result);
								if($result > 0){
									while($row = mysqli_fetch_array($query_result)){
										$name = $row['name'];
										$price = $row['price'];
										$category = $row['category'];
										$description = $row['description'];
										$picture = $row['picture'];
							?>
						<div class="col-sm-3">
							<div class="card text-center mb-2 mt-3">
								<img src="./uploads/<?php echo $picture; ?>" class="card-img-top" alt="" height="180px" width="180" />
								<div class="card-body">
									<h5 class="card-title h5 mb-4 text-success" style="font-weight: bold;"><?php echo $category; ?></h5>
									<h3 class="card-title mb-3"><?php echo $name; ?></h3>
									<h4 class="card-title h4 text-dark mb-4 text-info" style="font-weight: bold;"><?php echo "₦ " . $price; ?></h4>
									<p class="card-text"><?php echo $description; ?></p>
									<small><p class="text-grey">890 Reviews</p></small>
									<button type="submit" class="btn btn-warning btn-lg">Add to Cart</button>
								</div>
							</div>
						</div>
							<?php
									}
								}
							?>
				
				</div>
			</div>
		</div>
	</section><!--/section end-->
		
	</div>
	
	<?php include_once('./includes/footer.php'); ?>

	<?php include_once('./links/js/js-links.php'); ?>
	
</body>
</html>
