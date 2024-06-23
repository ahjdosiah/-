<?php
    $servername = "localhost";
    $serverusername = "admin";
    $serverpassword = "password";
    $dbname = "parking";
    
    // 创建连接
    $conn = new mysqli($servername, $serverusername, $serverpassword, $dbname);

    //检测连接
    if ($conn->connect_error) {
        echo "<script>alert('数据库连接失败');location.href='login.php';</script>";
    }
?>