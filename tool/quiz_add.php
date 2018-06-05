<?php require_once('../Connections/Conn_kosovo.php');

$userID = NULL;

if (isset($_COOKIE["user_id"])){
  $userID = $_COOKIE["user_id"];
}

if (isset($_POST['val'])){
  addQuizRecord();
}

function addQuizRecord(){
  global $database_Conn_kosovo, $Conn_kosovo, $userID;
  $insertSQLnew = sprintf("INSERT INTO quiz_group (vote_user_id, quiz_group, quiz_time) VALUES (%s, %s, %s)",
                       GetSQLValueString($userID, "int"),
                       GetSQLValueString($_POST['val'], "int"),
                       GetSQLValueString(time(), "int"));
  mysql_select_db($database_Conn_kosovo, $Conn_kosovo);
  $Result1 = mysql_query($insertSQLnew, $Conn_kosovo) or die(mysql_error());
  echo "true";
}

?>