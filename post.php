<?php
include("core.php");

if (!isLoggedIn() || !gt("status")) {
    header("Location:index.php");
    exit;
}

$r      = redisLink();
$postid = $r->incr("next_post_id");
$status = str_replace("\n", " ", gt("status"));

//hmget post:1 user_id time body
$r->hmset(
    "post:$postid",
    "user_id", $User['id'],
    "time", time(),
    "body", $status);
$followers   = $r->zrange("followers:" . $User['id'], 0, -1);
$followers[] = $User['id'];

//LRANGE posts:1 0 -1
foreach ($followers as $fid) {
    $r->lpush("posts:$fid", $postid);
}
//lrange timeline 0 -1
$r->lpush("timeline", $postid);
$r->ltrim("timeline", 0, 1000);

header("Location: index.php");