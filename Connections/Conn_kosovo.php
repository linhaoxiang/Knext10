<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_Conn_kosovo = "localhost";
$database_Conn_kosovo = "kosovo";
$username_Conn_kosovo = "root";
$password_Conn_kosovo = "4637";
$Conn_kosovo = mysql_pconnect($hostname_Conn_kosovo, $username_Conn_kosovo, $password_Conn_kosovo) or trigger_error(mysql_error(),E_USER_ERROR); 
?>