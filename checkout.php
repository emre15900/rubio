<?php

header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include ('config/database.php');
$cart_items = [];

if (isset($_COOKIE['cart_items'])) {
    $cart_items = json_decode($_COOKIE['cart_items'], true);
}

$total = [];
$currency = $_SESSION['currency'] ?? 'NGN';

?>


<!doctype html>
<html lang="en">

<?php include ('includes/head.php'); ?>

<body>

    <!-- Start preloader -->
        <?php include ('includes/preloader.php'); ?>
    <!-- End preloader -->

    <!-- Start header area -->
        <?php include ('includes/header.php'); ?>
    <!-- End header area -->

    <!-- Start checkout page area -->
    <div class="checkout__page--area">
        <div class="container">
            <?php if(empty($cart_items)): ?>
                <div class="alert-info px-4 py-3">No cart items</div>
            <?php else: ?>
                <div class="checkout__page--inner d-flex">
                    <div class="main checkout__mian">
                        <header class="main__header checkout__mian--header mb-30">
                            <h1 class="main__logo--title"><a class="logo logo__left mb-20" href="index.html"><img src="./assets/img/rubiologo.png" width="300px"  alt="logo"></a></h1>
                            <details class="order__summary--mobile__version">
                                <summary class="order__summary--toggle border-radius-5">
                                    <span class="order__summary--toggle__inner">
                                        <span class="order__summary--toggle__icon">
                                            <svg width="20" height="19" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M17.178 13.088H5.453c-.454 0-.91-.364-.91-.818L3.727 1.818H0V0h4.544c.455 0 .91.364.91.818l.09 1.272h13.45c.274 0 .547.09.73.364.18.182.27.454.18.727l-1.817 9.18c-.09.455-.455.728-.91.728zM6.27 11.27h10.09l1.454-7.362H5.634l.637 7.362zm.092 7.715c1.004 0 1.818-.813 1.818-1.817s-.814-1.818-1.818-1.818-1.818.814-1.818 1.818.814 1.817 1.818 1.817zm9.18 0c1.004 0 1.817-.813 1.817-1.817s-.814-1.818-1.818-1.818-1.818.814-1.818 1.818.814 1.817 1.818 1.817z" fill="currentColor"></path>
                                            </svg>
                                        </span>
                                        <span class="order__summary--toggle__text show">
                                            <span>Show order summary</span>
                                            <svg width="11" height="6" xmlns="http://www.w3.org/2000/svg" class="order-summary-toggle__dropdown" fill="currentColor"><path d="M.504 1.813l4.358 3.845.496.438.496-.438 4.642-4.096L9.504.438 4.862 4.534h.992L1.496.69.504 1.812z"></path></svg>
                                        </span>
                                        <span class="order__summary--final__price">$227.70</span>
                                    </span>
                                </summary>
                                <div class="order__summary--section">
                                    <div class="cart__table checkout__product--table">
                                        <table class="summary__table">
                                            <tbody class="summary__table--body">
                                                <tr class=" summary__table--items">
                                                    <td class=" summary__table--list">
                                                        <div class="product__image two  d-flex align-items-center">
                                                            <div class="product__thumbnail border-radius-5">
                                                                <a href="product-details.html"><img class="border-radius-5" src="https://risingtheme.com/html/demo-suruchi-v1/suruchi/assets/img/product/small-product7.png" alt="cart-product"></a>
                                                                <span class="product__thumbnail--quantity">1</span>
                                                            </div>
                                                            <div class="product__description">
                                                                <h3 class="product__description--name h4"><a href="product-details.html">Fresh-whole-fish</a></h3>
                                                                <span class="product__description--variant">COLOR: Blue</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class=" summary__table--list">
                                                        <span class="cart__price">£65.00</span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="checkout__discount--code">
                                        <form class="d-flex" action="#">
                                            <label>
                                                <input required="" class="checkout__discount--code__input--field border-radius-5" placeholder="Gift card or discount code"  type="text">
                                            </label>
                                            <button class="checkout__discount--code__btn primary__btn border-radius-5" type="submit">Apply</button>
                                        </form>
                                    </div>
                                    <div class="checkout__total">
                                        <table class="checkout__total--table">
                                            <tbody class="checkout__total--body">
                                                <tr class="checkout__total--items">
                                                    <td class="checkout__total--title text-left">Subtotal </td>
                                                    <td class="checkout__total--amount text-right"><?= $currency.convert_currency(array_sum($total)); ?></td>
                                                </tr>
                                                <?php $shipping = rand(7, 13); ?>
                                                <tr class="checkout__total--items">
                                                    <td class="checkout__total--title text-left">Shipping</td>
                                                    <td class="checkout__total--calculated__text text-right"><?= $currency.convert_currency($shipping); ?></td>
                                                </tr>
                                            </tbody>
                                            <tfoot class="checkout__total--footer">
                                                <tr class="checkout__total--footer__items">
                                                    <td class="checkout__total--footer__title checkout__total--footer__list text-left">Total </td>
                                                    <td class="checkout__total--footer__amount checkout__total--footer__list text-right"><?= $currency.convert_currency(array_sum($total) + $shipping); ?></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </details>
                            <nav>
                                <ol class="breadcrumb checkout__breadcrumb d-flex">
                                    <li class="breadcrumb__item breadcrumb__item--completed d-flex align-items-center">
                                        <a class="breadcrumb__link" href="cart.html">Cart</a>
                                        <svg class="readcrumb__chevron-icon" xmlns="http://www.w3.org/2000/svg" width="17.007" height="16.831" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M184 112l144 144-144 144"></path></svg>
                                    </li>

                                    <li class="breadcrumb__item breadcrumb__item--current d-flex align-items-center">
                                        <span class="breadcrumb__text current">Information</span>
                                        <svg class="readcrumb__chevron-icon" xmlns="http://www.w3.org/2000/svg" width="17.007" height="16.831" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M184 112l144 144-144 144"></path></svg>
                                    </li>
                                    <li class="breadcrumb__item breadcrumb__item--blank d-flex align-items-center">
                                        <span class="breadcrumb__text">Shipping</span>
                                        <svg class="readcrumb__chevron-icon" xmlns="http://www.w3.org/2000/svg" width="17.007" height="16.831" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M184 112l144 144-144 144"></path></svg>
                                    </li>
                                        <li class="breadcrumb__item breadcrumb__item--blank">
                                        <span class="breadcrumb__text">Payment</span>
                                    </li>
                                </ol>
                                </nav>
                        </header>
                        <main class="main__content_wrapper">
                            <form action="javascript:;">
                                <div class="checkout__content--step section__contact--information">
                                    <div class="section__header checkout__section--header d-flex align-items-center justify-content-between mb-25">
                                        <h2 class="section__header--title h3">Contact information</h2>
                                        <p class="layout__flex--item">
                                            Already have an account?
                                            <a class="layout__flex--item__link" href="<?= BASE_URL; ?>/login.php">Log in</a>
                                        </p>
                                    </div>
                                    <div class="customer__information">
                                        <div class="checkout__email--phone mb-12">
                                        <label>
                                                <input required="" class="checkout__input--field border-radius-5" placeholder="Email or mobile phone mumber"  type="text">
                                        </label>
                                        </div>
                                        <div class="checkout__checkbox">
                                            <input required="" class="checkout__checkbox--input" id="check1" type="checkbox">
                                            <span class="checkout__checkbox--checkmark"></span>
                                            <label class="checkout__checkbox--label" for="check1">
                                                Email me with news and offers</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="checkout__content--step section__shipping--address">
                                    <div class="section__header mb-25">
                                        <h3 class="section__header--title">Shipping address</h3>
                                    </div>
                                    <div class="section__shipping--address__content">
                                        <div class="row">
                                            <div class="col-lg-6 mb-12">
                                                <div class="checkout__input--list ">
                                                    <label>
                                                        <input required="" class="checkout__input--field border-radius-5" placeholder="First name (optional)"  type="text">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-12">
                                                <div class="checkout__input--list">
                                                    <label>
                                                        <input required="" class="checkout__input--field border-radius-5" placeholder="Last name"  type="text">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 mb-12">
                                                <div class="checkout__input--list">
                                                    <label>
                                                        <input required="" class="checkout__input--field border-radius-5" placeholder="Company (optional)"  type="text">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 mb-12">
                                                <div class="checkout__input--list">
                                                    <label>
                                                        <input required="" class="checkout__input--field border-radius-5" placeholder="Address1"  type="text">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 mb-12">
                                                <div class="checkout__input--list">
                                                    <label>
                                                        <input required="" class="checkout__input--field border-radius-5" placeholder="Apartment, suite, etc. (optional)"  type="text">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 mb-12">
                                                <div class="checkout__input--list">
                                                    <label>
                                                        <input required="" class="checkout__input--field border-radius-5" placeholder="City"  type="text">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-12">
                                                <div class="checkout__input--list checkout__input--select select">
                                                    <label class="checkout__select--label" for="country">Country/region</label>
                                                    <select class="checkout__input--select__field border-radius-5" id="country">
                                                        <option value="1">India</option>
                                                        <option value="2">United States</option>
                                                        <option value="3">Netherlands</option>
                                                        <option value="4">Afghanistan</option>
                                                        <option value="5">Islands</option>
                                                        <option value="6">Albania</option>
                                                        <option value="7">Antigua Barbuda</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-12">
                                                <div class="checkout__input--list">
                                                    <label>
                                                        <input required="" class="checkout__input--field border-radius-5" placeholder="Postal code"  type="text">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="checkout__checkbox">
                                            <input required="" class="checkout__checkbox--input" id="check2" type="checkbox">
                                            <span class="checkout__checkbox--checkmark"></span>
                                            <label class="checkout__checkbox--label" for="check2">
                                                Save this information for next time</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="checkout__content--step__footer d-flex align-items-center">
                                    <a class="continue__shipping--btn primary__btn border-radius-5" href="<?= BASE_URL; ?>/orders.php">Continue</a>
                                    <a class="previous__link--content" href="<?= BASE_URL; ?>/cart.php">Return to cart</a>
                                </div>
                            </form>
                        </main>
                        <footer class="main__footer checkout__footer">
                            <p class="copyright__content">Copyright © 2024 <a class="copyright__content--link text__primary" href="index.html">Suruchi</a> . All Rights Reserved.Design By Rubio</p>
                        </footer>
                    </div>
                    <aside class="checkout__sidebar sidebar">
                        <div class="cart__table checkout__product--table">
                            <table class="cart__table--inner">
                                <tbody class="cart__table--body">
                                    <?php foreach($cart_items as $item): ?>
                                        <?php $total[] = $item['price']; ?>
                                        <tr class="cart__table--body__items">
                                            <td class="cart__table--body__list">
                                                <div class="cart__product d-flex align-items-center">
                                                    <div class="product__thumbnail border-radius-5">
                                                        <a href="<?= BASE_URL; ?>/product.php?id=<?= $item['id']; ?>"><img class="border-radius-5" src="<?= $item['img']; ?>" alt="cart-product"></a>
                                                        <span class="product__thumbnail--quantity">1</span>
                                                    </div>
                                                    <div class="product__description">
                                                        <h3 class="product__description--name h4"><a href="<?= BASE_URL; ?>/product.php?id=<?= $item['id']; ?>"><?= $item['name']; ?></a></h3>
                                                        <span class="product__description--variant">COLOR: White</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="cart__table--body__list">
                                                <span class="cart__price"><?= $currency.convert_currency($item['price']); ?></span>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="checkout__discount--code">
                            <form class="d-flex" action="#">
                                <label>
                                    <input required="" class="checkout__discount--code__input--field border-radius-5" placeholder="Gift card or discount code"  type="text">
                                </label>
                                <button class="checkout__discount--code__btn primary__btn border-radius-5" type="submit">Apply</button>
                            </form>
                        </div>
                        <div class="checkout__total">
                            <table class="checkout__total--table">
                                <tbody class="checkout__total--body">
                                    <tr class="checkout__total--items">
                                        <td class="checkout__total--title text-left">Subtotal </td>
                                        <td class="checkout__total--amount text-right"><?= $currency.convert_currency(array_sum($total)); ?></td>
                                    </tr>
                                    <tr class="checkout__total--items">
                                        <td class="checkout__total--title text-left">Shipping</td>
                                        <td class="checkout__total--calculated__text text-right">Calculated at next step</td>
                                    </tr>
                                </tbody>
                                <tfoot class="checkout__total--footer">
                                    <tr class="checkout__total--footer__items">
                                        <td class="checkout__total--footer__title checkout__total--footer__list text-left">Total </td>
                                        <td class="checkout__total--footer__amount checkout__total--footer__list text-right"><?= $currency.convert_currency(array_sum($total)); ?></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </aside>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <!-- End checkout page area -->

    <!-- Scroll top bar -->
    <button id="scroll__top"><svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M112 244l144-144 144 144M256 120v292"/></svg></button>

  <!-- All Script JS Plugins here  -->
  <script src="assets/js/vendor/popper.js" defer="defer"></script>
  <script src="assets/js/vendor/bootstrap.min.js" defer="defer"></script>
  <script src="assets/js/plugins/swiper-bundle.min.js"></script>
  <script src="assets/js/plugins/glightbox.min.js"></script>

  <!-- Customscript js -->
  <script src="assets/js/script.js"></script>



</body>
</html>