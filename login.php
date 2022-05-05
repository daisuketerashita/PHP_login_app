<?php
session_start();
$errmsg = array();
if($_POST){
    //POST情報があるとき
    //1.入力チェック
    if(!$_POST['e']){
        $errmsg[] = 'Eメールを入力してください';
    }elseif(strlen($_POST['e']) > 100){
        $errmsg[] = 'Eメールは100文字以内で入力してください';
    }

    if(!$_POST['p']){
        $errmsg[] = 'パスワードを入力してください';
    }elseif(strlen($_POST['e']) > 50){
        $errmsg[] = 'パスワードは50文字以内で入力してください';
    }

    //2.ログインID,パスワードが一致しているかチェック
    $userfile = './user/userinfo.txt';
    if(file_exists($userfile)){
        $users = file_get_contents($userfile);
        $users = explode("\n",$users);
        foreach($users as $k => $v){
            $v_ary = str_getcsv($v);
            if($v_ary[0] == $POST['e']){
                if(password_verify($_POST['p'],$v_ary[1])){
                    $_SESSION['e'] = $_POST['e']; //セッション情報保存
                    $host = $_SERVER['HTTP_HOST'];
                    $uri = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
                    header("Location: //$host$uri/member.php");
                    exit;
                }
            }
        }
        $errmsg[] = 'ユーザーまたはパスワードが一致しません';
    }else{
        $errmsg[] = '見つかりません';
    }
}else{
    //GET情報のとき
    $_POST = array();
    $_POST['e'] = '';
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
        <?php if($errmsg): ?>
            <div class="alert alert-danger" role="alert"><?php echo implode('<br>',$errmsg); ?></div>
        <?php endif; ?>
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