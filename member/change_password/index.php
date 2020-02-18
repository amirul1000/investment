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
				$data['email']   = $_REQUEST['email'];
				$data['password']   = $_REQUEST['password'];
				$info['data']     =  $data;
		
				if(!empty($_SESSION['users_id']))
				{
				   if(get_password($db,$_REQUEST['old_password'])==true)
				   {
						$Id            = $_SESSION['users_id'];
						$info['where'] =  "id='".$_SESSION['users_id']."'";				
						$db->update($info);
						$message = "Password has been changed successfully";
				   }	
				   else
				   {
					  $message = "Old  password is not correct";
				   }
				}
				$email   = $_REQUEST['email'];
				$password   = $_REQUEST['password'];
				$old_password = $_REQUEST['old_password'];
				include("change_password_editor.php");
				break;
			case "edit":
				$Id               = $_SESSION['users_id'];
				if( !empty($Id ))
				{
					$info['table']    = "users";
					$info['fields']   = array("*");
					$info['where']    =  "id='".$_SESSION['users_id']."'";
						
					$res  =  $db->select($info);
						
					$Id        = $res[0]['id'];
					$email    = $res[0]['email'];
					//$password    = $res[0]['password'];			
				}
					
				include("change_password_editor.php");
				break;
			default:
			        $Id               = $_SESSION['users_id']; 
					if( !empty($Id ))
					{
						$info['table']    = "users";
						$info['fields']   = array("*");
						$info['where']    =  "id='".$_SESSION['users_id']."'";
							
						$res  =  $db->select($info);
							
						$Id        = $res[0]['id'];
						$email    = $res[0]['email'];
						//$password    = $res[0]['password'];			
					}
				  include("change_password_editor.php");
				
		}
		/*
		*
		*/
		function get_password($db,$password)
		{
			  unset($info);
			$info['table']    = "users";
			$info['fields']   = array("*");
			$info['where']    =  " password='".$password."'";
			$res  =  $db->select($info);
			if(count($res))
			{
			  return true;
			}
			return false;
		}
?>