<?php
include("core.php");

if (!gt("username") || !gt("password")) {
    goback("You need to enter both username and password to login.");
}

$username = gt("username");
$password = gt("password");
$r        = redisLink();
$userid   = $r->hget("users", $username);
if (!$userid) {
    goback("Wrong username or password");
}
$realpassword = $r->hget("user:$userid", "password");
if ($realpassword != $password) {
    goback("Wrong useranme or password");
}

$authsecret = $r->hget("user:$userid", "auth");
setcookie("auth", $authsecret, time() + 3600 * 24 * 365);
header("Location: index.php");