<?php session_start();?>
<?php require '../header.php'?>
<link rel="stylesheet" href="../webhome.css">
<link rel="stylesheet" href="../menu.css">
<?php require '../middle.php'?>

<?php require '../menu.php'?>

<?php require '../create-table.php'?>

<?php

$pdo = new PDO('mysql:host=localhost;dbname=kanjiweb;charset=utf8','staff','password');

?>

<div class="container">
    <p class="tope">あなたの漢字一覧です</p>

    <?php
        if(isset($_SESSION["loginsuccess"])){
            $sql = $pdo->prepare('SELECT * FROM kanji WHERE member_id = ?');
            $sql->execute([$_SESSION['loginsuccess']['id']]);

            echo '<p>',$_SESSION["loginsuccess"]['name'],'さん、今日も勉強を頑張りましょう','</p>';
            echo '<hr>';
        }else{
            echo '<p>漢字を表示するにはログインする必要があります！</p>';
            echo '<hr>';
        }
    ?>

    <?php
    //if(isset($_SESSION["loginsuccess"])){
    if(isset($_SESSION["loginsuccess"])){

        $flag = FALSE;

        echo '<table>';
            foreach($sql->fetchAll() as $item){
                echo '<tr>';
                echo '<td rowspan="2" class="bigcell">','&nbsp',$item['knj'],'&nbsp','</td>';
                echo '<td class="normalcell">','&nbsp',$item['yomione'],'&nbsp','</td>';
                echo '<td class="normalcell">','&nbsp',$item['yomitwo'],'&nbsp','</td>';
                echo '<td class="normalcell">','&nbsp',$item['yomithr'],'&nbsp','</td>';
                echo '</tr>';
                echo '<tr class="normalcell">';
                echo '<td class="normalcell">','&nbsp',$item['yomifor'],'&nbsp','</td>';
                echo '<td class="normalcell">','&nbsp',$item['yomifiv'],'&nbsp','</td>';
                echo '<td class="normalcell">','&nbsp',$item['yomisix'],'&nbsp','</td>';
                echo '</tr>';

                $flag = TRUE;

            }
        echo '</table>';
        
        if($flag){
        }else{
            echo '登録している漢字がないようです　右上から追加してみましょう！';
        }

    }else{
        echo '<p>右上からログインしてください</p>';
    }
    ?>

</div>

<?php require '../footer.php'?>
