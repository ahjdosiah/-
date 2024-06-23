<?php
    include '../connect.php';
    session_start();
    if (isset($_SESSION['username'])) {
        if(!$_SESSION['admin']){
            // 如果用户不是管理员，设置一个会话变量来显示提示信息
            echo "<script>alert('非管理员无法查看');location.href='{$_SESSION['url']}';</script>";
            // 重定向到先前的页面
            exit();
        }
    }else{
        echo "<script>alert('没登陆就想看？？？');location.href='../login.php';</script>";
        exit();
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>后台管理系统</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//cdn.staticfile.net/layui/2.9.11/css/layui.css" rel="stylesheet">
    <link href="../css/scrollable.css" rel="stylesheet">
</head>
<body>
    <div class="layui-layout layui-layout-admin">
        <div class="layui-header">
            <div class="layui-logo layui-hide-xs layui-bg-black">停车后台管理</div>

            <ul class="layui-nav layui-layout-right">
                <li class="layui-nav-item layui-hide layui-show-sm-inline-block">
                    <a href="javascript:;">
                        <img src="//unpkg.com/outeres@0.0.10/img/layui/icon-v2.png" class="layui-nav-img">
                        <?php echo $_SESSION['username'];?>
                    </a>
                    <dl class="layui-nav-child">
                        <dd><a href="../login.php">登出</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item" lay-header-event="menuRight" lay-unselect>
                    <a href="javascript:;">
                        <i class="layui-icon layui-icon-more-vertical"></i>
                    </a>
                </li>
            </ul>
        </div>

        <div class="layui-side layui-bg-black">
            <div class="layui-side-scroll">
            <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
            <ul class="layui-nav layui-nav-tree" lay-filter="test">
                <li class="layui-nav-item"><a href="baseinfo.php">基本信息</a></li>
                <li class="layui-nav-item">
                    <a class="" href="javascript:;">数据分析</a>
                    <dl class="layui-nav-child">
                        <dd><a href="moneyA.php">营收分析</a></dd>
                        <dd><a href="carA.php">车位分析 </a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item">
                    <a href="javascript:;">车主车辆</a>
                    <dl class="layui-nav-child">
                        <dd><a href="manInfo.php">车主信息</a></dd>
                        <dd><a href="carInfo.php">车辆信息</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item"><a href="blackCar.php">黑名单车辆</a></li>
                <li class="layui-nav-item"><a href="manager.php">账号管理</a></li>
                <li class="layui-nav-item"><a href="database.php">数据库管理</a></li>
                <li class="layui-nav-item"><a href="search.php">查询</a></li>
            </ul>
            </div>
        </div>

        <div class="layui-body">
            <!-- 内容主体区域 -->
            <div style="padding: 15px;">
            <blockquote class="layui-elem-quote layui-text">
                账号管理
                <div class="layui-btn-group" style="float: right">
                    <button id="editBtn" class="layui-btn">编辑信息</button>
                </div>
            </blockquote>
            <div class="layui-card layui-panel">
                <div class="layui-card-header">
                    
                </div>
                <?php
                // 定义一个字段数组
                    $fields = [
                        'username' => '账号',
                        'passwd' => '密码',
                        'isadmin' => '是否为管理员',
                    ];
                    
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $data = [];
                        foreach ($fields as $key => $label) {
                            $data[$key] = isset($_POST[$key]) ? $_POST[$key] : '';
                        }
                        $action = $_POST['action'];
                    
                        // 确保用户名既不是 'admin' 也不是当前会话用户
                        if ($data['username'] != 'admin' && $data['username'] != $_SESSION['username']) {
                            if ($action == "add") {
                                $sql = "INSERT INTO manager (username, passwd, isadmin) VALUES (?, ?, ?)";
                                $stmt = $conn->prepare($sql);
                                if ($stmt === false) {
                                    die("Error preparing statement: " . $conn->error);
                                }
                                $stmt->bind_param('ssi', $data['username'], $data['passwd'], $data['isadmin']);
                            } elseif ($action == "edit") {
                                $sql = "UPDATE manager SET passwd=?, isadmin=? WHERE username=?";
                                $stmt = $conn->prepare($sql);
                                if ($stmt === false) {
                                    die("Error preparing statement: " . $conn->error);
                                }
                                $stmt->bind_param('sis', $data['passwd'], $data['isadmin'], $data['username']);
                            } elseif ($action == "del") {
                                $sql = "DELETE FROM manager WHERE username = ?";
                                $stmt = $conn->prepare($sql);
                                if ($stmt === false) {
                                    die("Error preparing statement: " . $conn->error);
                                }
                                $stmt->bind_param('s', $data['username']);
                            }
                    
                            if ($stmt->execute()) {
                                echo "操作执行成功";
                            } else {
                                printf("Error: %s\n", $stmt->error);
                            }
                    
                            // 关闭预处理语句
                            $stmt->close();
                        }
                    }                
                ?>
            <!--弹窗-->
                <div id="myModal" class="modal">
                    <div class="modal-content">
                        <span class="close">&times;</span>
                        <form id="editForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                            <?php foreach ($fields as $key => $label): ?>
                                <label for="<?php echo $key; ?>"><?php echo $label; ?>:</label>
                                <input type="text" id="<?php echo $key; ?>" name="<?php echo $key; ?>" value=""><br><br>
                            <?php endforeach; ?>

                            <button type="submit" name="action" value="add">增加</button>
                            <button type="submit" name="action" value="edit">更改</button>
                            <button type="submit" name="action" value="del">删除</button>
                        </form>
                    </div>
                </div>

                <div class="layui-card-body">
                    <?php
                        $sql = "SELECT 
                                    COUNT(username) AS num,
                                    SUM(CASE WHEN isadmin = '1' THEN 1 ELSE 0 END) AS numadmin
                                    FROM manager";
                        $retval = mysqli_query($conn, $sql); 
                        if (!$retval) {
                            printf("Error: %s\n", mysqli_error($conn));
                            exit();
                        }
                        $row = mysqli_fetch_assoc($retval);
                    ?>
                    <div>
                        <ul class="layui-row layui-col-space10 layui-this">
                            <li class="layui-col-xs3">
                                <h3>总账号数</h3>
                                <p><?php echo $row['num']; ?></p>
                            </li>
                            <li class="layui-col-xs3">
                                <h3>管理员人数</h3>
                                <p><?php echo $row['numadmin']; ?></p>
                            </li>
                            <li class="layui-col-xs3">
                                <h3>非管理员人数</h3>
                                <p><?php echo $row['num']-$row['numadmin']; ?></p>
                            </li>
                        </ul>
                    </div>
                    <br></br><br></br><br></br>
                    <div>
                        <?php
                            //sql语句
                            $sql = 'select * from manager';
                            $tableMeta = $conn->query("DESCRIBE manager");
                            $retval = mysqli_query($conn, $sql);	//执行
                            //不加判断会报错
                            if (!$retval) {
                                printf("Error: %s\n", mysqli_error($conn));
                                exit();
                            }                                    
                            //返回记录数
                            $row_length = mysqli_num_rows($retval);
                            echo "<h1>账号管理表</h1>";
                            echo "<p>
                                    <span style='float: left;'>字段数量:". $tableMeta->num_rows."</span>
                                    <span style='float: right;'>信息数量：".$row_length."</span>
                                    <div style='clear: both;'></div>
                                </p>";
                        ?>
                        <div class=" scrollable-div">    
                            <table class="layui-table" lay-skin="line">
                                <tr>
                                    <th>账号</th>
                                    <th>密码</th>
                                    <th>是否为管理员</th>
                                </tr>

                                <?php
                                    //sql语句
                                    $sql = 'select * from manager';
                                    $retval = mysqli_query($conn, $sql);	//执行
                                    //不加判断会报错
                                    if (!$retval) {
                                        printf("Error: %s\n", mysqli_error($conn));
                                        exit();
                                    }                                    
                                    //返回记录数
                                    $row_length = mysqli_num_rows($retval);
                                    
                                    //循环遍历出数据表中的数据
                                    while ($row = mysqli_fetch_assoc($retval)) {
                                        echo '<tr>';
                                        foreach ($row as $value) {
                                            echo '<td>' . htmlspecialchars($value, ENT_QUOTES, 'UTF-8') . '</td>';
                                        }
                                        echo '</tr>';
                                    }                                  
                                    mysqli_close($conn);
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <br><br>
            </div>
        </div>
        
        <div class="layui-footer">
            <p>致力于服务好每一位业主 有问题请致电<a href="https://www.bilibili.com/" style="color: cyan;"> 123456</a></p>
        </div>
    </div>
 
    <script src="//cdn.staticfile.net/layui/2.9.11/layui.js"></script>
    <script>
    //JS 
        layui.use(['element', 'layer', 'util'], function(){
        var element = layui.element;
        var layer = layui.layer;
        var util = layui.util;
        var $ = layui.$;
        
        //头部事件
        util.event('lay-header-event', {
            menuLeft: function(othis){ // 左侧菜单事件
            layer.msg('展开左侧菜单的操作', {icon: 0});
            },
            menuRight: function(){  // 右侧菜单事件
            layer.open({
                type: 1,
                title: '更多',
                content: '<div style="padding: 15px;">处理右侧面板的操作</div>',
                area: ['260px', '100%'],
                offset: 'rt', // 右上角
                anim: 'slideLeft', // 从右侧抽屉滑出
                shadeClose: true,
                scrollbar: false
            });
            }
        });
        });
        var modal = document.getElementById("myModal");
        var btn = document.getElementById("editBtn");
        var span = document.getElementsByClassName("close")[0];

        // 点击按钮打开弹窗
        btn.onclick = function() {
            modal.style.display = "block";
            // 从服务器获取初始数据（这里用静态数据作为示例）
            document.getElementById('username').value = "用户名";
            document.getElementById('passwd').value = "密码";
            document.getElementById('isadmin').value = "0";
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