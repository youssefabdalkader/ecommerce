<?php 
    include_once __DIR__ . "/dir.php" ;
    $title = 'login' ;

    include_once $dir. "/models/user.php" ;   
    include_once $dir. "/layouts/header.php" ;   
     include_once $dir. "/middleware/guest.php" ;
    include_once $dir. "/layouts/nav.php" ;
    include_once $dir. "/layouts/breadcrumb.php" ;
?>

        <div class="login-register-area ptb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                        <div class="login-register-wrapper">
                            <div class="login-register-tab-list nav">
                                <a class="active" data-toggle="tab" href="#lg1">
                                    <h4> <?= $title ?> </h4>
                                </a>
                               
                            </div>
                            <div class="tab-content">
                                <div id="lg1" class="tab-pane active">
                                    <div class="login-form-container">
                                        <div class="login-register-form">
                                            <form action="app/post/loginvalidation.php " method="post">
                                                <input type="text" name="email" placeholder="email">
                                                <?php if(isset($_SESSION['errors']['email']))  {
                                                    foreach ($_SESSION['errors']['email'] as $key => $value) {
                                                        echo $value ;
                                                    }
                                                } ?> 
                                                <input type="password" name="password" placeholder="Password">
                                                <?php if(isset($_SESSION['errors']['password']))  {
                                                    foreach ($_SESSION['errors']['password'] as $key => $value) {
                                                        echo $value ;
                                                    }
                                                } ?>
                                                <div class="button-box">
                                                    <div class="login-toggle-btn">
                                                        <input type="checkbox" name ="remember_me">
                                                        <label>Remember me</label>
                                                        <a href="#">Forgot Password?</a>
                                                    </div>
                                                    <button type="submit"><span>Login</span></button>
                                                </div>
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  
        
<?php 
    include_once $dir. "/layouts/footer.php" ;
    include_once $dir. "/layouts/footerscripts.php" ;
    unset($_SESSION['errors'])

?>

