<?php 
require_once('../Connections/Conn_kosovo.php');
require("phpMQTT.php");

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
  checkVoteVal();
}

$returnJson = [];


function checkVoteVal(){
  global $database_Conn_kosovo, $Conn_kosovo,$aDayTime, $returnJson;
  mysql_select_db($database_Conn_kosovo, $Conn_kosovo);
  $query_Recordset = "SELECT * FROM vote_data";
  $Recordset = mysql_query($query_Recordset, $Conn_kosovo) or die(mysql_error());
  $row_Recordset = mysql_fetch_assoc($Recordset);
  $totalRows_Recordset = mysql_num_rows($Recordset);
  if($totalRows_Recordset>0){
    do {
      addValInArray($row_Recordset['vote_data']);
    } while ($row_Recordset = mysql_fetch_assoc($Recordset));
    //echo json_encode($returnJson);
    sendMqttData();
  }else{
    echo "NoValue";
  }
}

function addValInArray($quizData){
   global $returnJson;
   if(isset($returnJson[$quizData])){
      $returnJson[$quizData] = (int)$returnJson[$quizData]+1; 
   }else{
      $returnJson[$quizData] = 1;
   }
}

function sendMqttData(){
  global $returnJson;
  $mqtt = new phpMQTT("incode.tw", 1883, "phpMQTT Pub Example");
  if ($mqtt->connect()) {
      $mqtt->publish("kvote".$_POST['val'],$returnJson[$_POST['val']],0);
      $mqtt->close();
  }
}


?>