<?php 
 include("../../db-connect/notfound.php");


  $querystr = $_POST['p_name'];
  //$querystr = 'digital';
	if(@$_GET['type'] == 'product'){

		if(empty($querystr)){

			$results['error'] = true;

		}else{

			$sql = "SELECT p_name,p_photo,p_keyword FROM product WHERE p_name LIKE '%".$querystr."%' AND p_category != '394' AND status='2' ORDER BY p_name ASC";

			$sqlquery = $con->query($sql);
 

			if($sqlquery->num_rows > 0){

				while($ldata = $sqlquery->fetch_assoc()){

					$results['data'] .= "

            			<li class='list-gpfrm-list' style='padding: 8 15; border: 1px solid #cecece;' data-fullname='".$ldata['p_name']."'><img style='width: 40px; height: 40px; margin-right: 15px;' src='productlogo/".$ldata['p_photo']."'>".$ldata['p_name']."</li>
					";

				}

			}

			else{
        
				$results['data'] = "

					<font class='list-gpfrm-list'>No found data matches Records</font>

				";

			}

		}
		echo json_encode($results);
	}
	else{
		if(empty($querystr)){

			$results['error'] = true;

		}else{

			$sql = "SELECT p_name,p_photo,p_keyword FROM product WHERE p_name LIKE '%".$querystr."%' AND p_category = '394' AND status='2' ORDER BY p_name ASC";

			$sqlquery = $con->query($sql);


			if($sqlquery->num_rows > 0){

				while($ldata = $sqlquery->fetch_assoc()){

					$results['data'] .= "

            <li class='list-gpfrm-list' style='padding: 8 15; border: 1px solid #cecece;' data-fullname='".$ldata['p_name']."'><img style='width: 40px; height: 40px; margin-right: 15px;' src='productlogo/".$ldata['p_photo']."'>".$ldata['p_name']."</li>
					";

				}

			}

			else{
        
				$results['data'] = "

					<font class='list-gpfrm-list'>No found data matches Records</font>

				";

			}

		}
		echo json_encode($results);
	}
    //echo $results;
		

  
 
 
 
 
 ?>