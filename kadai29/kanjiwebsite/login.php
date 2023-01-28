<?php session_start();?>
<?php require '../header.php'?>
<link rel="stylesheet" href="../login.css">
<link rel="stylesheet" href="../menu.css">
<?php require '../middle.php'?>

<?php require '../create-table.php'?>

<?php require '../menu.php'?>

<form action="login.php" method="POST">

    <div class="container" id="line">
        <h1>KANJI-Web</h1>
        <p>ログイン情報を入力してください</p>

        <b>ログインID</b>   <b id="b1"></b>
        <?php
        if(!isset($_REQUEST['loginid'])){
            echo '<input type="text" class="form-control" name="loginid">';
        }else{
            echo '<input type="text" class="form-control" name="loginid" value="',$_REQUEST['loginid'],'">';
        }
        ?>
        
        <b>パスワード</b>   <b id="b2"></b>
        <?php
        if(!isset($_REQUEST['loginpass'])){
            echo '<input type="password" class="form-control" name="loginpass">';
        }else{
            echo '<input type="password" class="form-control" name="loginpass" value="',$_REQUEST['loginpass'],'">';
        }
        ?>

        <br>
        <a href="newsubsc.php" class="new">新規登録</a>
        <p class="btn"><input type="submit" class="btn btn-primary" value="ログイン"></p>
        <br>
        <a href="login-itiran.php" target="_blank" class="itiran">ログインID-パスワード一覧</a>

        <input type="hidden" name="ok">
    </div>

    <?php

    /*★3*/

//ログインチェック　テーブルに存在したなら　内容をSESSIONに格納
if(isset($_REQUEST['loginid'])&&($_REQUEST['loginpass'])){
    $pdo = new PDO('mysql:host=localhost;dbname=kanjiweb;charset=utf8','staff','password');
    $checklogin = $pdo->prepare('SELECT * FROM member WHERE name = ? AND password = ?');
    $checklogin->execute([$_REQUEST['loginid'],$_REQUEST['loginpass']]);

    foreach($checklogin as $val){
        $_SESSION['loginsuccess']=[
            'id'=>$val['id'],
            'name'=>$val['name'],
            'password'=>$val['password']
        ];
    }
}

//hiddenでnameのokが送られてきてなかったら　以下の処理は実行しない
    if(!isset($_REQUEST['ok'])){
        
    }else
    if(empty($_REQUEST['loginid'])){
        echo '<script>b1.innerHTML="※ログインIDを入力してください";</script>';
    }else
    if(empty($_REQUEST['loginpass'])){
        echo '<script>b2.innerHTML="※パスワードを入力してください";</script>';
    }else
    if(isset($_SESSION['loginsuccess'])){
        header('Location:webhome.php');
    }else{
        echo '<script>b1.innerHTML="※ログインID、またはパスワードが違います";</script>';
        echo '<script>b2.innerHTML="※ログインID、またはパスワードが違います";</script>';
    }

    ?>
    
</form>

<?php require '../footer.php'?>



<!--CREATE DATABASE xxxx DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
GRANT ALL ON xxxx.* TO 'staff'@'localhost'identified BY 'password';
USE xxxx;-->