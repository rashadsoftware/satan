<?php
	
	if(isset($_POST["idElan"])){

        $id=$_POST["idElan"];
		
		include("../include/connectDB.php");
		
        $elan_list=mysqli_query($connect, "SELECT *  FROM elan WHERE elan_id='$id' ");
        $elan=mysqli_fetch_array($elan_list);

        echo $elan["elan_id"];
        
        mysqli_close($connect);
	}
	
?>