<?php

require('dbconnect.php');
session_start();

$id=$_SESSION['id'];

    $subjects=$db->prepare('SELECT * FROM works WHERE id=?');
    $subjects->execute(array($id));
    $subject=$subjects->fetch();


    if(!empty($id)){
        $delete = $db->prepare('DELETE FROM works WHERE id=?');
        $delete->execute(array($id));
    }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style-p.css">
</head>
<body>

    <header>

    <div class="h-ttl">
    <h1>TasKist</h1>
    </div>
    <div class="menu">

    <a href="index.php">一覧へ</a>
    <a href="post.php">課題を追加する</a>
    

    </div>

    </header>

    <p class="ttl">以下の課題を削除しました</p>

    <div class="main">
    <div class="table-wrapper">

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>科目名</th>
            <th>課題内容</th>
            <th>提出期限</th>
        </tr>

    </thead>
    <tbody>

        <!-- テーブル表示 -->
        <tr>


            <th><?php print(htmlspecialchars($subject['id'], ENT_QUOTES)) ?></th>
            <td class=work<?php print($subject['id'])?>>
                <?php print(htmlspecialchars($subject['title'], ENT_QUOTES)) ?></td>
            <td class=work<?php print($subject['id'])?>>
                <?php print(htmlspecialchars($subject['work'], ENT_QUOTES)) ?></td>
            <td class=work<?php print($subject['id'])?>>
                <?php print(htmlspecialchars($subject['deadline'], ENT_QUOTES)) ?></td>

        </tr>


    </tbody>

</table>
            
        </div>

        <a href="index.php">>>一覧へ</a>
    </div>

    
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>