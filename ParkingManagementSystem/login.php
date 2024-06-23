<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登录界面</title>
    <link href="css/scrollable.css" rel="stylesheet">
    <link href="//cdn.staticfile.net/layui/2.9.11/css/layui.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="layui-btn-group" style="float: right">
        <button id="editBtn" class="layui-btn">临时用户登录</button>
    </div>
    <div class="padding-all">
        <div class="header">
            <h1>停车场后台管理系统</h1>
        </div>

        <div class="design-w3l">
            <div class="mail-form-agile">
                <!-- $_SERVER["PHP_SELF"]  当前文件的文件名-->
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                    <!-- 账号为admin -->
                    <input type="text" name="username" placeholder="账号" required>
                    <div class="password-container">
                        <input type="password" name="password" class="padding" placeholder="密码" required>
                        <div class="forgot-password"><a href="changePasswd.php" style="color: cyan;">忘记密码/注册</a></div>
                    </div>
                    <input type="submit" value="登录">
                </form>
            </div>
            <div class="clear"> </div>
        </div>

        <!--弹窗-->
        <div id="myModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <form id="editForm" method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <label for="name">姓名:</label>
                        <input type="text" id="name" name="name" value=""><br><br>
                        <label for="carID">车牌号:</label>
                        <input type="text" id="carID" name="carID" value=""><br><br>
                        <label for="stallID">车位号:</label>
                        <input type="text" id="stallID" name="stallID" value=""><br><br>
                        <label for="phone">电话号码:</label>
                        <input type="text" id="phone" name="phone" value=""><br><br>
                        <button type="submit" name="action" value="in">停车</button>
                        <button type="submit" name="action" value="out">出车</button>
                    </form>
                </div>
        </div>

        <div class="footer">
            <p>致力于服务好每一位业主 有问题请致电<a href="https://www.bilibili.com/" style="color: cyan;"> 123456</a></p>
        </div>
    </div>
    <script src="//cdn.staticfile.net/layui/2.9.11/layui.js"></script>
    <script>
        var modal = document.getElementById("myModal");
        var btn = document.getElementById("editBtn");
        var span = document.getElementsByClassName("close")[0];

        // 点击按钮打开弹窗
        btn.onclick = function() {
            modal.style.display = "block";
            document.getElementById('name').placeholder = "张静";
            document.getElementById('carID').placeholder = "赣N-P8549";
            document.getElementById('stallID').placeholder = "01006";
            document.getElementById('phone').placeholder = "13205143161";
        }

        // 点击 <span> (x) 关闭弹窗
        span.onclick = function() {
            modal.style.display = "none";
        }

        // 点击窗外关闭弹窗
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>

<?php
    include 'connect.php';
    session_start();
    if(isset($_SESSION['username'])){unset($_SESSION['username']);}
    if(isset($_SESSION['url'])){unset($_SESSION['url']);}
    if(isset($_SESSION['admin'])){unset($_SESSION['admin']);}
    // 检查表单是否以POST方式提交
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['username']) && isset($_POST['password'])){
            // 获取输入
            $username = $_POST['username'];
            $passwd = $_POST['password'];
            
            // 查询账户的密码
            $sql = "SELECT passwd FROM manager WHERE username = ?";
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
            // 查不到密码和密码错误的显示
            if(empty($row)){
                echo "<script>alert('用户不存在');location.href='login.php';</script>";
            } elseif ($row['passwd'] == $passwd) {
                $_SESSION['username'] = $username;

                header("Location: domain/baseinfo.php"); // 在header()之后立即退出
                exit();
            } else {
                echo "<script>alert('密码错误，请重新输入！');location.href='login.php';</script>";
                exit();
            }
        }
    }elseif ($_SERVER["REQUEST_METHOD"] == "GET"){
        $carID = $_GET['carID'];
        $stallID = $_GET['stallID'];

        //检查是否为固定车位
        $check = "SELECT isfixed FROM stall WHERE stallID=?";
        $stmt = $conn->prepare($check);
        if ($stmt === false) {
            die("Error preparing statement: " . $conn->error);
        }
        $stmt->bind_param('s',$stallID);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

        if($row['isfixed'] == 1){
            echo "<script>alert('该车位为固定车位，无法停车');location.href='login.php';</script>";
            exit();
        }

        date_default_timezone_set('Asia/Shanghai');
        $nowtime = new DateTime();
        if($_GET['action'] == 'in'){
            $query = "SELECT carOut,carIn FROM parkingnote WHERE stallID = ? ORDER BY carIn DESC LIMIT 1";
            $stmt_query = $conn->prepare($query);
            if ($stmt_query === false) {
                die("Error preparing statement: " . $conn->error);
            }
            $stmt_query->bind_param('s',$stallID);
            $stmt_query->execute();
            $result = $stmt_query->get_result();
            $row = $result->fetch_assoc();
            $stmt_query->close();
            if($row['carOut'] == NULL && $row['carIn'] != NULL){
                echo "<script>alert('该车位有车');location.href='login.php';</script>";
                exit();
            }

            $sql = "INSERT INTO parkingnote (stallID,carID,carIn) VALUES (?,?,?)";
            $stmt = $conn->prepare($sql);
            if ($stmt === false) {
                die("Error preparing statement: " . $conn->error);
            }
            $stmt->bind_param('sss',$stallID,$carID,$nowtime->format('Y-m-d H:i:s'));
            if($stmt->execute()){
                echo "<script>alert('停车成功');location.href='login.php';</script>";
                exit();
            }else{
                echo "<script>alert('$stmt->error');location.href='login.php';</script>";
                exit();
            }
            $stmt->close();
        }elseif ($_GET['action'] == 'out'){
            $sql1 = "SELECT carIn FROM parkingnote WHERE stallID=? AND carID=?";
            $stmt1 = $conn->prepare($sql1);
            if ($stmt1 === false) {
                die("Error preparing statement: " . $conn->error . "\nSQL: " . $sql1);
            }
            $stmt1->bind_param('ss', $stallID, $carID);
            $stmt1->execute();
            $result = $stmt1->get_result();
            $row = $result->fetch_assoc();
            $stmt1->close();

            if(empty($row)){
                echo "<script>alert('该车位没车或车牌号不对');location.href='login.php';</script>";
                exit();
            }else{                        
                $carIn = new DateTime($row['carIn']);
                $time = $carIn->diff($nowtime);
                $interval = new DateTime('0000-01-01 00:00:00');
                $interval->add($time);
                // $pay = "SELECT MAX(fee) as pay FROM fees WHERE timeType <= {$time->h}";
                // $retval = mysqli_query($conn, $pay);
                // if (!$retval) {
                //     printf("Error: %s\n", mysqli_error($conn));
                //     exit();
                // }    
                // $money = mysqli_fetch_assoc($retval);

                $sql = "UPDATE parkingnote SET carOut=?, time=? WHERE stallID=? AND carID=? ORDER BY carIn DESC LIMIT 1";
                $stmt = $conn->prepare($sql);
                if ($stmt === false) {
                    die("Error preparing statement: " . $conn->error . "\nSQL: " . $sql);
                }
                $stmt->bind_param('ssss',$nowtime->format('Y-m-d H:i:s'),$interval->format('H:i:s'),$stallID,$carID);
                if($stmt->execute()){
                    echo "<script>alert('出车成功');location.href='login.php';</script>";
                    exit();
                }else{
                    echo "<script>alert('出车失败');location.href='login.php';</script>";
                    exit();
                }
                $stmt->close();
            }
        }
    }
    $conn->close();
?>
