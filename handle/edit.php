<?php

require_once '../App.php';


if($request->get("id") != null && $request->hasGet("id")){    
    $id = $request->get('id');
    $title = $request->post('title');
    $validation->validate('title',$title,['Required', "Str"]);
    $editerrors = $validation->getError();
    if(empty($editerrors)){
        //check if exist
        $stm = $conn->prepare("select id from todo where id = :id");
        $stm->bindParam(':id', $id);
        $testResult = $stm->execute();
        if($testResult){
            $statement = $conn->prepare("update todo set `title` = :title where id=:id");
            $statement->bindParam(':title', $title);
            $statement->bindParam(':id', $id);
            $result = $statement->execute();
            if($result){
            if($session->hasGet('editerrors')){
                $session->remove('editerrors');
            }
            $request->header("../index.php");
            }else{
                echo 'error';
            }
        }else{
            $request->header("../index.php");
        }
    }else{
        $session->set('editerrors', $editerrors);
        $request->header("../edit.php?id=$id");
    }
}else{
    $request->header("../index.php");
}