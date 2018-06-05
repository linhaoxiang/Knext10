<?php 
//setcookie("user_id", "1121", time()+(365 * 24 * 60 * 60));
//setcookie("active_vote_time", time()+(24 * 60 * 60), time()+(24 * 60 * 60));
unset($_COOKIE['user_id']);
setcookie("user_id", "", time()-3600);

unset($_COOKIE['vote_time']);
setcookie("vote_time", "", time()-3600);

//echo $_COOKIE["user_id"];

?>