<?php 
    include '../connect.php';
    session_start(); 
    if (isset($_SESSION['username'])) {
        $_SESSION['url'] = $_SERVER['REQUEST_URI']; // 保存当前页面的 URL

        $sql = "SELECT isadmin FROM manager WHERE username = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            die("Error preparing statement: " . $mi->error);
        }
        // 绑定参数
        $stmt->bind_param('s', $_SESSION['username']);
        // 执行查询
        $stmt->execute();
        // 获取结果
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

        if ($result === FALSE) {
            die("Error: " . $conn->error); // 输出错误信息
        }      

        $_SESSION['admin'] = $row['isadmin']==1 ?true:false;
    }else{
        echo "<script>alert('没登陆就想看？？？');location.href='../login.php';</script>";
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
                    <!-- 在右上角显示用户名 -->
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
                        <?php
                            if($_SESSION['admin']){
                                echo "<dd><a href=\"moneyA.php\">营收分析</a></dd>";
                            }
                        ?>
                        <dd><a href="carA.php">车位分析 </a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item">
                    <a href="javascript:;">车主车辆</a>
                    <dl class="layui-nav-child">
                        <?php
                            if($_SESSION['admin']){
                                echo "<dd><a href=\"manInfo.php\">车主信息</a></dd>";
                            }
                        ?>
                        <dd><a href="carInfo.php">车辆信息</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item"><a href="blackCar.php">黑名单车辆</a></li>
                <?php
                    if($_SESSION['admin']){
                        echo "<li class=\"layui-nav-item\"><a href=\"manager.php\">账号管理</a></li>
                            <li class=\"layui-nav-item\"><a href=\"database.php\">数据库管理</a></li>
                            <li class=\"layui-nav-item\"><a href=\"search.php\">查询</a></li>";
                    }
                ?>
            </ul>
            </div>
        </div>

        <div class="layui-body">
            <!-- 内容主体区域 -->
            <div style="padding: 15px;">
                <blockquote class="layui-elem-quote layui-text">
                    基本信息
                    <?php
                        if($_SESSION['admin']){
                            echo "<div class=\"layui-btn-group\" style=\"float: right\">
                                    <button id=\"editBtn\" class=\"layui-btn\">编辑信息</button>
                            </div>";
                        }
                    ?>
                </blockquote>
                <!--处理弹窗-->
                <?php
                // 定义一个字段数组
                    $fields = [
                        'cfs' => '车库区数量',
                        'cws' => '区车位数量数',
                        'ls' => '楼栋数',
                        'dys' => '楼栋单元数',
                        'cs' => '单元层数',
                        'hs' => '层户数'
                    ];

                    $sql = "SELECT * FROM baseinfo";
                    $retval = mysqli_query($conn, $sql); 
                    if (!$retval){
                        printf("Error: %s\n", mysqli_error($conn));
                        exit();
                    }
                    // 由于我们期望的是多个结果，因此需要适当地获取这些结果
                    $row = mysqli_fetch_assoc($retval);

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $data = [];
                        foreach ($fields as $key => $label) {
                            $data[$key] = isset($_POST[$key]) ? $_POST[$key] : 0;
                        }
                        $action = $_POST['action'];

                        // 根据哪个按钮被点击来执行不同的操作
                        if ($action == "add") {
                            
                        } elseif ($action == "edit") {
                            $sql = "UPDATE baseinfo SET cfs=?,cws=?,ls=?,dys=?,cs=?,hs=?";

                        } elseif ($action == "del") {
                            
                        }
                        $stmt = $conn->prepare($sql);
                        if ($stmt === false) {
                            die("Error preparing statement: " . $conn->error);
                        }
                        $stmt->bind_param('iiiiii',$data['cfs'],$data['cws'],$data['ls'],$data['dys'],$data['cs'],$data['hs']);
                        // 执行查询
                        if ($stmt->execute()) {
                            echo "操作执行成功";
                        } else {
                            printf("Error: %s\n", $stmt->error);
                        }
                        $stmt->close();
                    }
                    $conn->close();
                ?>
                <!-- 弹窗 HTML -->
                <div id="myModal" class="modal">
                    <div class="modal-content">
                        <span class="close">&times;</span>
                        <form id="editForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                            <?php foreach ($fields as $key => $label): ?>
                                <label for="<?php echo $key; ?>"><?php echo $label; ?>:</label>
                                <input type="text" id="<?php echo $key; ?>" name="<?php echo $key; ?>" value=""><br><br>
                            <?php endforeach; ?>

                            <!-- <button type="submit" name="action" value="add">增加</button> -->
                            <button type="submit" name="action" value="edit">更改</button>
                            <!-- <button type="submit" name="action" value="del">删除</button> -->
                        </form>
                    </div>
                </div>

                <div class="layui-card layui-panel">
                    <div class="layui-card-header">
                        
                    </div>

                    <div class="layui-card-body">
                        <ul class="layui-row layui-col-space10 layui-this">
                            <li class="layui-col-xs3">
                                <h3>车库区数量</h3>
                                <p class="editable" data-field="cfs"><?php echo $row['cfs']; ?></p>
                            </li>
                            <li class="layui-col-xs3">
                                <h3>区车位数量</h3>
                                <p class="editable" data-field="cfs"><?php echo $row['cws']; ?></p>
                            </li>
                        </ul>

                        <ul class="layui-row layui-col-space10 layui-this">
                            <li class="layui-col-xs3">
                                <h3>小区楼栋数</h3>
                                <p class="editable" data-field="cfs"><?echo $row['ls'];?></p>
                            </li>
                            <li class="layui-col-xs3">
                                <h3>楼栋单元数</h3>
                                <p class="editable" data-field="cfs"><?php echo $row['dys']; ?></p>
                            </li>
                            <li class="layui-col-xs3">
                                <h3>单元层数</h3>
                                <p class="editable" data-field="cfs"><?php echo $row['cs']; ?></p>
                            </li>
                            <li class="layui-col-xs3">
                                <h3>每层户数</h3>
                                <p class="editable" data-field="cfs"><?php echo $row['hs']; ?></p>
                            </li>
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

    var modal = document.getElementById("myModal");
    var btn = document.getElementById("editBtn");
    var span = document.getElementsByClassName("close")[0];

    var phpData = <?php echo json_encode($row); ?>;
    // 点击按钮打开弹窗
    btn.onclick = function() {
        modal.style.display = "block";
        // 从服务器获取初始数据（这里用静态数据作为示例）
        for (var key in phpData) {
            if (phpData.hasOwnProperty(key)) {
                document.getElementById(key).value = phpData[key];
            }
        }
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