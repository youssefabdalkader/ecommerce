<?php 
session_start();

include_once __DIR__ . "/../../dir.php" ;
include_once $dir . "/requests/validation.php" ;
include_once $dir . "/models/user.php" ;



// frist name validation 
$fristnamevalidation = new Validation("frist name" ,$_POST["frist_name"]) ;
$fristnamerequire = $fristnamevalidation->require();

if(empty($fristnamerequire)){
    $fristnamestring = $fristnamevalidation->string();
    if(empty($fristnamestring)){
        $_SESSION['success']['frist_name'] = "frist_name";
        $_SESSION['values']['frist_name'] = $_POST["frist_name"];
    }else 
        $_SESSION['errors']['frist_name']['string'] = $fristnamerequire ; 
}else{
    $_SESSION['errors']['frist_name']['required'] = $fristnamerequire ; 
}
// -----------------------------------------------------------------------
// last name validation 
$lastnamevalidation = new Validation("last name" ,$_POST["last_name"]) ;
$lastnamerequire = $lastnamevalidation->require();

if(empty($lastnamerequire)){
    $lastnamestring = $lastnamevalidation->string();
    if(empty($lastnamestring)){
        $_SESSION['success']['last_name'] = "last_name";
        $_SESSION['values']['last_name'] = $_POST["last_name"];

    }else 
        $_SESSION['errors']['last_name']['string'] = $lastnamestring ; 
}else{
    $_SESSION['errors']['last_name']['required'] = $lastnamerequire ; 
}
// -----------------------------------------------------------------------
// gender validation 
$gendervalidation = new Validation("gender" ,$_POST["gender"]) ;
$genderrequire = $gendervalidation->require();

if(empty($genderrequire)){
    $gendervalue = $gendervalidation->gender();
    if(empty($gendervalue)){
        $_SESSION['success']['gender'] = "gender";
        $_SESSION['values']['gender'] = $_POST["gender"];

    }else 
        $_SESSION['errors']['gender']['m-f'] = $gendervalue ; 
}else{
    $_SESSION['errors']['gender']['required'] = $genderrequire ; 
}
// -----------------------------------------------------------------------
// email validation 
$emailvalidation = new Validation("email" ,$_POST["email"]) ;
$emailrequire = $emailvalidation->require();

if(empty($emailrequire)){
    $emailPattern = "/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/";
    $emailregex = $emailvalidation->regex($emailPattern);
    if(empty($emailregex)){
        $emailunique= $emailvalidation->unique("users") ;
        if(empty($emailunique)){
            $_SESSION['success']['email'] = "email";
            $_SESSION['values']['email'] = $_POST["email"];

        }else 
            $_SESSION['errors']['email']['unique'] = $emailunique ;  }
    else{
        $_SESSION['errors']['email']['regex'] = $emailregex ; 
    }
}else{
    $_SESSION['errors']['email']['required'] = $emailrequire ; 
}
// -----------------------------------------------------------------------   
// phone validation 
$phonevalidation = new Validation("phone" ,$_POST["phone"]) ;
$phonerequire = $phonevalidation->require();

if(empty($phonerequire)){
    $phonePattern = "/^01[0-2,5,9]{1}[0-9]{8}$/";    
    $phoneregex = $phonevalidation->regex($phonePattern);
    if(empty($phoneregex)){
        $phoneunique= $phonevalidation->unique("users") ;
        if(empty($phoneunique)){
            $_SESSION['success']['phone'] = "phone";
            $_SESSION['values']['phone'] = $_POST["phone"];

        }else 
            $_SESSION['errors']['phone']['unique'] = $phoneunique ;  }
    else{
        $_SESSION['errors']['phone']['regex'] = $phoneregex ; 
    }
}else{
    $_SESSION['errors']['phone']['required'] = $phonerequire ; 
}
// -----------------------------------------------------------------------    
// password validation 
$passwordvalidation = new Validation("password" ,$_POST["password"]) ;
$passwordrequire = $passwordvalidation->require();

if(empty($passwordrequire)){
    $passwordPattern =  "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,15}$/";
    $passwordregex = $passwordvalidation->regex($passwordPattern);
    if(empty($passwordregex)){
        $passwordunique= $passwordvalidation->confirm($_POST['confirm_password']) ;
        if(empty($passwordunique)){
            $_SESSION['success']['password'] = "password";
            $_SESSION['values']['password'] = $_POST["password"];

        }else 
            $_SESSION['errors']['password']['unique'] = $passwordunique ;  }
    else{
        $_SESSION['errors']['password']['regex'] = $passwordregex ; 
    }
}else{
    $_SESSION['errors']['password']['required'] = $passwordrequire ; 
}
// -----------------------------------------------------------------------   



// print_r($_POST);
// print_r($_SESSION); die;


if((isset($_SESSION['success']['frist_name']) && !empty($_SESSION['success']['frist_name'] )) &&
    isset($_SESSION['success']['last_name']) && !empty($_SESSION['success']['last_name']) &&
    isset($_SESSION['success']['gender']) && !empty($_SESSION['success']['gender']) && 
    isset($_SESSION['success']['email']) && !empty($_SESSION['success']['email']) && 
    isset($_SESSION['success']['phone']) && !empty($_SESSION['success']['phone']) && 
    isset($_SESSION['success']['password']) && !empty($_SESSION['success']['password']) 



)
{
    $user = new User ;
    $user->setFrist_name($_POST['frist_name']) ;
    $user->setLast_name($_POST['last_name']) ;
    $user->setPhone($_POST['phone']) ;
    $user->setEmail($_POST['email']) ;
    $user->setPassword($_POST['password']) ;
    $user->setGender($_POST['gender']) ;
    $code = rand(10000 , 99999);
    $user->setCode($code) ;
    $user->setEmail_varified_at(date("Y-m-d H-i-s")) ;
    $user->setStatus(1) ;
    $user->create();
    $user->varified_at();

    

    header("location:../../index.php") ; die ;
    
}
else {    header("location:../../register.php") ; die ; 
}









?>