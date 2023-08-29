<?php

require_once '../App.php';

if($request->get("id")!=null && $request->hasGet("id") && $request->get("id")!=null && $request->hasGet("id")){
    $id = $request->get('id');
    $status = $request->get('status');
    // test if exist
        $stm = $conn->prepare("select id from todo where id = :id");
        $stm->bindParam(':id', $id);
        $testResult = $stm->execute();
        if($testResult){
            if($status == 0){
                $statement = $conn->prepare("update todo set `status` = 'doing' where id=:id");
                $statement->bindParam(':id', $id);
                $result = $statement->execute();
                if($result){
                    $request->header("../index.php");
                }else{
                    echo 'error';
                }
            }else{
                $statement = $conn->prepare("update todo set `status` = 'done' where id=:id");
                $statement->bindParam(':id', $id);
                $result = $statement->execute();
                if($result){
                    $request->header("../index.php");
                }else{
                    echo 'error';
                }
            }
        }else{
            $request->header('../index.php');
        }

}else{
    $request->header('../index.php');
}