<?php

ob_start();
include ('config/database.php');

$query = $dbh->prepare("SHOW TABLES LIKE :contacts");
$query->execute([':contacts' => 'contacts']);

if (!($query->rowCount() > 0)) {
  $sql = "CREATE TABLE `contacts` (
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `firstname` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
    `lastname` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
    `phone` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
    `email` varchar(255) CHARACTER SET utf8mb4 NOT NULL,
    `message` varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
    PRIMARY KEY (`id`)
  )";
  $dbh->exec($sql);
}

$firstname_error = $lastname_error = $email_error = $phone_error = $message_error = "";
$phone = $email = $lastname = $firstname = $message = '';
$success_message = $error_message = '';

function sanitize_input($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function validate_length($str = '', $length = 255) {
    return strlen($str) <= $length;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : null;
  $lastname = isset($_POST['lastname']) ? $_POST['lastname'] : null;
  $email = isset($_POST['email']) ? $_POST['email'] : null;
  $message = isset($_POST['message']) ? $_POST['message'] : null;
  $phone = isset($_POST['phone']) ? $_POST['phone'] : null;

  // Validate the firstname and lastname
  $error = false;

  if (empty($firstname)) {
    $error = true;
    $firstname_error = "Firstname is required";
  } else {
    $firstname = sanitize_input($firstname);
    if (!validate_length($firstname)) {
      $error = true;
      $firstname_error = "Invalid length of characters.";
    }
  }

  if (empty($lastname)) {
    $error = true;
    $lastname_error = "Lastname is required";
  } else {
    $lastname = sanitize_input($lastname);
    if (!validate_length($lastname)) {
      $error = true;
      $firstname_error = "Invalid length of characters.";
    }
  }

  if (empty($email)) {
    $error = true;
    $email_error = "Email is required";
  } else {
    $email = sanitize_input($email);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $error = true;
      $email_error = "Invalid email format";
    }
  }

  if (empty($phone)) {
    $error = true;
    $phone_error = "Phone number is required";
  } else {
    $phone = sanitize_input($phone);
    if (!validate_length($phone)) {
      $error = true;
      $phone_error = "Invalid length of characters.";
    }
  }

  if (empty($message)) {
    $error = true;
    $message_error = "Your message is required";
  } else {
    $message = sanitize_input($message);
    if (!validate_length($message, $length = 500)) {
      $error = true;
      $message_error = "Only 500 length of characters allowed.";
    }
  }

  // If there are no validation errors
  if (empty($error)) {
    $query = $dbh->prepare("INSERT INTO contacts (email, firstname, lastname, phone, message) VALUES (:email, :firstname, :lastname, :phone, :message)");
    $query->execute(['email' => $email, 'firstname' => $firstname, 'lastname' => $lastname, 'phone' => $phone, 'message' => $message]);
    $count = $query->rowCount();

    if(!$count) {
      $error = true;
      $error_message = 'Operatio failed. Try again.';
    }else {
      header('Location: contact.php?success=1');
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
        <section class="breadcrumb__section breadcrumb__bg">
            <div class="container">
                <div class="row row-cols-1">
                    <div class="col">
                        <div class="breadcrumb__content text-center">
                            <h1 class="breadcrumb__content--title text-white mb-25">Contact Us</h1>
                            <ul class="breadcrumb__content--menu d-flex justify-content-center">
                                <li class="breadcrumb__content--menu__items"><a class="text-white" href="index.html">Home</a></li>
                                <li class="breadcrumb__content--menu__items"><span class="text-white">Contact Us</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End breadcrumb section -->

        <!-- Start contact section -->
        <section class="contact__section section--padding">
            <div class="container">
                <div class="section__heading text-center mb-40">
                    <h2 class="section__heading--maintitle">Get In Touch</h2>
                </div>
                <div class="main__contact--area position__relative">

                    <div class="contact__form">
                        <h3 class="contact__form--title mb-40">Contact Me</h3>
                        <?php if(isset($_GET['success'])): ?>
                            <div class="alert-success px-4 py-3 mb-4">
                                <div class='text-success small'>Contact details recieved. Thank you for contacting us.</div>
                            </div>
                        <?php else: ?>
                            <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="contact__form--list mb-20">
                                            <label class="contact__form--label" for="input1">First Name <span class="contact__form--label__star">*</span></label>
                                            <input class="contact__form--input" name="firstname" id="input1" placeholder="Your First Name" type="text" value="<?= $firstname; ?>">

                                            <?php if (!empty($firstname_error)): ?>
                                            <div class="alert-danger px-3 py-1 mb-4">
                                                <div class='text-danger small'><?= $firstname_error; ?></div>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="contact__form--list mb-20">
                                            <label class="contact__form--label" for="input2">Last Name <span class="contact__form--label__star">*</span></label>
                                            <input class="contact__form--input" name="lastname" id="input2" placeholder="Your Last Name" type="text" value="<?= $lastname; ?>">

                                            <?php if (!empty($lastname_error)): ?>
                                            <div class="alert-danger px-3 py-1 mb-4">
                                                <div class='text-danger small'><?= $lastname_error; ?></div>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="contact__form--list mb-20">
                                            <label class="contact__form--label" for="input3">Phone Number <span class="contact__form--label__star">*</span></label>
                                            <input class="contact__form--input" name="phone" id="input3" placeholder="Phone number" type="text" value="<?= $phone; ?>">

                                            <?php if (!empty($phone_error)): ?>
                                            <div class="alert-danger px-3 py-1 mb-4">
                                                <div class='text-danger small'><?= $phone_error; ?></div>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="contact__form--list mb-20">
                                            <label class="contact__form--label" for="input4">Email <span class="contact__form--label__star">*</span></label>
                                            <input class="contact__form--input" name="email" id="input4" placeholder="Email" type="email" value="<?= $email; ?>">

                                            <?php if (!empty($email_error)): ?>
                                            <div class="alert-danger px-3 py-1 mb-4">
                                                <div class='text-danger small'><?= $email_error; ?></div>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="contact__form--list mb-15">
                                            <label class="contact__form--label" for="input5">Write Your Message <span class="contact__form--label__star">*</span></label>
                                            <textarea class="contact__form--textarea" name="message" id="input5" placeholder="Write Your Message"><?= $message; ?></textarea>

                                            <?php if (!empty($message_error)): ?>
                                                <div class="alert-danger px-3 py-1 mb-4">
                                                    <div class='text-danger small'><?= $message_error; ?></div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <button class="contact__form--btn primary__btn" type="submit">Submit Now</button>
                            </form>
                        <?php endif; ?>
                    </div>
                    <div class="contact__info border-radius-5">
                        <div class="contact__info--items">
                            <h3 class="contact__info--content__title text-white mb-15">Contact Us</h3>
                            <div class="contact__info--items__inner d-flex">
                                <div class="contact__info--icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="31.568" height="31.128" viewBox="0 0 31.568 31.128">
                                        <path id="ic_phone_forwarded_24px" d="M26.676,16.564l7.892-7.782L26.676,1V5.669H20.362v6.226h6.314Zm3.157,7a18.162,18.162,0,0,1-5.635-.887,1.627,1.627,0,0,0-1.61.374l-3.472,3.424a23.585,23.585,0,0,1-10.4-10.257l3.472-3.44a1.48,1.48,0,0,0,.395-1.556,17.457,17.457,0,0,1-.9-5.556A1.572,1.572,0,0,0,10.1,4.113H4.578A1.572,1.572,0,0,0,3,5.669,26.645,26.645,0,0,0,29.832,32.128a1.572,1.572,0,0,0,1.578-1.556V25.124A1.572,1.572,0,0,0,29.832,23.568Z" transform="translate(-3 -1)" fill="currentColor"/>
                                    </svg>
                                </div>
                                <div class="contact__info--content">
                                    <p class="contact__info--content__desc text-white"><a href="tel:+254 723 826 12 73">+254 723 826 12 73</a>  </p>
                                </div>
                            </div>
                        </div>
                        <div class="contact__info--items">
                            <h3 class="contact__info--content__title text-white mb-15">Email Address</h3>
                            <div class="contact__info--items__inner d-flex">
                                <div class="contact__info--icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="31.57" height="31.13" viewBox="0 0 31.57 31.13">
                                        <path id="ic_email_24px" d="M30.413,4H5.157C3.421,4,2.016,5.751,2.016,7.891L2,31.239c0,2.14,1.421,3.891,3.157,3.891H30.413c1.736,0,3.157-1.751,3.157-3.891V7.891C33.57,5.751,32.149,4,30.413,4Zm0,7.783L17.785,21.511,5.157,11.783V7.891l12.628,9.728L30.413,7.891Z" transform="translate(-2 -4)" fill="currentColor"/>
                                    </svg>
                                </div>
                                <div class="contact__info--content">
                                    <p class="contact__info--content__desc text-white"> <a href="mailto:info@rubio.shopping"> info@rubio.shopping</a> </p>
                                </div>
                            </div>
                        </div>
                        <div class="contact__info--items">
                            <h3 class="contact__info--content__title text-white mb-15">Office Location</h3>
                            <div class="contact__info--items__inner d-flex">
                                <div class="contact__info--icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="31.57" height="31.13" viewBox="0 0 31.57 31.13">
                                        <path id="ic_account_balance_24px" d="M5.323,14.341V24.718h4.985V14.341Zm9.969,0V24.718h4.985V14.341ZM2,32.13H33.57V27.683H2ZM25.262,14.341V24.718h4.985V14.341ZM17.785,1,2,8.412v2.965H33.57V8.412Z" transform="translate(-2 -1)" fill="currentColor"/>
                                    </svg>
                                </div>
                                <div class="contact__info--content">
                                    <p class="contact__info--content__desc text-white"> PIKEVILLE NIGERIA LIMITED <br>
                                        Register Number : 1927300 <br>
                                        Address : 79/80 AWOLOWO WAY, IKEJA, IKEJA, LAGOS STATE</p>
                                </div>
                            </div>
                        </div>
                        <div class="contact__info--items">
                            <h3 class="contact__info--content__title text-white mb-15">Follow Us</h3>
                            <ul class="contact__info--social d-flex">
                                <li class="contact__info--social__list">
                                    <a class="contact__info--social__icon" target="_blank" href="https://www.facebook.com">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="7.667" height="16.524" viewBox="0 0 7.667 16.524">
                                            <path data-name="Path 237" d="M967.495,353.678h-2.3v8.253h-3.437v-8.253H960.13V350.77h1.624v-1.888a4.087,4.087,0,0,1,.264-1.492,2.9,2.9,0,0,1,1.039-1.379,3.626,3.626,0,0,1,2.153-.6l2.549.019v2.833h-1.851a.732.732,0,0,0-.472.151.8.8,0,0,0-.246.642v1.719H967.8Z" transform="translate(-960.13 -345.407)" fill="currentColor"></path>
                                        </svg>
                                        <span class="visually-hidden">Facebook</span>
                                    </a>
                                </li>
                                <li class="contact__info--social__list">
                                    <a class="contact__info--social__icon" target="_blank" href="https://twitter.com">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16.489" height="13.384" viewBox="0 0 16.489 13.384">
                                            <path data-name="Path 303" d="M966.025,1144.2v.433a9.783,9.783,0,0,1-.621,3.388,10.1,10.1,0,0,1-1.845,3.087,9.153,9.153,0,0,1-3.012,2.259,9.825,9.825,0,0,1-4.122.866,9.632,9.632,0,0,1-2.748-.4,9.346,9.346,0,0,1-2.447-1.11q.4.038.809.038a6.723,6.723,0,0,0,2.24-.376,7.022,7.022,0,0,0,1.958-1.054,3.379,3.379,0,0,1-1.958-.687,3.259,3.259,0,0,1-1.186-1.666,3.364,3.364,0,0,0,.621.056,3.488,3.488,0,0,0,.885-.113,3.267,3.267,0,0,1-1.374-.631,3.356,3.356,0,0,1-.969-1.186,3.524,3.524,0,0,1-.367-1.5v-.057a3.172,3.172,0,0,0,1.544.433,3.407,3.407,0,0,1-1.1-1.214,3.308,3.308,0,0,1-.4-1.609,3.362,3.362,0,0,1,.452-1.694,9.652,9.652,0,0,0,6.964,3.538,3.911,3.911,0,0,1-.075-.772,3.293,3.293,0,0,1,.452-1.694,3.409,3.409,0,0,1,1.233-1.233,3.257,3.257,0,0,1,1.685-.461,3.351,3.351,0,0,1,2.466,1.073,6.572,6.572,0,0,0,2.146-.828,3.272,3.272,0,0,1-.574,1.083,3.477,3.477,0,0,1-.913.8,6.869,6.869,0,0,0,1.958-.546A7.074,7.074,0,0,1,966.025,1144.2Z" transform="translate(-951.23 -1140.849)" fill="currentColor"></path>
                                        </svg>
                                        <span class="visually-hidden">Twitter</span>
                                    </a>
                                </li>
                                <li class="contact__info--social__list">
                                    <a class="contact__info--social__icon" target="_blank" href="https://www.instagram.com">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16.497" height="16.492" viewBox="0 0 19.497 19.492">
                                            <path  data-name="Icon awesome-instagram" d="M9.747,6.24a5,5,0,1,0,5,5A4.99,4.99,0,0,0,9.747,6.24Zm0,8.247A3.249,3.249,0,1,1,13,11.238a3.255,3.255,0,0,1-3.249,3.249Zm6.368-8.451A1.166,1.166,0,1,1,14.949,4.87,1.163,1.163,0,0,1,16.115,6.036Zm3.31,1.183A5.769,5.769,0,0,0,17.85,3.135,5.807,5.807,0,0,0,13.766,1.56c-1.609-.091-6.433-.091-8.042,0A5.8,5.8,0,0,0,1.64,3.13,5.788,5.788,0,0,0,.065,7.215c-.091,1.609-.091,6.433,0,8.042A5.769,5.769,0,0,0,1.64,19.341a5.814,5.814,0,0,0,4.084,1.575c1.609.091,6.433.091,8.042,0a5.769,5.769,0,0,0,4.084-1.575,5.807,5.807,0,0,0,1.575-4.084c.091-1.609.091-6.429,0-8.038Zm-2.079,9.765a3.289,3.289,0,0,1-1.853,1.853c-1.283.509-4.328.391-5.746.391S5.28,19.341,4,18.837a3.289,3.289,0,0,1-1.853-1.853c-.509-1.283-.391-4.328-.391-5.746s-.113-4.467.391-5.746A3.289,3.289,0,0,1,4,3.639c1.283-.509,4.328-.391,5.746-.391s4.467-.113,5.746.391a3.289,3.289,0,0,1,1.853,1.853c.509,1.283.391,4.328.391,5.746S17.855,15.705,17.346,16.984Z" transform="translate(0.004 -1.492)" fill="currentColor"/>
                                        </svg>
                                        <span class="visually-hidden">Instagram</span>
                                    </a>
                                </li>
                                <li class="contact__info--social__list">
                                    <a class="contact__info--social__icon" target="_blank" href="https://www.youtube.com">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16.49" height="11.582" viewBox="0 0 16.49 11.582">
                                            <path data-name="Path 321" d="M967.759,1365.592q0,1.377-.019,1.717-.076,1.114-.151,1.622a3.981,3.981,0,0,1-.245.925,1.847,1.847,0,0,1-.453.717,2.171,2.171,0,0,1-1.151.6q-3.585.265-7.641.189-2.377-.038-3.387-.085a11.337,11.337,0,0,1-1.5-.142,2.206,2.206,0,0,1-1.113-.585,2.562,2.562,0,0,1-.528-1.037,3.523,3.523,0,0,1-.141-.585c-.032-.2-.06-.5-.085-.906a38.894,38.894,0,0,1,0-4.867l.113-.925a4.382,4.382,0,0,1,.208-.906,2.069,2.069,0,0,1,.491-.755,2.409,2.409,0,0,1,1.113-.566,19.2,19.2,0,0,1,2.292-.151q1.82-.056,3.953-.056t3.952.066q1.821.067,2.311.142a2.3,2.3,0,0,1,.726.283,1.865,1.865,0,0,1,.557.49,3.425,3.425,0,0,1,.434,1.019,5.72,5.72,0,0,1,.189,1.075q0,.095.057,1C967.752,1364.1,967.759,1364.677,967.759,1365.592Zm-7.6.925q1.49-.754,2.113-1.094l-4.434-2.339v4.66Q958.609,1367.311,960.156,1366.517Z" transform="translate(-951.269 -1359.8)" fill="currentColor"></path>
                                        </svg>
                                        <span class="visually-hidden">Youtube</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End contact section -->

        <!-- Start contact map area -->
        <div class="contact__map--area section--padding pt-0">
            <iframe class="contact__map--iframe" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7887.465355142307!2d-0.13384360843222626!3d51.4876034467734!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48760532743b90e1%3A0x790260718555a20c!2sU.S.%20Embassy%2C%20London!5e0!3m2!1sen!2sbd!4v1632035375945!5m2!1sen!2sbd" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
        <!-- End contact map area -->

         <!-- Start brand logo section -->
         <div class="brand__logo--section bg__secondary section--padding">
            <div class="container-fluid">
                <div class="row row-cols-1">
                    <div class="col">
                        <div class="brand__logo--section__inner d-flex justify-content-center align-items-center">
                            <div class="brand__logo--items">
                                <img class="brand__logo--items__thumbnail--img display-block" src="https://risingtheme.com/html/demo-suruchi-v1/suruchi/assets/img/logo/brand-logo1.png" alt="brand logo">
                            </div>
                            <div class="brand__logo--items">
                                <img class="brand__logo--items__thumbnail--img display-block" src="https://risingtheme.com/html/demo-suruchi-v1/suruchi/assets/img/logo/brand-logo2.png" alt="brand logo">
                            </div>
                            <div class="brand__logo--items">
                                <img class="brand__logo--items__thumbnail--img display-block" src="https://risingtheme.com/html/demo-suruchi-v1/suruchi/assets/img/logo/brand-logo3.png" alt="brand logo">
                            </div>
                            <div class="brand__logo--items">
                                <img class="brand__logo--items__thumbnail--img display-block" src="https://risingtheme.com/html/demo-suruchi-v1/suruchi/assets/img/logo/brand-logo4.png" alt="brand logo">
                            </div>
                            <div class="brand__logo--items">
                                <img class="brand__logo--items__thumbnail--img display-block" src="https://risingtheme.com/html/demo-suruchi-v1/suruchi/assets/img/logo/brand-logo5.png" alt="brand logo">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End brand logo section -->

        <!-- Start shipping section -->
        <section class="shipping__section2 shipping__style3 section--padding">
            <div class="container">
                <div class="shipping__section2--inner shipping__style3--inner d-flex justify-content-between">
                    <div class="shipping__items2 d-flex align-items-center">
                        <div class="shipping__items2--icon">
                            <img src="https://risingtheme.com/html/demo-suruchi-v1/suruchi/assets/img/other/shipping1.png" alt="">
                        </div>
                        <div class="shipping__items2--content">
                            <h2 class="shipping__items2--content__title h3">Shipping</h2>
                            <p class="shipping__items2--content__desc">From handpicked sellers</p>
                        </div>
                    </div>
                    <div class="shipping__items2 d-flex align-items-center">
                        <div class="shipping__items2--icon">
                            <img src="https://risingtheme.com/html/demo-suruchi-v1/suruchi/assets/img/other/shipping2.png" alt="">
                        </div>
                        <div class="shipping__items2--content">
                            <h2 class="shipping__items2--content__title h3">Payment</h2>
                            <p class="shipping__items2--content__desc">From handpicked sellers</p>
                        </div>
                    </div>
                    <div class="shipping__items2 d-flex align-items-center">
                        <div class="shipping__items2--icon">
                            <img src="https://risingtheme.com/html/demo-suruchi-v1/suruchi/assets/img/other/shipping3.png" alt="">
                        </div>
                        <div class="shipping__items2--content">
                            <h2 class="shipping__items2--content__title h3">Return</h2>
                            <p class="shipping__items2--content__desc">From handpicked sellers</p>
                        </div>
                    </div>
                    <div class="shipping__items2 d-flex align-items-center">
                        <div class="shipping__items2--icon">
                            <img src="https://risingtheme.com/html/demo-suruchi-v1/suruchi/assets/img/other/shipping4.png" alt="">
                        </div>
                        <div class="shipping__items2--content">
                            <h2 class="shipping__items2--content__title h3">Support</h2>
                            <p class="shipping__items2--content__desc">From handpicked sellers</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End shipping section -->

    </main>

    <!-- Start footer section -->
    <footer class="footer__section bg__black">
        <div class="container-fluid">
            <div class="main__footer d-flex justify-content-between">
                <div class="footer__widget footer__widget--width">
                    <h2 class="footer__widget--title text-ofwhite h3">About Us
                        <button class="footer__widget--button" aria-label="footer widget button">
                            <svg class="footer__widget--title__arrowdown--icon" xmlns="http://www.w3.org/2000/svg" width="12.355" height="8.394" viewBox="0 0 10.355 6.394">
                                <path  d="M15.138,8.59l-3.961,3.952L7.217,8.59,6,9.807l5.178,5.178,5.178-5.178Z" transform="translate(-6 -8.59)" fill="currentColor"></path>
                            </svg>
                        </button>
                    </h2>
                    <div class="footer__widget--inner">
                        <p class="footer__widget--desc text-ofwhite mb-20">RUBIO SHOPPING<br>
Register Number : 1927300<br>
Address : UNIT 2,VIEWPOINT PLAZA, AJAH., IKEJA, IKEJA, LAGOS STATE , NIGERIA
<br>
Email: <a href="mailto:info@rubio.shopping">info@rubio.shopping</a>  | <a href="mailto:support@rubia.shopping">support@rubia.shopping</a>
<br>
Telephone: <a href="tel:+254 723 826 12 73">+254 723 826 12 73</a>
</p>
                        <div class="footer__social">
                            <h4 class="social__title text-ofwhite mb-15">Follow Us</h4>
                            <ul class="social__shear d-flex">
                                <li class="social__shear--list">
                                    <a class="social__shear--list__icon" target="_blank" href="https://www.facebook.com">
                                        <svg  xmlns="http://www.w3.org/2000/svg" width="7.667" height="16.524" viewBox="0 0 7.667 16.524">
                                            <path  data-name="Path 237" d="M967.495,353.678h-2.3v8.253h-3.437v-8.253H960.13V350.77h1.624v-1.888a4.087,4.087,0,0,1,.264-1.492,2.9,2.9,0,0,1,1.039-1.379,3.626,3.626,0,0,1,2.153-.6l2.549.019v2.833h-1.851a.732.732,0,0,0-.472.151.8.8,0,0,0-.246.642v1.719H967.8Z" transform="translate(-960.13 -345.407)" fill="currentColor"/>
                                        </svg>
                                        <span class="visually-hidden">Facebook</span>
                                    </a>
                                </li>
                                <li class="social__shear--list">
                                    <a class="social__shear--list__icon" target="_blank" href="https://twitter.com">
                                        <svg  xmlns="http://www.w3.org/2000/svg" width="16.489" height="13.384" viewBox="0 0 16.489 13.384">
                                            <path  data-name="Path 303" d="M966.025,1144.2v.433a9.783,9.783,0,0,1-.621,3.388,10.1,10.1,0,0,1-1.845,3.087,9.153,9.153,0,0,1-3.012,2.259,9.825,9.825,0,0,1-4.122.866,9.632,9.632,0,0,1-2.748-.4,9.346,9.346,0,0,1-2.447-1.11q.4.038.809.038a6.723,6.723,0,0,0,2.24-.376,7.022,7.022,0,0,0,1.958-1.054,3.379,3.379,0,0,1-1.958-.687,3.259,3.259,0,0,1-1.186-1.666,3.364,3.364,0,0,0,.621.056,3.488,3.488,0,0,0,.885-.113,3.267,3.267,0,0,1-1.374-.631,3.356,3.356,0,0,1-.969-1.186,3.524,3.524,0,0,1-.367-1.5v-.057a3.172,3.172,0,0,0,1.544.433,3.407,3.407,0,0,1-1.1-1.214,3.308,3.308,0,0,1-.4-1.609,3.362,3.362,0,0,1,.452-1.694,9.652,9.652,0,0,0,6.964,3.538,3.911,3.911,0,0,1-.075-.772,3.293,3.293,0,0,1,.452-1.694,3.409,3.409,0,0,1,1.233-1.233,3.257,3.257,0,0,1,1.685-.461,3.351,3.351,0,0,1,2.466,1.073,6.572,6.572,0,0,0,2.146-.828,3.272,3.272,0,0,1-.574,1.083,3.477,3.477,0,0,1-.913.8,6.869,6.869,0,0,0,1.958-.546A7.074,7.074,0,0,1,966.025,1144.2Z" transform="translate(-951.23 -1140.849)" fill="currentColor"/>
                                        </svg>
                                        <span class="visually-hidden">Twitter</span>
                                    </a>
                                </li>
                                <li class="social__shear--list">
                                    <a class="social__shear--list__icon" target="_blank" href="https://www.instagram.com">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16.497" height="16.492" viewBox="0 0 19.497 19.492">
                                            <path  data-name="Icon awesome-instagram" d="M9.747,6.24a5,5,0,1,0,5,5A4.99,4.99,0,0,0,9.747,6.24Zm0,8.247A3.249,3.249,0,1,1,13,11.238a3.255,3.255,0,0,1-3.249,3.249Zm6.368-8.451A1.166,1.166,0,1,1,14.949,4.87,1.163,1.163,0,0,1,16.115,6.036Zm3.31,1.183A5.769,5.769,0,0,0,17.85,3.135,5.807,5.807,0,0,0,13.766,1.56c-1.609-.091-6.433-.091-8.042,0A5.8,5.8,0,0,0,1.64,3.13,5.788,5.788,0,0,0,.065,7.215c-.091,1.609-.091,6.433,0,8.042A5.769,5.769,0,0,0,1.64,19.341a5.814,5.814,0,0,0,4.084,1.575c1.609.091,6.433.091,8.042,0a5.769,5.769,0,0,0,4.084-1.575,5.807,5.807,0,0,0,1.575-4.084c.091-1.609.091-6.429,0-8.038Zm-2.079,9.765a3.289,3.289,0,0,1-1.853,1.853c-1.283.509-4.328.391-5.746.391S5.28,19.341,4,18.837a3.289,3.289,0,0,1-1.853-1.853c-.509-1.283-.391-4.328-.391-5.746s-.113-4.467.391-5.746A3.289,3.289,0,0,1,4,3.639c1.283-.509,4.328-.391,5.746-.391s4.467-.113,5.746.391a3.289,3.289,0,0,1,1.853,1.853c.509,1.283.391,4.328.391,5.746S17.855,15.705,17.346,16.984Z" transform="translate(0.004 -1.492)" fill="currentColor"/>
                                        </svg>
                                        <span class="visually-hidden">Instagram</span>
                                    </a>
                                </li>
                                <li class="social__shear--list">
                                    <a class="social__shear--list__icon" target="_blank" href="https://www.youtube.com">
                                        <svg  xmlns="http://www.w3.org/2000/svg" width="16.49" height="11.582" viewBox="0 0 16.49 11.582">
                                            <path  data-name="Path 321" d="M967.759,1365.592q0,1.377-.019,1.717-.076,1.114-.151,1.622a3.981,3.981,0,0,1-.245.925,1.847,1.847,0,0,1-.453.717,2.171,2.171,0,0,1-1.151.6q-3.585.265-7.641.189-2.377-.038-3.387-.085a11.337,11.337,0,0,1-1.5-.142,2.206,2.206,0,0,1-1.113-.585,2.562,2.562,0,0,1-.528-1.037,3.523,3.523,0,0,1-.141-.585c-.032-.2-.06-.5-.085-.906a38.894,38.894,0,0,1,0-4.867l.113-.925a4.382,4.382,0,0,1,.208-.906,2.069,2.069,0,0,1,.491-.755,2.409,2.409,0,0,1,1.113-.566,19.2,19.2,0,0,1,2.292-.151q1.82-.056,3.953-.056t3.952.066q1.821.067,2.311.142a2.3,2.3,0,0,1,.726.283,1.865,1.865,0,0,1,.557.49,3.425,3.425,0,0,1,.434,1.019,5.72,5.72,0,0,1,.189,1.075q0,.095.057,1C967.752,1364.1,967.759,1364.677,967.759,1365.592Zm-7.6.925q1.49-.754,2.113-1.094l-4.434-2.339v4.66Q958.609,1367.311,960.156,1366.517Z" transform="translate(-951.269 -1359.8)" fill="currentColor"/>
                                        </svg>
                                        <span class="visually-hidden">Youtube</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="footer__widget--menu__wrapper d-flex footer__widget--width">
                    <div class="footer__widget">
                        <h2 class="footer__widget--title text-ofwhite h3">My Account
                            <button class="footer__widget--button" aria-label="footer widget button">
                                <svg class="footer__widget--title__arrowdown--icon" xmlns="http://www.w3.org/2000/svg" width="12.355" height="8.394" viewBox="0 0 10.355 6.394">
                                    <path  d="M15.138,8.59l-3.961,3.952L7.217,8.59,6,9.807l5.178,5.178,5.178-5.178Z" transform="translate(-6 -8.59)" fill="currentColor"></path>
                                </svg>
                            </button>
                        </h2>
                        <ul class="footer__widget--menu footer__widget--inner">
                            <li class="footer__widget--menu__list"><a class="footer__widget--menu__text" href="about.html">About Us</a></li>
                            <li class="footer__widget--menu__list"><a class="footer__widget--menu__text" href="contact.html">Contact Us</a></li>
                            <li class="footer__widget--menu__list"><a class="footer__widget--menu__text" href="portfolio.html">Portfolio</a></li>
                            <li class="footer__widget--menu__list"><a class="footer__widget--menu__text" href="terms-and-conditions.html">Terms and Conditions</a></li>
                            <li class="footer__widget--menu__list"><a class="footer__widget--menu__text" href="return-and-exhange-policy.html">Return and Exchange Policy</a></li>
                            <li class="footer__widget--menu__list"><a class="footer__widget--menu__text" href="compare.html">Compare</a></li>
                            <li class="footer__widget--menu__list"><a class="footer__widget--menu__text" href="faq.html">Frequently</a></li>
                        </ul>
                    </div>
                    <div class="footer__widget">
                        <h2 class="footer__widget--title text-ofwhite h3">Categories
                            <button class="footer__widget--button" aria-label="footer widget button">
                                <svg class="footer__widget--title__arrowdown--icon" xmlns="http://www.w3.org/2000/svg" width="12.355" height="8.394" viewBox="0 0 10.355 6.394">
                                    <path  d="M15.138,8.59l-3.961,3.952L7.217,8.59,6,9.807l5.178,5.178,5.178-5.178Z" transform="translate(-6 -8.59)" fill="currentColor"></path>
                                </svg>
                            </button>
                        </h2>
                        <ul class="footer__widget--menu footer__widget--inner">
                            <li class="footer__widget--menu__list"><a class="footer__widget--menu__text" href="about.html">About Us</a></li>
                            <li class="footer__widget--menu__list"><a class="footer__widget--menu__text" href="contact.html">Contact Us</a></li>
                            <li class="footer__widget--menu__list"><a class="footer__widget--menu__text" href="portfolio.html">Portfolio</a></li>
                            <li class="footer__widget--menu__list"><a class="footer__widget--menu__text" href="cart.html">Shopping Cart</a></li>
                            <li class="footer__widget--menu__list"><a class="footer__widget--menu__text" href="checkout.html">Checkout</a></li>
                            <li class="footer__widget--menu__list"><a class="footer__widget--menu__text" href="login.html">Register</a></li>
                        </ul>
                    </div>
                </div>
                <div class="footer__widget footer__widget--width">
                    <h2 class="footer__widget--title text-ofwhite h3">Instagram
                        <button class="footer__widget--button" aria-label="footer widget button">
                            <svg class="footer__widget--title__arrowdown--icon" xmlns="http://www.w3.org/2000/svg" width="12.355" height="8.394" viewBox="0 0 10.355 6.394">
                                <path  d="M15.138,8.59l-3.961,3.952L7.217,8.59,6,9.807l5.178,5.178,5.178-5.178Z" transform="translate(-6 -8.59)" fill="currentColor"></path>
                            </svg>
                        </button>
                    </h2>
                    <div class="footer__instagram footer__widget--inner">
                        <div class="footer__instagram--list d-flex">
                            <div class="instagram__thumbnail">
                                <a class="instagram__thumbnail--img" target="_blank" href="https://www.instagram.com/p/CZkF3TLBTT7"><img src="https://risingtheme.com/html/demo-suruchi-v1/suruchi/assets/img/other/instagram1.webp" alt="instagram"></a>
                            </div>
                            <div class="instagram__thumbnail">
                                <a class="instagram__thumbnail--img" target="_blank" href="https://www.instagram.com/p/CZkF60sBxhN"><img src="https://risingtheme.com/html/demo-suruchi-v1/suruchi/assets/img/other/instagram2.webp" alt="instagram"></a>
                            </div>
                            <div class="instagram__thumbnail">
                                <a class="instagram__thumbnail--img" target="_blank" href="https://www.instagram.com/p/CZkF90ZB6HG"><img src="https://risingtheme.com/html/demo-suruchi-v1/suruchi/assets/img/other/instagram3.webp" alt="instagram"></a>
                            </div>
                        </div>
                        <div class="footer__instagram--list d-flex">
                            <div class="instagram__thumbnail">
                                <a class="instagram__thumbnail--img" target="_blank" href="https://www.instagram.com/p/CZkGAe6BQeu"><img src="https://risingtheme.com/html/demo-suruchi-v1/suruchi/assets/img/other/instagram4.webp" alt="instagram"></a>
                            </div>
                            <div class="instagram__thumbnail">
                                <a class="instagram__thumbnail--img" target="_blank" href="https://www.instagram.com/p/CZkGCWcBbv9"><img src="https://risingtheme.com/html/demo-suruchi-v1/suruchi/assets/img/other/instagram5.webp" alt="instagram"></a>
                            </div>
                            <div class="instagram__thumbnail">
                                <a class="instagram__thumbnail--img" target="_blank" href="https://www.instagram.com/p/CZkGFDMhoid"><img src="https://risingtheme.com/html/demo-suruchi-v1/suruchi/assets/img/other/instagram6.webp" alt="instagram"></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer__widget footer__widget--width">
                    <h2 class="footer__widget--title text-ofwhite h3">Newsletter
                        <button class="footer__widget--button" aria-label="footer widget button">
                            <svg class="footer__widget--title__arrowdown--icon" xmlns="http://www.w3.org/2000/svg" width="12.355" height="8.394" viewBox="0 0 10.355 6.394">
                                <path  d="M15.138,8.59l-3.961,3.952L7.217,8.59,6,9.807l5.178,5.178,5.178-5.178Z" transform="translate(-6 -8.59)" fill="currentColor"></path>
                            </svg>
                        </button>
                    </h2>
                    <div class="footer__widget--inner">
                        <p class="footer__widget--desc text-ofwhite m-0">Fill their seed open meat. Sea you <br> great Saw image stl</p>
                        <div class="newsletter__subscribe">
                            <form class="newsletter__subscribe--form" action="#">
                                <label>
                                    <input class="newsletter__subscribe--input" placeholder="Email Address" type="email">
                                </label>
                                <button class="newsletter__subscribe--button" type="submit">Subscribe</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer__bottom d-flex justify-content-between align-items-center">
                <p class="copyright__content text-ofwhite m-0">Copyright © 2022 <a class="copyright__content--link" href="index.html">Rubio</a> . All Rights Reserved.Design By Rubio</p>
                <div class="footer__payment text-right">
                    <img class="display-block" src="https://risingtheme.com/html/demo-suruchi-v1/suruchi/assets/img/other/payment-visa-card.png" alt="visa-card">
                </div>
            </div>
        </div>
    </footer>
    <!-- End footer section -->

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