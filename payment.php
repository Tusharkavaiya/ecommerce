<?php
    if (session_status() == PHP_SESSION_NONE) {
    // Start the session only if it's not already started
    session_start();
}

    include 'comman/connection.php';
    $user_id = $_SESSION['userid'];

    $apiKey = "rzp_test_T27eWmFnoKCtRf";

    //rzp_test_VGWxY3DnVV8Ct0

    $profile_data = $obj->query("select * from user_registration where id='$user_id'");
    $profile = $profile_data->fetch_object();


?>

<!doctype html>
<html lang="zxx">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>payment</title>
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
      <style type="text/css">
          .razorpay-payment-button{
              display: inline-block;
              padding: 9px 42px;
              margin-top: 10px;
              border-radius: 50px;
              background-color: #ff3368;
              border: 1px solid #ecfdff;
              font-size: 15px;
              font-weight: 700;
              color: #fff;
              text-transform: uppercase;
              font-weight: 400;
              box-shadow: -1.717px 8.835px 29.76px 2.24px rgba(255, 51, 104, 0.18);
              border: 1px solid #ff3368;
              -webkit-transition: 0.5s;
              transition: 0.5s;
            }

            .razorpay-payment-button:hover {
              background-color: red;
              color: #fff;
            }
      </style>
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
                        <h2>Payment</h2>
                        <p>Home <span>-</span> Shop Single</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- breadcrumb start-->
      <!--================Checkout Area =================-->
      <!--================Checkout Area =================-->
      <section class="checkout_area padding_top">
         <div class="container text-center">
            <h5 style="color:#ff3368;">Thank you for shopping with us! To complete your purchase, please follow these payment instructions</h5>
            <form method="post" action="http://localhost/e-commerce/customer/thankyou.php">
              <script
                    src="https://checkout.razorpay.com/v1/checkout.js"
                    data-key="<?php echo $apiKey; ?>" // Enter the Test API Key ID generated from Dashboard → Settings → API Keys
                    data-amount="<?php echo intval($_SESSION['totalamount']) * 100;?>" // Amount is in currency subunits. Hence, 29935 refers to 29935 paise or ₹299.35.
                    data-currency="INR"//You can accept international payments by changing the currency code. Contact our Support Team to enable International for your account
                    data-id="<?php echo $_SESSION['order_id'];?>"//Replace with the order_id generated by you in the backend.
                    data-buttontext="Pay with Razorpay"
                    data-name="Online E-Commerce "
                    data-description="A sofa is similar to a couch"
                    data-image="img/favicon.png"
                    data-prefill.name="<?php echo $profile->fname.' '.$profile->lname;?>"
                    data-prefill.email="<?php echo $profile->email;?>"
                    data-prefill.contact="<?php echo $profile->contact;?>"
                    data-theme.color="#ff9902"
                ></script>
                    <input type="hidden"  custom="Hidden Element" name="hidden">  
            </form>
         </div>
      </section>
      <!--================End Checkout Area =================-->
      <!--================End Checkout Area =================-->
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
      
  </body> 
</html>