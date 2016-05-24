<?php
include("retwis.php");

# Form sanity checks
if (!gt("username") || !gt("password") || !gt("password2")) {
    goback("Every field of the registration form is needed!");
}
if (gt("password") != gt("password2")) {
    goback("The two password fileds don't match!");
}

# The form is ok, check if the username is available
$username = gt("username");
$password = gt("password");
$r        = redisLink();
if ($r->hget("users", $username)) {
    goback("Sorry the selected username is already in use.");
}

# Everything is ok, Register the user!
//get next_user_id
$userid     = $r->incr("next_user_id");
$authsecret = getrand();
//hget users yezuozuo
$r->hset("users", $username, $userid);
//HMGET user:1 username password auth
$r->hmset("user:$userid",
    "username", $username,
    "password", $password,
    "auth", $authsecret);

$r->hset("auths", $authsecret, $userid);
//ZRANGE users_by_time 0 -1
$r->zadd("users_by_time", time(), $username);

# User registered! Login her / him.
setcookie("auth", $authsecret, time() + 3600 * 24 * 365);

include("header.php");
?>
<h2>Welcome aboard!</h2>
Hey <?= utf8entities($username) ?>, now you have an account, <a href="index.php">a good start is to write your first
    message!</a>.
<?php
include("footer.php")
?>
