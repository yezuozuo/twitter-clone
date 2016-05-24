<div id="navbar">
    <a href="index.php">主页</a>
    | <a href="timeline.php">时间线</a>
    <?php if (isLoggedIn()) { ?>
        | <a href="logout.php">注销</a>
    <?php } ?>
</div>
