<?php

require_once '../App.php';

if($request->get("id") != null && $request->hasGet("id")){   
    $id = $request->get('id');
    $stm = $conn->prepare("select id from todo where id = :id");
    $stm->bindParam(':id', $id);
    $testResult = $stm->execute();
    if($testResult){
        $statement = $conn->prepare("delete from todo where id = :id");
        $statement->bindParam(':id', $id);
        $result = $statement->execute();
        if($result){
            $request->header("../index.php");
        }else{
            echo 'error';
        }
    }else{
        $request->header('index.php');
    }
}else{
    $request->header('index.php');
}