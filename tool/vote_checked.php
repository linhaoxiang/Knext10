<?php require_once('../Connections/Conn_kosovo.php');

$aDayTime = 60;
$aYearTime = 365 * 24 * 60 * 60;

if (isset($_COOKIE["user_id"])&&isset($_COOKIE["vote_time"])){
  if(time() > ((int)$_COOKIE["vote_time"])+$aDayTime){
    echo "newSection";
  }else{
    checkVoteVal();
  }
}else{
  echo "newUser";
}

function checkVoteVal(){
  global $database_Conn_kosovo, $Conn_kosovo,$aDayTime;
  mysql_select_db($database_Conn_kosovo, $Conn_kosovo);
  $query_Recordset = sprintf("SELECT * FROM vote_data WHERE vote_user_id=%s AND vote_time>=%s AND vote_time<%s ORDER BY vote_id DESC", GetSQLValueString($_COOKIE["user_id"], "int"), GetSQLValueString($_COOKIE["vote_time"], "int"), GetSQLValueString(((int)$_COOKIE["vote_time"])+$aDayTime, "int"));
  $Recordset = mysql_query($query_Recordset, $Conn_kosovo) or die(mysql_error());
  $row_Recordset = mysql_fetch_assoc($Recordset);
  $totalRows_Recordset = mysql_num_rows($Recordset);

  if($totalRows_Recordset<=0){
    echo "NoRecords";
  }else{
    $return = [];
    do {
      array_push($return, $row_Recordset['vote_data']);
    } while ($row_Recordset = mysql_fetch_assoc($Recordset)); 
    echo json_encode($return);
  }
}

?>