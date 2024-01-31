	<header class="header">
		<!-- Top Bar -->
		<div class="top_bar">
			<div class="container">
				<div class="row">
					<div class="col d-flex flex-row">
						<div class="top_bar_contact_item">
							<div class="top_bar_icon"><img src="images/phone.png" alt=""></div>+2519 0817 0601
						</div>
						<div class="top_bar_contact_item">
							<div class="top_bar_icon"><img src="images/mail.png" alt=""></div><a href="mailto:fastsales@gmail.com">fastsales@gmail.com</a>
						</div>
						<div class="top_bar_content ml-auto">
							<div class="top_bar_menu">
								<ul class="standard_dropdown top_bar_dropdown">
									<li>
										<?php
										// Define an array of available languages
										$languages = [
											'Amharic' => 'Am',
											'English' => 'en',
											'Italian' => 'it',
											'Spanish' => 'es',
											'Japanese' => 'ja'
										];
										// Check if a language selection has been made
										if (isset($_GET['lang'])) {
											$selectedLang = $_GET['lang'];
										} else {
											// Default language if no selection is made
											$selectedLang = 'Am';
										}
										?>
										<a href="#"><?php echo $selectedLang; ?><i class="fas fa-chevron-down"></i></a>
										<ul>
											<?php foreach ($languages as $language => $code) { ?>
												<li><a href="?lang=<?php echo $code; ?>"><?php echo $language; ?></a></li>
											<?php } ?>
										</ul>
									</li>
									<li>
										<?php
										// Define an array of available Money type
										$languages = [
											'Ethiopian Birr' => 'Birr',
											'EUR Euro' => 'Euro',
											'$ US dollar' => '$ dollar',
											'GBP British Pound' => 'Pound',
											'JPY Japanese Yen' => 'Yen'
										];
										// Check if a Money type selection has been made
										if (isset($_GET['money'])) {
											$selectedLang = $_GET['money'];
										} else {
											// Default Money type if no selection is made
											$selectedLang = 'Birr';
										}
										?>
										<a href="#"><?php echo $selectedLang; ?><i class="fas fa-chevron-down"></i></a>
										<ul>
											<?php foreach ($languages as $language => $code) { ?>
												<li><a href="?money=<?php echo $code; ?>"><?php echo $language; ?></a></li>
											<?php } ?>
										</ul>
									</li>
								</ul>
							</div>
							<div class="top_bar_user">
								<div class="user_icon"><img src="images/user.svg" alt=""></div>
								<div><a href="my-account.php#register">Register</a></div>
								<div><a href="my-account.php#login">Sign in</a></div>
								<a href="logout.php">Logout</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Header Main -->
		<div class="header_main">
			<div class="container">
				<div class="row">
					<!-- Logo -->
					<div class="col-lg-2 col-sm-3 col-3 order-1">
						<div class="logo_container">
							<div class="logo"><a href="#">OneTech</a></div>
						</div>
					</div>
					<!-- Search -->
					<div class="col-lg-6 col-12 order-lg-2 order-3 text-lg-left text-right">
						<div class="header_search">
							<div class="header_search_content">
								<div class="header_search_form_container">
									<form action="search.php" method="GET" class="header_search_form clearfix"> <!-- Specify the search.php as the action and use GET method -->
										<input type="search" name="search" required="required" class="header_search_input" placeholder="Search products..."> <!-- Add the name attribute to the input field -->
										<div class="custom_dropdown">
											<div class="custom_dropdown_list">
												<span class="custom_dropdown_placeholder clc">All Categories</span>
												<i class="fas fa-chevron-down"></i>
												<ul class="custom_list clc">
													<li><a class="clc" href="search.php">All Categories</a></li> <!-- Link to search.php for All Categories -->
													<?php
													include_once 'dbselect.inc';
													$selected = $db_selected;
													$num_rows_c = mysqli_num_rows($cate_querry);
													while ($rowc = mysqli_fetch_array($cate_querry)) {
														$catid = $rowc['c_id'];
														$catname = $rowc['c_name'];
													?>
														<li><a class="clc" href="search.php?category=<?php echo $catid; ?>"><?php echo $catname; ?></a></li> <!-- Link to search.php with category parameter -->
													<?php } ?>
												</ul>
											</div>
										</div>
										<button type="submit" class="header_search_button trans_300" value="Submit"><img src="images/search.png" alt=""></button>
									</form>
								</div>
							</div>
						</div>
					</div>
					<!-- Wishlist -->
					<div class="col-lg-4 col-9 order-lg-3 order-2 text-lg-left text-right">
						<div class="wishlist_cart d-flex flex-row align-items-center justify-content-end">
							<div class="wishlist d-flex flex-row align-items-center justify-content-end">
								<div class="wishlist_icon"><img src="images/heart.png" alt=""></div>
								<div class="wishlist_content">
									<div class="wishlist_text"><a href="#">Wishlist</a></div>
									<div class="wishlist_count">115</div>
								</div>
							</div>
							<!-- Cart -->
							<?php
							ini_set('precision', 8);
							if (isset($_SESSION["cart_item"])) {
								$total_quantity = 0;
								$total_price = 0;
								foreach ($_SESSION["cart_item"] as $item) {
									$item_price = $item["quantity"] * $item["sale_price"];
									$total_quantity += $item["quantity"];
									$total_price += ($item["sale_price"] * $item["quantity"]);
								}
							?>
							
								<div class="cart">
									<div class="cart_container d-flex flex-row align-items-center justify-content-end">
										<div class="cart_icon">
											<img src="images/cart.png" alt="">
											<div class="cart_count"><span><?php echo $total_quantity;?></span></div>
										</div>
										<div class="cart_content">
											<div class="cart_text"><a href="cart.php">Cart</a></div>
											<div class="cart_price"><?php echo  "$$total_price"; ?></div>
										</div>
									</div>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Main Navigation -->
		<nav class="main_nav">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="main_nav_content d-flex flex-row">
							<!-- Categories Menu -->
							<div class="cat_menu_container">
								<div class="cat_menu_title d-flex flex-row align-items-center justify-content-start">
									<div class="cat_burger"><span></span><span></span><span></span></div>
									<div class="cat_menu_text">categories</div>
								</div>
								<ul class="cat_menu">
									<?php
									include_once 'dbselect.inc';
									$selected = $db_selected;
									$num_rows_c = mysqli_num_rows($cate_querry2);
									while ($rowc = mysqli_fetch_array($cate_querry2)) {
										$catid = $rowc['c_id'];
										$catname = $rowc['c_name'];
									?>
										<li><a class="clc" href="category.php?category=<?php echo $catid; ?>"><?php echo $catname; ?></a></li> <!-- Link to search.php with category parameter -->
									<?php } ?>
								</ul>
							</div>
							<!-- Main Nav Menu -->
							<div class="main_nav_menu ml-auto">
								<ul class="standard_dropdown main_nav_dropdown">
									<li><a href="index.php">Home<i class="fas fa-chevron-down"></i></a></li>
									<li class="hassubs">
										<a href="index.php#products">products<i class="fas fa-chevron-down"></i></a>
										<ul class="horizontal-category-list" style="display: flex; list-style: none; padding: 0; margin: 0;">
											<?php
											include_once 'dbselect.inc';
											$selected = $db_selected;
											$num_rows_c = mysqli_num_rows($cate_querry3);
											while ($rowc2 = mysqli_fetch_array($cate_querry3)) {
												$catid2 = $rowc2['c_id'];
												$catname2 = $rowc2['c_name'];
											?>
												<li style="margin-right: 10px;">
													<a target="_blank" href="category.php?category=<?php echo $catid2; ?>"><?php echo $catname2; ?><i class="fas fa-chevron-right"></i></a>
													<ul>
														<?php
														// Retrieve the products for the current category
														$queryProducts4 = mysqli_prepare($con_srv, "SELECT * FROM bdu_product WHERE c_id = ?");
														mysqli_stmt_bind_param($queryProducts4, 'i', $catid2);
														mysqli_stmt_execute($queryProducts4);
														$resultProducts = mysqli_stmt_get_result($queryProducts4);
														// Loop through the products and display them
														while ($rowProduct = mysqli_fetch_array($resultProducts)) {
															$productId = $rowProduct['p_id'];
															$productName = $rowProduct['p_name'];
															// Retrieve other product information
															// Display the product information
															echo '<li><a target="_blank" href="singleproduct.php?pid=' . $productId . '">' . $productName . '</a></li>';
														}
														// Close the prepared statement
														mysqli_stmt_close($queryProducts4);
														?>
													</ul>
												</li>
											<?php } ?>
											<li>
										</ul>
									<li class="hassubs">
										<a href="#">Super Deals<i class="fas fa-chevron-down"></i></a>
										<ul>
											<li>
												<a href="#">Featured<i class="fas fa-chevron-down"></i></a>
												<ul>
													<?php
													include_once 'dbselect.inc';
													$selected = $db_selected;
													$num_rows_c = mysqli_num_rows($queryFeatured22);
													while ($rowc2 = mysqli_fetch_array($queryFeatured22)) {
														$pid2 = $rowc2['p_id'];
														$pname2 = $rowc2['p_name'];
													?>
														<li><a href="singleproduct.php?pid=<?php echo $pid2; ?>"><?php echo $pname2; ?><i class="fas fa-chevron-down"></i></a></li>
													<?php } ?>
												</ul>
											</li>
											<li>
												<a href="#">On Sale<i class="fas fa-chevron-down"></i></a>
												<ul>
													<?php
													include_once 'dbselect.inc';
													$selected = $db_selected;
													$num_rows_c = mysqli_num_rows($queryOnSale2);
													while ($rowc2 = mysqli_fetch_array($queryOnSale2)) {
														$pid2 = $rowc2['p_id'];
														$pname2 = $rowc2['p_name'];
													?>
														<li><a href="singleproduct.php?pid=<?php echo $pid2; ?>"><?php echo $pname2; ?><i class="fas fa-chevron-down"></i></a></li>
													<?php } ?>
												</ul>
											</li>
											<li>
												<a href="#">Best Rated<i class="fas fa-chevron-down"></i></a>
												<ul>
													<?php
													include_once 'dbselect.inc';
													$selected = $db_selected;
													$num_rows_c = mysqli_num_rows($queryBestRated2);
													while ($rowc2 = mysqli_fetch_array($queryBestRated2)) {
														$pid2 = $rowc2['p_id'];
														$pname2 = $rowc2['p_name'];
													?>
														<li><a href="singleproduct.php?pid=<?php echo $pid2; ?>"><?php echo $pname2; ?><i class="fas fa-chevron-down"></i></a></li>
													<?php } ?>
												</ul>
											</li>
										</ul>
									</li>
									<li class="hassubs">
										<a href="#">Featured Brands<i class="fas fa-chevron-down"></i></a>
										<ul>
											<li>
												<?php
												include_once 'dbconnect.inc';
												$queryFeatured4 = mysqli_query($con_srv, "SELECT p_id, p_name, p_image, p_color, p_price, p_status, sale_price, tag, weight, total_review, p_availability, p_description, bdu_product.c_id FROM bdu_product, bdu_category WHERE bdu_product.c_id = bdu_category.c_id AND p_availability='In Store' AND p_status='Featured' ORDER BY p_name ASC") or die("Mission Failed /Query doesnt work.");
												$selected = $db_selected;
												$num_rows_c = mysqli_num_rows($queryFeatured4);
												while ($rowc2 = mysqli_fetch_array($queryFeatured4)) {
													$productId = $rowc2['p_id'];
													$productName = $rowc2['p_name'];
													// Display the product information
													echo '<li><a target="_blank" href="singleproduct.php?pid=' . $productId . '">' . $productName . '</a></li>';
												}
												?>
										</ul>
									</li>
									<li class="hassubs">
										<a href="#">Pages<i class="fas fa-chevron-down"></i></a>
										<ul>
											<li><a href="shop.php">Shop<i class="fas fa-chevron-down"></i></a></li>
											<li><a href="index.php#products">Product<i class="fas fa-chevron-down"></i></a></li>
											<li><a href="blog.php">Blog<i class="fas fa-chevron-down"></i></a></li>
											<li><a href="blog_single.php">Blog Post<i class="fas fa-chevron-down"></i></a></li>
											<li><a href="regular.php">Regular Post<i class="fas fa-chevron-down"></i></a></li>
											<li><a href="cart.php">Cart<i class="fas fa-chevron-down"></i></a></li>
											<li><a href="contact.php#contact_form">Contact<i class="fas fa-chevron-down"></i></a></li>
										</ul>
									</li>
									<li><a href="blog.php">Blog<i class="fas fa-chevron-down"></i></a></li>
									<li><a href="contact.php#contact_form">Contact<i class="fas fa-chevron-down"></i></a></li>
								</ul>
								<?php ?>
								<!-- Menu Trigger -->
								<div class="menu_trigger_container ml-auto">
									<div class="menu_trigger d-flex flex-row ali<!-- Menu Trigger -->gn-items-center justify-content-end">
										<div class="menu_burger">
											<div class="menu_trigger_text">menu</div>
											<div class="cat_burger menu_burger_inner"><span></span><span></span><span></span></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
		</nav>
	</header>