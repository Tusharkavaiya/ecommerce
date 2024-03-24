<?php
session_start();
include 'comman/connection.php';

// Fetch data for dropdowns
$state_id = $obj->query("select * from state");
$city_id = $obj->query("select * from city");
$area_id = $obj->query("select * from area");

if (isset($_POST['submit'])) {
    $companyName = $_POST['company_name'];
    $sellerName = $_POST['seller_name'];
    $registrationNumber = $_POST['registration_number'];
    $email = $_POST['email'];
    $companyContact = $_POST['company_contact'];
    $sellerContact = $_POST['seller_contact'];
    $address = $_POST['address'];
    $state = $_POST['state_id'];
    $city = $_POST['city_id'];
    $area = $_POST['area_id'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    $image = $_FILES['image']['name'];
    $file_type = explode(".", $image);
    $ext = strtolower(end($file_type));
    $tmp = $_FILES['image']['tmp_name'];
    $path = "seller_image/$image"; // Update the path

    if ($password == $cpassword) {
        if ($ext == 'jpg' || $ext == 'png' || $ext == 'jpeg') {
            move_uploaded_file($tmp, $path);

            $exe = $obj->query("INSERT INTO `seller_register`(`company_name`, `seller_name`, `registration_number`, `email`, `company_contact`, `seller_contact`, `address`, `state_id`, `city_id`, `area_id`, `image`, `password`) VALUES ('$companyName','$sellerName','$registrationNumber','$email','$companyContact','$sellerContact','$address','$state','$city','$area','$image','$password')");

            if ($exe) {
                echo "<script>alert('Data Successfully Inserted...✅😊')</script>";
            }
        } else {
            echo "<script>alert('Invalid File Try Again..')</script>";
        }
    } else {
        echo "<script>alert('Mismatched passwords')</script>";
        header("location:signup.php");
    }
}
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
   <!--  <section class="breadcrumb breadcrumb_bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="breadcrumb_iner">
                        <div class="breadcrumb_iner_item">
                            <h2>Tracking Order</h2>
                            <p>Home <span>-</span> Tracking Order</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- breadcrumb start-->

     <!--================registar Area =================-->
   <section class="login_part padding_top">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-6">
                    <div class="section-top-border">
                        <h3 class="mb-30 text-center" style="color: #ff3368; font-weight:bolder;">Seller Registration Form</h3>
                        <form method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="company_name">Company Name</label>
                                <input type="text" name="company_name" placeholder="Company Name" class="single-input"
                                    style="border-bottom: 1px solid #ff3368;" required>
                            </div>
                            <div class="form-group">
                                <label for="seller_name">Seller Name</label>
                                <input type="text" name="seller_name" placeholder="Seller Name" class="single-input"
                                    style="border-bottom: 1px solid #ff3368;" required>
                            </div>
                            <div class="form-group">
                                <label for="registration_number">Registration Number</label>
                                <input type="text" name="registration_number" placeholder="Registration Number" class="single-input"
                                    style="border-bottom: 1px solid #ff3368;" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" name="email" placeholder="Email" class="single-input"
                                    style="border-bottom: 1px solid #ff3368;" required>
                            </div>
                            <div class="form-group">
                                <label for="company_contact">Company Contact</label>
                                <input type="text" name="company_contact" placeholder="Company Contact" class="single-input"
                                    style="border-bottom: 1px solid #ff3368;" required>
                            </div>
                            <div class="form-group">
                                <label for="seller_contact">Seller Contact</label>
                                <input type="text" name="seller_contact" placeholder="Seller Contact" class="single-input"
                                    style="border-bottom: 1px solid #ff3368;" required>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea class="single-input" placeholder="Address" name="address" style="border-bottom: 1px solid #ff3368;" required></textarea>
                            </div>
                            <div class="input-group-icon mt-10">
                                <label for="state_id">State</label>
                                <div class="form-select" id="default-select">
                                    <select name="state_id">
                                        <option value="">---select state---</option>
                                        <?php while ($state = $state_id->fetch_object()) { ?>
                                            <option value="<?php echo $state->state_id;?>"><?php echo $state->state_name;?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>
                            <div class="input-group-icon mt-10">
                                <label for="city_id">City</label>
                                <div class="form-select" id="default-select">
                                    <select name="city_id">
                                        <option value="">---select City---</option>
                                        <?php while ($city = $city_id->fetch_object()) { ?>
                                            <option value="<?php echo $city->city_id;?>"><?php echo $city->city_name;?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>
                            <div class="input-group-icon mt-10">
                                <label for="area_id">Area</label>
                                <div class="form-select" id="default-select">
                                    <select name="area_id">
                                        <option value="">---select Area---</option>
                                        <?php while ($area = $area_id->fetch_object()) { ?>
                                            <option value="<?php echo $area->area_id;?>"><?php echo $area->area_name;?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" placeholder="Password" class="single-input"
                                    style="border-bottom: 1px solid #ff3368;" required>
                            </div>
                            <div class="form-group">
                                <label for="cpassword">Confirm Password</label>
                                <input type="password" name="cpassword" placeholder="Confirm Password"
                                    class="single-input" style="border-bottom: 1px solid #ff3368;" required>
                            </div>
                            <div class="form-group">
                                <label for="image">Choose Image</label>
                                <div class="row">
                                    <div class="col-12 input-group-icon">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input single-input mb-5 pb-3" id="customFile" name="image" style="border-bottom: 1px solid #ff3368;" required>
                                            <label class="custom-file-label" id="fileLabel" for="customFile">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 form-group">
                                <button type="submit" name="submit" value="submit" class="btn_3">Sign Up</button>
                                <a class="lost_pass" href="#">Forget password?</a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                      <div class="login_part_text text-center" style="height: 600px; margin-top: 70px;">
                        <div class="login_part_text_iner">
                            <h2>New to our Shop?</h2>
                            <p>There are advances being made in science and technology
                                everyday, and a good example of this is the</p>
                            <a href="registration.php" class="btn_3">Create an Account</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!--================login_part end =================-->

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
    <!-- custom js -->
    <script src="js/custom.js"></script>
</body>

</html>


