<?php 
require 'comman/session.php';
include 'comman/connection.php';




$product_id 	= $_POST['product_id'];
$customer_id 	= $_SESSION['userid'];   
$quantity		= 1;

$cart_result = $obj->query("select * from cart where p_id='$product_id' and user_id='$customer_id'");

$rowcount = $cart_result->num_rows;

	if ($rowcount == 0)
	{
		
		$result = $obj->query("select * from product where p_id='$product_id'");
		$row = $result->fetch_object();
		$price = $row->price;

		$add_cart_insert = $obj->query("INSERT INTO `cart`(`user_id`, `p_id`, `quantity`, `price`) VALUES ('$customer_id','$product_id','$quantity','$price')");
		if($add_cart_insert)
		{
			echo "Added to Cart Successfully";
		}
		else
		{
			echo "Error in Cart";
		}

	}
	else
	{
		$cart_row = $cart_result->fetch_object();
		$quantity = $cart_row->quantity + 1;

		$add_cart_update = $obj->query("update cart set quantity='$quantity' where p_id='$product_id' and user_id='$customer_id'");

		if($add_cart_update)
		{
			echo "Quantity  Updated Successfully";
		}
		else
		{
			echo "Error in Updating the cart";
		}
	}


?>


