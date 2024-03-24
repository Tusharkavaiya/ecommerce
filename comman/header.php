<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

?>

<header class="main_menu home_menu">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="navbar-brand" href="index.php"> <img src="img/logo.png" alt="logo"> </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="menu_icon"><i class="fas fa-bars"></i></span>
                    </button>

                    <div class="collapse navbar-collapse main-menu-item" id="navbarSupportedContent">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="index.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="category.php">Products </a>
                            </li>
                            <!-- Other menu items... -->
                            <li class="nav-item">
                                <a class="nav-link" href="contact.php">Contact</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../seller/index.php">Seller</a>
                            </li>
                        </ul>
                    </div>

                    <div class="hearer_icon d-flex">
                        <a id="search_1" href="javascript:void(0)"><i class="ti-search"></i></a>
                        <div class="dropdown cart">
                            <a class="dropdown-toggle" href="cart.php">
                                <i class="fa fa-cart-plus"></i>
                            </a>
                        </div>
                        <?php if (isset($_SESSION['userid'])) : ?>
                            <li class=" dropdown" style="list-style-type: none; font-size: 0px;">
                                <a class=" dropdown-toggle" href="#" id="navbarDropdown_3"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-user"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown_2" >
                                    <a class="dropdown-item" href="view_profile.php">Profile</a>
                                    <a class="dropdown-item" href="logout.php" >LogOut</a>
                                    <a class="dropdown-item" href="myorder.php" >My Order</a>
                                </div>
                            </li>
                        <?php else : ?>
                            <a href="login.php"  class="login-btn" >Login</a>
                        <?php endif; ?>
                    </div>
                </nav>
            </div>
        </div>
    </div>

    <div class="search_input" id="search_input_box">
        <div class="container ">
            <form class="d-flex justify-content-between search-inner">
                <input type="text" class="form-control" id="search_input" placeholder="Search Here">
                <button type="submit" class="btn"></button>
                <span class="ti-close" id="close_search" title="Close Search"></span>
            </form>
        </div>
    </div>
</header>
