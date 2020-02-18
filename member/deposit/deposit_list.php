<?php
 include("../template/header.php");
?>

    <style>	    
			h5 {
				font-size: 1.28571429em;
				font-weight: 700;
				line-height: 1.2857em;
				margin: 0;
			}
			
			.card {
				font-size: 1em;
				overflow: hidden;
				padding: 0;
				border: none;
				border-radius: .28571429rem;
				box-shadow: 0 1px 3px 0 #d4d4d5, 0 0 0 1px #d4d4d5;
			}
			
			.card-block {
				font-size: 1em;
				position: relative;
				margin: 0;
				padding: 1em;
				border: none;
				border-top: 1px solid rgba(34, 36, 38, .1);
				box-shadow: none;
			}
			
			.card-img-top {
				display: block;
				width: 100%;
				height: auto;
			}
			
			.card-title {
				font-size: 1.28571429em;
				font-weight: 700;
				line-height: 1.2857em;
			}
			
			.card-text {
				clear: both;
				margin-top: .5em;
				color: rgba(0, 0, 0, .68);
			}
			
			/*.card-footer {
				font-size: 1em;
				position: static;
				top: 0;
				left: 0;
				max-width: 100%;
				padding: .75em 1em;
				color: rgba(0, 0, 0, .4);
				border-top: 1px solid rgba(0, 0, 0, .05) !important;
				background: #fff;
			}*/
			
			.card-inverse .btn {
				border: 1px solid rgba(0, 0, 0, .05);
			}
			
			.profile {
				position: absolute;
				top: -12px;
				display: inline-block;
				overflow: hidden;
				box-sizing: border-box;
				width: 25px;
				height: 25px;
				margin: 0;
				border: 1px solid #fff;
				border-radius: 50%;
			}
			
			.profile-avatar {
				display: block;
				width: 100%;
				height: auto;
				border-radius: 50%;
			}
			
			.profile-inline {
				position: relative;
				top: 0;
				display: inline-block;
			}
			
			.profile-inline ~ .card-title {
				display: inline-block;
				margin-left: 4px;
				vertical-align: top;
			}
			
			.text-bold {
				font-weight: 700;
			}
			
			.meta {
				font-size: 1em;
				color: rgba(0, 0, 0, .4);
			}
			
			.meta a {
				text-decoration: none;
				color: rgba(0, 0, 0, .4);
			}
			
			.meta a:hover {
				color: rgba(0, 0, 0, .87);
			}	
	</style>
 
    <!-- Prices block BEGIN -->
      <div class="row">
	 <?php
              unset($info);
			  unset($data);
            $info["table"] = "investment";
            $info["fields"] = array("investment.*"); 
            $info["where"]   = "1   $whrstr ORDER BY id DESC";
            $arr =  $db->select($info);
            
            for($i=0;$i<count($arr);$i++)
            {
     ?>
        <div class="col-sm-6 col-md-4 col-lg-3 mt-4">
            <div class="card">
                <div class="card-block">
                    <h4 class="card-title"><?=$arr[$i]['investment_name']?></h4>                    
                    <div class="card-text">
                        <?=$arr[$i]['description']?>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="float-right">Minimum Invest <?=$arr[$i]['minimum_amount']?></div>
                    <div><i class=""></i>Profit <?=$arr[$i]['commission_in_percent']?> in <?=$arr[$i]['in_days']?> days</div>
                    <br>
                    <a href="index.php?cmd=deposit&investment_id=<?=$arr[$i]['id']?>&minimum_amount=<?=$arr[$i]['minimum_amount']?>" class="btn green">Add a deposit</a>
                </div>
            </div>
        </div>
    <?php
              }
    ?>			
      </div>
    <!-- Prices block END -->
     		
 
 
 
 
 
 <div class="portlet box blue">
           <div class="portlet-title">
                <div class="caption"><i class="fa fa-globe"></i><b><?=ucwords(str_replace("_"," ","deposit"))?></b>
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
						<td align="center" valign="top">
						  <form name="search_frm" id="search_frm" method="post">
							<div class="portlet-body">
					         <div class="table-responsive">	
				                <table class="table">
									  <TR>
										<TD  nowrap="nowrap">
										  <?php
											  $hash    =  getTableFieldsName("deposit");
											  $hash    = array_diff($hash,array("id"));
										  ?>
										  Search Key:
										  <select   name="field_name" id="field_name"  class="textbox">
											<option value="">--Select--</option>
											<?php
											foreach($hash as $key=>$value)
											{
										    ?>
											<option value="<?=$key?>" <?php if($_SESSION['field_name']==$key) echo "selected"; ?>><?=str_replace("_"," ",$value)?></option>
											<?php
										    }
										  ?>
										  </select>
										</TD>
										<TD  nowrap="nowrap" align="right"><label for="searchbar"><img src="../../images/icon_searchbox.png" alt="Search"></label>
										   <input type="text"    name="field_value" id="field_value" value="<?=$_SESSION["field_value"]?>" class="textbox"></TD>
										<td nowrap="nowrap" align="right">
										  <input type="hidden" name="cmd" id="cmd" value="search_deposit" >
										  <input type="submit" name="btn_submit" id="btn_submit"  value="Search" class="button" />
										</td>
									  </TR>
									</table>
							</div>
							</div>
						  </form>
						</td>
				   </tr>
				   <tr>
				   <td> 
				
						<div class="portlet-body">
				      <div class="table-responsive">	
				          <table class="table">
							<tr bgcolor="#ABCAE0">
                                <td>Users</td>
                                <td>Investment</td>
                                <td>Amount</td>
                                <td>Date Deposit</td>
							</tr>
						 <?php
								
								if($_SESSION["search"]=="yes")
								  {
									$whrstr = " AND ".$_SESSION['field_name']." LIKE '%".$_SESSION["field_value"]."%'";
								  }
								  else
								  {
									$whrstr = "";
								  }
								  
								$whrstr .= " AND users_id='".$_SESSION['users_id']."'";
								  
						 
								$rowsPerPage = 10;
								$pageNum = 1;
								if(isset($_REQUEST['page']))
								{
									$pageNum = $_REQUEST['page'];
								}
								$offset = ($pageNum - 1) * $rowsPerPage;  
						 
						 
											  
								$info["table"] = "deposit";
								$info["fields"] = array("deposit.*"); 
								$info["where"]   = "1   $whrstr ORDER BY id DESC  LIMIT $offset, $rowsPerPage";
													
								
								$arr =  $db->select($info);
								
								for($i=0;$i<count($arr);$i++)
								{
								
								   $rowColor;
						
									if($i % 2 == 0)
									{
										
										$row="#C8C8C8";
									}
									else
									{
										
										$row="#FFFFFF";
									}
								
						 ?>
							<tr bgcolor="<?=$row?>" onmouseover=" this.style.background='#ECF5B6'; " onmouseout=" this.style.background='<?=$row?>'; ">
							  <td>
		                            <?php
									    unset($info2);        
										$info2['table']    = "users";	
										$info2['fields']   = array("*");	   	   
										$info2['where']    =  "1 AND id='".$arr[$i]['users_id']."' LIMIT 0,1";
										$res2  =  $db->select($info2);
										echo $res2[0]['first_name'].' '.$res2[0]['last_name'];	
					                ?>
							   </td>
			  				   <td>
		                            <?php
									    unset($info2);        
										$info2['table']    = "investment";	
										$info2['fields']   = array("investment_name");	   	   
										$info2['where']    =  "1 AND id='".$arr[$i]['investment_id']."' LIMIT 0,1";
										$res2  =  $db->select($info2);
										echo $res2[0]['investment_name'];	
					                ?>
							   </td>
                               <td><?=$arr[$i]['amount']?></td>
                               <td><?=$arr[$i]['date_deposit']?></td>
							</tr>
						<?php
								  }
						?>
						
						<tr>
						   <td colspan="10" align="center">
							  <?php              
									  unset($info);
					
									   $info["table"] = "deposit";
									   $info["fields"] = array("count(*) as total_rows"); 
									   $info["where"]   = "1  $whrstr ORDER BY id DESC";
									  
									   $res  = $db->select($info);  
					
												
										$numrows = $res[0]['total_rows'];
										$maxPage = ceil($numrows/$rowsPerPage);
										$self = 'index.php?cmd=list';
										$nav  = '';
										
										$start    = ceil($pageNum/5)*5-5+1;
										$end      = ceil($pageNum/5)*5;
										
										if($maxPage<$end)
										{
										  $end  = $maxPage;
										}
										
										for($page = $start; $page <= $end; $page++)
										//for($page = 1; $page <= $maxPage; $page++)
										{
											if ($page == $pageNum)
											{
												$nav .= "<li>$page</li>"; 
											}
											else
											{
												$nav .= "<li><a href=\"$self&&page=$page\" class=\"nav\">$page</a></li>";
											} 
										}
										if ($pageNum > 1)
										{
											$page  = $pageNum - 1;
											$prev  = "<li><a href=\"$self&&page=$page\" class=\"nav\">[Prev]</a></li>";
									
										   $first = "<li><a href=\"$self&&page=1\" class=\"nav\">[First Page]</a></li>";
										} 
										else
										{
											$prev  = '<li>&nbsp;</li>'; 
											$first = '<li>&nbsp;</li>'; 
										}
									
										if ($pageNum < $maxPage)
										{
											$page = $pageNum + 1;
											$next = "<li><a href=\"$self&&page=$page\" class=\"nav\">[Next]</a></li>";
									
											$last = "<li><a href=\"$self&&page=$maxPage\" class=\"nav\">[Last Page]</a></li>";
										} 
										else
										{
											$next = '<li>&nbsp;</li>'; 
											$last = '<li>&nbsp;</li>'; 
										}
										
										if($numrows>1)
										{
										  echo '<ul id="navlist">';
										   echo $first . $prev . $nav . $next . $last;
										  echo '</ul>';
										}
									?>     
						   </td>
						</tr>
						</table>
						</div>
					 </div>				
				</td>
				</tr>
				</table>
				</div>
			</div>
		</div>
<?php
include("../template/footer.php");
?>









