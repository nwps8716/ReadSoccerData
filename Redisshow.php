<?php

$redis = new Redis();
$redis->connect('127.0.0.1', 6379);

$game = $redis->get('gamedata');
?>

<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <p>JSON格式資料:</p></br>
        <?php echo $game; ?>
        <script>
            setTimeout(function() {
               window.location.reload(1);
            }, 60000);
        </script>
    </body>
</html>