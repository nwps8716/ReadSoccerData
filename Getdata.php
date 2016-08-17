<?php

require_once "League.php";

ignore_user_abort();
$reload = true;
while($reload)
{
    $url = 'http://www.228365365.com/sports.php';
    $url2 = 'http://www.228365365.com/app/member/FT_browse/body_var.php?uid=test00&rtype=r&langx=zh-cn&mtype=3&page_no=0&league_id=&hot_game=';
    //第一次抓cookie
    $ch=curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_HEADER,false);
    curl_setopt($ch, CURLOPT_COOKIEJAR, dirname(__FILE__). '/cookie.txt');
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    $content = curl_exec($ch);

    //將cookie拿出來用
    curl_setopt($ch,CURLOPT_URL,$url2);
    curl_setopt($ch,CURLOPT_HEADER,false);
    curl_setopt($ch, CURLOPT_COOKIEFILE, dirname(__FILE__). '/cookie.txt');
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    $pagecontent = curl_exec($ch);
    curl_close($ch);

    //跳過陣列$newarr[0](前面多餘的資料)
    $jump = substr($pagecontent,65);
    $arr = explode('parent.GameFT', $jump);

    $insert = new League();
    $insert->deleteGameData();  //先清除資料表

    for ($i = 1 ; $i < count($arr) ; $i++)
    {
        $newarr[$i] = explode(',', $arr[$i]);
        for ($j = 1 ; $j <= 3 ; $j++){
            //將一個資料切成3個row的方式存入資料庫
            if ($j == 1) {
                $league = $newarr[$i][2];
                $time = substr($newarr[$i][1], 10, 5);
                $teamName = $newarr[$i][5];
                $capott1 = $newarr[$i][15];
                $overAllHandicap = $newarr[$i][8] . $newarr[$i][9];
                $overAllSize = $newarr[$i][12] . $newarr[$i][14];
                $oddOrEven = $newarr[$i][18] . $newarr[$i][20];
                $capott2 = $newarr[$i][31];
                $halfHandicap = $newarr[$i][24] . $newarr[$i][25];
                $halfSize = $newarr[$i][28] . $newarr[$i][14] . $newarr[$i][30];

                $insert->insertGameData($league, $time, $teamName, $capott1, $overAllHandicap,
                    $overAllSize, $oddOrEven, $capott2, $halfHandicap, $halfSize);
            } elseif ($j == 2) {
                $league = $newarr[$i][2];
                $time = substr($newarr[$i][1], 10, 5);
                $teamName = $newarr[$i][6];
                $capott1 = $newarr[$i][16];
                $overAllHandicap = $newarr[$i][10];
                $overAllSize = $newarr[$i][11] . $newarr[$i][13];
                $oddOrEven = $newarr[$i][19] . $newarr[$i][21];
                $capott2 = $newarr[$i][32];
                $halfHandicap = $newarr[$i][26];
                $halfSize = $newarr[$i][27] . $newarr[$i][13] . $newarr[$i][29];

                $insert->insertGameData($league, $time, $teamName, $capott1, $overAllHandicap,
                    $overAllSize, $oddOrEven, $capott2, $halfHandicap, $halfSize);
            } elseif ($j == 3) {
                $league = $newarr[$i][2];
                $time = substr($newarr[$i][1], 10, 5);
                $teamName = "和";
                $capott1 = $newarr[$i][17];
                $overAllHandicap = "";
                $overAllSize = "";
                $oddOrEven = "";
                $capott2 = $newarr[$i][33];
                $halfHandicap = "";
                $halfSize = "";
                $insert->insertGameData($league, $time, $teamName, $capott1, $overAllHandicap,
                    $overAllSize, $oddOrEven, $capott2, $halfHandicap, $halfSize);
            }
        }
    }
    sleep(60);
}//endwhile

?>
