<?php


include("classes/autoload.php");



$login = new Login();

$user_data = $login->check_login($_SESSION['mybook_userid']);



if (isset($_GET['id']) && is_numeric($_GET['id'])) {
			$profile = new Profile();
			$profile_data = $profile->get_profile($_GET['id']);
			if (is_array($profile_data)) {
				$user_data=$profile_data[0];
			}

		}

  //posting start
	if ($_SERVER['REQUEST_METHOD']== "POST") {


		if (isset($_POST['first_name'])) {
			# code...

			$settings_class = new Settings();
			$settings_class->save_settings($_POST,$_SESSION['mybook_userid']);
			// header("Location :profile.php");

		}else{
			$post = new Post();
		$id = $_SESSION['mybook_userid'];
		$result =$post->create_post($id, $_POST,$_FILES);
		if ($result == "") {
			
			header("location: profile.php");
			die;
		} else {
			
		 // echo "<div style='text-align:center;font-size:12px;background-color:#eee;'>";
 	 // 	echo "<br> the following errors occured <br><br>";
 	 // 	echo $result;
 	 // 	echo "</div>";
		}


		}
		
		
		
	}

	//collect posts
	$post =new Post();
	$id= $user_data['userid'];
	$posts =$post->get_posts($id);

	//collect friends
	$user =new User();
	
	$friends =$user->get_friends($id);

	$image_class =new Image();
?>
<!DOCTYPE html>
	<html>
	<head>
		<title>Profile | Mybook</title>
	</head>

	<style type="text/css">
		
		#blue_bar{

			height: 50px;
			background-color: #405d9b;
			color: #d9dfeb;

		}

		#search_box{

			width: 400px;
			height: 20px;
			border-radius: 5px;
			border:none;
			padding: 4px;
			font-size: 14px;
			background-image: url(search.png);
			background-repeat: no-repeat;
			background-position: right;

		}

		#textbox{

			width: 100%;
			height: 20px;
			border-radius: 5px;
			border:none;
			padding: 4px;
			font-size: 14px;
			border: solid thin grey;
			margin:10px;
 
		}

		#profile_pic{

			width: 150px;
			margin-top: -300px;
			border-radius: 50%;
			border:solid 2px white;
		}

		#menu_buttons{

			width: 100px;
			display: inline-block;
			margin:2px;
		}

		#friends_img{

			width: 75px;
			float: left;
			margin:8px;

		}

		#friends_bar{

			background-color: white;
			min-height: 400px;
			margin-top: 20px;
			color: #aaa;
			padding: 8px;
		}

		#friends{

		 	clear: both;
		 	font-size: 12px;
		 	font-weight: bold;
		 	color: #405d9b;
		}

		textarea{

			width: 100%;
			border:none;
			font-family: tahoma;
			font-size: 14px;
			height: 60px;

		}

		#post_button{

			float: right;
			background-color: #405d9b;
			border:none;
			color: white;
			padding: 4px;
			font-size: 14px;
			border-radius: 2px;
			width: 50px;
			min-width: 50px;
			cursor: pointer;
		}
 
 		#post_bar{

 			margin-top: 20px;
 			background-color: white;
 			padding: 10px;
 			padding-bottom: 2px;
 		}

 		#post{

 			padding: 4px;
 			font-size: 13px;
 			display: flex;
 			margin-bottom: 20px;
 		}

	</style>

	<body style="font-family: tahoma; background-color: #d0d8e4;">




		<?php include("header.php");  ?>





		<!--cover area-->
		<div style="width: 800px;margin:auto;min-height: 400px;">
			
			<div style="background-color: white;text-align: center;color: #405d9b">
				<?php 

                		$image="images/cover_image.jpg";
                		if (file_exists($user_data['cover_image'])) {
                			$image = $image_class->get_thumb_cover($user_data['cover_image']);
                		}

                	?>
                <img  src="<?php echo $image ?>" style="width:100%;">

              







                <span style="font-size: 12px">
                	<?php 

                		$image="images/user_male.jpg";
                		if ($user_data['gender'] == 'Female') {
                			$image="images/user_female.jpg";
                		}
                		if (file_exists($user_data['profile_image'])) {
                			$image =$image_class->get_thumb_profile($user_data['profile_image']);
                		}

                	?>
                	  <img   id="profile_pic" src="<?php echo $image ?>"><br>


<?php 



				if ($user_data['userid'] == $_SESSION['mybook_userid']) {
					# code...

				
				echo "<a style='text-decoration: none;color: inherit;' href='change_profile_image.php?change=profile'>change profile image </a> |";
		             echo   "<a style='text-decoration: none;color: inherit;' href='change_profile_image.php?change=cover'>change cover </a>";
				}


								?>







		              
		                
            	</span>
                <br>  
                	<div style="font-size: 20px">

                		<a style="color: inherit;text-decoration: none;" href="profile.php?id=<?php echo $user_data['userid'] ; ?>">
					<?php  echo $user_data['first_name']." ".$user_data['last_name']; ?>

					</a>
                </div>
                <?php 

				$mylikes ="(".$user_data['likes'].")";
				if ($user_data['likes'] == 0) {
					# code...
					$mylikes ="";
				}
                ?>

                

                  <div>
                	<a href="like.php?type=user&id=<?php echo $user_data['userid'] ?>">
                <input style="margin-right:10px;margin-top: -35px; text-align: center; width: 150px;height: 25px; background:#f406e3; border: none;border-radius: 5px;" id="post_button" type="button"  value="followers <?php echo $mylikes    ?> "></a>




            </div>
                <br>
					

				<a href="index.php"><div id="menu_buttons">Timeline</div></a>
				<a href="profile.php?section=about&id=<?php echo $user_data['userid'] ; ?>"><div id="menu_buttons">about</div></a>
				<a href="profile.php?section=followers&id=<?php echo $user_data['userid'] ; ?>"><div id="menu_buttons">Followers</div></a>
				<a href="profile.php?section=following&id=<?php echo $user_data['userid'] ; ?>"><div id="menu_buttons">Following</div></a>
				<a href="profile.php?section=photos&id=<?php echo $user_data['userid'] ; ?>"><div id="menu_buttons">Photos</div></a>

				<?php 



				if ($user_data['userid'] == $_SESSION['mybook_userid']) {
					# code...

				echo "<a href='profile.php?section=settings&id=$user_data[userid]'><div id='menu_buttons'>Settings</div></a>";
				}


								?>
				
			</div>


				<!-- below thr cover area   ---> 
				<?php 

				$section ="default";
				if (isset($_GET['section'])) {
					# code...

					$section = $_GET['section'];


				}
				if ($section == "default") {

					
					include("profile_content_default.php");

				}elseif($section=="photos"){
					include("profile_content_photos.php");

				}elseif($section=="followers"){
					include("profile_content_followers.php");

				}elseif($section=="following"){
					include("profile_content_following.php");

				}elseif($section=="settings"){
					include("profile_content_settings.php");

				}elseif($section=="about"){
					include("profile_content_about.php");

				}


				 ?>

	</body>
</html>

