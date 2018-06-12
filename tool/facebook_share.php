<?php require_once('../Connections/Conn_kosovo.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_Conn_kosovo, $Conn_kosovo);
$query_Resys = "SELECT * FROM system_info";
$Resys = mysql_query($query_Resys, $Conn_kosovo) or die(mysql_error());
$row_Resys = mysql_fetch_assoc($Resys);
$totalRows_Resys = mysql_num_rows($Resys);

$colname_RecShare = "-1";
if (isset($_GET['sid'])) {
  $colname_RecShare = $_GET['sid'];
}
mysql_select_db($database_Conn_kosovo, $Conn_kosovo);
$query_RecShare = sprintf("SELECT * FROM facebook_share WHERE share_id = %s", GetSQLValueString($colname_RecShare, "int"));
$RecShare = mysql_query($query_RecShare, $Conn_kosovo) or die(mysql_error());
$row_RecShare = mysql_fetch_assoc($RecShare);
$totalRows_RecShare = mysql_num_rows($RecShare);
?>
<html>
<head>
	
	
  <title><?php echo $row_RecShare['share_title']; ?></title>
    <!-- You can use Open Graph tags to customize link previews.
    Learn more: https://developers.facebook.com/docs/sharing/webmasters -->
  	<meta property="og:url"           content="<?php echo $row_Resys['self_domain']; ?>tool/facebook_share.php?sid=<?php echo $_GET['sid']?>" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="<?php echo $row_RecShare['share_title']; ?>" />
    <meta property="og:description"   content="<?php echo $row_RecShare['share_description']; ?>" />
    <meta property="og:image"         content="<?php echo $row_Resys['self_domain']; ?><?php echo $row_RecShare['share_img']; ?>" />
	<meta property="fb:app_id" content="<?php echo $row_Resys['facebook_app_id']; ?>"/>
	<meta http-equiv="refresh" content="0;url='<?php echo $row_Resys['self_domain']; ?>'" />
<script>
</script>
	
	
</head>
	
	
<body>

</body>
</html>
<?php
mysql_free_result($Resys);

mysql_free_result($RecShare);
?>
