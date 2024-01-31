<!DOCTYPE html>
<html lang="en">

<head>
    <title>Searching</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="OneTech shop project">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
    <link href="plugins/fontawesome-free-5.0.1/css/fontawesome-all.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
    <link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
    <link rel="stylesheet" type="text/css" href="plugins/slick-1.8.0/slick.css">
    <link rel="stylesheet" type="text/css" href="styles/main_styles.css">
    <link rel="stylesheet" type="text/css" href="styles/responsive.css">
    <link rel="stylesheet" type="text/css" href="styles/searchstyle.css">

</head>

<body>
    <div class="super_container">

        <!-- Header -->
        <?php include_once('header-menu.php'); ?>
        <?php
        include_once 'dbselect.inc';
        $selected = $db_selected;

        // Check if the search term is provided
        if (isset($_GET['search'])) {
            $searchTerm = $_GET['search'];

            // Check if a specific category is selected
            if (isset($_GET['category']) && $_GET['category'] !== 'All Categories') {
                $selectedCategory = $_GET['category'];

                // Prepare the query using a prepared statement to prevent SQL injection
                $queryProducts = mysqli_prepare($con_srv, "SELECT bdu_product.p_id, bdu_product.p_name,/* bdu_product.p_image, bdu_product.p_color, bdu_product.p_price, bdu_product.p_status, bdu_product.sale_price, bdu_product.tag, bdu_product.weight, bdu_product.total_review, bdu_product.p_availability, bdu_product.p_description,*/ bdu_product.c_id, bdu_category.c_name 
                                                FROM bdu_product, bdu_category 
                                                WHERE bdu_product.c_id = bdu_category.c_id 
                                                AND bdu_product.p_availability = 'In Store'
                                                AND bdu_product.c_id = ?
                                                AND p_name LIKE CONCAT('%', ?, '%')
                                                ORDER BY bdu_product.p_name ASC");

                // Bind the category and search term parameters to the prepared statement
                mysqli_stmt_bind_param($queryProducts, 'is', $selectedCategory, $searchTerm);
            } else {
                // Prepare the query for all categories
                $queryProducts = mysqli_prepare($con_srv, "SELECT bdu_product.p_id, bdu_product.p_name,/* bdu_product.p_image, bdu_product.p_color, bdu_product.p_price, bdu_product.p_status, bdu_product.sale_price, bdu_product.tag, bdu_product.weight, bdu_product.total_review, bdu_product.p_availability, bdu_product.p_description,*/ bdu_product.c_id, bdu_category.c_name 
                                                FROM bdu_product, bdu_category 
                                                WHERE bdu_product.c_id = bdu_category.c_id 
                                                AND bdu_product.p_availability = 'In Store'
                                                AND p_name LIKE CONCAT('%', ?, '%')
                                                ORDER BY bdu_product.p_name ASC");

                // Bind only the search term parameter to the prepared statement
                mysqli_stmt_bind_param($queryProducts, 's', $searchTerm);
            }

            // Execute the query
            mysqli_stmt_execute($queryProducts);

            // Retrieve the results
            $result = mysqli_stmt_get_result($queryProducts);

            // Check if any products are found
            if (mysqli_num_rows($result) > 0) {
                // Loop through the results and display the products
                while ($row = mysqli_fetch_array($result)) {
                    // Retrieve the product information
                    $productId = $row['p_id'];
                    $productName = $row['p_name'];
                    // $pimage = $row['p_image'];
                    // $pcolor = $row['p_color'];
                    // $pprice = $row['p_price'];
                    // $saleprice = $row['sale_price'];
                    // $tag = $row['tag'];
                    //$weight = $row['weight'];
                    //$total_review = $row['total_review'];
                    //$p_availability = $row['p_availability'];
                    //$p_description = $row['p_description'];
                    //$pstatus = $row['p_status'];
                    $c_id = $row['c_id'];
                    // $cname = $row['c_name'];

                    // Display the product information
                    echo '<li><a target="_blank" href="singleproduct.php?pid=' . $productId . '" >' . $productName . ' </a></li>';
                }
            } else {
                echo 'No products found.';
            }

            // Close the prepared statement
            mysqli_stmt_close($queryProducts);
        }

        // Close the database connection
        mysqli_close($con_srv);
        ?>
        <!-- Newsletter -->
        <?php include_once('subscribe.php'); ?>
        <!-- Footer -->
        <?php include_once('footer.php'); ?>
        <!-- Copyright -->
        <?php include_once('copyright.php'); ?>

</body>

</html>