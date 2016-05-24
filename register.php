<?php
include("core.php");

if (!gt("username") || !gt("password") || !gt("password2")) {
    goback("请输入用户名和密码");
}
if (gt("password") != gt("password2")) {
    goback("密码不一致");
}

$username = gt("username");
$password = gt("password");
$r        = redisLink();
if ($r->hget("users", $username)) {
    goback("该用户名已经被使用");
}

$userid     = $r->incr("next_user_id");
$authsecret = getrand();
//hget users yezuozuo
$r->hset("users", $username, $userid);
//hmget user:1 username password auth
$r->hmset("user:$userid",
    "username", $username,
    "password", $password,
    "auth", $authsecret);

$r->hset("auths", $authsecret, $userid);
//ZRANGE users_by_time 0 -1
$r->zadd("users_by_time", time(), $username);

setcookie("auth", $authsecret, time() + 3600 * 24 * 365);

include("header.php");
?>
<h2>欢迎！</h2>
您好：<?= utf8entities($username) ?>, 您的账户已经建立成功, <a href="index.php">来写您的第一条动态吧</a>.
<?php
include("footer.php")
?>
