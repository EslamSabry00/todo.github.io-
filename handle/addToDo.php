<?php

require_once '../App.php';
if($request->hasPost('submit')){
    $title = $request->clean('title');
    
    //validation
    $validation->validate('title', $title,['Required','Str']);
    $errors = $validation->getError();
    if(empty($errors)){
        $statement = $conn->prepare("insert into todo(`title`) values(:title)");
        $statement->bindParam(':title', $title);
        $result = $statement->execute();
        if($result){
        if($session->hasGet('errors')){
            $session->remove('errors');
        }
        $request->header("../index.php");
        }else{
            echo 'error';
        }
    }else{
        $session->set('errors', $errors);
        $request->header("../index.php");
    }
}else{
    $request->header('../index.php');
}