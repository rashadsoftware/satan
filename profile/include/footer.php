        <footer>
			<div class="container">
				<div class="row">
					<div class="footer-content">
						<h1><?php echo $company['company_name']; ?></h1>
						<p>Saytın rəhbərliyi reklam bannerlərinin və yerləşdirilmiş elanların məzmununa şəklillərinə görə məsuliyyət daşımır</p>
						<!--
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
						-->
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

        <!-- Bootstrap JS -->
        <script src="../assets/js/main2.js"></script>
        <script src="../assets/js/profile3.js"></script>	

		<script>
			$(function(){
				// header area
				var headerHeight = $("header").height();
				$("#head-section").css("padding-top", headerHeight);

				$(window).scroll(function () {
					if ($(this).scrollTop() > 0) {
						$("header").addClass("active");
						$(".scrollUp").fadeIn();
					} else {
						$("header").removeClass("active");
						$(".scrollUp").fadeOut();
					}
				});
			});
		</script>
    </body>
</html>