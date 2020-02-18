<?php
 include("../template/header.php");
?>
<script language="javascript" src="transaction.js"></script>
<script type="text/javascript" src="../../js/jquery.js"></script>
<script	src="../../js/main.js" type="text/javascript"></script>
<link rel="stylesheet" href="../../css/datepicker.css">

  <span class="error">
   <?php
     if(isset($message))
     { 
       echo "<h3>".$message."</h3>";
     }
   ?>
</span>

  <div class="portlet box blue">
      <div class="portlet-title">
          <div class="caption"><i class="fa fa-globe"></i><b><?=ucwords(str_replace("_"," ","Change Password"))?></b>
          </div>
          <div class="tools">
              <a href="javascript:;" class="reload"></a>
              <a href="javascript:;" class="remove"></a>
          </div>
      </div>
	   <div class="portlet-body">
		         <div class="table-responsive">	                    
                    <form name="frm_users" method="post" enctype="multipart/form-data"  onSubmit="return checkRequired();">
                      		  <table class="table">
                                <tr>
                                    <td>Email<span>*</span>
                                    </td>
                                    <td><input type="email" name="email" id="email"
                                        value="<?=$_SESSION['email']?>" class="form-control-static" readonly required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Old Password<span>*</span>
                                    </td>
                                    <td><input type="password" name="old_password" id="old_password"
                                        value="<?=$_REQUEST['old_password']?>" class="form-control-static" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>New Password<span>*</span>
                                    </td>
                                    <td><input type="password" name="password" id="password"
                                        value="<?=$_REQUEST['password']?>" class="form-control-static" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                    <input type="hidden" name="cmd" value="change"> 
                                    <input type="hidden" name="id" value="<?=$Id?>"> 
                                    <input type="submit" name="btn_submit" id="btn_submit" value="submit"  class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored purple"> 
                                    </td>
                                </tr>
                            </table>
                    </form>
                   
    			
                </div>
			</div>
  </div>			
<?php
 include("../template/footer.php");
?>

