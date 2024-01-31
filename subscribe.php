<!DOCTYPE html>
<html lang="en">

<head>
    <title>subscribe</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="OneTech shop project">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
    <link href="plugins/fontawesome-free-5.0.1/css/fontawesome-all.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="styles/cart_styles.css">
    <link rel="stylesheet" type="text/css" href="styles/cart_responsive.css">

</head>

<body>
    <div class="newsletter">
        <div class="container" id="subscribe">
            <div class="row">
                <div class="col">
                    <div class="newsletter_container d-flex flex-lg-row flex-column align-items-lg-center align-items-center justify-content-lg-start justify-content-center">
                        <div class="newsletter_title_container">
                            <div class="newsletter_icon"><img src="images/send.png" alt=""></div>
                            <div class="newsletter_title">Sign up for Newsletter</div>
                            <div class="newsletter_text">
                                <p>...and receive %20 coupon for first shopping.</p>
                            </div>
                        </div>
                        <div class="newsletter_content clearfix">
                            <form action="index.php#subscribe" method="POST" class="newsletter_form">
                                <input type="email" class="newsletter_input" name="User_Email" required="required" placeholder="Enter your email address">
                                <button id="subscribe" name="Subscribe" class="newsletter_button">Subscribe</button>
                            </form>

                            <?php
                            // PHP code for subscription functionality

                            $errors55 = ''; // Invalid account
                            require_once('dbconnect.inc');

                            if (isset($_POST['Subscribe'])) {
                                $sub_email = htmlspecialchars($_POST['User_Email'], ENT_QUOTES);

                                $sub_statement = "SELECT bdu_subscription.subscription_code, bdu_subscription.customer_email FROM bdu_subscription WHERE customer_email = '" . $sub_email . "'";
                                $c_subscription = mysqli_query($con_srv, $sub_statement);
                                $sub_num_rows = mysqli_num_rows($c_subscription);

                                if ($sub_num_rows == 0) {
                                    $subscribeqry = "INSERT INTO bdu_subscription (subscription_code, customer_email, subscription_date) VALUES ('', '" . $sub_email . "', CURRENT_TIMESTAMP)";
                                    $run_subqry = mysqli_query($con_srv, $subscribeqry);
                                    if (!$run_subqry) {
                                        $errors55 .= "Something went wrong. Please try with a different email address.";
                                    } else {
                                        $errors55 .= "Thanks for your subscription!";
                                    }
                                } else {
                                    $errors55 .= "You are already subscribed. Thanks!";
                                }

                                if (!empty($errors55)) {
                                    echo '<h3>' . $errors55 . '</h3>';
                                }
                            }
                            ?>

                            <div class="newsletter_unsubscribe_link"><a href="unsubscribe.php?email=<?php echo $sub_email; ?>">unsubscribe</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>