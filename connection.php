<?php
//khai báo biến 
// Tên sever mýql
$host='localhost';
//usename truy cập vào database
$username ='root';
//password của root
$password='';

$dbname='du_an_1';
try{
    $conn=new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",$username,$password);

}catch(PDOException $e){
    echo"Lỗi kết nối dữ liệu <br>".$e->getMessage();

}