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
          <div class="caption"><i class="fa fa-globe"></i><b><?=ucwords(str_replace("_"," ","Profile"))?></b>
          </div>
          <div class="tools">
              <a href="javascript:;" class="reload"></a>
              <a href="javascript:;" class="remove"></a>
          </div>
      </div>
	   <div class="portlet-body">
		         <div class="table-responsive">	 
                   <form name="frm_company" method="post"  enctype="multipart/form-data" onSubmit="return checkRequired();">
                     <table class="table">
                             <tr>
                                 <td>Title</td>
                                 <td>
                                    <input type="text" name="title" id="title"  value="<?=$title?>" class="form-control-static">
                                 </td>
                             </tr>
                             <tr>
                                 <td>First Name</td>
                                 <td>
                                    <input type="text" name="first_name" id="first_name"  value="<?=$first_name?>" class="form-control-static">
                                 </td>
                             </tr>
                             <tr>
                                 <td>Last Name</td>
                                 <td>
                                    <input type="text" name="last_name" id="last_name"  value="<?=$last_name?>" class="form-control-static">
                                 </td>
                             </tr>
                             <tr>
                                     <td>Picture(75px X 75px)</td>
                                     <td>	 
                                     
                                             <!--<link href="../../Simple-Ajax-Uploader-master/assets/css/styles.css" rel="stylesheet">-->
                                             
                                                  <!--<div class="container">-->
                                                    <div class="page-header">
                                                      <h5>Upload Picture</h5>
                                                    </div>
                                                      <div class="row" style="padding-top:10px;">
                                                        <div class="col-xs-2">
                                                          <button id="uploadBtn" class="btn btn-large btn-primary">Choose File</button>
                                                        </div>
                                                        <div class="col-xs-10">
                                                      <div id="progressOuter" class="progress progress-striped active" style="display:none;">
                                                        <div id="progressBar" class="progress-bar progress-bar-success"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                                                        </div>
                                                      </div>
                                                        </div>
                                                      </div>
                                                      <div class="row" style="padding-top:10px;">
                                                        <div class="col-xs-10">
                                                          <div id="msgBox">
                                                          </div>
                                                        </div>
                                                      </div>
                                                  <!--</div>-->
                                                  <?php
                                                     if(isset($Id)) {
                                                       $url = 'file_upload.php?id='.$Id;
                                                    }
                                                    else {
                                                        $url = 'file_upload.php';
                                                        }
                                                  ?>
                                            
                                            <script src="../../Simple-Ajax-Uploader-master/SimpleAjaxUploader.js"></script>
                                            <script>
                                            function escapeTags( str ) {
                                              return String( str )
                                                       .replace( /&/g, '&amp;' )
                                                       .replace( /"/g, '&quot;' )
                                                       .replace( /'/g, '&#39;' )
                                                       .replace( /</g, '&lt;' )
                                                       .replace( />/g, '&gt;' );
                                            }
                                            
                                            window.onload = function() {
                                            
                                              var btn = document.getElementById('uploadBtn'),
                                                  progressBar = document.getElementById('progressBar'),
                                                  progressOuter = document.getElementById('progressOuter'),
                                                  msgBox = document.getElementById('msgBox');
                                            
                                              var uploader = new ss.SimpleUpload({
                                                    button: btn,
                                                    url: '<?=$url?>',
                                                    sessionProgressUrl: '../../Simple-Ajax-Uploader-master/code/sessionProgress.php',
                                                    name: 'uploadfile',
                                                    multipart: true,
                                                    hoverClass: 'hover',
                                                    focusClass: 'focus',
                                                    responseType: 'json',
                                                    startXHR: function() {
                                                        progressOuter.style.display = 'block'; // make progress bar visible           
                                                        this.setProgressBar( progressBar );           
                                                    },
                                                    onSubmit: function() {
                                                        msgBox.innerHTML = ''; // empty the message box
                                                        btn.innerHTML = 'Uploading...'; // change button text to "Uploading..."
                                                      },
                                                    onComplete: function( filename, response ) {
                                                        //btn.innerHTML = 'Choose Another File';
                                                        btn.innerHTML = 'Choose File';
                                                        progressOuter.style.display = 'none'; // hide progress bar when upload is completed
                                            
                                                        if ( !response ) {
                                                            msgBox.innerHTML = 'Unable to upload file';
                                                            return;
                                                        }
                                            
                                                        if ( response.success === true ) {
                                                            msgBox.innerHTML = '<strong>' + escapeTags( filename ) + '</strong>' + ' successfully uploaded.';
															
															
															//$("#picture").attr("src",filename);
                                            
                                                        } else {
                                                            if ( response.msg )  {
                                                                msgBox.innerHTML = escapeTags( response.msg );
                                            
                                                            } else {
                                                                msgBox.innerHTML = 'An error occurred and the upload failed.';
                                                            }
                                                        }
                                                      },
                                                    onError: function() {
                                                        progressOuter.style.display = 'none';
                                                        msgBox.innerHTML = 'Unable to upload file';
                                                      }
                                                });
                                            };
                                            </script>
                                            <br>
                                            <?php
											 if(is_file("../../".$file_picture) && file_exists("../../".$file_picture))
											 {
											?>
                                               <img id="picture" src="<?="../../".$file_picture?>" style="width:75px;height:75px;">
                                            <?php
											 }
											 else
											 {
											?> 
                                            <img id="picture" src="<?="../../images/no_image.jpg"?>" style="width:75px;height:75px;">
                                            <?php
											 }
											?>
                                 </td>
                             </tr>
                             <tr>
                                 <td>Address</td>
                                 <td>
                                    <input type="text" name="address" id="address"  value="<?=$address?>" class="form-control-static">
                                 </td>
                             </tr>
                             <tr>
                                 <td>City</td>
                                 <td>
                                    <input type="text" name="city" id="city"  value="<?=$city?>" class="form-control-static">
                                 </td>
                             </tr>
                             <tr>
                                 <td>State</td>
                                 <td>
                                    <input type="text" name="state" id="state"  value="<?=$state?>" class="form-control-static">
                                 </td>
                             </tr>
                             <tr>
                                 <td>Zip</td>
                                 <td>
                                    <input type="text" name="zip" id="zip"  value="<?=$zip?>" class="form-control-static">
                                 </td>
                             </tr>
                             <tr>
                                     <td>Country</td>
                                     <td><?php
                                        $info['table']    = "country";
                                        $info['fields']   = array("*");   	   
                                        $info['where']    =  "1=1 ORDER BY country ASC";
                                        $rescountry  =  $db->select($info);
                                    ?>
                                    <select  name="country_id" id="country_id"   class="form-control-static">
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
                              </tr>            
                              <tr> 
                                   <td align="right"></td>
                                   <td>
                                      <input type="hidden" name="cmd" value="change">
                                      <input type="hidden" name="id" value="<?=$Id?>">			
                                      <input type="submit" name="btn_submit" id="btn_submit" value="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored purple">
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

             