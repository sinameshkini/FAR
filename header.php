<html>
<link rel="stylesheet" href="style.css" type="text/css">
<div id="header">
<div style="width:55%; display: inline-block;">
<img src="img/Head32.png">
</div>
<div style="float:left; width:45%;">
<a id="project" href="index.php?logout=1" style="margin-top:30px;margin-right:25px;">Logout</a>
<?php 
echo $_SESSION['username'];
?>
&nbsp;
<?php
echo $_SESSION['project_name'];
?>
</div>
</div>

</html>