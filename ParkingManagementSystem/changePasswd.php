<?php    
// 检查表单是否提交
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $passwd = $_POST['password'];
    $checkpasswd = $_POST['checkpasswd'];
    
    if ($passwd !== $checkpasswd) {
        echo "<script>alert('两次输入密码不同');location.href='changePasswd.php';</script>";
    } else {
        include 'connect.php';
        //查看users中是否有username
        $sql = "SELECT username FROM manager WHERE username = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die("Error preparing statement: " . $conn->error);
        }
        // 绑定参数
        $stmt->bind_param('s', $username);
        // 执行查询
        $stmt->execute();
        // 获取结果
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $stmt->close();
        if (!empty($row)) {
            $sql = "UPDATE manager SET passwd = ? WHERE username = ?";
            $stmt = $conn->prepare($sql);
            if ($stmt === false) {
                die("Error preparing statement: " . $conn->error);
            }
            // 绑定参数
            $stmt->bind_param('ss', $passwd,$username);
            if ($stmt->execute()) {
                echo "<script>alert('密码更新成功');location.href='login.php';</script>";
            } else {
                echo "<script>alert('密码更新失败');location.href='changePasswd.php';</script>";
            }
            $stmt->close();
        } else {
            echo "<script>
                var userChoice = confirm('该用户不存在。是否要注册新用户？');
                if (userChoice) {
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', 'register.php', true);
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            alert(xhr.responseText);
                            if (xhr.responseText === '用户注册成功') {
                                location.href = 'login.php'; // 注册成功后跳转到登录页面
                            } else {
                                location.href = 'changePasswd.php'; // 注册失败后返回修改密码页面
                            }
                        }
                    };
                    xhr.send('username=$username&passwd=$passwd');
                } else {
                    location.href = 'changePasswd.php'; // 返回到修改密码页面
                }
            </script>";
        }
    }
    $conn->close();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>更改密码</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="padding-all">
        <div class="header">
            <h1></h1>
        </div>

        <div class="design-w3l">
            <div class="header">
                <h1></h1>
            </div>

            <div class="mail-form-agile">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" autocomplete="new-password">
                    <input type="text" name="username" placeholder="账号" required>
                    <input type="password" name="checkpasswd" class="padding" placeholder="密码" required>
                    <input type="password" name="password" placeholder="确认密码" required>
                    <input type="submit" value="更改密码" style="margin-top: 50px;">
                </form>
            </div>
            <div class="clear"> </div>
        </div>
        
        <div class="footer">
            <p>致力于服务好每一位业主 有问题致电<a href="https://www.bilibili.com/" style="color: cyan;"> 123456</a></p>
        </div>
    </div>
</body>
</html>
