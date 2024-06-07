<?php 
session_start();

include_once __DIR__ . "/../../dir.php" ;
include_once $dir . "/requests/validation.php" ;
include_once $dir . "/models/User.php" ;




// email validation 
$emailvalidation = new Validation("email" ,$_POST["email"]) ;
$emailrequire = $emailvalidation->require();

if(empty($emailrequire)){
    $emailPattern = "/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/";
    $emailregex = $emailvalidation->regex($emailPattern);
    if(empty($emailregex)){
        
            $_SESSION['success']['email'] = "email";
            $_SESSION['values']['email'] = $_POST["email"];

    }
    else{
        $_SESSION['errors']['email']['regex'] = $emailregex ; 
    }
}else{
    $_SESSION['errors']['email']['required'] = $emailrequire ; 
}
// ---------------------------------------------------------------------------------------------------------------------------------------------------
// password validation 
$passwordvalidation = new Validation("password" ,$_POST["password"]) ;
$passwordrequire = $passwordvalidation->require();

if(empty($passwordrequire)){
    $passwordPattern =  "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,15}$/";
    $passwordregex = $passwordvalidation->regex($passwordPattern);
    if(empty($passwordregex)){
        
            $_SESSION['success']['password'] = "password";
            $_SESSION['values']['password'] = $_POST["password"];

        }
    else{
        $_SESSION['errors']['password']['regex'] = $passwordregex ; 
    }
}else{
    $_SESSION['errors']['password']['required'] = $passwordrequire ; 
}
// -----------------------------------------------------------------------   



// print_r($_POST);
// print_r($_SESSION); die;


if(
    empty($_SESSION['errors'])

)
{
    $user = new User ;
   
    $user->setEmail($_POST['email']) ;
    $user->setPassword($_POST['password']) ;
    // print_r($user); die ; 

    $result = $user->login(); // one user || no user
    // print_r($result); die ; 

  
    
    
    
    if(!empty($result)){
        $userobject = $result->fetch_object();
        if($userobject->status == "1"){
            if($_POST['remember_me']){
                setcookie('remember_me' ,$_POST['email'] , time() +(24*60*60) , '/' );
            }
            $_SESSION['user'] = $userobject;
            header("location:../../index.php") ; die ;
        }
        if($userobject->status == "2"){
            echo "block" ; die ;
        }else{
            echo "try agian" ; die;
        }
    }
    else{
        echo "error" ; die ; 
    }
    

    
}
else {    header("location:../../login.php") ; die ; 
}









?>