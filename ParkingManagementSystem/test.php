<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>编辑弹窗示例</title>
    <style>
        /* 弹窗的样式 */
        .modal {
            display: none; /* 默认隐藏 */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            border-radius: 10px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

<h2>编辑弹窗示例</h2>
<button id="editBtn">编辑信息</button>

<!-- 弹窗 HTML -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <form id="editForm">
            <label for="username">用户名:</label>
            <input type="text" id="username" name="username" value=""><br><br>
            <label for="email">电子邮件:</label>
            <input type="email" id="email" name="email" value=""><br><br>
            <button type="button" onclick="submitForm()">保存</button>
        </form>
    </div>
</div>

<script>
    // 获取弹窗元素和按钮
    var modal = document.getElementById("myModal");
    var btn = document.getElementById("editBtn");
    var span = document.getElementsByClassName("close")[0];

    // 点击按钮打开弹窗
    btn.onclick = function() {
        modal.style.display = "block";
        // 从服务器获取初始数据（这里用静态数据作为示例）
        document.getElementById("username").value = "示例用户";
        document.getElementById("email").value = "example@example.com";
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

    // 提交表单数据（可以通过 AJAX 提交到服务器）
    function submitForm() {
        var username = document.getElementById("username").value;
        var email = document.getElementById("email").value;

        // 打印数据作为示例
        console.log("用户名: " + username);
        console.log("电子邮件: " + email);

        // 关闭弹窗
        modal.style.display = "none";

        // 发送数据到服务器（这里是示例，实际应用中可以使用 AJAX）
        // var xhr = new XMLHttpRequest();
        // xhr.open("POST", "your_server_endpoint.php", true);
        // xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        // xhr.onreadystatechange = function () {
        //     if (xhr.readyState == 4 && xhr.status == 200) {
        //         alert("保存成功！");
        //     }
        // };
        // xhr.send("username=" + encodeURIComponent(username) + "&email=" + encodeURIComponent(email));
    }
</script>

</body>
</html>
