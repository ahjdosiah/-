<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $passwd = $_POST['passwd'];

    // 使用预处理语句进行插入操作
    $sql = "INSERT INTO manager (username, passwd) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }
    // 绑定参数
    $stmt->bind_param('ss', $username, $passwd);
    // 执行插入操作
    if ($stmt->execute()) {
        echo "用户注册成功";
    } else {
        echo "用户注册失败: " . $stmt->error;
    }
    // 关闭预处理语句
    $stmt->close();
}

// 关闭数据库连接
$conn->close();
?>