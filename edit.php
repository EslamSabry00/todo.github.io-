<?php
require_once 'inc/header.php';
require_once 'App.php';
?>

<?php 
if($request->hasGet('id') && $request->get('id')!= null){
    $id = $request->get('id');
}else{
    $request->header('index.php');
}
$statement = $conn->prepare("select * from todo where id= :id");
$statement->bindParam('id',$id);
$result = $statement->execute();
if($result){
    $task = $statement->fetch(pdo::FETCH_ASSOC);
}else{
    $request->header('index.php');
}

?>


<body class="container w-50 mt-5">
                        <?php
                        if($session->hasGet('editerrors')):
                            foreach($session->get("editerrors") as $error):
                        ?>
                            <div class="item">
                                <div class="alert-info text-center ">
                                 <?php echo $error?>
                                </div>
                            </div>
                        <?php 
                        endforeach;
                        endif;
                        ?>
    <form action="handle/edit.php?id=<?php echo $id?>" method="post">
            <textarea type="text" class="form-control"  name="title" id="" placeholder="enter your note here"><?php echo (isset($task['title']))? $task['title']:'no title' ?> </textarea>
            <div class="text-center">
                <button type="submit" name="submit" class="form-control text-white bg-info mt-3 " >Update</button>
            </div>  
    </form>
</body>
</html>