<footer class="footer">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 footer_col">
				<div class="footer_column footer_contact">
					<div class="logo_container">
						<div class="logo"><a href="#">OneTech</a></div>
					</div>
					<div class="footer_title">Got Question? Call Us 24/7</div>
					<div class="footer_phone">+2519 0817 0601</div>
					<div class="footer_contact_text">
						<p>Piassa, Addis Ababa</p>
						<p>Arada Giorgis Addiss Ababa, Ethiopia</p>
					</div>
					<div class="footer_social">
						<ul>
							<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
							<li><a href="#"><i class="fab fa-twitter"></i></a></li>
							<li><a href="#"><i class="fab fa-youtube"></i></a></li>
							<li><a href="#"><i class="fab fa-google"></i></a></li>
							<li><a href="#"><i class="fab fa-vimeo-v"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-lg-2 offset-lg-2">
				<div class="footer_column">
					<div class="footer_title">Find it Fast</div>
					<ul class="footer_list">
						<?php
						include_once 'dbselect.inc';
						$selected = $db_selected;
	   				    $num_rows_c = mysqli_num_rows($cate_querryFotter);
						while ($rowc2 = mysqli_fetch_array($cate_querryFotter)) {
							$catid2 = $rowc2['c_id'];
							$catname2 = $rowc2['c_name'];
						?>
							<li><a target="_blank" href="category.php?category=<?php echo $catid2; ?>"><?php echo " $catname2"; ?></a></li>
						<?php } ?>
					</ul>
				</div>
			</div>
			<div class="col-lg-2">
				<div class="footer_column">
					<ul class="footer_list footer_list_2">
						<li><a href="#">Video Games & Consoles</a></li>
						<li><a href="#">Accessories</a></li>
						<li><a href="#">Cameras & Photos</a></li>
						<li><a href="#">Hardware</a></li>
						<li><a href="#">Computers & Laptops</a></li>
					</ul>
				</div>
			</div>
			<div class="col-lg-2">
				<div class="footer_column">
					<div class="footer_title">Customer Care</div>
					<ul class="footer_list">
						<li><a href="#">My Account</a></li>
						<li><a href="#">Order Tracking</a></li>
						<li><a href="#">Wish List</a></li>
						<li><a href="#">Customer Services</a></li>
						<li><a href="#">Returns / Exchange</a></li>
						<li><a href="#">FAQs</a></li>
						<li><a href="#">Product Support</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</footer>