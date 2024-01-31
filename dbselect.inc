
<?php
include_once 'dbconnect.inc';
$query1 = mysqli_query($con_srv, "SELECT bdu_product.p_id, bdu_product.p_name, bdu_product.p_image, bdu_product.p_color, bdu_product.p_price, bdu_product.p_status, bdu_product.sale_price, bdu_product.tag, bdu_product.weight, bdu_product.total_review, bdu_product.p_availability, bdu_product.p_description, bdu_product.c_id, bdu_category.c_name
                                  FROM bdu_product
                                  JOIN bdu_category ON bdu_product.c_id = bdu_category.c_id 
                                  WHERE bdu_product.p_availability = 'In Store' 
                                  ORDER BY bdu_product.p_name ASC") or die("Mission Failed / Query doesn't work.");
$queryFeatured = mysqli_query($con_srv, "SELECT p_id, p_name, p_image, p_color, p_price, p_status, sale_price, tag, weight, total_review, p_availability, p_description, bdu_product.c_id FROM bdu_product, bdu_category WHERE bdu_product.c_id = bdu_category.c_id AND p_availability='In Store' AND p_status='Featured' ORDER BY p_name ASC") or die("Mission Failed /Query doesnt work.");
$queryFeatured3 = mysqli_query($con_srv, "SELECT p_id, p_name, p_image, p_color, p_price, p_status, sale_price, tag, weight, total_review, p_availability, p_description, bdu_product.c_id FROM bdu_product, bdu_category WHERE bdu_product.c_id = bdu_category.c_id AND p_availability='In Store' AND p_status='Featured' ORDER BY p_name ASC") or die("Mission Failed /Query doesnt work.");
$querytrend = mysqli_query($con_srv, "SELECT bdu_product.p_id, bdu_product.p_name, bdu_product.p_image, bdu_product.p_color, bdu_product.p_price, bdu_product.p_status, bdu_product.sale_price, bdu_product.tag, bdu_product.weight, bdu_product.total_review, bdu_product.p_availability, bdu_product.p_description, bdu_product.c_id, bdu_category.c_name
                                  FROM bdu_product
                                  JOIN bdu_category ON bdu_product.c_id = bdu_category.c_id 
                                  WHERE bdu_product.p_availability = 'In Store' 
                                  ORDER BY bdu_product.p_name ASC") or die("Mission Failed / Query doesn't work.");
$queryOnSale = mysqli_query($con_srv, "SELECT p_id, p_name, p_image, p_color, p_price, p_status, sale_price, tag, weight, total_review, p_availability, p_description, bdu_product.c_id FROM bdu_product, bdu_category WHERE bdu_product.c_id = bdu_category.c_id AND p_availability='In Store' AND p_status='On Sale' ORDER BY p_name ASC") or die("Mission Failed /Query doesnt work.");
$queryBestRated = mysqli_query($con_srv, "SELECT p_id, p_name, p_image, p_color, p_price, p_status, sale_price, tag, weight, total_review, p_availability, p_description, bdu_product.c_id FROM bdu_product, bdu_category WHERE bdu_product.c_id = bdu_category.c_id AND p_availability='In Store' AND p_status='Best Rated' ORDER BY p_name ASC") or die("Mission Failed /Query doesnt work.");
$queryPopularCategory=mysqli_query($con_srv, "SELECT c_id, c_name, c_image FROM bdu_category");
$queryBanner = mysqli_query($con_srv, "SELECT bdu_product.p_id, bdu_product.p_name, bdu_product.p_image, bdu_product.p_color, bdu_product.p_price, bdu_product.p_status, bdu_product.sale_price, bdu_product.tag, bdu_product.weight, bdu_product.total_review, bdu_product.p_availability, bdu_product.p_description, bdu_product.c_id, bdu_category.c_name FROM bdu_product INNER JOIN bdu_category ON bdu_product.c_id = bdu_category.c_id ORDER BY bdu_product.p_name ASC") or die("Mission Failed / Query doesn't work.");
$queryFeatured2 = mysqli_query($con_srv, "SELECT p_id, p_name, p_image, p_color, p_price, p_status, sale_price, tag, weight, total_review, p_availability, p_description, bdu_product.c_id FROM bdu_product, bdu_category WHERE bdu_product.c_id = bdu_category.c_id AND p_availability='In Store' AND p_status='Featured' ORDER BY p_name ASC") or die("Mission Failed /Query doesnt work.");
$queryPhone = mysqli_query($con_srv, "SELECT bdu_product.p_id, bdu_product.p_name, bdu_product.p_image, bdu_product.p_color, bdu_product.p_price, bdu_product.p_status, bdu_product.sale_price, bdu_product.tag, bdu_product.weight, bdu_product.total_review, bdu_product.p_availability, bdu_product.p_description, bdu_product.c_id 
                                  FROM bdu_product, bdu_category 
                                  WHERE bdu_product.c_id = bdu_category.c_id 
                                  AND bdu_product.p_availability = 'In Store'
                                  AND bdu_product.c_id=4
                                  ORDER BY bdu_product.p_name ASC") or die("Mission Failed /Query doesn't work.");
$queryLaptop = mysqli_query($con_srv, "SELECT bdu_product.p_id, bdu_product.p_name, bdu_product.p_image, bdu_product.p_color, bdu_product.p_price, bdu_product.p_status, bdu_product.sale_price, bdu_product.tag, bdu_product.weight, bdu_product.total_review, bdu_product.p_availability, bdu_product.p_description, bdu_product.c_id 
                                  FROM bdu_product, bdu_category 
                                  WHERE bdu_product.c_id = bdu_category.c_id 
                                  AND bdu_product.p_availability = 'In Store'
                                  AND bdu_product.c_id=1
                                  ORDER BY bdu_product.p_name ASC") or die("Mission Failed /Query doesn't work.");
$queryTop20 = mysqli_query($con_srv, "SELECT bdu_product.p_id, bdu_product.p_name, bdu_product.p_image, bdu_product.p_color, bdu_product.p_price, bdu_product.p_status, bdu_product.sale_price, bdu_product.tag, bdu_product.weight, bdu_product.total_review, bdu_product.p_availability, bdu_product.p_description, bdu_product.c_id, bdu_category.c_name 
                                  FROM bdu_product, bdu_category 
                                  WHERE bdu_product.c_id = bdu_category.c_id 
                                  AND bdu_product.p_availability = 'In Store'
                                  AND p_price>200 
                                  ORDER BY bdu_product.p_name ASC") or die("Mission Failed /Query doesn't work.");
$queryPhone2 = mysqli_query($con_srv, "SELECT bdu_product.p_id, bdu_product.p_name, bdu_product.p_image, bdu_product.p_color, bdu_product.p_price, bdu_product.p_status, bdu_product.sale_price, bdu_product.tag, bdu_product.weight, bdu_product.total_review, bdu_product.p_availability, bdu_product.p_description, bdu_product.c_id 
                                  FROM bdu_product, bdu_category 
                                  WHERE bdu_product.c_id = bdu_category.c_id 
                                  AND bdu_product.p_availability = 'In Store'
                                  AND bdu_product.c_id=4
                                  AND p_price>200 
                                  ORDER BY bdu_product.p_name ASC") or die("Mission Failed /Query doesn't work.");
$queryLaptop2 = mysqli_query($con_srv, "SELECT bdu_product.p_id, bdu_product.p_name, bdu_product.p_image, bdu_product.p_color, bdu_product.p_price, bdu_product.p_status, bdu_product.sale_price, bdu_product.tag, bdu_product.weight, bdu_product.total_review, bdu_product.p_availability, bdu_product.p_description, bdu_product.c_id 
                                  FROM bdu_product, bdu_category 
                                  WHERE bdu_product.c_id = bdu_category.c_id 
                                  AND bdu_product.p_availability = 'In Store'
                                  AND bdu_product.c_id=1
                                  AND p_price>200 
                                  ORDER BY bdu_product.p_name ASC") or die("Mission Failed /Query doesn't work.");
$queryreviews = mysqli_query($con_srv, "SELECT bdu_product.p_id, bdu_product.p_name, bdu_product.p_image, bdu_product.p_color, bdu_product.p_price, bdu_product.p_status, bdu_product.sale_price, bdu_product.tag, bdu_product.weight, bdu_product.total_review, bdu_product.p_availability, bdu_product.p_description, bdu_product.c_id, bdu_category.c_name
                                  FROM bdu_product
                                  JOIN bdu_category ON bdu_product.c_id = bdu_category.c_id 
                                  WHERE bdu_product.p_availability = 'In Store' 
                                  ORDER BY bdu_product.p_name ASC") or die("Mission Failed / Query doesn't work.");
$queryrecent= mysqli_query($con_srv, "SELECT bdu_product.p_id, bdu_product.p_name, bdu_product.p_image, bdu_product.p_color, bdu_product.p_price, bdu_product.p_status, bdu_product.sale_price, bdu_product.tag, bdu_product.weight, bdu_product.total_review, bdu_product.p_availability, bdu_product.p_description, bdu_product.c_id, bdu_category.c_name
                                  FROM bdu_product
                                  JOIN bdu_category ON bdu_product.c_id = bdu_category.c_id 
                                  WHERE bdu_product.p_availability = 'In Store' 
                                  ORDER BY bdu_product.p_name ASC") or die("Mission Failed / Query doesn't work.");
$queryFeatured22 = mysqli_query($con_srv, "SELECT p_id, p_name, p_availability,  bdu_product.c_id FROM bdu_product, bdu_category WHERE bdu_product.c_id = bdu_category.c_id AND p_availability='In Store' AND p_status='Featured' ORDER BY p_name ASC") or die("Mission Failed /Query doesnt work.");
$queryOnSale2 = mysqli_query($con_srv, "SELECT p_id, p_name,  p_availability, bdu_product.c_id FROM bdu_product, bdu_category WHERE bdu_product.c_id = bdu_category.c_id AND p_availability='In Store' AND p_status='On Sale' ORDER BY p_name ASC") or die("Mission Failed /Query doesnt work.");
$queryBestRated2 = mysqli_query($con_srv, "SELECT p_id, p_name, p_availability, bdu_product.c_id FROM bdu_product, bdu_category WHERE bdu_product.c_id = bdu_category.c_id AND p_availability='In Store' AND p_status='Best Rated' ORDER BY p_name ASC") or die("Mission Failed /Query doesnt work.");
$queryProducts4 = mysqli_query($con_srv, "SELECT * FROM bdu_product WHERE c_id = ?");
$cate_querry = mysqli_query($con_srv, "SELECT c_id, c_name, c_image FROM bdu_category");
$cate_querry2 = mysqli_query($con_srv, "SELECT c_id, c_name FROM bdu_category");
$cate_querry3 = mysqli_query($con_srv, "SELECT c_id, c_name FROM bdu_category");
$cate_querryFotter = mysqli_query($con_srv, "SELECT c_id, c_name FROM bdu_category");
$queryCategories = mysqli_query($con_srv, "SELECT * FROM bdu_category") or die("Failed to fetch categories.");
$queryCategories2 = mysqli_query($con_srv, "SELECT * FROM bdu_category") or die("Failed to fetch categories.");
$queryProducts = mysqli_prepare($con_srv, "SELECT bdu_product.p_id, bdu_product.p_name, bdu_product.p_image, bdu_product.p_color, bdu_product.p_price, bdu_product.p_status, bdu_product.sale_price, bdu_product.tag, bdu_product.weight, bdu_product.total_review, bdu_product.p_availability, bdu_product.p_description, bdu_product.c_id, bdu_category.c_name 
                                        FROM bdu_product, bdu_category 
                                        WHERE bdu_product.c_id = bdu_category.c_id 
                                        AND bdu_product.p_availability = 'In Store'
                                        AND bdu_product.c_id = ?
                                        AND p_price > 200 
                                        ORDER BY bdu_product.p_name ASC");
?>