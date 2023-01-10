<?php
// compensate for magic quotes if necessary
if (get_magic_quotes_gpc()){
  function _stripslashes_rcurs($variable, $top = true){
    $clean_data = array();
    foreach ($variable as $key => $value){
      $key = ($top) ? $key : stripslashes($key);
      $clean_data[$key] = (is_array($value)) ?
      _stripslashes_rcurs($value, false) : stripslashes($value);
    }
    return $clean_data;
  }

  $_GET     = _stripslashes_rcurs($_GET);
  $_POST    = _stripslashes_rcurs($_POST);
  $_REQUEST = _stripslashes_rcurs($_REQUEST);
  // $_COOKIE = _stripslashes_rcurs($_COOKIE);
}

//MYSQL
function quote_smart($value)
{
   if( is_array($value) ) {
       return array_map("quote_smart", $value);
   } else {
       if( get_magic_quotes_gpc() ) {
           $value = stripslashes($value);
       }
       if( $value == '' ) {
           $value = '';
       } if( !ctype_digit($value) || $value[0] == '0' ) {
           $value = "'".mysql_real_escape_string($value)."'";
       }
       return $value;
   }
}
//////insert and update//////
function sql_perform($table, $data, $action = 'insert', $parameters = ''){
  reset($data);

  if ($action == 'insert'){
    $query = 'insert into ' . $table . ' (';
    while (list($columns, ) = each($data)) {
      $query .= $columns . ', ';
    }
     $query = substr($query, 0, -2) . ') values (';
    reset($data);
    while (list(, $value) = each($data)) {
      switch ((string)$value) {
        case 'now()':
          $query .= 'now(), ';
          break;
        case 'null':
          $query .= 'null, ';
          break;
        default:
          $query .= quote_smart($value).", ";
          break;
      }
    }
    
    $query = substr($query, 0, -2) . ')';
  } elseif ($action == 'update') {
    $query = 'update ' . $table . ' set ';
    while (list($columns, $value) = each($data)) {
      switch ((string)$value) {
        case 'now()':
          $query .= $columns . ' = now(), ';
          break;
        case 'null':
          $query .= $columns .= ' = null, ';
          break;
        default:
          $query .= $columns." = ".quote_smart($value).", ";
          break;
      }
    }
    $query = substr($query, 0, -2) . ' where ' . $parameters;
  }
	//return ($query);

	return sql_query($query);
}
//////end of insert and update//////

function sql_query($query = ""){
  //echo $query."<br>";
  return mysql_query($query);		
}
//end MySQL

function pagesbutton($filename, $query, $go, $off, $path, $default){
	// config-------------------------------------
	$option = array (5, 10, 25, 50, 100, 200);
	//$default = 10; // default number of records per page
	$action = $_SERVER['PHP_SELF']; // if this doesn't work, enter the filename
	// end config---------------------------------

	// paranoid
	if ($go == "") {
	$go = $default;
	}
	elseif (!in_array ($go, $option)) {
	$go = $default;
	}
	elseif (!is_numeric ($go)) {
	$go = $default;
	}
	$nol = $go;
	$limit = "0, $nol";
	$count = 1;

	// control query------------------------------
	/* this query checks how many records you have in your table.
	I created this query so we could be able to check if user is
	trying to append number larger than the number of records
	to the query string.*/
	$off_sql = mysql_query ("$query") or die ("Error in query: $off_sql".mysql_error());
	$off_pag = ceil (mysql_num_rows($off_sql) / $nol);
	//--------------------------------------------

	//paranoid
	if (get_magic_quotes_gpc() == 0) {
	$off = addslashes ($off);
	}
	if (!is_numeric ($off)) {
	$off = 1;
	}
	// this checks if user is trying to put something stupid in query string
	if ($off > $off_pag) {
	$off = 1;
	}

	if ($off == "1") {
	$limit = "0, $nol";
	}
	elseif ($off <> "") {
	for ($i = 0; $i <= ($off - 1) * $nol; $i ++) {
	$limit = "$i, $nol";
	$count = $i + 1;
	}
	}

	if ($off <> 1) {
	$prev = $off - 1;
	$prevarrow = "&lt; <a href=\"$filename?offset=$prev&amp;go=$go".$path."\">prev</a>";
	}

	$thispage = '';
	$i = 1;
	if($off) $i = $off;
	$until = $off + 5;
	if($until > $off_pag)$until = $off_pag;
	$from = $off - 5;
	if($from < 1) $from = 1;
	for ($i = $from; $i <= $until; $i ++) {
	if ($i == $off) {
	$thispage .="<b> $i </b>|";
	} else {
	$thispage .=" <a href=\"$filename?offset=$i&amp;go=$go".$path."\">$i</a> |";
	}
	}

	if ($off < $off_pag) {
	$next = $off + 1;
	$nextarrow = "<a href=\"$filename?offset=$next&amp;go=$go".$path."\">next</a> &gt;";
	}

	$totalpage = mysql_num_rows($off_sql);
	$thispage = trim($thispage, '|');


  return array($prevarrow, $thispage, $nextarrow, $totalpage, $limit);
}

