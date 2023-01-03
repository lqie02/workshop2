<?php include('../includes/DatabaseClass.php'); 
$db = new DatabaseClass (); 


 if($_POST['sm']){
    $json = array();
   

    if(!$_POST['category_id']){
       $query = $db->query("INSERT INTO category SET categoryName = '" . $db->escape($_POST['categoryName'])."', description = '" . $db->escape($_POST['description']) ."'");

        $json['success'] = 'Success Add';
	    header('Content-Type: application/json; charset=utf-8');
	    echo json_encode($json);
    }else{

    	$query = $db->query("UPDATE category SET categoryName = '" . $db->escape($_POST['categoryName'])."', description = '" . $db->escape($_POST['description']) ."' WHERE category_id='".(int)$_POST['category_id']."'");

    	 $json['success'] = 'Success Save';
	     header('Content-Type: application/json; charset=utf-8');
	     echo json_encode($json);
    }


    exit();
 }

?>