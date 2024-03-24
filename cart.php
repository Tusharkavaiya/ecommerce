<?php
require 'comman/session.php';
include 'comman/connection.php';

$user_id = $_SESSION['userid'];

$cart_detail = $obj->query("SELECT cart.*, product.p_name,p_image FROM cart INNER JOIN product ON cart.p_id = product.p_id WHERE user_id = '$user_id'");



?>




<!doctype html>
<html lang="zxx">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>aranaz</title>
  <link rel="icon" href="img/favicon.png">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- animate CSS -->
  <link rel="stylesheet" href="css/animate.css">
  <!-- owl carousel CSS -->
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <!-- nice select CSS -->
  <link rel="stylesheet" href="css/nice-select.css">
  <!-- font awesome CSS -->
  <link rel="stylesheet" href="css/all.css">
  <!-- flaticon CSS -->
  <link rel="stylesheet" href="css/flaticon.css">
  <link rel="stylesheet" href="css/themify-icons.css">
  <!-- font awesome CSS -->
  <link rel="stylesheet" href="css/magnific-popup.css">
  <!-- swiper CSS -->
  <link rel="stylesheet" href="css/slick.css">
  <link rel="stylesheet" href="css/price_rangs.css">
  <!-- style CSS -->
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <!--::header part start::-->
 <?php include 'comman/header.php';?>
  <!-- Header part end-->


  <!--================Home Banner Area =================-->
  <!-- breadcrumb start-->
  <section class="breadcrumb breadcrumb_bg">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="breadcrumb_iner">
            <div class="breadcrumb_iner_item">
              <h2>Cart Products</h2>
              <p>Home <span>-</span>Cart Products</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- breadcrumb start-->

  <!--================Cart Area =================-->
  <section class="cart_area padding_top">
    <div class="container">
      <div class="cart_inner">
        <div class="table-responsive">
          <h2 class="text-center" style="color: #ff3367;">Cart</h2>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Product</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total</th>
                <th scope="col">Delete</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($cart = $cart_detail->fetch_object()) { ?>
               
                <tr>
                <td>
                  <div class="media">
                    <div class="d-flex justify-content-between">
                      <img src="../seller/products/<?php echo $cart->p_image;?>" height="100"; width="150" alt="" />
                    </div>
                    <div class="media-body">
                      <p><?php echo $cart->p_name;?></p>
                    </div>
                  </div>
                </td>
                <td>
                  <h5>&#8377;<?php echo $cart->price;?></h5>
                </td>
                <td>
                  <div class="product_count">
                    <!-- <span class="input-number-decrement"> <i class="ti-angle-down"></i></span> -->
                    <input class="input-number" type="text" value="<?php echo $cart->quantity;?>" min="0" max="10" onchange="update_quantity(this.value,<?php echo $cart->cart_id;?>)">
                    <!-- <span class="input-number-increment"> <i class="ti-angle-up"></i></span> -->
                  </div>
                </td>
                <td>
                  <h5>&#8377;<?php echo $cart->price * $cart->quantity;?></h5>
                </td>
                <td>
                  <a href="clear_cart.php?deleteCart=<?php echo $cart->cart_id;?>"><i class="fas fa-trash"></i></a>
                </td>
              </tr>

             <?php }?>
              <tr>
              <td colspan="4" align="right"><a href="clear_cart.php?deleteWholeCart=<?php echo $user_id;?>" class="btn_3">Clear Cart</a></td>              
              </tr>
             
            </tbody>
          </table>
          <div class="checkout_btn_inner float-right">
            <a class="btn_1" href="category.php">Continue Shopping</a>
            <a class="btn_1 checkout_btn_1" href="checkout.php">Proceed to checkout</a>
          </div>
        </div>
      </div>
  </section>
  <!--================End Cart Area =================-->

  <!--::footer_part start::-->
 <?php include 'comman/footer.php';?>

  <!--::footer_part end::-->

  <!-- jquery plugins here-->
  <!-- jquery -->
  <script src="js/jquery-1.12.1.min.js"></script>
  <!-- popper js -->
  <script src="js/popper.min.js"></script>
  <!-- bootstrap js -->
  <script src="js/bootstrap.min.js"></script>
  <!-- easing js -->
  <script src="js/jquery.magnific-popup.js"></script>
  <!-- swiper js -->
  <script src="js/swiper.min.js"></script>
  <!-- swiper js -->
  <script src="js/masonry.pkgd.js"></script>
  <!-- particles js -->
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.nice-select.min.js"></script>
  <!-- slick js -->
  <script src="js/slick.min.js"></script>
  <script src="js/jquery.counterup.min.js"></script>
  <script src="js/waypoints.min.js"></script>
  <script src="js/contact.js"></script>
  <script src="js/jquery.ajaxchimp.min.js"></script>
  <script src="js/jquery.form.js"></script>
  <script src="js/jquery.validate.min.js"></script>
  <script src="js/mail-script.js"></script>
  <script src="js/stellar.js"></script>
  <script src="js/price_rangs.js"></script>
  <!-- custom js -->
  <script src="js/custom.js"></script>

  <script type="text/javascript">
    function update_quantity(quantity,cart_id)
    {
        $.ajax({
          type:"POST",
          url:"update_cart.php",
          data: { quantity: quantity, cart_id: cart_id },
          success:function(result)
          {
              document.location='cart.php';
          }
        });
    }
  </script>
</body>

</html>