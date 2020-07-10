<?php
if(defined('SID'))
  session_id(SID);
session_start();
session_destroy();
header("Location:admin.php?m=login");
exit();
?>