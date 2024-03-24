<?php
session_start();
include 'comman/connection.php';

if (!isset($_SESSION['userid'])) {
    // Redirect to login page or display a message
    header("Location: login.php");
    exit;
}

$id = $_SESSION['userid'];

$state = $obj->query("select * from state");
$city = $obj->query("select * from city");
$area = $obj->query("select * from area");

$result = $obj->query("SELECT * from user_registration WHERE id='$id'");

$row = $result->fetch_object();
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
     <?php if (isset($row)) {  ?>
           <div class="section-top-border mb-0">
        <div class="container">
            <h3 class="text-center mt-5" style="color: #ff3368; font-weight:bold;">My Profile</h3>
        <div class="row">
            <div class="col-lg-8 col-md-8 mt-3 w-100"  style="height:500px;">

                <table class="table table-hover text-center" style="color: #ff3368;">
                    <tr>
                                 <td class="font-weight-bold">Name:</td>
                                 <td>
                                    <?php echo $full_name =  "$row->fname $row->lname"; ?>
                                 </td>
                              </tr>
                              <tr>
                                 <td class="font-weight-bold">Gender:</td>
                                 <td>
                                    <?php echo $row->gender; ?>
                                 </td>
                              </tr>
                              <tr>
                                 <td class="font-weight-bold">Date of Birth:</td>
                                 <td>
                                    <?php echo $row->dob; ?>
                                 </td>
                              </tr>
                              <tr>
                                 <td class="font-weight-bold">Email:</td>
                                 <td>
                                    <?php echo $row->email; ?>
                                 </td>
                              </tr>
                              <tr>
                                 <td class="font-weight-bold">Contact:</td>
                                 <td>
                                    <?php echo $row->contact; ?>
                                 </td>
                              </tr>
                              <tr>
                                 <td class="font-weight-bold">Address:</td>
                                 <td>
                                    <?php echo $row->address; ?>
                                 </td>
                              </tr>
                              <tr>
                                 <td class="font-weight-bold">State:</td>
                                 <td>
                                    <?php
                                       while ($s = $state->fetch_object()) {
                                           if ($s->state_id == $row->state_id) {
                                               echo $s->state_name;
                                               break;
                                           }
                                       }
                                       ?>
                                 </td>
                              </tr>
                              <tr>
                                 <td class="font-weight-bold">City:</td>
                                 <td>
                                    <?php
                                       while ($c = $city->fetch_object()) {
                                           if ($c->city_id == $row->city_id) {
                                               echo $c->city_name;
                                               break;
                                           }
                                       }
                                       ?>
                                 </td>
                              </tr>
                              <tr>
                                 <td class="font-weight-bold">Area:</td>
                                 <td>
                                    <?php
                                       while ($a = $area->fetch_object()) {
                                           if ($a->area_id == $row->area_id) {
                                               echo $a->area_name;
                                               break;
                                           }
                                       }
                                       ?>
                                 </td>
                              </tr>
                              <tr>
                                 <td class="font-weight-bold">Regisration Date:</td>
                                 <td>
                                    <?php echo $row->registration_date; ?>
                                 </td>
                              </tr>
                              <tr>
                                 <td colspan="2" class="text-center">
                                    <a href="edit_profile.php" class="btn btn-outline-info">Edit Profile</a>
                                 </td>
                              </tr>
                </table>
            </div>
            <div class="col-lg-4 col-md-4 text-center mt-3">
                 <img src="customer_image/<?php echo $row->image; ?>" alt="Profile Image"
                 height="500" width="300">
            </div>

        </div>
    </div>
    </div>
    <?php }?>
   

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


