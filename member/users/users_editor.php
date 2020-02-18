<?php
 include("../template/header.php");
?>
<script language="javascript" src="users.js"></script>
<script type="text/javascript" src="../../js/jquery.js"></script>
<script	src="../../js/main.js" type="text/javascript"></script>
<link rel="stylesheet" href="../../css/datepicker.css">

<a href="index.php?cmd=list" class="btn green">List</a> <br><br>
  <div class="portlet box blue">
      <div class="portlet-title">
          <div class="caption"><i class="fa fa-globe"></i><b><?=ucwords(str_replace("_"," ","users"))?></b>
          </div>
          <div class="tools">
              <a href="javascript:;" class="reload"></a>
              <a href="javascript:;" class="remove"></a>
          </div>
      </div>
	   <div class="portlet-body">
		         <div class="table-responsive">	
	                <table class="table">
							 <tr>
							  <td>  

								 <form name="frm_users" method="post"  enctype="multipart/form-data" onSubmit="return checkRequired();">			
								  <div class="portlet-body">
						         <div class="table-responsive">	
					                <table class="table">
										 <tr>
						 <td>Email</td>
						 <td>
						    <input type="text" name="email" id="email"  value="<?=$email?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>Password</td>
						 <td>
						    <input type="text" name="password" id="password"  value="<?=$password?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>Title</td>
						 <td>
						    <input type="text" name="title" id="title"  value="<?=$title?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>First Name</td>
						 <td>
						    <input type="text" name="first_name" id="first_name"  value="<?=$first_name?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>Last Name</td>
						 <td>
						    <input type="text" name="last_name" id="last_name"  value="<?=$last_name?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>Company</td>
						 <td>
						    <input type="text" name="company" id="company"  value="<?=$company?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>Address</td>
						 <td>
						    <input type="text" name="address" id="address"  value="<?=$address?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>City</td>
						 <td>
						    <input type="text" name="city" id="city"  value="<?=$city?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>State</td>
						 <td>
						    <input type="text" name="state" id="state"  value="<?=$state?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>Zip</td>
						 <td>
						    <input type="text" name="zip" id="zip"  value="<?=$zip?>" class="textbox">
						 </td>
				     </tr><tr>
							 <td>Country</td>
							 <td><?php
	$info['table']    = "country";
	$info['fields']   = array("*");   	   
	$info['where']    =  "1=1 ORDER BY id DESC";
	$rescountry  =  $db->select($info);
?>
<select  name="country_id" id="country_id"   class="textbox">
	<option value="">--Select--</option>
	<?php
	   foreach($rescountry as $key=>$each)
	   { 
	?>
	  <option value="<?=$rescountry[$key]['id']?>" <?php if($rescountry[$key]['id']==$country_id){ echo "selected"; }?>><?=$rescountry[$key]['country']?></option>
	<?php
	 }
	?> 
</select></td>
					  </tr><tr>
						 <td>Created At</td>
						 <td>
						    <input type="text" name="created_at" id="created_at"  value="<?=$created_at?>" class="textbox">
							<a href="javascript:void(0);" onclick="displayDatePicker('created_at');"><img src="../../images/calendar.gif" width="16" height="16" border="0" /></a>
						 </td>
				     </tr><tr>
						 <td>Updated At</td>
						 <td>
						    <input type="text" name="updated_at" id="updated_at"  value="<?=$updated_at?>" class="textbox">
							<a href="javascript:void(0);" onclick="displayDatePicker('updated_at');"><img src="../../images/calendar.gif" width="16" height="16" border="0" /></a>
						 </td>
				     </tr><tr>
		           		 <td>Type</td>
				   		 <td><?php
	$enumusers = getEnumFieldValues('users','type');
?>
<select  name="type" id="type"   class="textbox">
<?php
   foreach($enumusers as $key=>$value)
   { 
?>
  <option value="<?=$value?>" <?php if($value==$type){ echo "selected"; }?>><?=$value?></option>
 <?php
  }
?> 
</select></td>
				  </tr><tr>
		           		 <td>Status</td>
				   		 <td><?php
	$enumusers = getEnumFieldValues('users','status');
?>
<select  name="status" id="status"   class="textbox">
<?php
   foreach($enumusers as $key=>$value)
   { 
?>
  <option value="<?=$value?>" <?php if($value==$status){ echo "selected"; }?>><?=$value?></option>
 <?php
  }
?> 
</select></td>
				  </tr>
										 <tr> 
											 <td align="right"></td>
											 <td>
												<input type="hidden" name="cmd" value="add">
												<input type="hidden" name="id" value="<?=$Id?>">			
												<input type="submit" name="btn_submit" id="btn_submit" value="submit" class="button_blue">
											 </td>     
										 </tr>
										</table>
										</div>
										</div>
								</form>
							  </td>
							 </tr>
							</table>
			      </div>
			</div>
  </div>			
<?php
 include("../template/footer.php");
?>

