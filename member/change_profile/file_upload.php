<?php
       session_start();
	   require(dirname(__FILE__) . '/../../Simple-Ajax-Uploader-master/code/Uploader.php');
	   
	   include("../../common/lib.php");
	   include("../../lib/class.db.php");
	   include("../../common/config.php");
	   
	   
	   if(check_file_extension($_FILES)==false)
		{
		  exit(json_encode(array('success' => false, 'msg' =>'Error:  .'.$_SESSION['extension'].' is not a supported file'))); 
		}
	   
		// Directory where we're storing uploaded images
		// Remember to set correct permissions or it won't work
		if(strlen($_FILES['uploadfile']['name'])>0 && $_FILES['uploadfile']['size']>0)
		{			
			if(!file_exists("../../users_images"))
			{ 
			   mkdir("../../users_images",0777);	
			}	
			
           if(!empty($_SESSION['users_id']))
			{
			  $file    =  $_SESSION['users_id']."_".str_replace(" ","_",strtolower(trim($_FILES['uploadfile']['name'])));
			  $inserted = true;
			}			
			else if(!empty($_REQUEST['id']))
			{
          
              $_SESSION['users_id']  = $_REQUEST['id'];
			  $file                   = $_SESSION['users_id']."_".str_replace(" ","_",strtolower(trim($_FILES['uploadfile']['name'])));
			  $inserted = true;
			}
			else
			{
			  $_SESSION['users_id'] = get_auto_increment($db); 
			  $file=trim($_SESSION['users_id'])."_".str_replace(" ","_",strtolower(trim($_FILES['uploadfile']['name'])));
			  $inserted=false;
			}
		}
   
		
		$upload_dir = '../../users_images/';		
		$uploader = new FileUpload('uploadfile');		
		$uploader->newFileName = $file;		
		// Handle the upload
		$result = $uploader->handleUpload($upload_dir);
		
		
		
		
		////////////////////////Resize Image///////////////////////////
         require_once('../../image_lib/image_lib_class.php');

		 	 /*	Purpose: Open image
		     *	Usage:	 resize('filename.type')
		     * 	Params:	 filename.type - the filename to open
		     */
			$imageLibObj = new imageLib($upload_dir.$file);
		
		
			/*	Purpose: Resize image
		     *	Usage:	 resizeImage([width], [height], [resize type], [sharpen])
		     * 	Params:	 width - the new width to resize to
		     *			 height - the new height to resize to
		     *			 resize type - choose from the below options
		     *
		     *      exact = The exact height and width dimensions you set. (Default)
		     *      portrait = Whatever height is passed in will be the height that
		     *          is set. The width will be calculated and set automatically 
		     *          to a the value that keeps the original aspect ratio. 
		     *      landscape = The same but based on the width. We try make the image 
		     *         the biggest size we can while stil fitting inside the box size
		     *      auto = Depending whether the image is landscape or portrait, this
		     *          will automatically determine whether to resize via 
		     *          dimension 1,2 or 0
		     *      crop = Will resize and then crop the image for best fit
		 	 *	
		 	 *			 sharpen - set as true if you would like shapening applied to 
		 	 *				to your resized image    
		     */	
			$imageLibObj -> resizeImage(125, 125, 'auto', true);
		
		
			/*	Purpose: Save image
		     *	Usage:	 saveImage('[filename.type]', [quality])
		     * 	Params:	 filename.type - the filename and file type to save as
		 	 * 			 quality - (optional) 0-100 (100 being the highest (default))
		     *				Only applies to jpg & png only
		     */
			$imageLibObj -> saveImage($upload_dir.'_'.$file, 100);
			
			   unlink($upload_dir.$file);

      //////////////////////Resize Image//////////////////////////////////



		//////////////////Save logo//////////////////
		       unset($info);
		      $info['table']    = "users";
		      $data['file_picture']= "users_images/".trim('_'.$file);
			   $info['data']     =  $data;
				if($inserted==false)
				{
					$db->insert($info);
					$inserted = true;
				}
		      else if(isset($_SESSION['users_id'])) 
				{
					$Id            = $_SESSION['users_id'];
					$info['where'] = "id='".$Id."' AND id='".$_SESSION['users_id']."'";
					$db->update($info);
		        }
		////////////////////////////////////
		
		
		if (!$result) {
		  exit(json_encode(array('success' => false, 'msg' => $uploader->getErrorMsg())));  
		}		
		echo json_encode(array('success' => true));
		
		function check_file_extension($_files)
		{
		  foreach($_files as $key=>$name)
		  {
			 if(strlen($_files[$key]['name'])>0 && $_files[$key]['size']>0)
			 {
					 unset($arr);			
					 $arr = explode(".",$_files[$key]['name']);			
					 $extension = strtolower($arr[count($arr)-1]);			
					 if(!(  $extension == "png"  || $extension == "jpg" || $extension == "jpeg" || $extension == "gif"  ))
					 {
						 $_SESSION['extension'] = $extension;
						// echo '<font color="red"><h3>Error:'.$extension .' is not supported file</h3></font>';
						 return false;
					 }
			 }
			// echo $arr[count($arr)-1];
		  } 
		  return true;
		}
		
		
		function get_auto_increment($db)
		{
			$sql    = "SHOW TABLE STATUS LIKE 'users'";
			$result = $db->execQuery($sql);
			$row    = $db->resultArray();
			return $row[0]['Auto_increment'];	
		}
?>