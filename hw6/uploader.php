<?php

$files = $_FILES;
$file_count = count($files['files']['name']) - 1;
$dir_upload = "txt/";
$ext_avable = ["txt"];
$max_file_size = 10000;


foreach (range(0,$file_count) as $index_file) {
    $file_name = $files['files']['name'][$index_file]; // имя файла
    $file_type = $files['files']['type'][$index_file]; //text/plain
    $file_size = $files['files']['size'][$index_file]; //размер файла
    $file_tmp = $files['files']['tmp_name'][$index_file]; //временный путь
    $file_ext = pathinfo($file_name,PATHINFO_EXTENSION); //рaсширение файла
    echo "Файл №" . $index_file . "<br> имя : " . $file_name  . "<br> тип : " . $file_type  . "<br> размер : " . $file_size . "<br> временная дирректория : " . $file_tmp . "<br> с расширением файла: " . $file_ext . "<br>";
    if (in_array($file_ext, $ext_avable)) {
        if ($max_file_size > $file_size) {
           if (move_uploaded_file($file_tmp, $dir_upload . random_int(1,1000000) . $file_name)) {  // если это будет какой то реальный проект, то естественно имя файла будет генерироваться по другому
            echo "Файл " . $file_name . " успешно загружен<br><br>";
           }
           else {
            echo "Неполучилось загрузить " . $file_name . " ИЗВИНИТЕ <br><br>"; 
           }
           
        }
        else {
            echo "Размер файла превышает допустимый <br><br>";
            continue;
        }
    }
    else {
        echo "Тип файла не соответсвует допустимомум<br><br>";
        continue;
    }

}