<?php

class Request { // 


    public function get(string $key=null) 
    {
        // return $_GET[$key];
        
        // return ($key !=null )?  (isset($_GET[$key])? $_GET[$key] :null) : null;
        
        return ($key != null) ? ( isset($_GET[$key])? $_GET[$key] :null ): null;

    }

    public function post(string $key) {
        return ($key !=null )?  (isset($_POST[$key])? $_POST[$key] :null) : null;

        return $_POST[$key];
    }

    public function hasPost($key) 
    {
        return isset($_POST[$key]);
    }

    public function hasGet($key) 
    {
        return isset($_GET[$key]);
    }

    public function clean($key) {
        return trim(htmlspecialchars($_POST[$key]));
    }

    public function header($file)
    {
        return header("location:$file");
    }
}
