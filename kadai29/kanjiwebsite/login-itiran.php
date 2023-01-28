<?php session_start();?>
<?php require '../header.php'?>
<link rel="stylesheet" href="../edit.css">
<?php require '../middle.php'?>

<?php require '../create-table.php'?>

<?php
$pdo = new PDO('mysql:host=localhost;dbname=kanjiweb;charset=utf8','staff','password');
?>


<div class="container" id="itirancss">

<b>制作者向けのページです</b>
<br>
<br>
<b>ポップアップなし、ワンクリックで行タプルごと消えます　注意して操作してください</b>
<br>
<br>


<?php
if(isset($_REQUEST['delkey'])){
    $delsql = $pdo->prepare('DELETE FROM member WHERE id = ?');
    $delsql->execute([$_REQUEST['delkey']]);
    echo '<b>一行削除しました</b>';
    echo '<br>';

    unset($_SESSION['loginsuccess']);
    
}
?>

<table border="1">
    <tr>
        <td>番号(ログイン時不要)</td>
        <td>ログインID</td>
        <td>パスワード</td>
        <td>登録している漢字の数</td>
        <td>削除ボタン※注意</td>
    </tr>
<?php
$allsql = $db->query('SELECT * FROM member');

foreach($allsql as $item){
    echo '<tr>';
    echo '<td>',$item['id'],'</td>';
    echo '<td>',$item['name'],'</td>';
    echo '<td>',$item['password'],'</td>';
    $countsql = $db->prepare('SELECT member_id FROM kanji WHERE member_id = ?'); //count文が使えなかったので　インクリメントで対応
    $countsql->execute([$item['id']]);

        $i = 0;
    foreach($countsql as $count){
        $i++;
    }

    echo'<td>';
    echo $i;
    echo'</td>';

    echo '<form action="login-itiran.php" method="post">';
    echo '<input type="hidden" name="delkey" value="',$item['id'],'">';
    echo '<td><input type="submit" value="←削除(登録中の漢字も消えます)"></td>';
    echo '</form>';
    echo '</tr>';
}
?>
</table>
</div>

<?php require '../footer.php'?>