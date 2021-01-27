<?php
//error_reporting(E_ALL);
echo "Задание 5: Удадение не пустого каталога<br>";
$path = '/rmdir';

function rmfilesanddir($p) {
    if ($remove_files = glob($p . '/*')) {
        foreach ($remove_files as $remfile) {
            if (is_dir($remfile)) {
                rmfilesanddir($remfile);
            }
            else {
                @chmod($remfile, 0777);
                unlink($remfile);
            }
        }
    }
    @chmod($remfile, 0777);
    rmdir($p);
}
rmfilesanddir(getcwd() . $path);

?>