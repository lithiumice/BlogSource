---
title: get random poems from phpserver
top: false
cover: false
toc: true
mathjax: true
date: 2019-09-16 23:05:42
password:
summary:
tags:
categories:
---
## 最全中华古诗词数据库
唐宋两朝近一万四千古诗人, 接近5.5万首唐诗加26万宋诗. 两宋时期1564位词人，21050首词
地址: https://github.com/chinese-poetry/chinese-poetry
## 转换脚本
古诗词、唐诗宋词转换成mysql sql 文件的PHP脚本
地址: https://github.com/woodylan/chinese-poetry-to-mysql-tool
## 使用的服务器端代码
```
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
    $is_success = mysqli_real_connect(
                                   $con,
                                   $host,
                                   $user,
                                   $password,
                                   $db,
                                   $port
                                   );
    if(!$is_success){echoJSON(false,"Connect Error: " . mysqli_connect_error());}
    $id = $_GET["id"];
    if(true || is_numeric($id)){
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
    }else{
      echoJSON(false,"unsupported id");
    }
    mysqli_close($link);
?>
```
