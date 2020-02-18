<?php
function add_transaction($db,$users_id,$subject,$description,$debit,$credit,$date_trans)
{
	$info['table']    = "transaction";
	$data['users_id']   = $users_id;
	$data['subject']   = $subject;
	$data['description']   = $description;
	$data['debit']   = $debit;
	$data['credit']   = $credit;
	$data['date_trans']   = $date_trans;
	$info['data']     =  $data;
	$db->insert($info);
}

function get_investment_info($db,$id)
{
	$info["table"] = "investment";
	$info["fields"] = array("investment.*"); 
	$info["where"]   = "1  AND id='".$id."'";
	$arr =  $db->select($info);
	
	return $arr;
	 
}
?>