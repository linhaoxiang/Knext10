<?php require_once('../Connections/Conn_kosovo.php');

$aDayTime = 60;
$aYearTime = 365 * 24 * 60 * 60;

if (isset($_COOKIE["user_id"])&&isset($_COOKIE["vote_time"])){
  if(time() > ((int)$_COOKIE["vote_time"])+$aDayTime){
    echo "newSection";
  }else{
    removeData();
  }
}else{
  echo "newUser";
}

function removeData(){
  global $database_Conn_kosovo, $Conn_kosovo, $aDayTime;
   $deleteSQL = sprintf("DELETE FROM vote_data WHERE vote_user_id=%s AND vote_time>=%s AND vote_time<%s  AND vote_data=%s", 
                            GetSQLValueString($_COOKIE["user_id"], "int"), 
                            GetSQLValueString($_COOKIE["vote_time"], "int"), 
                            GetSQLValueString(((int)$_COOKIE["vote_time"])+$aDayTime, "int"), 
                            GetSQLValueString($_POST['val'], "int"));
  mysql_select_db($database_Conn_kosovo, $Conn_kosovo);
  $Result1 = mysql_query($deleteSQL, $Conn_kosovo) or die(mysql_error());

  echo "true";
}
?>