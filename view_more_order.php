<?php
include 'comman/connection.php';
  $order_id = $_GET['order_id'];
   
   $order_result = $obj->query("SELECT * FROM user_order o
                       INNER JOIN order_detail od ON od.order_id = o.order_id
                       INNER JOIN product p ON p.p_id = od.product_id
                       WHERE o.order_id = '$order_id' ");
   
                       $billing_result = $obj->query("SELECT * FROM billing_detail WHERE order_id = '$order_id' ");
                       $billing_row = $billing_result->fetch_object();
   
                       $shipping_result = $obj->query("SELECT * FROM shiping_detail WHERE order_id = '$order_id' ");
                       $shipping_row = $shipping_result->fetch_object();
   
    $total_amount_result = $obj->query("SELECT * FROM payment WHERE order_id = '$order_id' ");
    $total_amount_row = $total_amount_result->fetch_object();



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
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="css/all.css">
    <!-- flaticon CSS -->
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/nice-select.css">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="css/magnific-popup.css">
    <!-- swiper CSS -->
    <link rel="stylesheet" href="css/slick.css">
    <!-- style CSS -->
    <link rel="stylesheet" href="css/style.css">
    <style type="text/css">
        label{
            color: #ff3368 ;
            font-weight: bold;
        }
    </style>

    <script>
    document.getElementById('customFile').addEventListener('change', function () {
        var fileName = this.value.split('\\').pop();
        document.getElementById('fileLabel').innerHTML = fileName;
    });
</script>

</head>

<body>

    <!--::header part start::-->
   <?php include 'comman/header.php';?>
    <!-- Header part end-->


   
    <!-- breadcrumb start-->

     <!--================registar Area =================-->
     
        <div class="section-top-border">
        <div class="container">
            <h3 class="text-center mt-5" style="color: #ff3368; font-weight:bold;">Order Details</h3>
        <div class="row">
            <div class="col-lg-8 col-md-8 mt-3 mb-1 w-100" style="margin: 0 auto;">
                <table class="table">
                        <thead>
                           <tr>
                              <th>Order-ID</th>
                              <th>Product Image</th>
                              <th>Product Name</th>
                              <th>Quantity</th>
                              <th>Total</th>
                              <th>Order Date</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                              while ($order_row = $order_result->fetch_object()) {
                                  ?>
                           <tr>
                              <td><?php echo $order_row->od_id; ?></td>
                              <td>
                                  <img src="../seller/products/<?php echo $order_row->p_image;?>" height="50" width="50">
                              </td>
                              <td><?php echo $order_row->p_name; ?></td>
                              <td><?php echo $order_row->quantity; ?></td>
                              <td>&#8377;<?php echo $order_row->price * $order_row->quantity; ?></td>
                              <td><?php echo $order_row->order_date; ?></td>
                           </tr>
                           <?php } ?>
                           <tr><th colspan="4">Total Amount</th>
                           <td>&#8377;<?php echo $total_amount_row->amount; ?></td></tr>
                        </tbody>
                     </table>
                     <div class="row">
                        <div class="col-md-6">
                           <!-- Billing Details -->
                           <div class="billing-details">
                              <h5 class="card-title">Billing Details</h5>
                              <p><?php echo "$billing_row->fname $billing_row->lname"; ?></p>
                              <p><?php echo $billing_row->email; ?></p>
                              <p><?php echo $billing_row->street_address; ?></p>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <!-- Shipping Details -->
                           <div class="shipping-details">
                              <h5 class="card-title">Shipping Details</h5>
                              <p><?php echo "$shipping_row->fname $shipping_row->lname"; ?></p>
                              <p><?php echo $shipping_row->email; ?></p>
                              <p><?php echo $shipping_row->street_address; ?></p>
                           </div>
                        </div>
                     </div>
            </div>
        </div>
    </div>
    </div>

   

     <!--================registar Area =================-->


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
    <!-- custom js -->
    <script src="js/custom.js"></script>
</body>

</html>