function refreshback($topage){
  echo '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Blank Page</title>
<meta http-equiv="Refresh" content="0;URL='.$topage.'" />
</head>

<body>
</body>
</html>
  ';
  exit();
}

//check file extension
function get_ext($key) { 
  $key=strtolower($key);
  $key=substr(strrchr($key, "."), 1);
  return($key); 
}

function popupNredirect($msgtext,$topage){
  echo '
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Alert!</title>
</head>
<SCRIPT LANGUAGE="JavaScript">
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location=\'"+args[i+1]+"\'");
}
  alert("'.htmlspecialchars($msgtext).'");
</SCRIPT>
<body onload="MM_goToURL(\'parent\',\''.$topage.'\');return document.MM_returnValue">
</body>
</html>
	';
  exit();
}

function uploadFiles($directory,$filename,$newname) {
	$thisdirectory = '';
	$message = '';

	$imgext = '.'.get_ext($_FILES[$filename]['name']);
	create_dir($directory);
	$my_upload = new file_upload;
	$my_upload->upload_dir = $directory;
	$my_upload->extensions = array($imgext);
	$my_upload->max_length_filename = 50;
	$my_upload->rename_file = true;
	$my_upload->the_temp_file = $_FILES[$filename]['tmp_name'];
	$my_upload->the_file = $_FILES[$filename]['name'];
	$my_upload->http_error = $_FILES[$filename]['error'];
	$my_upload->replace = (isset($replace)) ? $replace : "y";
	$new_name = (isset($newname)) ? $newname : "";
	if($my_upload->upload($new_name)){
		$full_path = $my_upload->upload_dir.$my_upload->file_copy;
		$uploadyes = true;
	}else{
		$message = $my_upload->show_error_string();
		$uploadyes = false;
	}

	if($uploadyes == true){

		$thisdirectory = $newname.$imgext;
	}else{
		if(is_file($directory.$newname.$imgext))
			unlink($directory.$newname.$imgext);
	}
	return array($message, $thisdirectory);
}

function create_dir($directory) {
	if (!is_dir($directory)) {
		umask(0);
		mkdir($directory, 0777);
		return true;
	} else {
		return true;
	}
}

function remove_querystring_var($url, $key='', $query='') {
  $newvar = '';
  if(!is_array($key)){
    $key[] ='';
  }
  foreach ($url as $varname => $varvalue){
    if(!in_array($varname, $key)){
      if(is_array($url[$varname])){
        foreach ($url[$varname] as $arrvalue){
          if($arrvalue){
            $newvar .= ($query == 'input') ? '<input name="'.$varname.'[]" type="hidden" value="'.$arrvalue.'" />' : $varname.'[]='.$arrvalue.'&';
          }
        }
      }else{
        if($varvalue)
          $newvar .= ($query == 'input') ? '<input name="'.$varname.'" type="hidden" value="'.$varvalue.'" />' : $varname.'='.$varvalue.'&';
      }
    }
  }
  return trim($newvar, "&");
}

function unhtmlspecialchars($string){
  $string = str_replace ( '&amp;', '&', $string );
  $string = str_replace ( ' ', '+', $string );

  return $string;
}


function DisplayBanner($url,$banner,$imagepath,$width){
  $exttypes = array("swf");
  $ext = get_ext($banner);
  if(is_file($imagepath.$banner)){

    if(!in_array($ext, $exttypes)){
      $returnthis = '<img src="phpThumb.php?src='.$imagepath.$banner.'&w='.$width.'" />';
      if($ext == 'gif'){
        $returnthis = '<img src="'.$imagepath.$banner.'" width="'.$width.'" />';
      } 
    }else{
      list($swf_width, $swf_height) = getimagesize($imagepath.$banner);
      $getpercent = $swf_width / $width;
      $newheight = round($swf_height / $getpercent);

      $returnthis =  '
          <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="'.$width.'"height="'.$newheight.'">
          <param name="movie" value="'.$imagepath.$banner.'" />
          <param name="quality" value="high" />
          <param name="wmode" value="opaque" /> 
          <embed src="'.$imagepath.$banner.'" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="'.$width.'"height="'.$newheight.'" wmode="opaque"></embed>
          </object>
      ';
    }
  }
  if($url){
    $returnthis = '<a href="'.$url.'">'.$returnthis.'</a>';
  }

  return $returnthis;
}

?>