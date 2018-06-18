<?php require_once('../Connections/Conn_kosovo.php');

addVoteRecord(0);

function addVoteRecord($userID){
  global $database_Conn_kosovo, $Conn_kosovo;
  $insertSQLnew = sprintf("INSERT INTO vote_data (vote_user_id, vote_data, vote_time) VALUES (%s, %s, %s)",
                       GetSQLValueString($userID, "int"),
                       GetSQLValueString($_GET['val'], "int"),
                       GetSQLValueString(time(), "int"));
  mysql_select_db($database_Conn_kosovo, $Conn_kosovo);
  $Result1 = mysql_query($insertSQLnew, $Conn_kosovo) or die(mysql_error());
  //echo "true";
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
    echo $returnJson[$_GET['val']];
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


?>