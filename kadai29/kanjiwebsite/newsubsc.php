<?php require '../header.php'?>
<link rel="stylesheet" href="../subsc.css">
<link rel="stylesheet" href="../menu.css">
<?php require '../middle.php'?>

<?php require '../menu.php'?>

<?php require '../create-table.php'?>

<?php
$pdo = new PDO('mysql:host=localhost;dbname=kanjiweb;charset=utf8','staff','password');
?>

<?php require '../create-table.php'?>

<form action="newsubsc.php" method="POST">

    <div class="container" id="line">
        <h1>新規登録</h1>
        <h2>新しく登録する情報を入力してください</h2>
        <b>ログインID</b>   <b id="b1"></b>
        <p>半角英数字で入力してください、記号は使えません</p>
        <?php
        if(empty($_REQUEST['subid'])){
            echo '<input type="text" class="form-control" name="subid" value="">';
        }else{
            echo '<input type="text" class="form-control" name="subid" value="',$_REQUEST['subid'],'">';
        }

        ?>
        <!--<input type="text" class="form-control" name="subid" value="<?php echo $_REQUEST['subid'];?>">-->
        <b>パスワード</b>   <b id="b2"></b>
        <p>半角英数字で入力してください、記号は使えません</p>
        <?php
        if(empty($_REQUEST['subpass'])){
            echo '<input type="password" class="form-control" name="subpass" value="">';
        }else{
            echo '<input type="password" class="form-control" name="subpass" value="',$_REQUEST['subpass'],'">';
        }


        if(!isset($_REQUEST['checkbox'])){
            echo '<input type="checkbox" class="formcontrol" name="checkbox"><a href="subsc-agree.php" target="_blank">利用規約</a>に同意してください   <b id="b4"></b>';
        }else{
            echo '<input type="checkbox" class="formcontrol" name="checkbox" checked><a href="subsc-agree.php" target="_blank">利用規約</a>に同意してください   <b id="b4"></b>';
        }
        /*★1*/
        /*★2*/
        /*★5*/

        ?>


        <br>
        <b id="b3"></b>
        <br>
        <p class="btn"><input type="submit" class="btn btn-primary" value="登録"></p>
        <br>
        <a href="login-itiran.php" target="_blank" class="itiran">ログインID-パスワード一覧</a>
    </div>
</form>


<?php

//重複チェック
if(!empty($_REQUEST['subid'])){
    $subid = $_REQUEST['subid'];
    $check = $db->query('SELECT name FROM member');

    foreach($check as $item){
        if($subid === $item['name']){
            $miss = 'false';
        }
    }
}


//正規表現チェック
if(!isset($_REQUEST['subid'])){
    
}else
if(empty($_REQUEST['subid'])){
    echo '<script>b1.innerHTML="※ログインIDが空白です";</script>';
}else
if(empty($_REQUEST['subpass'])){
    echo '<script>b2.innerHTML="※パスワードが空白です";</script>';
}else
if(!preg_match('/^[a-zA-Z0-9]{3,}$/',$_REQUEST['subid'])){
    echo '<script>b1.innerHTML="※半角英数字３文字以上で入力してください";</script>';
}else
if(!preg_match('/^[a-zA-Z0-9]+$/',$_REQUEST['subpass'])){
    echo '<script>b2.innerHTML="※半角英数字で入力してください";</script>';
}else
if(isset($miss)){
    echo '<script>b1.innerHTML="※このログインIDは既に使用されています";</script>';
}else
if(!isset($_REQUEST['checkbox'])){
    echo '<script>b4.innerHTML="※利用規約にチェックが必要です";</script>';
}else{
    $ins = $db->prepare('INSERT INTO member(id,name,password)VALUES("",?,?)');
    $ins->execute([$_REQUEST['subid'],$_REQUEST['subpass']]); //新規登録

    echo '<script>b3.innerHTML="登録が完了しました! 右上からログインできます!";</script>';

    $select = $db->prepare('SELECT id FROM member WHERE name = ?');
    $select->execute([$_REQUEST['subid']]);

    foreach($select as $val){

        $selectid = $val['id'];
    }
                                                                                                                   //id  knj   one  two                             thr                  for      fivsix 
    $exsample=$db->prepare('INSERT INTO kanji (member_id,knj,yomione,yomitwo,yomithr,yomifor,yomifiv,yomisix) VALUES (?,"例","れい","例えばこのように漢字を追加できる","例えるなら猫みたいだ","たと(え)","","")');
    $exsample->execute([$selectid]); //最初だけサンプルの行を追加

    echo '<script>b3.innerHTML="登録が完了しました! 右上からログインできます!";</script>';
}

?>


<?php require '../footer.php'?>