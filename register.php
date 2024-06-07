<?php 
    include_once __DIR__ . "/dir.php" ;
    $title = 'register' ;
    include_once $dir. "/models/User.php" ;
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
                              
                                <a class="active" data-toggle="tab" href="#lg2">
                                    <h4> register </h4>
                                </a>
                            </div>
                            <div class="tab-content">
                                <div id="lg1" class="tab-pane active">
                                  
                                <div id="lg2" class="tab-pane active">
                                    <div class="login-form-container">
                                        <div class="login-register-form">
                                            <form action="app/post/registervalidation.php" method="post">
                                                <input type="text" name="frist_name" placeholder="frist name" value="<?php if(isset($_SESSION['values']['frist_name'])) {echo $_SESSION['values']['frist_name'];}?>">
                                                <?php if(isset($_SESSION['errors']['frist_name']))  {
                                                    foreach ($_SESSION['errors']['frist_name'] as $key => $value) {
                                                        echo $value ;
                                                    }
                                                } ?> 
                                                <input type="text" name="last_name" placeholder="last name" value="<?php if(isset($_SESSION['values']['last_name'])) {echo $_SESSION['values']['last_name'];}?>">
                                                <?php if(isset($_SESSION['errors']['last_name']))  {
                                                    foreach ($_SESSION['errors']['last_name'] as $key => $value) {
                                                        echo $value ;
                                                    }
                                                } ?> 
                                                <input name= "phone" placeholder="phone" type="text" value="<?php if(isset($_SESSION['values']['phone'])) {echo $_SESSION['values']['phone'];}?>">
                                                <?php if(isset($_SESSION['errors']['phone']))  {
                                                    foreach ($_SESSION['errors']['phone'] as $key => $value) {
                                                        echo $value ;
                                                    }
                                                } ?> 
                                                <input name="email" placeholder="Email" type="email" value="<?php if(isset($_SESSION['values']['email'])) {echo $_SESSION['values']['email'];}?>">
                                                <?php if(isset($_SESSION['errors']['email']))  {
                                                    foreach ($_SESSION['errors']['email'] as $key => $value) {
                                                        echo $value ;
                                                    }
                                                } ?> 
                                                <input type="password" name="password" placeholder="Password" >
                                                <?php if(isset($_SESSION['errors']['password']))  {
                                                    foreach ($_SESSION['errors']['password'] as $key => $value) {
                                                        echo $value ;
                                                    }
                                                } ?> 
                                                <input type="password" name="confirm_password" placeholder="confirm Password">
                                                <select name="gender" id="">
                                                    <option <?php if(isset($_SESSION['values']['gender']) && $_SESSION['values']['gender'] =='m') {echo "selected" ;}?>  value="m">male</option>
                                                    <option <?php if(isset($_SESSION['values']['gender']) && $_SESSION['values']['gender'] =='f') {echo "selected" ;}?>value="f">female</option>
                                                </select>
                                                <?php if(isset($_SESSION['errors']['gender']))  {
                                                    foreach ($_SESSION['errors']['gender'] as $key => $value) {
                                                        echo $value ;
                                                    }
                                                } ?> 

                                                <div class="button-box mt-5">
                                                    <button type="submit"><span><?= $title ?></span></button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer style Start -->
 

<?php 
    include_once $dir. "/layouts/footer.php" ;
    include_once $dir. "/layouts/footerscripts.php" ;
    unset($_SESSION['errors'])
?>