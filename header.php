<!-- header bar-->
<?php               $image_class =new Image(); 
                      $user1_data = $login->check_login($_SESSION['mybook_userid']);

                        $corner_image="images/user_male.jpg";
                        if ($user1_data['gender'] == 'Female') {
                            $corner_image="images/user_female.jpg";
                        }
                        if (file_exists($user1_data['profile_image'])) {
                            $corner_image =$image_class->get_thumb_profile($user1_data['profile_image']);
                        }

                    ?>
         <div id="blue_bar">
             <form method="get" action="search.php">
             <div style="width:800px;margin:auto;font-size:30px;">
                
                <a href="index.php" style="color: white;text-decoration:none; ">Halmouch</a>



               

                 &nbsp &nbsp <input name="find" type="text" id="search_box" placeholder="search for people" >

                




                <a href="profile.php">
                <img src="<?php echo $corner_image ?>" style="width:50px; float:right">
                </a>
                <a href="logout.php">
                <span style="font-size: 11px;float: right;margin: 10px;color: white;">logout</span>
               
                </a>

                
             </div>
             </form>

         </div>