<?php require_once('../Connections/Conn_kosovo.php');

$aDayTime = 60;
$aYearTime = 365 * 24 * 60 * 60;

if (isset($_COOKIE["user_id"])&&isset($_COOKIE["vote_time"])){
  checkTime();
}else{
  newUser();
}

function newUser(){
  global $database_Conn_kosovo, $Conn_kosovo, $aYearTime;
  $insertSQLhis = sprintf("INSERT INTO vote_user_info (register_time) VALUES (%s)",
                       GetSQLValueString(time(), "int"));
  mysql_select_db($database_Conn_kosovo, $Conn_kosovo);
  $Result1 = mysql_query($insertSQLhis, $Conn_kosovo) or die(mysql_error());
  $lastId = mysql_insert_id();
  setcookie("user_id", $lastId, time()+$aYearTime);
  setcookie("vote_time", time(), time()+$aYearTime);
  echo "newUser:".$lastId;

}

function checkTime(){
  global $aDayTime, $aYearTime;
  if(time()>((int)$_COOKIE["vote_time"])+$aDayTime){
    setcookie("vote_time", time(), time()+$aYearTime);
    addVoteRecord();
    //echo "Update Time ".time()." ;<br/>";
  }else{
    checkVoteExist();
  }
}

function checkVoteExist(){
  global $database_Conn_kosovo, $Conn_kosovo,$aDayTime;
  mysql_select_db($database_Conn_kosovo, $Conn_kosovo);
  $query_Recordset = sprintf("SELECT * FROM vote_data WHERE vote_user_id=%s AND vote_time>=%s AND vote_time<%s  AND vote_data=%s ORDER BY vote_id DESC", GetSQLValueString($_COOKIE["user_id"], "int"), GetSQLValueString($_COOKIE["vote_time"], "int"), GetSQLValueString(((int)$_COOKIE["vote_time"])+$aDayTime, "int"), GetSQLValueString($_POST['val'], "int"));
  $Recordset = mysql_query($query_Recordset, $Conn_kosovo) or die(mysql_error());
  $row_Recordset = mysql_fetch_assoc($Recordset);
  $totalRows_Recordset = mysql_num_rows($Recordset);
  if($totalRows_Recordset>0){
    echo "dataExist";
  }else{
    checkVoteOver();
  }
}

function checkVoteOver(){
  global $database_Conn_kosovo, $Conn_kosovo,$aDayTime;
  mysql_select_db($database_Conn_kosovo, $Conn_kosovo);
  $query_Recordset = sprintf("SELECT * FROM vote_data WHERE vote_user_id=%s AND vote_time>=%s AND vote_time<%s ORDER BY vote_id DESC", GetSQLValueString($_COOKIE["user_id"], "int"), GetSQLValueString($_COOKIE["vote_time"], "int"), GetSQLValueString(((int)$_COOKIE["vote_time"])+$aDayTime, "int"));
  $Recordset = mysql_query($query_Recordset, $Conn_kosovo) or die(mysql_error());
  $row_Recordset = mysql_fetch_assoc($Recordset);
  $totalRows_Recordset = mysql_num_rows($Recordset);
  if($totalRows_Recordset<3){
    addVoteRecord();
  }else{
    echo "dataExcess";
  }
  //echo $query_Recordset;
  //echo "<br/>".$totalRows_Recordset."<br/>";
}

function addVoteRecord(){
  global $database_Conn_kosovo, $Conn_kosovo;
  $insertSQLnew = sprintf("INSERT INTO vote_data (vote_user_id, vote_data, vote_time) VALUES (%s, %s, %s)",
                       GetSQLValueString($_COOKIE["user_id"], "int"),
                       GetSQLValueString($_POST['val'], "int"),
                       GetSQLValueString(time(), "int"));
  mysql_select_db($database_Conn_kosovo, $Conn_kosovo);
  $Result1 = mysql_query($insertSQLnew, $Conn_kosovo) or die(mysql_error());
  echo "true";
}

?>