<?php require_once('../Connections/Conn_kosovo.php');

$returnJson = [];
$dataJson = [];
$aYearTime = 365 * 24 * 60 * 60;

if(isset($_GET["lang"])){
  if (isset($_COOKIE["mission_id"])){
    getMissionInfo($_COOKIE["mission_id"], $_GET["lang"], 'false');
  }else{
    newMission();
  }
}

function newMission(){
  global $database_Conn_kosovo, $Conn_kosovo, $returnJson, $aYearTime;
  mysql_select_db($database_Conn_kosovo, $Conn_kosovo);
  $query_Recordset = "SELECT * FROM mission";
  $Recordset = mysql_query($query_Recordset, $Conn_kosovo) or die(mysql_error());
  $row_Recordset = mysql_fetch_assoc($Recordset);
  $totalRows_Recordset = mysql_num_rows($Recordset);

  if($totalRows_Recordset>0){
    do {
      array_push($returnJson, $row_Recordset['mission_id']);
    } while ($row_Recordset = mysql_fetch_assoc($Recordset));
    $randID =  rand(0,count($returnJson)-1);
    setcookie("mission_id", $returnJson[$randID], time()+$aYearTime);
    getMissionInfo($returnJson[$randID], $_GET["lang"], 'true');
  }
}

function getMissionInfo($missionID,$lang, $firstTime){
  global $database_Conn_kosovo, $Conn_kosovo, $dataJson;
  mysql_select_db($database_Conn_kosovo, $Conn_kosovo);
  $query_Recordset = sprintf("SELECT * FROM mission WHERE mission_id=%s", GetSQLValueString($missionID, "int"));
  $Recordset = mysql_query($query_Recordset, $Conn_kosovo) or die(mysql_error());
  $row_Recordset = mysql_fetch_assoc($Recordset);
  $totalRows_Recordset = mysql_num_rows($Recordset);
  $dataJson['mission_id'] = $missionID;
  $dataJson['mission_content'] = $row_Recordset['mission_content_'.$lang];
  $dataJson['firstTime'] = $firstTime;
  echo json_encode($dataJson);
}



?>