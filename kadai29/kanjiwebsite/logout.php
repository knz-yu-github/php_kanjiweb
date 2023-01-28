<?php session_start();?>
<?php require '../header.php'?>
<link rel="stylesheet" href="../menu.css">
<?php require '../middle.php'?>

<?php require '../create-table.php'?>

<?php require '../menu.php'?>

<?php unset($_SESSION['loginsuccess']); ?>

<div class="container">
    <p class="logoutcall">ログアウトしました</p>
    <hr>
    <p class="logoutcalltwo">右上から再度、ログインすることができます</p>
</div>

<!--★4-->