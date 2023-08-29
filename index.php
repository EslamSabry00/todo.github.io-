<?php 
require_once 'inc/header.php';
require_once 'App.php';
?>
<body>
    
    <div class="container my-3 ">    
        <div class="row d-flex justify-content-center">
               
                <div class="container mb-5 d-flex justify-content-center">
                    <div class="col-md-4">
                        <?php
                        if($session->hasGet('errors')):
                            foreach($session->get("errors") as $error):
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
                        <form action="handle/addToDo.php" method="post">
                        <textarea type="text" class="form-control" rows="3" name="title" id="" placeholder="enter your note here"></textarea>
                        <div class="text-center">
                            <button type="submit" name="submit" class="form-control text-white bg-info mt-3 " >Add To Do</button>
                        </div>
                        </form>
                    </div>
                </div>
               

        </div>
        <div class="row d-flex justify-content-between">   
            <!-- all -->
            <div class="col-md-3 "> 
                <h4 class="text-white">All Notes</h4>

                <?php
                $statement = $conn->query("select * from todo where `status`= 'todo'");
                        if($statement->rowCount()<1):
                        ?>
                            <div class="item">
                                <div class="alert-info text-center ">
                                 empty to do
                                </div>
                            </div>
                        <?php 
                        endif;
                while($oneTodo = $statement->fetch(pdo::FETCH_ASSOC)):
                ?>
                
                <div class="m-2  py-3">
                    <div class="show-to-do">
                        
                        <div class="alert alert-info p-2">
                                <h4 ><?php echo $oneTodo['title']?></h4>
                                <h5><?php echo $oneTodo['created_at']?></h5>
                                <div class="d-flex justify-content-between mt-3">
                                    <a href="edit.php?id=<?php echo $oneTodo['id']?>"class="btn btn-info p-1 text-white" >edit</a>
                                   
                                    <a href="handle/goto.php?status=0&id=<?php echo $oneTodo['id']?>"class="btn btn-info p-1 text-white" >doing</a>
                                </div>
                            
                        </div>
                    </div>
                </div>
                <?php 
                endwhile;
                ?>

            </div>

            <!-- doing -->
            <div class="col-md-3 ">
            
                <h4 class="text-white">Doing</h4>

                <?php
                $statement = $conn->query("select * from todo where `status`= 'doing'");
                        if($statement->rowCount()<1):
                        ?>
                   
                            <div class="item">
                                <div class="alert-success text-center ">
                                 empty to do
                                </div>
                            </div>
                        <?php 
                        endif;
                while($onedoing = $statement->fetch(pdo::FETCH_ASSOC)):
                ?>

                <div class="m-2 py-3">
                    <div class="show-to-do">
                        
                        <div class="alert alert-success p-2">
                                <h4 ><?php echo $onedoing['title']?></h4>
                                <h5><?php echo $onedoing['created_at']?></h5>
                                <div class="d-flex justify-content-between mt-3">
                                    <a></a>
                                    <a href="handle/goto.php?status=1&id=<?php echo $onedoing['id']?>"class="btn btn-success p-1 text-white" >Done</a>
                                </div>
                            
                        </div>
                    </div>
                </div>
                <?php 
                endwhile;
                ?>
            </div>
           
            <!-- done -->
            <div class="col-md-3">
                <h4 class="text-white">Done</h4>
                <?php
                $statement = $conn->query("select * from todo where `status`= 'done'");
                        if($statement->rowCount()<1):
                        ?>
                            <div class="item">
                                <div class="alert-warning text-center ">
                                 empty to do
                                </div>
                            </div>
                        <?php 
                        endif;
                while($onedone = $statement->fetch(pdo::FETCH_ASSOC)):
                ?>
                <div class="m-2 py-3">
                    <div class="show-to-do">
                        
                        <div class="alert alert-warning p-2">
                                <a href="handle/delete.php?id=<?php echo $onedone['id']?>" onclick="confirm('are your sure')"  class="remove-to-do text-dark d-flex justify-content-end " >X</a>                                                                
                                <h4 ><?php echo $onedone['title']?></h4>
                               <h5><?php echo $onedone['created_at']?></h5>
                               
                            
                        </div>
                    </div>
                </div>
                <?php 
                endwhile;
                ?>
            </div>
        </div>
    </div>

</body>
</html>