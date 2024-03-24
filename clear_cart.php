<?php

require 'comman/session.php';

include 'comman/connection.php';

// delete Single product

if (isset($_GET['deleteCart'])) {

	$delCart = $_GET['deleteCart'];

	$Q = $obj->query("DELETE FROM cart WHERE cart_id  ='$delCart' ");

	if ($Q) {
		echo "<script>
				alert('Delete Cart Succesfully');
				document.location = 'cart.php'; 
				</script>";
	} else {
				echo "<script>alert('Error In query');</script>";
	}
	
}
 

// Delete Whole Cart

if (isset($_GET['deleteWholeCart'])) {

	$user_id = $_GET['deleteWholeCart'];

	$Q = $obj->query("DELETE FROM cart WHERE user_id  ='$user_id' ");

	if ($Q) {
		echo "<script>
				alert('Delete Cart Succesfully');
				document.location = 'category.php'; 
				</script>";
	} else {
				echo "<script>alert('Error In query');</script>";
	}
	
}
 

?>