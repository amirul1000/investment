<?php
 include("../template/header.php");
?>
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

                 <table border='0' width='40%' cellspacing='2' cellpadding='2' align="center">
                    <?php
                    require_once("../../paypal_pro/paypal_pro.inc.php");
                    $firstName =urlencode( $_POST['firstName']);
                    $lastName =urlencode( $_POST['lastName']);
                    $creditCardType =urlencode( $_POST['creditCardType']);
                    $creditCardNumber = urlencode($_POST['creditCardNumber']);
                    $expDateMonth =urlencode( $_POST['expDateMonth']);
                    $padDateMonth = str_pad($expDateMonth, 2, '0', STR_PAD_LEFT);
                    $expDateYear =urlencode( $_POST['expDateYear']);
                    $cvv2Number = urlencode($_POST['cvv2Number']);
                    $address1 = urlencode($_POST['address1']);
                    $address2 = urlencode($_POST['address2']);
                    $city = urlencode($_POST['city']);
                    $state =urlencode( $_POST['state']);
                    $zip = urlencode($_POST['zip']);
                    $amount = urlencode($_POST['amount']);
                    $currencyCode="USD";
                    $paymentAction = urlencode("Sale");
                    if($_POST['recurring'] == 1) // For Recurring
                    {
                        $profileStartDate = urlencode(date('Y-m-d h:i:s'));
                        $billingPeriod = urlencode($_POST['billingPeriod']);// or "Day", "Week", "SemiMonth", "Year"
                        $billingFreq = urlencode($_POST['billingFreq']);// combination of this and billingPeriod must be at most a year
                        $initAmt = $amount;
                        $failedInitAmtAction = urlencode("ContinueOnFailure");
                        $desc = urlencode("Recurring $".$amount);
                        $autoBillAmt = urlencode("AddToNextBilling");
                        $profileReference = urlencode("Anonymous");
                        $methodToCall = 'CreateRecurringPaymentsProfile';
                        $nvpRecurring ='&BILLINGPERIOD='.$billingPeriod.'&BILLINGFREQUENCY='.$billingFreq.'&PROFILESTARTDATE='.$profileStartDate.'&INITAMT='.$initAmt.'&FAILEDINITAMTACTION='.$failedInitAmtAction.'&DESC='.$desc.'&AUTOBILLAMT='.$autoBillAmt.'&PROFILEREFERENCE='.$profileReference;
                    }
                    else
                    {
                        $nvpRecurring = '';
                        $methodToCall = 'doDirectPayment';
                    }
                    
                    
                    
                    $nvpstr='&PAYMENTACTION='.$paymentAction.'&AMT='.$amount.'&CREDITCARDTYPE='.$creditCardType.'&ACCT='.$creditCardNumber.'&EXPDATE='.         $padDateMonth.$expDateYear.'&CVV2='.$cvv2Number.'&FIRSTNAME='.$firstName.'&LASTNAME='.$lastName.'&STREET='.$address1.'&CITY='.$city.'&STATE='.$state.'&ZIP='.$zip.'&COUNTRYCODE=US&CURRENCYCODE='.$currencyCode.$nvpRecurring;
                    
                    $paypalPro = new paypal_pro('sdk-three_api1.sdk.com', 'QFZCWN5HZM8VBG7Q', 'A.d9eRKfd1yVkRrtmMfCFLTqa6M9AyodL0SJkhYztxUi8W9pCXF6.4NI', '', '', FALSE, FALSE );
                    $resArray = $paypalPro->hash_call($methodToCall,$nvpstr);
                    $ack = strtoupper($resArray["ACK"]);
                    echo '<pre>';
                    print_r($resArray);
                    echo '</pre>';
                    if($ack!="SUCCESS")
                    {
                        echo '<tr>';
                            echo '<td colspan="2" style="font-weight:bold;color:red;" align="center">Error! Please check that u will provide all information correctly :(</td>';
                        echo '</tr>';
                        echo '<tr>';
                            echo '<td align="right">Ack:</td>';
                            echo '<td>'.$resArray["ACK"].'</td>';
                        echo '</tr>';
                        echo '<tr>';
                            echo '<td align="right">Correlation ID:</td>';
                            echo '<td>'.$resArray['CORRELATIONID'].'</td>';
                        echo '</tr>';
                    }
                    else
                    {
                        echo '<tr>';
                            echo '<td colspan="2" style="font-weight:bold;color:Green" align="center">Thank You For Your Payment :)</td>';
                        echo '</tr>';
                        echo '<tr>';
                            echo '<td align="right"> Transaction ID:</td>';
                            echo '<td>'.$resArray["TRANSACTIONID"].'</td>';
                        echo '</tr>';
                        echo '<tr>';
                            echo '<td align="right"> Amount:</td>';
                            echo '<td>'.$currencyCode.$resArray['AMT'].'</td>';
                        echo '</tr>';
						
						
						  unset($info);
						  unset($data);  
						$info['table']    = "deposit";
						$data['users_id']   = $_SESSION['users_id'];
						$data['investment_id']   = $_SESSION['investment_id'];
						$data['amount']   = $amount;
						$data['date_deposit']   = date("Y-m-d H:i:s");
						$info['data']     =  $data;
					     $db->insert($info);
						 
						 
						$arr_investment = get_investment_info($db,$_SESSION['investment_id']); 
						 
						 add_transaction($db,$_SESSION['users_id'],
						              $arr_investment[0]['investment_name'],
									  $arr_investment[0]['description'],
									  0,
									  $amount,
									  date("Y-m-d H:i:s"));
						
						$ack = "";
						 
						 
                    }
                    ?>
                    </table>
				</div>
			</div>
		</div>
<?php
include("../template/footer.php");
?>
