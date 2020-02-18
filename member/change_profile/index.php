<?php
		session_start();
		include("../../common/lib.php");
		include("../../lib/class.db.php");
		include("../../common/config.php");
		
	    if(empty($_SESSION['users_id'])) 
	   {
	     Header("Location: ../../");
	   }
	   
	   $cmd = $_REQUEST['cmd'];
	   switch($cmd)
	   {
	     
		  case 'change': 
						$info['table']    = "users";
						$data['title']   = $_REQUEST['title'];
						$data['first_name']   = $_REQUEST['first_name'];
						$data['last_name']   = $_REQUEST['last_name'];
						$data['company']   = $_REQUEST['company'];
						$data['address']   = $_REQUEST['address'];
						$data['city']   = $_REQUEST['city'];
						$data['state']   = $_REQUEST['state'];
						$data['zip']   = $_REQUEST['zip'];
						$data['country_id']   = $_REQUEST['country_id'];				
						$info['data']     =  $data;
						
					 	 $info['where'] = "id=".$_SESSION['users_id'];
					  	 $db->update($info);
					  	 
					  	 
					  	$info['table']    = "users";
						$info['fields']   = array("*");   	   
						$info['where']    = "id=".$_SESSION['users_id'];					   
						$res  =  $db->select($info);
					   
						$Id        = $res[0]['id'];  
						$title    = $res[0]['title'];
						$first_name    = $res[0]['first_name'];
						$last_name    = $res[0]['last_name'];
						$company    = $res[0]['company'];
						$address    = $res[0]['address'];
						$city    = $res[0]['city'];
						$state    = $res[0]['state'];
						$zip    = $res[0]['zip'];
						$country_id    = $res[0]['country_id'];			   
					
				include("change_profile_editor.php");						   
				break; 
		  case 'delete': 
				$Id               = $_REQUEST['id'];
				//get logo
				 unset($info);
				$info["table"] = "users";
				$info["fields"] = array("users.*"); 
				$info["where"]   = "id='$Id' AND id='".$_SESSION['users_id']."'";
				$arr =  $db->select($info);
				$file_picture = $arr[0]['file_picture']; 				
				//
				
				 unset($info);
				$info['table']    = "users";
				$info['where']    = "id='$Id' AND users_id='".$_SESSION['users_id']."'";
				
				if($Id && count($arr)>0)
				{
					$db->delete($info);					
                    unlink("../../".$file_picture);
				}
				include("change_profile_editor.php");						   
				break; 		 
	     default :    
		    
					$info['table']    = "users";
					$info['fields']   = array("*");   	   
					$info['where']    = "id=".$_SESSION['users_id'];
				   
					$res  =  $db->select($info);
				   
					$Id        = $res[0]['id'];  
					$title    = $res[0]['title'];
					$first_name    = $res[0]['first_name'];
					$last_name    = $res[0]['last_name'];
					$file_picture    = $res[0]['file_picture'];
					$company    = $res[0]['company'];
					$address    = $res[0]['address'];
					$city    = $res[0]['city'];
					$state    = $res[0]['state'];
					$zip    = $res[0]['zip'];	
					$country_id    = $res[0]['country_id'];	
				   
				include("change_profile_editor.php");
	   }
?>
