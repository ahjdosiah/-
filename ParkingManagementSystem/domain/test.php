<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>后台管理系统</title>

    <link href="../css/sidebar.css" rel="stylesheet">
    <style media="screen">
      /*body { padding-top: 70px; }*/
      #connectLogo {
        height: 60px;
        padding: 15px 0 5px 0;
      }
      #logo {
        height: 60px;
        padding: 5px 0 5px 20px;
      }

      .share-link {
        line-height: 60px;
        padding: 0 1em;
        font-size: 2em;
      }
    </style>

</head>

<body>
    <div id="wrapper">
        <!-- <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <img src="../image/lable.png">
                </li>
                <li>
                    <a href="dataAnalysis.php">数据分析</a>
                </li>
                <li>
                    <a href="carInfo.php">车主车辆</a>
                </li>
                <li>
                    <a href="parkingInfo.php">车位信息</a>
                </li>
                <li>
                    <a href="perInfo.php">人员信息</a>
                </li>
                <li>
                    <a href="other.php">其它</a>
                </li>
            </ul>
        </div> -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <button type="submit" name="action" value="add">增加</button>
                    </form>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->
</body>

</html>

<?php
if($_SERVER['REQUEST_METHOD'] == "POST")
$table_name = "maninfo";
    $command = "python ../export.py " . escapeshellarg($table_name);
    exec($command, $output, $return_var);
                            
    echo "<pre>";
    print_r($output);
    print_r($return_var);
    echo "</pre>";
    
?>