<?php
    include("../include/connectDB.php");

    if(isset($_POST["idsubCategory"])){
		echo '<link rel="stylesheet" href="./css/bootstrap.css">';
        $output='';

		$querySubcat_opt=mysqli_query($connect, "SELECT *  FROM options WHERE subcategory_id='".$_POST["idsubCategory"]."' ");

		while($Subcat_optOption_list=mysqli_fetch_array($querySubcat_opt)){
			$queryoptions=mysqli_query($connect, "SELECT *  FROM options WHERE options_id='".$Subcat_optOption_list["options_id"]."' ");

			while($options=mysqli_fetch_array($queryoptions)){
				$type=$options["options_type"];
				
				if($type == "select"){
					$output.='

						<div class="form-group">
							<label for="'.str_replace("-","_",$options["options_seflink"]).'">'.$options["options_title"].'</label>
							<select class="form-control" id="'.str_replace("-","_",$options["options_seflink"]).'" name="optionsAdd[]" required>
								<option value="">Siyahıdan seçin</option> ';
								$options_id=$options["options_id"];
								
								$subquery=mysqli_query($connect, "SELECT *  FROM suboptions WHERE options_id='$options_id' ");
								while($suboptions=mysqli_fetch_array($subquery)){
									$output.='
										<option value="'.$suboptions['suboptions_id'].'">'.$suboptions['suboptions_title'].'</option>
									';
								}
								
			$output.='          
							</select>
						</div>
					';
				} else if($type == "text"){
					$output.='
						<div class="form-group">
							<label for="'.str_replace("-","_",$options["options_seflink"]).'">'.$options["options_title"].'</label>
							<input 
								type="'.$options["options_security"].'" 
								class="form-control" 
								id="'.str_replace("-","_",$options["options_seflink"]).'" 
								name="optionsAdd[]"
								required>
						</div>
					';
				}
	   
			}
		}
		

        echo $output;
		echo '<script src="./js/jquery-3.6.0.js" ></script>
		<script src="./js/bootstrap.js" ></script>
		<script>
			$(function(){
				// dependent select option with ajax
				$("#geyimin_tipi").on("change", function () {
					var idsubOptions = $(this).val();

					$.ajax({
						type: "POST",
						url: "php/fetchSubOptions.php",
						data: { idsubOptions: idsubOptions },
						success: function (data) {
							$("#geyimin_novu").html(data);
						},
					});
				});

				$("#marka").on("change", function () {
					var idsubOptions = $(this).val();

					$.ajax({
						type: "POST",
						url: "php/fetchSubOptions.php",
						data: { idsubOptions: idsubOptions },
						success: function (data) {
							$("#model").html(data);
						},
					});
				});
			});
		</script>';
    } else {

    }

    mysqli_close($connect);
?>
