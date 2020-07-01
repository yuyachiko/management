<?php

try{
    $db= new PDO('mysql:dbname=hw_db;host=127.0.0.1','root','');


}catch(PDOException $e){
    echo 'DB接続エラー'.$e->getMessage();
}

?>