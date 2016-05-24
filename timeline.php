<?php
include("core.php");
include("header.php");
?>
<h2>时间线</h2>
<i>最近注册的用户</i><br>
<?php
showLastUsers();
?>
<i>最近的50条信息</i><br>
<?php
showUserPosts(-1, 0, 50);
include("footer.php")
?>