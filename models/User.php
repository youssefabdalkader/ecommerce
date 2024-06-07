<?php 
include_once __DIR__ . "/../dir.php" ;
include_once $dir . "/app/database/config.php";
include_once $dir . "/app/database/operations.php";


class User extends Config  implements Operations{
    private $frist_name ;
    private $last_name ;
    private $email  ;
    private $password ;
    private $phone ;
    private $gender ;
    private $image ;
    private $status ;
    private $code ;
    private $email_varified_at ;
    private $created_at ;
    private $update_at ;


  

    /**
     * Get the value of frist_name
     */ 
    public function getFrist_name()
    {
        return $this->frist_name;
    }

    /**
     * Set the value of frist_name
     *
     * @return  self
     */ 
    public function setFrist_name($frist_name)
    {
        $this->frist_name = $frist_name;

        return $this;
    }

    /**
     * Get the value of last_name
     */ 
    public function getLast_name()
    {
        return $this->last_name;
    }

    /**
     * Set the value of last_name
     *
     * @return  self
     */ 
    public function setLast_name($last_name)
    {
        $this->last_name = $last_name;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = sha1($password);

        return $this;
    }

    /**
     * Get the value of phone
     */ 
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set the value of phone
     *
     * @return  self
     */ 
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get the value of gender
     */ 
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set the value of gender
     *
     * @return  self
     */ 
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get the value of image
     */ 
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image
     *
     * @return  self
     */ 
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of code
     */ 
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set the value of code
     *
     * @return  self
     */ 
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get the value of email_varified_at
     */ 
    public function getEmail_varified_at()
    {
        return $this->email_varified_at;
    }

    /**
     * Set the value of email_varified_at
     *
     * @return  self
     */ 
    public function setEmail_varified_at($email_varified_at)
    {
        $this->email_varified_at = $email_varified_at;

        return $this;
    }

    /**
     * Get the value of created_at
     */ 
    public function getCreated_at()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * @return  self
     */ 
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get the value of update_at
     */ 
    public function getUpdate_at()
    {
        return $this->update_at;
    }

    /**
     * Set the value of update_at
     *
     * @return  self
     */ 
    public function setUpdate_at($update_at)
    {
        $this->update_at = $update_at;

        return $this;
    }

    public function create(){
        $query = "INSERT INTO `users`(`frist_name`, `last_name`, `email`, `password`, `phone`, `gender`,`code`)
         VALUES ('$this->frist_name' , '$this->last_name' ,'$this->email' ,'$this->password' , '$this->phone' , '$this->gender' , $this->code  )" ; 
         return $this->runDML($query) ;
    }

    public function update(){

    }

    public function delete(){

    }

    public function read(){

    }
    public function varified_at(){
        $query = "UPDATE `users` SET `email_varified_at` = '$this->email_varified_at' , `status` =  '$this->status'  WHERE `email` = '$this->email' " ;
        return $this->runDML($query) ;

    }

    public function login(){
        $query = "SELECT * FROM `users` WHERE `email` = '$this->email' AND `password` = '$this->password' " ;
        return $this->runDQL($query) ;
    }
    public function getuserbyemail(){
        $query = "SELECT * FROM `users` WHERE `email` = '$this->email' " ;
        return $this->runDQL($query) ;
    }
    public function updateprofile(){
        $image =null ;
        if(isset($this->image)){
            $image =", `image` =  '$this->image'" ;
        }
        $query = "UPDATE `users` SET `frist_name` = '$this->frist_name' , `last_name` =  '$this->last_name' , `phone` =  '$this->phone' , `gender` =  '$this->gender' $image
        WHERE `email` = '$this->email' " ;
        return $this->runDML($query) ;

    }
    public function getuserbypassword(){
        $query = "SELECT * FROM `users` WHERE `email` = '$this->email' and `password` = '$this->password' " ;
        return $this->runDQL($query) ;
    }
    public function updatepassword(){
        $query = "UPDATE `users` SET `password` = '$this->password' 
        WHERE `email` = '$this->email' " ;
        return $this->runDML($query) ;
    }

}