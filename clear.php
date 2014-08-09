<?php
 session_start();
if (isset($_SESSION['user'])) {
   $auth = "Привет ".$_SESSION['user']."!<br />\n";

$name = $_SESSION['user']; }
   
$open=fopen($name.".txt","a");   
$trunc=ftruncate($open,0);
if (!$trunc)
print "bad";

?>

<script language="JavaScript"> 
  window.location.href = "http://localhost/testreg/write.php"
</script>