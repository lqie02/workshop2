
<?php 
include('../connection.php');

 if($_POST['sm']){
    $json = array();
   

    if(!$_POST['category_id']){
       $query = mysqli_query($conn,"INSERT INTO category SET categoryName = '" . $_POST['categoryName']."', description = '" .$_POST['description'] ."'");

       $row = mysqli_insert_id($conn);


        $json['success'] = 'Success Add';
	    header('Content-Type: application/json; charset=utf-8');
	    echo json_encode($json);
    }else{

    	$query_update = mysqli_query($conn,"UPDATE category SET categoryName = '" . $_POST['categoryName']."', description = '" . $_POST['description'] ."' WHERE category_id='".(int)$_POST['category_id']."'");

      //$roww = mysqli_fetch_assoc($query_update);

    	 $json['success'] = 'Success Save';
	     header('Content-Type: application/json; charset=utf-8');
	     echo json_encode($json);
    }


    exit();
 }

?>