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
                数据库显示
                <div class="layui-btn-group" style="float: right">
                    <form method="POST">
                        <button type="submit" class="layui-btn" name="add">增加</button>
                        <button type="submit" class="layui-btn" name="del">清空</button>
                        <button type="submit" class="layui-btn" name="export">导出数据库文件</button>
                    </form>
                    <!-- 按钮事件处理 -->
                    <?php
                        if(isset($_POST['add'])){
                            //$head = shell_exec("where python");
                            exec('python ../insert.py 2>&1', $output, $return_var);
                            if ($return_var !== 0) {
                                $head = "增加失败";
                                $head .= "错误输出";

                                // 检查 $output 是否为数组
                                if (is_array($output)) {
                                    foreach ($output as $line) {
                                        $head .= $line;
                                    }
                                } else {
                                    $head .= "无法获取错误输出，输出不是一个数组";
                                }
                            } else {
                                $head = "增加成功";
                            }
                            
                            exec('python ../drawG.py 2>&1', $output, $return_var);
                            
                            // 获取当前工作目录
                            $current_dir = __DIR__;
                            $image_path = $current_dir . '/../image/earn.png';
                            
                            if (file_exists($image_path)) {
                                //echo "图片生成成功<br>";
                                // 图片的相对路径
                                $relative_image_path = '../image/earn.png';
                                // 添加时间戳来强制刷新缓存
                                $head .= "  分析完成";
                            } else {
                                echo "图片文件不存在: $image_path<br>";
                            }

                        }elseif(isset($_POST['del'])){
                            require "../connect.php";
                            $tablename = ['blackcar','carinfo','maninfo','parkingnote','stall'];
                            foreach ($tablename as $value) {
                                $sql = "DELETE FROM $value";
                                if ($conn->query($sql) !== TRUE) {
                                    $head = "执行删除操作时出错: {$conn->error}";
                                }else{
                                    $head = "删除成功!!!";
                                }
                            }
                        }elseif(isset($_POST['export'])){
                            exec('python ../export.py 2>&1', $output, $return_var);
                            if ($return_var !== 0) {
                                $head = "导出失败";
                                $head .= "错误输出";
                                // 检查 $output 是否为数组
                                if (is_array($output)) {
                                    foreach ($output as $line) {
                                        $head .= $line;
                                    }
                                } else {
                                    $head .= "无法获取错误输出，输出不是一个数组";
                                }
                            } else {
                                $head = "导出成功";
                            }
                        }
                    ?>
                </div>
            </blockquote>
            <div class="layui-card layui-panel">
                <div class="layui-card-header">
                    <?php echo $head;?>
                </div>
                <!-- 输出每个表的详细信息 -->
                <div class="layui-card-body">
                    <ul class="layui-row layui-col-space10 layui-this">
                        <?php
                            $sql = "SHOW TABLES";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // 输出每个表的字段信息
                                while($row = $result->fetch_assoc()) {
                                    $tableName = array_values($row)[0]; // 获取表名

                                    // 查询表的字段信息
                                    $tableMeta = $conn->query("DESCRIBE `$tableName`");

                                    //查询表中字段值
                                    if($tableName == "parkingnote"){
                                        $sel = "select * from $tableName order by carIn DESC";    
                                    }elseif($tableName == "maninfo" || $tableName == "stall"){
                                        $sel = "select * from $tableName order by stallID";
                                    }else{
                                        $sel = "select * from $tableName";
                                    }
                                    
                                    $retval = mysqli_query($conn, $sel);
                                    //不加判断会报错
                                    if (!$retval) {
                                        printf("Error: %s\n", mysqli_error($conn));
                                        exit();
                                    }  
                                    //返回记录数
                                    $row_length = mysqli_num_rows($retval);
                                    echo "<h2>$tableName</h2>";
                                    echo "<p>
                                            <span style='float: left;'>字段数量:". $tableMeta->num_rows."</span>
                                            <span style='float: right;'>信息数量：".$row_length."</span>
                                            <div style='clear: both;'></div>
                                        </p>";
                                    echo '<div class="scrollable-div">';
                                    echo '<table class="layui-table" lay-skin="line">';
                                    echo "<tr>";
                                    
                                    if ($tableMeta->num_rows > 0) {
                                        // 输出字段名称
                                        while($field = $tableMeta->fetch_assoc()) {
                                            echo "<th>" . $field["Field"] . "</th>";
                                        }
                                    } else {
                                        echo "<li>0 个字段</li>";
                                    }
                                    echo "</tr>";

                                    // 遍历输出数据表中的数据
                                    while ($row = mysqli_fetch_assoc($retval)) {
                                        echo '<tr>';
                                        foreach ($row as $value) {
                                            echo '<td>' . htmlspecialchars($value, ENT_QUOTES, 'UTF-8') . '</td>';
                                        }
                                        echo '</tr>';
                                    }

                                    echo "</table>";
                                    echo "</div><br>";
                                }
                            } else {
                                echo "0 results";
                            }
                            
                            // 关闭连接
                            $conn->close();
                        ?>
                    </ul>
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
    </script>
</body>
</html>