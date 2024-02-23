<?php

ob_start();
include ('config/database.php');

$query = $dbh->prepare("SHOW TABLES LIKE :users");
$query->execute([':users' => 'users']);

if (!$query->rowCount()) {
  header('Location: signup.php');
  exit;
}

$success_message = $error_message = $email = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = isset($_POST['email']) ? $_POST['email'] : null;
  $password = isset($_POST['password']) ? $_POST['password'] : null;
  $rememberme = isset($_POST['rememberme']) ? $_POST['rememberme'] : false;

  if (empty($email)) {
    $error_message = "Kindly enter your email.";
  }elseif(empty($password)) {
    $error_message = "Kindly enter your password.";
  } else {
    $query = $dbh->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
    $query->execute(['email' => $email]);
    $row = $query->fetch(PDO::FETCH_ASSOC);

    if(!$row) {
      $error_message = "Invalid login details";
    }else {
      if (!password_verify($password, $row['password'])) {
        $error_message = "Invalid login details";
      }else {

        if ($rememberme) {
          $expiry = time() + 60 * 60 * 24 * 30; // 30 days
          setcookie('RUBIO__REMEMBERME_COOKIE', $email, $expiry);
        }

        $user = [
          'login' => true,
          'email' => $row['email']
        ];

        $_SESSION['user'] = $user;
        $success_message = "Login successfull";
        header('Location:'.BASE_URL);
        exit;
      }
    }
  }
}

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

    <main class="main__content_wrapper">

        <!-- Start breadcrumb section -->
        <?php $title = 'Login Page'; $subtitle = 'Login page'; ?>
        <?php include ('includes/breadcrumb.php'); ?>
        <!-- End breadcrumb section -->

        <!-- Start login section  -->
        <div class="login__section section--padding">
            <div class="container">
                <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <div class="login__section--inner">
                        <div class="row row-cols-lg-2 row-cols-md-1 row-cols-1">
                            <div class="col">
                                <?php if(!empty($_GET['signup'])): ?>
                                    <div class="alert-success px-4 py-3 mb-5">
                                        <div class='small'>Signup successful. Kindly login.</div>
                                    </div>
                                <?php endif; ?>
                                <div class="account__login">
                                    <?php if(!empty($error_message)): ?>
                                        <div class="alert-danger px-4 py-3 mb-4">
                                            <div class=''><?= $error_message; ?></div>
                                        </div>
                                    <?php endif; ?>
                                    <div class="account__login--header mb-25">
                                        <h2 class="account__login--header__title h3 mb-10">Login</h2>
                                    </div>
                                    <div class="account__login--inner">
                                        <input class="account__login--input" placeholder="Email Addres" type="text" value="<?= $email; ?>" name="email">
                                        <input class="account__login--input" placeholder="Password" type="password" name="password">

                                        <div class="account__login--remember__forgot mb-15 d-flex justify-content-between align-items-center">
                                            <div class="account__login--remember position__relative">
                                                <input class="checkout__checkbox--input" id="check1" type="checkbox" name="rememberme" value="1">
                                                <span class="checkout__checkbox--checkmark"></span>
                                                <label class="checkout__checkbox--label login__remember--label" for="check1">
                                                    Remember me</label>
                                            </div>
                                        </div>
                                        <button class="account__login--btn primary__btn" type="submit">Login</button>
                                        <div class="account__login--divide">
                                            <span class="account__login--divide__text">OR</span>
                                        </div>
                                        <p class="account__login--signup__text">Don,t Have an Account? <a href="<?= BASE_URL; ?>/signup.php">Sign up now</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- End login section  -->

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


  <!-- All Script JS Plugins here && Customscript js -->
    <?php include ('includes/javascripts.php'); ?>

</body>
</html>