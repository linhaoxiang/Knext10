<?php require_once('../Connections/Conn_kosovo.php');

$returnJson = [];
checkVoteVal();

function checkVoteVal(){
  global $database_Conn_kosovo, $Conn_kosovo,$aDayTime, $returnJson;
  mysql_select_db($database_Conn_kosovo, $Conn_kosovo);
  $query_Recordset = "SELECT * FROM quiz_group";
  $Recordset = mysql_query($query_Recordset, $Conn_kosovo) or die(mysql_error());
  $row_Recordset = mysql_fetch_assoc($Recordset);
  $totalRows_Recordset = mysql_num_rows($Recordset);
  if($totalRows_Recordset>0){
    do {
      addValInArray($row_Recordset['quiz_group']);
    } while ($row_Recordset = mysql_fetch_assoc($Recordset));
    echo json_encode($returnJson);
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