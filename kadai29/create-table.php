<?php
$sql = "CREATE TABLE IF NOT EXISTS member(
    id INT NOT NUlL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(200) NOT NULL UNIQUE,
    password VARCHAR(200) NOT NULL
    )DEFAULT CHARSET=utf8";
 
 $kanjisql = "CREATE TABLE IF NOT EXISTS kanji(
    member_id INT NOT NUlL,
    knj VARCHAR(200),
    yomione VARCHAR(200),
    yomitwo VARCHAR(200),
    yomithr VARCHAR(200),
    yomifor VARCHAR(200),
    yomifiv VARCHAR(200),
    yomisix VARCHAR(200),
    editid INT AUTO_INCREMENT PRIMARY KEY,
    FOREIGN KEY(member_id) REFERENCES member(id)
    ON DELETE CASCADE ON UPDATE CASCADE
    )DEFAULT CHARSET=utf8";

    $db = new PDO('mysql:host=localhost;dbname=kanjiweb;charset=utf8','staff','password');

    $db->query($sql);
    $db->query($kanjisql);

?>

<!--CREATE DATABASE kanjiweb DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
GRANT ALL ON kanjiweb.* TO 'staff'@'localhost'identified BY 'password';
USE kanjiweb;-->