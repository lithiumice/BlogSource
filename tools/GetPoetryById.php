<?php
    //函数：用于把数据封装为 JSON 格式
    function echoJSON($withStatus,$andMessage){
        $data = array('status' => $withStatus, 'message' => $andMessage);
        $jsonstring = json_encode($data);
        header('Content-Type: application/json');
        echo $jsonstring;
    }
    // 配置数据库
    $user = 'poetry';
    $password = '123qwe';
    $db = 'poetry';
    $host = 'localhost';
    $port = 3306;
    $con=mysqli_init();
    if (!$con)
    {
        die("mysqli_init failed");
    }
    $success = mysqli_real_connect(
                                   $con,
                                   $host,
                                   $user,
                                   $password,
                                   $db,
                                   $port
                                   );
    if(!$success){
      die("mysqli connect failed");
    }
    $id = $_GET["id"] or die("no param!");
    if($id){
      if(is_numeric($id)){
            $result = mysqli_query($link,"SELECT * FROM `poetry` WHERE id=$id LIMIT 1");
            $row = mysqli_fetch_array($result);
            $data = array('status' => true, 'id' => $row["id"], 'content' => $row["content"]);
            $jsonstring = json_encode($data);
            header('Content-Type: application/json');
            echo $jsonstring;
          }
            else{
              echoJSON(false,"unsupported id");
            }

    }else{
        echoJSON(false,"invalid key");
    }
    // }else{
    //     echoJSON(false,"Connect Error: " . mysqli_connect_error());
    // }
    // 关闭数据库连接。
    mysqli_close($link);
?>
