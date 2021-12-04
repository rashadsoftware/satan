<footer>
			<div class="container">
				<div class="row">
					<div class="footer-content">
						<h1><?php echo $company['company_name']; ?></h1>
						<p>Saytın rəhbərliyi reklam bannerlərinin və yerləşdirilmiş elanların məzmununa şəklillərinə görə məsuliyyət daşımır</p>
						<ul class="custom">
							<?php
								$configs_listr=mysqli_query($connect, "SELECT * FROM configs WHERE configs_type='social' ");
								while($countconfigs=mysqli_fetch_array($configs_listr)){ 
									if($countconfigs['configs_value'] != ""){ ?>
										<li><a href="<?php  echo $countconfigs['configs_value']; ?>" target="_blank"><?php  echo $countconfigs['configs_icon']; ?></a></li>
							<?php	}
								}									
							?>
						</ul>
					</div>
				</div>
			</div>
			<div class="footer-bottom">
				<div class="container h-100">
					<div class="row h-100">
						<div class="flex-between-center">
							<p class="mb-0 px-3 text-center">Copyright &copy; 2020-<?php echo date("Y") ?> <?php echo $company["company_name"] ?> | Bütün Hüquqlar Qorunur</p>
							<ul class="custom">
								<li><a href="index">Ana Səhifə</a></li>
                                <li><a href="about">Haqqımızda</a></li>
								<li><a href="rules">Qaydalar</a></li>
                                <li><a href="contact">Əlaqə</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</footer>
		<div class="preloader">
			<img src="img/icons/loading.gif" alt="loading">
		</div>

		<!-- Swiper JS -->
		<script src="plugin/swiper/swiper-bundle.js"></script>
		<!-- Isotope JS -->
		<script src="plugin/isotope/isotope.pkgd.js"></script>
		<!-- Fancybox JS -->
		<script src="plugin/fancybox/jquery.fancybox.js"></script>
		<!-- Watermark JS -->
		<script src="plugin/watermark/jquery.watermark.js"></script>
		<!-- OwlCarousel2-2.3.4 -->
		<script src="plugin/OwlCarousel2-2.3.4/owl.carousel.js"></script>
		<!-- summernote js -->
		<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
		
        <script src="js/main2.js"></script>

		<script>
			// jquery 
			$(function(){
				// watermark js
				$(".center_watermark").watermark({
					path: '../img/watermark.png',
					gravity: 'c',
					opacity: 1,
					textBg:'transparent',
					outputHeight:'auto',
					outputWidth:'auto',
					margin:0

				});
				$(".center_watermark_all").watermark({
					path: '../img/watermark.png',
					gravity: 'c',
					opacity: 1,
					textBg:'transparent',
					outputHeight:'auto',
					outputWidth:'auto',
					margin:0

				});

				// jquery
				$(".heart").click(function () {
					var idImgFavorites = $(this).attr("id");

					$.ajax({
						method: "POST",
						url: "php/addtoBookmark.php",
						data: { idImgFavorites: idImgFavorites },
						dataType: "json",
						success: function (data) {
							if (data.ok == "ok") {
								document.getElementById(data.id).src = "img/icons/heart_full.png";
							} else {
								document.getElementById(data.id).src = "img/icons/heart_empty.png";
							}
						},
					});
				});

				// view data in add detail page
				$(".view-data").click(function () {
					var idAdd = $(this).attr("id");

					$.ajax({
						method: "POST",
						url: "php/fetchAddCart.php",
						data: { idAdd: idAdd },
						dataType: "json",
						success: function (data) {
							$("#exampleModalLabel").text(data.title);
							$("#textAdd").html(data.text);
							$("#priceAdvert").html(data.price);
							$("#exampleModal").modal("show");
						},
					});
				});
			});
		</script> 
    </body>
</html>
<?php
    mysqli_close($connect);
?>