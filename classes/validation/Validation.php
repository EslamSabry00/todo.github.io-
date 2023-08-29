<?php

class Validation {

    private $errors;
    public function validate($key , $value , $rules) {

        foreach($rules as $rule)
        {
            $obj = new $rule;

          $error =   $obj->check($key , $value);
          if($error !=false) {
            $this->errors[] = $error;
          }
        }
    }
    public function getError()
    {
        return $this->errors;
    }

}