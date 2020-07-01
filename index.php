<?php

require('dbconnect.php');
session_start();

$subjects = $db->query('SELECT * FROM works ORDER BY id DESC');

if (!empty($_POST['id'])) {

    $checkID = $db->prepare('SELECT * FROM works WHERE id=?');
    $checkID->execute(array($_POST['id']));

    if ($check = $checkID->fetch()) {
        $_SESSION['id'] = $_POST['id'];
        header('Location:delete.php');
    } else {
        $error['id'] = 'exist';
    }
}

if($_POST['id']===''){
    $error['id']='blank';
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
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
                        <?php while ($subject = $subjects->fetch()) : ?>
                            <?php
                            $deadline = new DateTime(date('Y-m-d', strtotime($subject['deadline'] . '-3day')));
                            $today = new DateTime(date('Y-m-d'));
                            if ($today >= $deadline) :
                            ?>
                                <style>
                                    .work<?php print($subject['id']) ?> {
                                        color: red;
                                    }
                                </style>
                            <?php endif ?>


                            <th><?php print(htmlspecialchars($subject['id'], ENT_QUOTES)) ?></th>
                            <td class=work<?php print($subject['id']) ?>>
                                <?php print(htmlspecialchars($subject['title'], ENT_QUOTES)) ?></td>
                            <td class=work<?php print($subject['id']) ?>>
                                <?php print(htmlspecialchars($subject['work'], ENT_QUOTES)) ?></td>
                            <td class=work<?php print($subject['id']) ?>>
                                <?php print(htmlspecialchars($subject['deadline'], ENT_QUOTES)) ?></td>

                    </tr>
                <?php endwhile ?>

                </tbody>

            </table>

        </div>

    </div>




    <?php if (empty($_REQUEST['action'])) : ?>
        <div class="action">
            <?php if (!empty($_POST['id'])) : ?>
                <p>課題を削除しました</p>
            <?php endif ?>
            <a href="index.php?action=delete">編集する</a>
        </div>
    <?php else : ?>
        <?php if ($_REQUEST['action'] = 'delete') : ?>
            <div class="delete">
                <form action="" method='POST'>
                    <p>削除したい課題のIDを選択してください</p>
                    <?php if ($error['id'] === 'blank') : ?>
                        <p class="error">*IDを入力してください</p>
                    <?php endif ?>
                    <?php if ($error['id'] === 'exist') : ?>
                        <p class="error">*入力されたIDは存在しません</p>
                    <?php endif ?>
                    <input type="text" name='id' value='' placeholder="ID">
                    <button type="submit">決定</button>
                </form>
            </div>
        <?php endif ?>
    <?php endif ?>



    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>