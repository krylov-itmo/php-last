<?php

$url = trim($_GET['url']);

function checkURL($link) {
    if (!$link) {
        echo "введена пустая ссылка";
        return false;
    }

    if (!filter_var($link, FILTER_VALIDATE_URL,FILTER_FLAG_PATH_REQUIRED)) {
        echo $link . " не соответствует действительности";
        return false;
    }

    return $link;
}

function hash_gen($link,$entropy='') {
    $data_arr = file("url.txt", FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES);
    $hashs = [];
    foreach ($data_arr as $value) {
        $hash = explode('|',$value)[1];
        $hashs[] = $hash; 
    
    }
    $out = substr(md5(sha1(base64_encode($link . $entropy))),0,8);
    while(in_array($out, $hashs)) {
        $out = hash_gen($link, (string) random_int(0,100000));
    }
    return $out;
}

function search_link($url) {
    $data_arr = file("url.txt", FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES);
    foreach ($data_arr as $value) {
            $link = explode('|',$value)[0];
            $hash = explode('|',$value)[1];
            if ($link === $url) {
                return "https://site.com/" . $hash;
            }
        }
        $data = $url ."|". hash_gen($url);
        if (file_put_contents('url.txt',$data . "\n", FILE_APPEND) !== false) {
            echo "Добавленна новая ссылка<br>";
            echo "https://site.com/" , explode('|',$data)[1];
        }
        else {
            echo "ошибка записи в файл";
        };
}

if (checkURL($url)) {
   echo search_link($url);
}

?>
