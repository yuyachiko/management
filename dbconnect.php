<?php

try{
   //db接続


}catch(PDOException $e){
    echo 'DB接続エラー'.$e->getMessage();
}

?>
