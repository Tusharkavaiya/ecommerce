<?php
session_start();

include "comman/connection.php";
$user_id = $_SESSION['userid'];

$user_details = $obj->query("SELECT * FROM user_registration where id = '$user_id'");
$user  = $user_details->fetch_object();

$all_product  = $obj->query("SELECT * FROM cart c INNER JOIN product p ON p.p_id = c.p_id where c.user_id ='$user_id' ");
$all_products = $obj->query("SELECT * FROM cart WHERE user_id = '$user_id'");

// Fetch data from the database for state, city, and area
$state_id = $obj->query("SELECT * FROM state");
$city_id  = $obj->query("SELECT * FROM city");
$area_id  = $obj->query("SELECT * FROM area");

// Fetch data for shipping
$diff_state  = $obj->query("SELECT * FROM state");
$diff_city   = $obj->query("SELECT * FROM city");
$diff_area   = $obj->query("SELECT * FROM area");

if (isset($_POST["submit"]))
 {
    $fname          = $_POST["fname"];
    $lname          = $_POST["lname"];
    $email          = $_POST["email"];
    $contact        = $_POST["number"];
    $address        = $_POST["address"];
    $user_state_id  = $_POST["state_id"];
    $user_city_id   = $_POST["city_id"];
    $user_area_id   = $_POST["area_id"];
    $zipcode        = $_POST["pincode"];
    $payment_method = $_POST['payment'];

    $amount = 0;

    $s_fname     = $fname;
    $s_lname     = $lname;
    $s_email     = $email;
    $s_contact   = $contact;
    $s_address   = $address;
    $s_state_id  = $user_state_id;
    $s_city_id   = $user_city_id;
    $s_area_id   = $user_area_id;
    $s_zipcode   = $zipcode;

    if (isset($_POST["selector"]) && $_POST["selector"] ==1) 
    {
        $s_fname    = $_POST["diff_fname"];
        $s_lname    = $_POST["diff_lname"];
        $s_email    = $_POST["diffemail"];
        $s_contact  = $_POST["diffnumber"];
        $s_address  = $_POST["diffaddress"];
        $s_state_id = $_POST["diffstate_id"];
        $s_city_id  = $_POST["diffcity_id"];
        $s_area_id  = $_POST["diffarea_id"];
        $s_zipcode  = $_POST["diffpincode"];
    }

    
    $status  = 'pending';

    $obj->query("INSERT INTO `user_order`(`user_id`, `status`) VALUES ('$user_id','$status')");

    $order_id = $obj->insert_id;


     $shipping_query = $obj->query(
           "INSERT INTO `shiping_detail`( `fname`, `lname`, `email`, `contact`, `street_address`, `state_id`, `city_id`, `area_id`, `pincode`, `order_id`) VALUES ('$s_fname','$s_lname','$s_email','$s_contact','$s_address','$s_state_id','$s_city_id','$s_area_id','$s_zipcode', '$order_id')"
       );

     while($order=$all_products->fetch_object())
         {
            $order_details = $obj->query("INSERT INTO order_detail ( order_id, product_id, quantity, price) VALUES ('$order_id','$order->p_id','$order->quantity','$order->price')");

            if ($order_details) {
                  
                  $amount += $order->price * $order->quantity;

            } 
            

          }

          $_SESSION['totalamount'] = $amount;
          $_SESSION['order_id'] = $order_id;  


       if (!$shipping_query) {
           echo "<script> alert('Error in inserting shipping information');</script>";
       }
   
       $billing_query = $obj->query(
           "INSERT INTO `billing_detail`(`fname`, `lname`, `email`, `contact`, `street_address`, `state_id`, `city_id`, `area_id`, `pincode`, `order_id`) VALUES ('$fname','$lname','$email','$contact','$address','$user_state_id','$user_city_id','$user_area_id','$zipcode', '$order_id')"
       );

        if (!$billing_query) {
           echo "<script> alert('Error in inserting billing information');</script>";
       }
      
      $payment_detail = $obj->query("INSERT INTO `payment`(`order_id`, `user_id`, `amount`, `payment_method`) VALUES ('$order_id','$user_id','$amount','$payment_method')");

      

                
    if ($payment_detail )
     {

       

        if($payment_method=='onlinepayment')
        {
             header("location:payment.php");
        }
        else
        {
             header("location:thankyou.php");
        }
      } 
      else 
      {
        echo "<script> alert('Invalid query, try again');</script>";
      }      
   }
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
                        <h2>Product Checkout</h2>
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
         <div class="container">
            <div class="billing_details">
               <div class="row">
                  <div class="col-lg-8">
                     <h3 class="text-center">Billing Details</h3>
                     <form class="row contact_form" method="post" novalidate="novalidate">
                        <div class="col-md-6 form-group p_star">
                           <input type="text" class="form-control" id="first" name="fname" placeholder="First Name" value="<?php echo $user->fname?>" />
                        </div>
                        <div class="col-md-6 form-group p_star">
                           <input type="text" class="form-control" id="last" name="lname" placeholder="LAst Name" value="<?php echo $user->lname?>" />
                        </div>
                        <div class="col-md-6 form-group p_star">
                           <input type="text" class="form-control" id="number" name="number"  placeholder="Phone Number" value="<?php echo $user->contact?>" />
                        </div>
                        <div class="col-md-6 form-group p_star">
                           <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $user->email?>"/>
                        </div>
                        <div class="col-md-12 form-group p_star">
                           <select class="country_select" name="state_id">
                              <option value="">---Select State---</option>
                              <?php while ($state = $state_id->fetch_object()) { ?>
                              <option value="<?php echo $state->state_id;?>"<?php if(
                                                $user->state_id == $state->state_id) echo "selected";?>><?php echo $state->state_name;?></option>
                              <?php }?>
                           </select>
                        </div>
                        <div class="col-md-12 form-group p_star">
                           <select class="country_select" name="city_id">
                              <option value="">---select City---</option>
                              <?php while ($city = $city_id->fetch_object()) { ?>
                              <option value="<?php echo $city->city_id;?>" <?php if(
                                                $user->city_id == $city->city_id) echo "selected";?>><?php echo $city->city_name;?></option>
                              <?php }?>
                           </select>
                        </div>
                        <div class="col-md-12 form-group p_star">
                           <select class="country_select" name="area_id">
                              <option value="">---select Area---</option>
                              <?php while ($area = $area_id->fetch_object()) { ?>
                              <option value="<?php echo $area->area_id;?>"<?php if($user->area_id == $area->area_id) echo "selected";?> ><?php echo $area->area_name;?></option>
                              <?php }?>
                           </select>
                        </div>
                        <div class="col-md-12 form-group p_star">
                           <input type="text" class="form-control" id="add2" name="address"  placeholder="Address" value="<?php echo $user->address?>" />
                        </div>
                        <div class="col-md-12 form-group">
                           <input type="text" class="form-control" id="zip" name="pincode" placeholder="Postcode/ZIP" />
                        </div>
                        <div class="col-md-12 form-group">
                           <div class="creat_account">
                              <h3>Shipping Details</h3>
                              <!-- <input type="checkbox" name="selector" checked />
                              <label for="f-option3">As above</label> -->
                              <input type="checkbox" id="f-option3" name="selector"  value="1" />
                              <label for="f-option3">Ship to a different address?</label>
                           </div>
                           <div class="row">
                              <div id="shipping-details-form">
                                 <div class="col-md-12 form-group p_star">
                                    <input type="text" class="form-control" id="first" name="diff_fname" placeholder="First Name" />
                                 </div>
                                 <div class="col-md-12 form-group p_star">
                                    <input type="text" class="form-control" id="last" name="diff_lname" placeholder="Last Name" />
                                 </div>
                                 <div class="col-md-12 form-group p_star">
                                    <input type="text" class="form-control" id="number" name="diffnumber"  placeholder="Phone Number" />
                                 </div>
                                 <div class="col-md-12 form-group p_star">
                                    <input type="text" class="form-control" id="email" name="diffemail" placeholder="Email" />
                                 </div>
                                 <div class="col-md-12 form-group p_star">
                                    <select class="country_select" name="diffstate_id" >
                                       <option value="">---Select State---</option>
                                       <?php while ($diffstate = $diff_state->fetch_object()) { ?>
                                       <option value="<?php echo $diffstate->state_id;?>"><?php echo $diffstate->state_name;?></option>
                                       <?php }?>
                                    </select>
                                 </div>
                                 <div class="col-md-12 form-group p_star">
                                    <select class="country_select" name="diffcity_id">
                                       <option value="">---select City---</option>
                                       <?php while ($diffcity = $diff_city->fetch_object()) { ?>
                                       <option value="<?php echo $diffcity->city_id;?>"><?php echo $diffcity->city_name;?></option>
                                       <?php }?>
                                    </select>
                                 </div>
                                 <div class="col-md-12 form-group p_star">
                                    <select class="country_select" name="diffarea_id">
                                       <option value="">---select Area---</option>
                                       <?php while ($diffarea = $diff_area->fetch_object()) { ?>
                                       <option value="<?php echo $diffarea->area_id;?>" ><?php echo $diffarea->area_name;?></option>
                                       <?php }?>
                                    </select>
                                 </div>
                                 <div class="col-md-12 form-group p_star">
                                    <input type="text" class="form-control" id="add2" name="diffaddress" placeholder="Address" />
                                 </div>
                                 <div class="col-md-12 form-group">
                                    <input type="text" class="form-control" id="zip" name="diffpincode" placeholder="Postcode/ZIP" />
                                 </div>
                              </div>
                              <textarea class="form-control" name="message" id="message" rows="1"
                                 placeholder="Order Notes"></textarea>
                           </div>
                        </div>
                      </div>
                      <div class="col-lg-4">
                    <div class="order_box">
                      <h2>Your Order</h2>
                        <ul class="list">
                          <li>
                              <a href="#">Product<span>Total</span></a>
                          </li>
                         <?php
                              $subtotal = 0;
                              while ($row = $all_product->fetch_object()) { // Change $all_product to $all_products
                                  $product_name = $row->p_name;
                                  $total_price = $row->price * $row->quantity;
                                  $subtotal += $total_price;
                              ?>
                              <li>
                                  <a href="#"><?php echo $product_name; ?>
                                      <span class="middle">x <?php echo $row->quantity; ?></span>
                                      <span class="last">&#8377;<?php echo $total_price; ?></span>
                                  </a>
                              </li>
                          <?php } ?>

                      </ul>

                      <ul class="list list_2">
                          <li><a href="#">Subtotal
                                  <span>&#8377;<?php echo $subtotal; ?></span>
                              </a>
                          </li>
                          <li>
                              <a href="#">Shipping charge
                                  <span>&#8377;50.00</span>
                              </a>
                          </li>
                          <li>
                              <a href="#">Total
                                  <span>&#8377;<?php echo $subtotal + 50.00; ?></span>
                              </a>
                          </li>
                      </ul>
                      <div class="payment_item">
                      <div class="radion_btn">
                      <input type="radio" id="f-option5" name="payment" value="cod" />
                      <label for="f-option5">COD</label>
                      <div class="check"></div>
                      </div>
                      <p>
                      Please send a check to Store Name, Store Street, Store Town,
                      Store State / County, Store Postcode.
                      </p>
                      </div>
                      <div class="payment_item active">
                      <div class="radion_btn">
                      <input type="radio" id="f-option6" name="payment" value="onlinepayment" />
                      <label for="f-option6">Online Payment </label>
                      <img src="img/product/single-product/card.jpg" alt="" />
                      <div class="check"></div>
                      </div>
                      <p>
                      Please send a check to Store Name, Store Street, Store Town,
                      Store State / County, Store Postcode.
                      </p>
                      </div>
                      <div class="creat_account">
                      <input type="checkbox" id="f-option4" name="selector" />
                      <label for="f-option4">I’ve read and accept the </label>
                      <a href="#">terms & conditions*</a>
                      </div>
                      <button type="submit" name="submit" class="btn_3" style="margin-left: 30px;" >Proceed to Paypal</button>
                      </div>
                      </div>
                </form>
               </div>
            </div>
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
      <script>
         document.addEventListener('DOMContentLoaded', function () {
             // Get the checkbox and shipping details form elements
             var shipToDifferentAddressCheckbox = document.getElementById('f-option3');
             var shippingDetailsForm = document.getElementById('shipping-details-form');
         
             // Set initial visibility based on checkbox state
             toggleShippingDetailsForm();
         
             // Add an onchange event to the checkbox
             shipToDifferentAddressCheckbox.addEventListener('change', function () {
                 toggleShippingDetailsForm();
             });
         
             // Function to toggle the visibility of the shipping details form
             function toggleShippingDetailsForm() {
                 if (shipToDifferentAddressCheckbox.checked) {
                     // If checkbox is checked, show the shipping details form
                     shippingDetailsForm.style.display = 'block';
                 } else {
                     // If checkbox is not checked, hide the shipping details form
                     shippingDetailsForm.style.display = 'none'; } } });
      </script> 
  </body> 
</html>