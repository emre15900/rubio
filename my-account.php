<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Rubio - My Account</title>
  <meta name="description" content="RUBIO SHOPPING">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" type="image/x-icon" href="./assets/img/favicon.png">

   <!-- ======= All CSS Plugins here ======== -->
  <link rel="stylesheet" href="assets/css/plugins/swiper-bundle.min.css">
  <link rel="stylesheet" href="assets/css/plugins/glightbox.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Plugin css -->
  <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css">

  <!-- Custom Style CSS -->
  <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

    <!-- Start preloader -->
    <div id="preloader">
        <div id="ctn-preloader" class="ctn-preloader">
            <div class="animation-preloader">
                <div class="spinner"></div>
                <div class="txt-loading">
                    <span data-text-preloader="L" class="letters-loading">
                        L
                    </span>

                    <span data-text-preloader="O" class="letters-loading">
                        O
                    </span>

                    <span data-text-preloader="A" class="letters-loading">
                        A
                    </span>

                    <span data-text-preloader="D" class="letters-loading">
                        D
                    </span>

                    <span data-text-preloader="I" class="letters-loading">
                        I
                    </span>

                    <span data-text-preloader="N" class="letters-loading">
                        N
                    </span>

                    <span data-text-preloader="G" class="letters-loading">
                        G
                    </span>
                </div>
            </div>

            <div class="loader-section section-left"></div>
            <div class="loader-section section-right"></div>
        </div>
    </div>
    <!-- End preloader -->

    <!-- Start header area -->
    <?php include ('includes/header.php'); ?>
    <!-- End header area -->

    <main class="main__content_wrapper">

        <!-- Start breadcrumb section -->
        <section class="breadcrumb__section breadcrumb__bg">
            <div class="container">
                <div class="row row-cols-1">
                    <div class="col">
                        <div class="breadcrumb__content text-center">
                            <h1 class="breadcrumb__content--title text-white mb-25">My Account</h1>
                            <ul class="breadcrumb__content--menu d-flex justify-content-center">
                                <li class="breadcrumb__content--menu__items"><a class="text-white" href="index.html">Home</a></li>
                                <li class="breadcrumb__content--menu__items"><span class="text-white">My Account</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End breadcrumb section -->

        <!-- my account section start -->
        <section class="my__account--section section--padding">
            <div class="container">
                <p class="account__welcome--text">Hello, Admin welcome to your dashboard!</p>
                <div class="my__account--section__inner border-radius-10 d-flex">
                    <div class="account__left--sidebar">
                        <h2 class="account__content--title h3 mb-20">My Profile</h2>
                        <ul class="account__menu">
                            <li class="account__menu--list active"><a href="my-account.html">Dashboard</a></li>
                            <li class="account__menu--list"><a href="my-account-2.html">Addresses</a></li>
                            <li class="account__menu--list"><a href="wishlist.html">Wishlist</a></li>
                            <li class="account__menu--list"><a href="login.html">Log Out</a></li>
                        </ul>
                    </div>
                    <div class="account__wrapper">
                        <div class="account__content">
                            <h2 class="account__content--title h3 mb-20">Orders History</h2>
                            <div class="account__table--area">
                                <table class="account__table">
                                    <thead class="account__table--header">
                                        <tr class="account__table--header__child">
                                            <th class="account__table--header__child--items">Order</th>
                                            <th class="account__table--header__child--items">Date</th>
                                            <th class="account__table--header__child--items">Payment Status</th>
                                            <th class="account__table--header__child--items">Fulfillment Status</th>
                                            <th class="account__table--header__child--items">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody class="account__table--body mobile__none">
                                        <tr class="account__table--body__child">
                                            <td class="account__table--body__child--items">#2014</td>
                                            <td class="account__table--body__child--items">February 06, 2022</td>
                                            <td class="account__table--body__child--items">Paid</td>
                                            <td class="account__table--body__child--items">Unfulfilled</td>
                                            <td class="account__table--body__child--items">$40.00 USD</td>
                                        </tr>
                                        <tr class="account__table--body__child">
                                            <td class="account__table--body__child--items">#2024</td>
                                            <td class="account__table--body__child--items">February 06, 2022</td>
                                            <td class="account__table--body__child--items">Paid</td>
                                            <td class="account__table--body__child--items">Fulfilled</td>
                                            <td class="account__table--body__child--items">$44.00 USD</td>
                                        </tr>
                                        <tr class="account__table--body__child">
                                            <td class="account__table--body__child--items">#2164</td>
                                            <td class="account__table--body__child--items">February 06, 2022</td>
                                            <td class="account__table--body__child--items">Paid</td>
                                            <td class="account__table--body__child--items">Unfulfilled</td>
                                            <td class="account__table--body__child--items">$36.00 USD</td>
                                        </tr>
                                        <tr class="account__table--body__child">
                                            <td class="account__table--body__child--items">#2345</td>
                                            <td class="account__table--body__child--items">February 06, 2022</td>
                                            <td class="account__table--body__child--items">Paid</td>
                                            <td class="account__table--body__child--items">Unfulfilled</td>
                                            <td class="account__table--body__child--items">$87.00 USD</td>
                                        </tr>
                                        <tr class="account__table--body__child">
                                            <td class="account__table--body__child--items">#1244</td>
                                            <td class="account__table--body__child--items">February 06, 2022</td>
                                            <td class="account__table--body__child--items">Paid</td>
                                            <td class="account__table--body__child--items">Fulfilled</td>
                                            <td class="account__table--body__child--items">$66.00 USD</td>
                                        </tr>
                                        <tr class="account__table--body__child">
                                            <td class="account__table--body__child--items">#3455</td>
                                            <td class="account__table--body__child--items">February 06, 2022</td>
                                            <td class="account__table--body__child--items">Paid</td>
                                            <td class="account__table--body__child--items">Fulfilled</td>
                                            <td class="account__table--body__child--items">$55.00 USD</td>
                                        </tr>
                                        <tr class="account__table--body__child">
                                            <td class="account__table--body__child--items">#4566</td>
                                            <td class="account__table--body__child--items">February 06, 2022</td>
                                            <td class="account__table--body__child--items">Paid</td>
                                            <td class="account__table--body__child--items">Unfulfilled</td>
                                            <td class="account__table--body__child--items">$87.00 USD</td>
                                        </tr>
                                    </tbody>
                                    <tbody class="account__table--body mobile__block">
                                        <tr class="account__table--body__child">
                                            <td class="account__table--body__child--items">
                                                <strong>Order</strong>
                                                <span>#2014</span>
                                            </td>
                                            <td class="account__table--body__child--items">
                                                <strong>Date</strong>
                                                <span>November 24, 2022</span>
                                            </td>
                                            <td class="account__table--body__child--items">
                                                <strong>Payment Status</strong>
                                                <span>Paid</span>
                                            </td>
                                            <td class="account__table--body__child--items">
                                                <strong>Fulfillment Status</strong>
                                                <span>Unfulfilled</span>
                                            </td>
                                            <td class="account__table--body__child--items">
                                                <strong>Total</strong>
                                                <span>$40.00 USD</span>
                                            </td>
                                        </tr>
                                        <tr class="account__table--body__child">
                                            <td class="account__table--body__child--items">
                                                <strong>Order</strong>
                                                <span>#2014</span>
                                            </td>
                                            <td class="account__table--body__child--items">
                                                <strong>Date</strong>
                                                <span>November 24, 2022</span>
                                            </td>
                                            <td class="account__table--body__child--items">
                                                <strong>Payment Status</strong>
                                                <span>Paid</span>
                                            </td>
                                            <td class="account__table--body__child--items">
                                                <strong>Fulfillment Status</strong>
                                                <span>Unfulfilled</span>
                                            </td>
                                            <td class="account__table--body__child--items">
                                                <strong>Total</strong>
                                                <span>$40.00 USD</span>
                                            </td>
                                        </tr>
                                        <tr class="account__table--body__child">
                                            <td class="account__table--body__child--items">
                                                <strong>Order</strong>
                                                <span>#2014</span>
                                            </td>
                                            <td class="account__table--body__child--items">
                                                <strong>Date</strong>
                                                <span>November 24, 2022</span>
                                            </td>
                                            <td class="account__table--body__child--items">
                                                <strong>Payment Status</strong>
                                                <span>Paid</span>
                                            </td>
                                            <td class="account__table--body__child--items">
                                                <strong>Fulfillment Status</strong>
                                                <span>Unfulfilled</span>
                                            </td>
                                            <td class="account__table--body__child--items">
                                                <strong>Total</strong>
                                                <span>$40.00 USD</span>
                                            </td>
                                        </tr>
                                        <tr class="account__table--body__child">
                                            <td class="account__table--body__child--items">
                                                <strong>Order</strong>
                                                <span>#2014</span>
                                            </td>
                                            <td class="account__table--body__child--items">
                                                <strong>Date</strong>
                                                <span>November 24, 2022</span>
                                            </td>
                                            <td class="account__table--body__child--items">
                                                <strong>Payment Status</strong>
                                                <span>Paid</span>
                                            </td>
                                            <td class="account__table--body__child--items">
                                                <strong>Fulfillment Status</strong>
                                                <span>Unfulfilled</span>
                                            </td>
                                            <td class="account__table--body__child--items">
                                                <strong>Total</strong>
                                                <span>$40.00 USD</span>
                                            </td>
                                        </tr>
                                        <tr class="account__table--body__child">
                                            <td class="account__table--body__child--items">
                                                <strong>Order</strong>
                                                <span>#2014</span>
                                            </td>
                                            <td class="account__table--body__child--items">
                                                <strong>Date</strong>
                                                <span>November 24, 2022</span>
                                            </td>
                                            <td class="account__table--body__child--items">
                                                <strong>Payment Status</strong>
                                                <span>Paid</span>
                                            </td>
                                            <td class="account__table--body__child--items">
                                                <strong>Fulfillment Status</strong>
                                                <span>Unfulfilled</span>
                                            </td>
                                            <td class="account__table--body__child--items">
                                                <strong>Total</strong>
                                                <span>$40.00 USD</span>
                                            </td>
                                        </tr>
                                        <tr class="account__table--body__child">
                                            <td class="account__table--body__child--items">
                                                <strong>Order</strong>
                                                <span>#2014</span>
                                            </td>
                                            <td class="account__table--body__child--items">
                                                <strong>Date</strong>
                                                <span>November 24, 2022</span>
                                            </td>
                                            <td class="account__table--body__child--items">
                                                <strong>Payment Status</strong>
                                                <span>Paid</span>
                                            </td>
                                            <td class="account__table--body__child--items">
                                                <strong>Fulfillment Status</strong>
                                                <span>Unfulfilled</span>
                                            </td>
                                            <td class="account__table--body__child--items">
                                                <strong>Total</strong>
                                                <span>$40.00 USD</span>
                                            </td>
                                        </tr>
                                        <tr class="account__table--body__child">
                                            <td class="account__table--body__child--items">
                                                <strong>Order</strong>
                                                <span>#2014</span>
                                            </td>
                                            <td class="account__table--body__child--items">
                                                <strong>Date</strong>
                                                <span>November 24, 2022</span>
                                            </td>
                                            <td class="account__table--body__child--items">
                                                <strong>Payment Status</strong>
                                                <span>Paid</span>
                                            </td>
                                            <td class="account__table--body__child--items">
                                                <strong>Fulfillment Status</strong>
                                                <span>Unfulfilled</span>
                                            </td>
                                            <td class="account__table--body__child--items">
                                                <strong>Total</strong>
                                                <span>$40.00 USD</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- my account section end -->

        <!-- Start shipping section -->
        <section class="shipping__section2 shipping__style3 section--padding pt-0">
            <div class="container">
                <div class="shipping__section2--inner shipping__style3--inner d-flex justify-content-between">
                    <div class="shipping__items2 d-flex align-items-center">
                        <div class="shipping__items2--icon">
                            <img src="./assets/img/delivery.png" alt="" width="70px">
                        </div>
                        <div class="shipping__items2--content">
                            <h2 class="shipping__items2--content__title h3">Fast Delivery</h2>
                            <p class="shipping__items2--content__desc">We deliver to you quickly</p>
                        </div>
                    </div>
                    <div class="shipping__items2 d-flex align-items-center">
                        <div class="shipping__items2--icon">
                            <img src="./assets/img/payment.png" alt=""  width="70px">
                        </div>
                        <div class="shipping__items2--content">
                            <h2 class="shipping__items2--content__title h3">Payment</h2>
                            <p class="shipping__items2--content__desc">We provide ease of payment</p>
                        </div>
                    </div>
                    <div class="shipping__items2 d-flex align-items-center">
                        <div class="shipping__items2--icon">
                            <img src="./assets/img/return.png" alt=""  width="70px">
                        </div>
                        <div class="shipping__items2--content">
                            <h2 class="shipping__items2--content__title h3">Return</h2>
                            <p class="shipping__items2--content__desc">We offer a return guarantee</p>
                        </div>
                    </div>
                    <div class="shipping__items2 d-flex align-items-center">
                        <div class="shipping__items2--icon">
                            <img src="./assets/img/customer.png" alt="" width="70px">
                        </div>
                        <div class="shipping__items2--content">
                            <h2 class="shipping__items2--content__title h3">Support</h2>
                            <p class="shipping__items2--content__desc">24/7 Live support</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End shipping section -->

    </main>

    <!-- Start footer section -->
    <?php include ('includes/footer.php'); ?>
    <!-- End footer section -->

    <!-- Scroll top bar -->
    <button id="scroll__top"><svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M112 244l144-144 144 144M256 120v292"/></svg></button>


  <!-- All Script JS Plugins here  -->
  <?php include ('includes/javascripts.php'); ?>

</body>
</html>