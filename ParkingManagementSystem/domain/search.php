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
                <<li class="layui-nav-item"><a href="baseinfo.php">基本信息</a></li>
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
                查询
            </blockquote>

            <div class="layui-card layui-panel">
                <div class="layui-card-header">
                    _代表一个字符，%代表多个字符
                </div>
                <div class="layui-card-body">
                    <form class="layui-form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <input type="text" name="input" placeholder="请输入搜索内容" class="layui-input">
                        <button type="button"  class="layui-btn demo-dropdown-base">
                            <input type="hidden" name="type" id="type">
                            <span>请选择查询类型</span>
                            <i class="layui-icon layui-icon-down layui-font-12"></i>
                        </button>
                        <button type="submit" class="layui-btn" style="float: right">搜索</button>
                    </form>
                    <?php
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            // 获取文本框内容
                            $input = isset($_POST['input']) ? $_POST['input'] : '';
                            // 获取下拉菜单的选择值
                            $type = isset($_POST['type']) ? $_POST['type'] : '';

                            if($type == "carID"){
                                $sql = "SELECT * FROM parkingnote WHERE carID LIKE ?";
                                $stmt = $conn->prepare($sql);
                                if ($stmt === false) {
                                    die("Error preparing statement: " . $conn->error);
                                }
                                // 绑定参数
                                $stmt->bind_param('s', $input);
                                // 执行查询
                                $stmt->execute();
                                // 获取结果
                                $result = $stmt->get_result();
                                echo '<div class="scrollable-div">';
                                echo '<table class="layui-table" lay-skin="line">
                                        <tr>
                                            <th>车位号</th>
                                            <th>车牌号</th>
                                            <th>停车时间</th>
                                            <th>出车时间</th>
                                            <th>时间间隔</th>
                                            <th>收费/员</th>
                                        </tr>';
                                echo '<tr>';
                                do{
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<tr>';
                                        foreach ($row as $value) {
                                            echo '<td>' . htmlspecialchars($value, ENT_QUOTES, 'UTF-8') . '</td>';
                                        }
                                        echo '</tr>';
                                    }     
                                } while($result = $stmt->get_result());
                                echo '</div>';
                                $stmt->close();
                            } 
                            $sql = "SELECT * FROM maninfo, carinfo, stall WHERE 
                                    maninfo.carID = carinfo.carID AND carinfo.carID = stall.carID AND maninfo.{$type} LIKE ?";
                            $stmt = $conn->prepare($sql);
                            if ($stmt === false) {
                                echo "error:".$conn->error;
                            }
                            // 绑定参数
                            $stmt->bind_param('s', $input);
                            // 执行查询
                            $stmt->execute();
                            // 获取结果
                            $result = $stmt->get_result();
                            $row = $result->fetch_assoc();
                            if(empty($row)){
                                echo "<h2>查无人员信息</h2>";
                            }else{
                                do{
                                    echo '<table class="layui-table" lay-skin="line">
                                        <tr>
                                            <th>姓名</th>
                                            <th>车位号</th>
                                            <th>车牌号</th>
                                            <th>电话号码</th>
                                            <th>住址</th>
                                            <th>月套餐收费</th>
                                            <th>车颜色</th>
                                            <th>车品牌</th>
                                            <th>车位地址</th>
                                            <th>是否为固定车位</th>
                                        </tr>';
                                    echo '<tr>';
                                    foreach ($row as $value) {
                                        echo '<td>' . htmlspecialchars($value, ENT_QUOTES, 'UTF-8') . '</td>';
                                    }
                                    echo '</tr>'; 
                                    echo '</table>';
                                    if($type != "carID"){
                                        $sql = "SELECT carIn,carOut,time,money FROM parkingnote WHERE carID = ?";
                                        $stmt1 = $conn->prepare($sql);
                                        if ($stmt1 === false) {
                                            die("Error preparing statement: " . $conn->error);
                                        }
                                        // 绑定参数
                                        $stmt1->bind_param('s', $row['carID']);
                                        // 执行查询
                                        $stmt1->execute();
                                        // 获取结果
                                        $result1 = $stmt1->get_result();
                                        echo '<table class="layui-table" lay-skin="line">
                                                <tr>
                                                    <th>停车时间</th>
                                                    <th>出车时间</th>
                                                    <th>时间间隔</th>
                                                    <th>收费/元</th>
                                                </tr>';
                                        echo '<tr>';
                                        while ($row = $result1->fetch_assoc()) {
                                            echo '<tr>';
                                            foreach ($row as $value) {
                                                echo '<td>' . htmlspecialchars($value, ENT_QUOTES, 'UTF-8') . '</td>';
                                            }
                                            echo '</tr>';
                                        }   
                                        echo '</tr>';
                                        echo '</table>';
                                        $stmt1->close();   
                                    }
                                    echo '<hr style="height:3px;border:none;color:black;background-color:black;">';
                                }while($row = $result->fetch_assoc());
                                $stmt->close();
                            }
                        }
                        $conn->close();
                    ?>
                </div>
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

        var dropdown = layui.dropdown;
            dropdown.render({
                elem: '.demo-dropdown-base', // 绑定元素选择器，此处指向 class 可同时绑定多个元素
                data: [{
                title: '姓名',
                    id: 'name'
                },{
                title: '车牌号',
                    id: 'carID'
                },{
                title: '停车位号',
                    id: 'stallID'
                },{
                title: '手机号',
                    id: 'phone'
                }],
                click: function(obj){
                    this.elem.find('span').text(obj.title);
                    document.getElementById('type').value = obj.id; // 设置隐藏输入框的值
                }
            });
        });
        document.querySelector('form').addEventListener('submit', function(event) {
            if (document.getElementById('type').value === '') {
                event.preventDefault(); // 阻止表单提交
                alert('请选择查询类型');
            }
        });
    </script>
</body>
</html>
