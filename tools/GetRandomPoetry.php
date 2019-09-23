<?php
    //函数：用于把数据封装为 JSON 格式
    function echoJSON($withStatus,$andMessage){
        $data = array('status' => $withStatus, 'message' => $andMessage);
        $jsonstring = json_encode($data);
        header('Content-Type: application/json');
        echo $jsonstring;
    }
    $user = 'poetry';
    $password = '123qwe';
    $db = 'poetry';
    $host = 'localhost';
    $port = 3306;
    $con=mysqli_init();
    $is_success = mysqli_real_connect($con,$host,$user,$password,$db,$port);
    if(!$is_success){echoJSON(false,"Connect Error: " . mysqli_connect_error());}
    $sql="SELECT *
    FROM poems AS t1 JOIN (SELECT ROUND(RAND() * ((SELECT MAX(id) FROM poems)-(SELECT MIN(id) FROM poems))+(SELECT MIN(id) FROM poems)) AS id) AS t2
    WHERE t1.id >= t2.id
    ORDER BY t1.id LIMIT 1;";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_array($result);
    $data = array('status' => true, 'title' => $row["title"], 'author' => $row["author"], 'content' => $row["content"]);
    $jsonstring = json_encode($data);
    header('Content-Type: application/json');
    echo $jsonstring;
    mysqli_close($con);
?>
