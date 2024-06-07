<?php 
    include_once __DIR__ . "/dir.php" ;
    $title = 'profile' ;
    include_once $dir. "/models/user.php" ;   
    include_once $dir. "/layouts/header.php" ;
    include_once $dir. "/middleware/auth.php" ;
   
    $user =new User ;
    $user->setEmail($_SESSION['user']->email);

    $error=[];
   if(isset($_POST['update-profile'])){ 
        $user->setFrist_name($_POST['frist_name']);
        $user->setLast_name($_POST['last_name']);
        $user->setPhone($_POST['phone']);
        $user->setgender($_POST['gender']);

        if($_FILES['image']['error'] == 0){
            if($_FILES['image']['size'] > 10**6){
                $errors['size'] = "size greater than 1 megabyte" ;
            }
            $allowextension =['jpg' , 'png'] ;
            $imageextention = pathinfo($_FILES['image']['name'] ,PATHINFO_EXTENSION );
            
            if(!in_array($imageextention , $allowextension)){
                $errors['ex'] = "extensitin allow . " . implode("," , $allowextension)  ;
            }
            if(empty($errors)){
                $nameimage = uniqid() . $imageextention; 
                $path = "assets/img/users/" . $nameimage  ;
                move_uploaded_file($_FILES['image']['tmp_name'] , $path);
                $user->setImage($nameimage);
                $_SESSION['user']->image =  $nameimage;
            }

        }
        if(empty($errors)){
            $result = $user->updateprofile();
            $_SESSION['user']->frist_name = $_POST['frist_name']; 
            $_SESSION['user']->last_name  = $_POST['last_name']; 
            $_SESSION['user']->phone      = $_POST['phone']; 
            $_SESSION['user']->gender     = $_POST['gender']; 
            include_once $dir. "/layouts/nav.php" ;
            include_once $dir. "/layouts/breadcrumb.php" ;
        
            if($result){
                $success = "sucsess";
            }else {
                $errors['error'] = "error" ;

            }

        }
   }

   if(isset($_POST['update-password'])){
    if(!empty($_POST['old_password'])){
        $user->setPassword($_POST['old_password']);
        $result = $user->getuserbypassword() ;
        // print_r($result);
        
        if($result){
            if(!empty($_POST['new_password'])){
                $user->setPassword($_POST['new_password']);
                $result2=$user->updatepassword();
                if($result2){
                    $success = "sucsess";
                }else {
                    $errors1['errorpassword'] = "error1" ;
    
                
                }

            }else {
                $errors1['errorpassword'] = "error2" ;

            
            }
        }else {
            $errors1['errorpassword'] = "error3" ;

        
        }
    }else {
        $errors1['errorpassword'] = "error4" ;

    
    }
   }
?>
      <div class="checkout-area pb-80 pt-100">
    <div class="container">
        <div class="row">
            <div class="ml-auto mr-auto col-lg-9">
                <div class="checkout-wrapper">
                    <div id="faq" class="panel-group">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title"><span>1</span> <a data-toggle="collapse" data-parent="#faq" href="#my-account-1">Edit your account information </a></h5>
                            </div>
                            <div id="my-account-1" class="panel-collapse collapse show">
                                <div class="panel-body">
                                    <div class="billing-information-wrapper">
                                        <div class="account-info-wrapper">
                                            <h4>My Account Information</h4>
                                            <h5>Your Personal Details</h5>

                                            <h5 class="text-center">
                                                <?php
                                                if (!empty($errors)) {
                                                    foreach ($errors as $key => $error) {
                                                        echo $error;
                                                    }
                                                }
                                                if (isset($success)) {
                                                    echo $success;
                                                }
                                                ?>
                                            </h5>
                                        </div>
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-12 ">
                                                    <div class="row">
                                                        <div class="col-4 offset-4">
                                                            <img src="assets/img/users/<?=  $_SESSION['user']->image ?>" alt="" id="image" class="w-100 rounded-circle" >
                                                            <input type="file" name="image" id="file" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 mt-5">
                                                    <div class="billing-info">
                                                        <label>First Name</label>
                                                        <input type="text" name="frist_name" value="<?= $_SESSION['user']->frist_name?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 mt-5">
                                                    <div class="billing-info">
                                                        <label>Last Name</label>
                                                        <input type="text" name="last_name" value="<?= $_SESSION['user']->last_name ?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="billing-info">
                                                        <label>Phone</label>
                                                        <input type="number" name="phone" value="<?= $_SESSION['user']->phone ?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="billing-info">
                                                        <label for="Gender"> Gender </label>
                                                        <select name="gender" id="Gender" class="form-control">
                                                            <option  value="m" <?php if($_SESSION['user']->gender == 'm'){echo "selected" ; } ?>>Male</option>
                                                            <option  value="f" <?php if($_SESSION['user']->gender == 'f'){echo "selected" ; } ?>>Female</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="billing-back-btn">
                                                <div class="billing-btn">
                                                    <button type="submit" name="update-profile">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title"><span>2</span> <a data-toggle="collapse" data-parent="#faq" href="#my-account-2">Change your password </a></h5>
                            </div>
                            <div id="my-account-2" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="billing-information-wrapper">
                                        <div class="account-info-wrapper">
                                            <h4>Change Password</h4>
                                            <h5>Your Password</h5>
                                            <h5 class="text-center">
                                                <?php
                                                if (isset($errors1['errorpassword'])) {
                                                    
                                                        echo $errors1['errorpassword'];
                                                    
                                                }
                                                if (isset($success)) {
                                                    echo $success;
                                                }
                                                ?>
                                            </h5>
                                        </div>
                                        <form  method="post">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>Old Password</label>
                                                        <input type="password" name="old_password">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>New Password</label>
                                                        <input type="password" name="new_password">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="billing-info">
                                                        <label>Password Confirm</label>
                                                        <input type="password" name="password_confirmation">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="billing-back-btn">
                                                <div class="billing-btn">
                                                    <button type="submit" name="update-password">Update Password</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title"><span>3</span> <a data-toggle="collapse" data-parent="#faq" href="#my-account-3">Modify your address book entries </a></h5>
                            </div>
                            <div id="my-account-3" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <div class="billing-information-wrapper">
                                        <div class="account-info-wrapper">
                                            <h4>Address Book Entries</h4>
                                        </div>
                                        <div class="entries-wrapper">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 d-flex align-items-center justify-content-center">
                                                    <div class="entries-info text-center">
                                                        <p>Farhana hayder (shuvo) </p>
                                                        <p>hastech </p>
                                                        <p> Road#1 , Block#c </p>
                                                        <p> Rampura. </p>
                                                        <p>Dhaka </p>
                                                        <p>Bangladesh </p>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 d-flex align-items-center justify-content-center">
                                                    <div class="entries-edit-delete text-center">
                                                        <a class="edit" href="#">Edit</a>
                                                        <a href="#">Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="billing-back-btn">
                                            <div class="billing-back">
                                                <a href="#"><i class="ion-arrow-up-c"></i> back</a>
                                            </div>
                                            <div class="billing-btn">
                                                <button type="submit">Continue</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title"><span>4</span> <a href="wishlist.html">Modify your wish list </a></h5>
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
?>
<!-- <script>
    // document.getElementById('image').click(function(){
    //     document.getElementById('file').click();
    // });
    $('#image').on('click', function() {
        $('#file').click();
    });
</script> -->
