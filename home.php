<?php
    include("retwis.php");
    if (!isLoggedIn()) {
        header("Location: index.php");
        exit;
    }
    include("header.php");
    $r = redisLink();
?>
<div id="postform">
    <form method="POST" action="post.php">
        <?= utf8entities($User['username']) ?>,您正在做什么？
        <br>
        <table>
            <tr>
                <td><textarea cols="70" rows="3" name="status"></textarea></td>
            </tr>
            <tr>
                <td align="right"><input type="submit" name="doit" value="Update"></td>
            </tr>
        </table>
    </form>
    <div id="homeinfobox">
        <?= $r->zcard("followers:" . $User['id']) ?> 粉丝<br>
        <?= $r->zcard("following:" . $User['id']) ?> 关注<br>
    </div>
</div>
<?php
    $start = gt("start") === false ? 0 : intval(gt("start"));
    showUserPostsWithPagination(false, $User['id'], $start, 10);
    include("footer.php")
?>