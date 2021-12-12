<div id="post">
								
		<div style="width: 80px">

			<?php 

				$image = "images/user_male.jpg";
				if($ROW_USER['gender'] == "Female")
				{
					$image = "images/user_female.jpg";
				}
				// if($ROW_USER['type'] == "group")
				// {
				// 	$image = $image_class->get_thumb_profile("images/cover_image.jpg");
				// }
				
				if(file_exists($ROW_USER['profile_image']))
				{
					$image = $image_class->get_thumb_profile($ROW_USER['profile_image']);
				}else
				if( file_exists($ROW_USER['cover_image']))
				{
					$image = $image_class->get_thumb_profile($ROW_USER['cover_image']);
				}
			?>


<?php 
echo "<a href='profile.php?id=$ROW[userid]'>"; 
		echo"<img src='$image' style='width: 60px;margin-right: 5px;border-radius: 50%'>";
			echo "</a>";
			?>
		</div>

		<div style="width: 100%">
			<div style="font-weight: bold;color: #405d9b;width: 100%;">
				
				<?php 




				echo "<a style='color:inherit;text-decoration:none;' href='profile.php?id=$ROW[userid]'>";
				 echo htmlspecialchars($ROW_USER['first_name']) ." " . htmlspecialchars($ROW_USER['last_name']); 
				 echo "</a>";





					if($ROW['is_profile_image'])
					{
						$pronoun = "his";
						if($ROW_USER['gender'] == "Female")
						{
							$pronoun = "her";
						}
						echo "<span style='font-weight:normal;color:#aaa;'> updated $pronoun profile image</span>";

					}

					if($ROW['is_cover_image'])
					{
						$pronoun = "his";
						if($ROW_USER['gender'] == "Female")
						{
							$pronoun = "her";
						}
						echo "<span style='font-weight:normal;color:#aaa;'> updated $pronoun cover image</span>";

						
						}


				 ?>

			</div>
			<br>

			&nbsp &nbsp &nbsp <?php echo htmlspecialchars($ROW['post']); ?><br><br>
			<?php 

			if (file_exists($ROW['image'])) 

			{
				$post_image = $image_class->get_thumb_post($ROW['image']);
				echo "<a style='text-decoration:none;color:blue;' href='image_view.php?id=$ROW[postid]'> <img src='$post_image' style='width:80%' /></a>";
			}

			?>
			<br>
			<br>
			<?php 
			$likes ='';
			$likes  =  ($ROW['likes'] > 0) ? " (".$ROW['likes'].")" :  ""  ;


			 ?>

			
			<a style="color: inherit;text-decoration: none;" href="like.php?type=post&id=<?php echo $ROW['postid'] ?>">like<?php echo $likes ?></a>  . 


<?php 
			$comments ='';
			$comments  =  ($ROW['comments'] > 0) ? " (".$ROW['comments'].")" :  ""  ;
			


			 ?>

			 <a href="single_post.php?id=<?php echo $ROW['postid'] ?>"   style="color: inherit;text-decoration: none;"  >comments<?php echo   $comments ?></a> . 

			<span style="color: #999">
			<?php echo Time::get_time($ROW['date']) ?> 

		</span> 
		<?php 
		if ($ROW['has_image']) {
			# code...
			
			echo ".<a style='text-decoration:none;color:blue;' href='image_view.php?id=$ROW[postid]'> View full image</a> .";
			
		}



		?>
		
         <span style="color: #999 ;float: right;">


         	<?php 
         			$post = new Post();
         			

         			$checkk = $post->i_own_post($ROW['postid'],$_SESSION['mybook_userid']);
         			if ($checkk) {
         				echo "<a style='color: #999;text-decoration: none;' href='edit.php?id=$ROW[postid]'>
						  edit
						</a> . 
						<a style='color: #999;text-decoration: none;' href='delete.php?id=$ROW[postid]'>
							delete
						</a>";
         			}



         			

					

			?>

		</span> 

		 <?php 
		 $i_like = false;
		 if (isset($_SESSION['mybook_userid'])) {
		 	# code...
		 

 			$DB = new Database();
 			
			//save likes details
			$sql = "select likes from likes where type='post' && contentid = '$ROW[postid]' limit 1";
			$result = $DB->read($sql);
			if(is_array($result)){

				$likes = json_decode($result[0]['likes'],true);

				$user_ids = array_column($likes, "userid");
 
				if(in_array($_SESSION['mybook_userid'], $user_ids)){
					$i_like = true;

				}

			}


}


		 if ($ROW['likes'] > 0) {
         				# code...
		 				echo "<br>";
		 				echo "<a href='likes.php?type=post&id=$ROW[postid]'>"; 

         				if ($ROW['likes']== 1) {
         					# code...
         					if ($i_like) {
         						echo "<div style='text-align:left;'>You liked this post </div>";
         					}else{
         					
         					echo "<div style='text-align:left;'> 1 person liked this post </div>";}
         				}else{
         					if ($i_like) {
         						$text ="others";
         						if ($ROW['likes']-1 ==1) {
         							# code...

         							$text ="other";
         						}

         						echo "<div style='text-align:left;'> You and " . ($ROW['likes'] - 1) ." ". $text." liked this post </div>";
         					}else{
         					
         					echo "<div style='text-align:left;'>". $ROW['likes']." others liked this post </div>";}
         				

         				

}

echo "</a>";

}

		  ?>
		</div>

</div>
<div style="background-color:#d0d8e4;height: 15px;width: 103.9%;margin-left: -10px;"></div>