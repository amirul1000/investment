<?php
 include("../template/header.php");
?>
<script language="javascript" src="profit.js"></script>
<script type="text/javascript" src="../../js/jquery.js"></script>
<script	src="../../js/main.js" type="text/javascript"></script>
<link rel="stylesheet" href="../../css/datepicker.css">

<a href="index.php?cmd=list" class="btn green">List</a> <br><br>
  <div class="portlet box blue">
      <div class="portlet-title">
          <div class="caption"><i class="fa fa-globe"></i><b><?=ucwords(str_replace("_"," ","profit"))?></b>
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

								 <form name="frm_profit" method="post"  enctype="multipart/form-data" onSubmit="return checkRequired();">			
								  <div class="portlet-body">
						         <div class="table-responsive">	
					                <table class="table">
										 <tr>
							 <td>Users</td>
							 <td><?php
	$info['table']    = "users";
	$info['fields']   = array("*");   	   
	$info['where']    =  "1=1 ORDER BY id DESC";
	$resusers  =  $db->select($info);
?>
<select  name="users_id" id="users_id"   class="textbox">
	<option value="">--Select--</option>
	<?php
	   foreach($resusers as $key=>$each)
	   { 
	?>
	  <option value="<?=$resusers[$key]['id']?>" <?php if($resusers[$key]['id']==$users_id){ echo "selected"; }?>><?=$resusers[$key]['email']?></option>
	<?php
	 }
	?> 
</select></td>
					  </tr><tr>
							 <td>Investment</td>
							 <td><?php
	$info['table']    = "investment";
	$info['fields']   = array("*");   	   
	$info['where']    =  "1=1 ORDER BY id DESC";
	$resinvestment  =  $db->select($info);
?>
<select  name="investment_id" id="investment_id"   class="textbox">
	<option value="">--Select--</option>
	<?php
	   foreach($resinvestment as $key=>$each)
	   { 
	?>
	  <option value="<?=$resinvestment[$key]['id']?>" <?php if($resinvestment[$key]['id']==$investment_id){ echo "selected"; }?>><?=$resinvestment[$key]['investment_name']?></option>
	<?php
	 }
	?> 
</select></td>
					  </tr><tr>
						 <td>Amount</td>
						 <td>
						    <input type="text" name="amount" id="amount"  value="<?=$amount?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>Date Profit</td>
						 <td>
						    <input type="text" name="date_profit" id="date_profit"  value="<?=$date_profit?>" class="textbox">
							<a href="javascript:void(0);" onclick="displayDatePicker('date_profit');"><img src="../../images/calendar.gif" width="16" height="16" border="0" /></a>
						 </td>
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

