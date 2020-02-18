<?php
 include("../template/header.php");
?>
<script language="javascript" src="investment.js"></script>
<script type="text/javascript" src="../../js/jquery.js"></script>
<script	src="../../js/main.js" type="text/javascript"></script>
<link rel="stylesheet" href="../../css/datepicker.css">

<a href="index.php?cmd=list" class="btn green">List</a> <br><br>
  <div class="portlet box blue">
      <div class="portlet-title">
          <div class="caption"><i class="fa fa-globe"></i><b><?=ucwords(str_replace("_"," ","investment"))?></b>
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

								 <form name="frm_investment" method="post"  enctype="multipart/form-data" onSubmit="return checkRequired();">			
								  <div class="portlet-body">
						         <div class="table-responsive">	
					                <table class="table">
										 <tr>
						 <td>Invest Name</td>
						 <td>
						    <input type="text" name="investment_name" id="investment_name"  value="<?=$investment_name?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>Minimum Amount</td>
						 <td>
						    <input type="text" name="minimum_amount" id="minimum_amount"  value="<?=$minimum_amount?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>Commission In Percent</td>
						 <td>
						    <input type="text" name="commission_in_percent" id="commission_in_percent"  value="<?=$commission_in_percent?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td>In Days</td>
						 <td>
						    <input type="text" name="in_days" id="in_days"  value="<?=$in_days?>" class="textbox">
						 </td>
				     </tr><tr>
						 <td valign="top">Description</td>
						 <td>
						    <textarea name="description" id="description"  class="textbox" style="width:200px;height:100px;"><?=$description?></textarea>
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

