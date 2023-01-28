<?php session_start();?>
<?php require '../header.php'?>
<link rel="stylesheet" href="../edit.css">
<link rel="stylesheet" href="../menu.css">
<?php require '../middle.php'?>

<?php require '../menu.php'?>

<?php require '../create-table.php'?>

<?php
$pdo = new PDO('mysql:host=localhost;dbname=kanjiweb;charset=utf8','staff','password');
?>

<div class="container">
    <?php
        if(isset($_SESSION["loginsuccess"])) {
            echo '<p class="tope">',$_SESSION["loginsuccess"]['name'],'さんの漢字一覧です</p>';
        }else{
            echo '<p class="tope">ログインしていないので、漢字を表示、編集することができません</p>';
            echo '<hr>';
            echo '<p>右上からログインしてください</p>';
        }
    ?>

    <?php

    if(isset($_REQUEST['insertkey'])){                                                                              //sessionid k o t t f f s   
        $insertsql = $pdo->prepare('INSERT INTO kanji (member_id,knj,yomione,yomitwo,yomithr,yomifor,yomifiv,yomisix) VALUES (?,?,?,?,?,?,?,?)');
        $insertsql->execute([$_SESSION['loginsuccess']['id'],$_REQUEST['insertknj'],$_REQUEST['insertone'],$_REQUEST['inserttwo'],$_REQUEST['insertthr'],$_REQUEST['insertfor'],$_REQUEST['insertfiv'],$_REQUEST['insertsix']]);
        echo '<hr>';
        echo '<b id="blue">★追加しました</b>';
        echo '<hr>';
    }
    


    if(isset($_REQUEST['deletekey'])){
        $deletesql = $pdo->prepare('DELETE FROM kanji WHERE editid = ?');
        $deletesql->execute([$_REQUEST['editid']]);
        echo '<hr>';
        echo '<b id="red">★削除しました</b>';
        echo '<hr>';
    }



    if(isset($_REQUEST['updatekey'])){
        $updatesql = $pdo->prepare('UPDATE kanji SET knj = ?,yomione = ?,yomitwo = ?,yomithr = ?,yomifor = ?,yomifiv = ?,yomisix = ? WHERE editid = ?');
        $updatesql->execute([$_REQUEST['knj'],$_REQUEST['yomione'],$_REQUEST['yomitwo'],$_REQUEST['yomithr'],$_REQUEST['yomifor'],$_REQUEST['yomifiv'],$_REQUEST['yomisix'],$_REQUEST['editid']]);
        echo '<hr>';
        echo '<b id="green">★更新しました</b>';
        echo '<hr>';
    }

    ?>        

<!--★789 10-->


<?php
    //db接続済
if(isset($_SESSION['loginsuccess'])){
    $sql = $pdo->prepare('SELECT * FROM kanji WHERE member_id = ?');//? prepare
    $sql->execute([$_SESSION['loginsuccess']['id']]);

    echo '<p>漢字を入力して追加、または登録済みの漢字を 直接書き換えて編集(更新)、削除することが可能です</p>';

        echo '<table border="1">';

            echo '<form action="edit.php" method="POST">';
                echo '<tr>';
                echo '<td rowspan="2" class="cellcontrol"><input type="text" name="insertknj" class="form-control"></td>';
                echo '<td><input type="text" class="form-control" id="normal" name="insertone"></td>';
                echo '<td><input type="text" class="form-control" id="normal" name="inserttwo" ></td>';
                echo '<td><input type="text" class="form-control" id="normal" name="insertthr"></td>';
                echo '</tr>';
                echo '<br>';
                echo '<tr>';
                echo '<td><input type="text" class="form-control" id="normal" name="insertfor"></td>';
                echo '<td><input type="text" class="form-control" id="normal" name="insertfiv"></td>';
                echo '<td><input type="text" class="form-control" id="normal" name="insertsix"></td>';
                echo '</tr>';

                echo '<button type="submit" class="btn btn-primary" name="insertkey">追加</button>';
            echo '</form>';

        echo '</table>';

        //$sql->execute([$_SESSION['aaa']]);
        foreach($sql as $item){
        echo '<table border="1">';

            echo '<form action="edit.php" method="POST">';
                echo '<tr>';
                echo '<td rowspan="2" class="cellcontrol"><input type="text" name="knj" class="form-control" value=',$item['knj'],'></td>';
                echo '<td><input type="text" name="yomione" class="form-control" id="normal" value=',$item['yomione'],'></td>';
                echo '<td><input type="text" name="yomitwo" class="form-control" id="normal" value=',$item['yomitwo'],'></td>';
                echo '<td><input type="text" name="yomithr" class="form-control" id="normal" value=',$item['yomithr'],'></td>';
                echo '</tr>';
                echo '<br>';
                echo '<tr>';
                echo '<td><input type="text" name="yomifor" class="form-control" id="normal" value=',$item['yomifor'],'></td>';
                echo '<td><input type="text" name="yomifiv" class="form-control" id="normal" value=',$item['yomifiv'],'></td>';
                echo '<td><input type="text" name="yomisix" class="form-control" id="normal" value=',$item['yomisix'],'></td>';
                echo '</tr>';

                echo '<input type="hidden" name="editid" value="',$item['editid'],'">';

                echo '<button type="submit" class="btn btn-danger" name="deletekey">削除</button>';
                echo '<button type="submit" class="btn btn-success" id="successbtn" name="updatekey">更新</button>';
            echo '</form>';
        echo '</table>';
        }
}
?>
</div>

<?php require '../footer.php'?>