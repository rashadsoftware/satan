<?php
    include("../include/connectDB.php");

    if(isset($_POST["idsubOptions"])){
        $output='';

		$querySubcat_opt=mysqli_query($connect, "SELECT *  FROM merges WHERE merge_key='".$_POST["idsubOptions"]."' ");

        $output.='<option value="">Siyahıdan seçin</option>';
		while($Subcat_optOption_list=mysqli_fetch_array($querySubcat_opt)){
            $querySubopt=mysqli_query($connect, "SELECT *  FROM suboptions WHERE suboptions_id='".$Subcat_optOption_list["merge_value"]."' ");
            $fetchQuerySubopt=mysqli_fetch_array($querySubopt);

            $output.='<option value="'.$fetchQuerySubopt['suboptions_id'].'">'.$fetchQuerySubopt['suboptions_title'].'</option>';
		}

        echo $output;
			
    }

    mysqli_close($connect);
?>
