<?php
include 'comman/connection.php';

session_start();

$user_id  = $_SESSION['userid'];

 $order_result = $obj->query("SELECT * FROM user_order o
                        INNER JOIN billing_detail b ON b.order_id = o.order_id
                        INNER JOIN payment p ON p.order_id = o.order_id
                        WHERE o.user_id = '$user_id' ");


?>


<!doctype html>
<html lang="zxx">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>aranoz</title>
  <link rel="icon" href="img/favicon.png">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- animate CSS -->
  <link rel="stylesheet" href="css/animate.css">
  <!-- owl carousel CSS -->
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/lightslider.min.css">
  <!-- font awesome CSS -->
  <link rel="stylesheet" href="css/all.css">
  <!-- flaticon CSS -->
  <link rel="stylesheet" href="css/flaticon.css">
  <link rel="stylesheet" href="css/themify-icons.css">
  <!-- font awesome CSS -->
  <link rel="stylesheet" href="css/magnific-popup.css">
  <!-- style CSS -->
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
   <!--::header part start::-->
  <?php include 'comman/header.php';?>
    <!-- Header part end-->

  
  
   <section class="cart_area padding_top">
    <div class="container">
      <div class="cart_inner">
        <div class="table-responsive">
          <h2 class="text-center" style="color: #ff3367;">My Orders</h2>
          <table class="table">
            <thead>
              <tr>
                <th class="col-lg-2 col-md-2 text-center">Order Id</th>
                  <th class="col-lg-2 col-md-2 text-center">Order Date</th>
                  <th class="col-lg-2 col-md-2 text-center">Total Amount</th>
                  <th class="col-lg-2 col-md-2 text-center">Status</th>
                  <th class="col-lg-3 col-md-3 text-center">View More</th>
              </tr>
            </thead>
            <tbody>
               <?php while($order = $order_result->fetch_object()) { ?>
                                <tr>
                                    <td class="col-lg-2 col-md-2 text-center">
                                        <?php echo $order->order_id; ?>
                                    </td>
                                    <td class="col-lg-2 col-md-2 text-center">
                                        <?php echo $order->order_date; ?>
                                    </td>
                                    <td class="col-lg-2 col-md-2 text-center">
                                        <?php echo $order->amount; ?>
                                    </td>
                                    <td class="col-lg-2 col-md-2 text-center">
                                        <?php echo $order->status; ?>
                                    </td>
                                    <td class="col-lg-3 col-md-3 text-center">
                                        <a href="view_more_order.php?order_id=<?php echo $order->order_id; ?>" class="btn btn-sm btn-primary">
                                            View More
                                        </a>
                                    </td>
                                </tr>
                                <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
  </section>


 
  <!-- product_list part end-->

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
  <script src="js/lightslider.min.js"></script>
  <!-- swiper js -->
  <script src="js/masonry.pkgd.js"></script>
  <!-- particles js -->
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.nice-select.min.js"></script>
  <!-- slick js -->
  <script src="js/slick.min.js"></script>
  <script src="js/swiper.jquery.js"></script>
  <script src="js/jquery.counterup.min.js"></script>
  <script src="js/waypoints.min.js"></script>
  <script src="js/contact.js"></script>
  <script src="js/jquery.ajaxchimp.min.js"></script>
  <script src="js/jquery.form.js"></script>
  <script src="js/jquery.validate.min.js"></script>
  <script src="js/mail-script.js"></script>
  <script src="js/stellar.js"></script>
  <!-- custom js -->
  <script src="js/theme.js"></script>
  <script src="js/custom.js"></script>
  
</body> 

</html>