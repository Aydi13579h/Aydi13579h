
<div id="friends" style="display: inline-block; width: 200px;background-color: #eee;margin-bottom: 7px;" >
	<?php 

		$image = "images/user_male.jpg";
		if($FRIEND_ROW['gender'] == "Female")
		{
			$image = "images/user_female.jpg";
		}

		if(file_exists($FRIEND_ROW['profile_image']))
		{
			$image = $image_class->get_thumb_profile($FRIEND_ROW['profile_image']);
		}
 

	
 

	?>

	<a style="color:  #405d9b; text-decoration:none;" href="profile.php?id=<?php echo $FRIEND_ROW['userid']; ?>">
 		<img id="friends_img" src="<?php echo $image ?>">
		<br>
		<?php echo $FRIEND_ROW['first_name'] . " " . $FRIEND_ROW['last_name'] ?>
		<br>

		</a>

		<br>
		<div>
 	<?php 

				$mylikes ="(".$user_data['likes'].")";
				if ($user_data['likes'] == 0) {
					# code...
					$mylikes ="";
				}
                ?>
                	<a href="profile.php?type=user&id=<?php echo $FRIEND_ROW['userid'] ?>">
                <input style="margin-right:10px;margin-top: -35px; text-align: center; width: 100px;height: 25px; background:#f406e3; border: none;border-radius: 5px;" id="post_button" type="button"  value="following"></a>




            </div>
		
 	
</div>

 