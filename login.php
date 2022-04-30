<?php
if($_POST){
    //POST情報があるとき
    //1.入力チェック
    //2.ログインID,パスワードが一致しているかチェック
    //3.ログイン後画面にリダイレクト
    $host = $_SERVER['HTTP_HOST'];
    $uri = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
    header("Location: //$host$uri/member.php");
    exit;
}else{
    //GET情報のとき
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <div class="container">
        <div class="mx-auto" style="width: 400px;">
            <form action="./login.php" method="POST">
                Eメール：<input type="email" name="e" value="" class="form-control"><br>
                パスワード：<input type="password" name="p" value="" class="form-control"><br>
                <div class="button">
                    <input type="submit" name="login" value="ログイン" class="btn btn-primary btn-lg">
                </div>
            </form>
        </div>
    </div>
</body>
</html>