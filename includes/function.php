<?php
	
	function RedirectTo($newlocation){
		header('Location:' . $newlocation);
		exit();
	}

	function getImageName($name){
		
		$num = rand(1, 3);

		global $img_name;

		if(($num == 1) && ($name == 'Shoe')){
			$img_name = 'shoe1.jpg';
		}
		elseif(($num == 2) && ($name == 'Shoe')){
			$img_name = 'shoe2.jpg';
		}
		elseif(($num == 3) && ($name == 'Shoe')){
			$img_name = 'shoe3.jpg';
		}
		elseif(($num == 1) && ($name == 'Laptop')){
			$img_name = 'laptop1.jpg';
		}
		elseif(($num == 2) && ($name == 'Laptop')){
			$img_name = 'laptop2.jpg';
		}
		elseif(($num == 3) && ($name == 'Laptop')){
			$img_name = 'laptop3.jpg';
		}
		elseif(($num == 1) && ($name == 'Phone')){
			$img_name = 'phone1.jpg';
		}
		elseif(($num == 2) && ($name == 'Phone')){
			$img_name = 'phone2.jpg';
		}
		elseif(($num == 3) && ($name == 'Phone')){
			$img_name = 'phone3.jpg';
		}
		elseif(($num == 1) && ($name == 'Clipper')){
			$img_name = 'clipper1.jpg';
		}
		elseif(($num == 2) && ($name == 'Clipper')){
			$img_name = 'clipper2.jpg';
		}
		elseif(($num == 3) && ($name == 'Clipper')){
			$img_name = 'clipper3.jpg';
		}

		return $img_name;

	}


?>