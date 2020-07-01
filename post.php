<?php

require('dbconnect.php');

if (!empty($_POST)) {

    //エラー処理

    if ($_POST['title'] === '') {
        $error['title'] = 'blank';
    }

    if ($_POST['work'] === '') {
        $error['work'] = 'blank';
    }

    $deadline=$_POST['deadline'];

    if ($deadline === '') {
        $error['deadline'] = 'blank';
    }

    // if($deadline === date('Y-m-d',strtotime($deadline))){
    //     $error['deadline']='type';
    // }

    if (empty($error)) {
        $posts = $db->prepare('INSERT INTO works SET title=?,work=?,deadline=?');
        $posts->execute(array($_POST['title'], $_POST['work'], $_POST['deadline']));

        header('Location:thanks.php');
        exit();
    }
}

?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
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

    <p class="ttl">課題を登録してください</p>
    <div class="div ml">




        <form action="" method='post'>
            <div class="input">
                <label for="name">科目名: </label>
                <?php if ($error['title'] === 'blank') : ?>
                    <p class="error">*科目名を登録してください</p>
                <?php endif ?>
                <input class="inst" type="text" name="title" value="<?php print($_POST['title'])?>">
            </div>

            <div class="input">

                <label for="work">課題内容: </label>
                <?php if ($error['work'] === 'blank') : ?>
                    <p class="error">*課題内容を登録してください</p>
                <?php endif ?>
                <input class="inst" type="text" name="work" value="<?php print($_POST['work'])?>" placeholder="例:レポート">

            </div>

            <div class="input">
                <label for="deadline">締切: </label>
                <?php if ($error['deadline'] === 'blank') : ?>
                    <p class="error">*締切期限を登録してください</p>
                <?php endif ?>
                <?php if ($error['deadline']==='type'):?>
                    <p class='error'>*日付は形式通り入力してください</p>
                    <?php endif ?>
                <input class="inst" type="text" name="deadline" value="<?php print($_POST['deadline'])?>" placeholder="例:2020-●●-●●">

            </div>

            <div class="submit">
                <input class="sub" type="submit" value="登録する">
            </div>

        </form>

    </div>



    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>