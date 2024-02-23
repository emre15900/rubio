<?php

ob_start();
include ('config/database.php');

$query = $dbh->prepare("SHOW TABLES LIKE :users");
$query->execute([':users' => 'users']);

if (!($query->rowCount() > 0)) {
  $sql = "CREATE TABLE `users` (
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `email` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
    `username` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
    `password` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
    `status` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
    PRIMARY KEY (`id`)
  )";
  $dbh->exec($sql);
}

$username_error = $email_error = $password_error = $confirm_password_error = "";
$username = $email = '';
$success_message = $error_message = '';

// Function to sanitize user input
function sanitize_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get the submitted username and password
  $username = isset($_POST['username']) ? $_POST['username'] : null;
  $password = isset($_POST['password']) ? $_POST['password'] : null;
  $email = isset($_POST['email']) ? $_POST['email'] : null;
  $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : null;

  // Validate the username and password
  $error = false;

  if (empty($username)) {
    $error = true;
    $username_error = "Username is required";
  } else {
    $username = sanitize_input($username);
    // Check if name contains only letters
    if (!preg_match("/^[a-zA-Z]*$/", $username)) {
      $error = true;
      $username_error = "Only letters allowed. No white space allowed";
    }

    $query = $dbh->prepare("SELECT * FROM users WHERE username = :username LIMIT 1");
    $query->execute(['username' => $username]);
    $row = $query->rowCount();
    if($row) {
      $error = true;
      $username_error = "Username already exists";
    }
  }

  // Validate email
  if (empty($email)) {
    $error = true;
    $email_error = "Email is required";
  } else {
    $email = sanitize_input($email);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $error = true;
      $email_error = "Invalid email format";
    }
    $query = $dbh->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
    $query->execute(['email' => $email]);
    $row = $query->rowCount();
    if($row) {
      $error = true;
      $email_error = "Email already exists";
    }
  }

  if (empty($password)) {
    $error = true;
    $password_error = "Password is required";
  }

  if (empty($confirm_password) || $password !== $confirm_password) {
    $error = true;
    $confirm_password_error = "Password and Confirm password must match.";
  }

  // If there are no validation errors
  if (empty($error)) {
    $password = password_hash($password, PASSWORD_DEFAULT);

    $query = $dbh->prepare("INSERT INTO users (email, username, password, status) VALUES (:email, :username, :password, :status)");
    $query->execute(['email' => $email, 'username' => $username, 'password' => $password, 'status' => 'active']);
    $count = $query->rowCount();

    if(!$count) {
      $error = true;
      $error_message = 'Signup failed. Try again later.';
    }else {
      $success_message = 'Signup successfull';
      header('Location: login.php?signup=1');
      exit;
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
        <?php $title = 'Signup Page'; $subtitle = 'Signup page'; ?>
        <?php include ('includes/breadcrumb.php'); ?>
        <!-- End breadcrumb section -->

        <!-- Start login section  -->
        <div class="login__section section--padding">
            <div class="container">
                <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <div class="login__section--inner">
                        <div class="row row-cols-md-2 row-cols-1">
                            <div class="col">
                                <div class="account__login register">
                                    <div class="account__login--header mb-25">
                                        <h2 class="account__login--header__title h3 mb-10">Create an Account</h2>
                                        <p class="account__login--header__desc">Register here if you are a new customer</p>
                                    </div>
                                    <div class="account__login--inner">
                                        <input class="account__login--input <?= !empty($username_error) ? 'mb-0' : ''; ?>" placeholder="Username" type="text" name="username" value="<?= $username; ?>">
                                        <?php if (!empty($username_error)): ?>
                                          <div class="alert-danger px-3 py-1 mb-4">
                                            <div class='text-danger small'><?= $username_error; ?></div>
                                          </div>
                                        <?php endif; ?>

                                        <input class="account__login--input <?= !empty($email_error) ? 'mb-0' : ''; ?>" placeholder="Email Address" type="email" name="email" value="<?= $email; ?>">
                                        <?php if (!empty($email_error)): ?>
                                          <div class="alert-danger px-3 py-1 mb-4">
                                            <div class='text-danger small'><?= $email_error; ?></div>
                                          </div>
                                        <?php endif; ?>

                                        <input class="account__login--input <?= !empty($password_error) ? 'mb-0' : ''; ?>" placeholder="Password" type="password" name="password">
                                        <?php if (!empty($password_error)): ?>
                                          <div class="alert-danger px-3 py-1 mb-4">
                                            <div class='text-danger small'><?= $password_error; ?></div>
                                          </div>
                                        <?php endif; ?>

                                        <input class="account__login--input <?= !empty($confirm_password_error) ? 'mb-0' : ''; ?>" placeholder="Confirm Password" type="password" name="confirm_password">
                                        <?php if (!empty($confirm_password_error)): ?>
                                          <div class="alert-danger px-3 py-1 mb-4">
                                            <div class='text-danger small'><?= $confirm_password_error; ?></div>
                                          </div>
                                        <?php endif; ?>

                                        <button class="account__login--btn primary__btn mb-10" type="submit">Submit & Register</button>
                                        <div class="account__login--remember position__relative">
                                            <input class="checkout__checkbox--input" id="check2" type="checkbox">
                                            <span class="checkout__checkbox--checkmark"></span>
                                            <label class="checkout__checkbox--label login__remember--label" for="check2">
                                                I have read and agree to the terms & conditions</label>
                                        </div>
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