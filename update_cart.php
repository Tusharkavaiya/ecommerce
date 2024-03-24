<?php

include 'comman/connection.php';

$quantity = $_POST['quantity'];
$cart_id = $_POST['cart_id'];

$exe = $obj->query("update cart set quantity='$quantity' where cart_id='$cart_id'");

if($exe)
{
	echo "Cart Updated Successfully";
}
else
{
	echo "Cart Updation Failed";
}




?>
