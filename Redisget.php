<?php

require_once "DB/League.php";

//Connecting to Redis server on localhocast
ignore_user_abort();
$reload = true;
while($reload)
{
    $redis = new Redis();
    $redis->connect('127.0.0.1', 6379);

    $result = new League();
    $data = $result->getGameData();

    $redis->set('gamedata', json_encode($data));
    sleep(60);
}
