<?php 
/**
 * 
 */
 class core
 {
 	
 	public function database($post)
 	{
 		$post = (object) array_filter($post);

 				// Connect to the database
		$mysqli = new mysqli($post->hostname,$post->username,$post->password,$post->database);

		// Check for errors
		if(mysqli_connect_errno())
			{
				return false;}
		else{

		// Open the default SQL file
		$query = file_get_contents('database');

		// Execute a multi query
		$mysqli->multi_query($query);

		// Close the connection
		$mysqli->close();

		return true;
		}



 	}	

 	public function system($post,$template,$file)
 	{
 		$post = (object) $post;

		$template_path = file_get_contents($template);


		$new  = str_replace("%installed%",'on',$template_path);

		$new  = str_replace("%hostname%",$post->hostname,$new);
		$new  = str_replace("%username%",$post->username,$new);
		$new  = str_replace("%password%",$post->password,$new);
		$new  = str_replace("%dbname%",$post->database,$new);

		// Write the new database.php file
		$handle = fopen($file,'w+');

		// Chmod the file, in case the user forgot
		@chmod($file,0777);

		// Verify file permissions
		if(is_writable($file)) {

			// Write the file
			if(fwrite($handle,$new)) {
				return true;
			} else {
				return false;
			}

		}

		return true;
 	}










 } 








 ?>