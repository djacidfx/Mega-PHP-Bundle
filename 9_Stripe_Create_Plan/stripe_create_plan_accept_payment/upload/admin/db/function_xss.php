<?php
function _e($string) {
	return htmlentities(strip_tags($string), ENT_QUOTES, 'UTF-8');
}
function item_name($pdo,$item_id)
{
	$query = "SELECT * FROM subscription_plan WHERE sub_status = '1' AND id = '".$item_id."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= _e($row["sub_name"]);
	}
	return ($output);
}
function fill_subscription_price($pdo, $sub_id)
{
	$query = "SELECT * FROM subscription_plan WHERE sub_status = '1' AND id = '".$sub_id."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= _e($row["sub_price"]);
	}
	return ($output);
}
function count_total_activeplan_curday($pdo)
{	
	$curday = date('Y-m-d');
	$query = "SELECT * FROM subscription_plan WHERE sub_status='1' and sub_date = '".$curday."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
	
}
function count_total_purchase_curday($pdo)
{	
	$curday = date('Y-m-d');
	$query = "SELECT * FROM payments WHERE payment_status='succeeded' and created_date = '".$curday."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
	
}
function count_total_purchase_value_curday($pdo)
{	
	$curday = date('Y-m-d');
	$query = "SELECT sum(amount) as total_order_value FROM payments WHERE payment_status='succeeded' and created_date = '".$curday."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		if($row['total_order_value'] == '' || $row['total_order_value'] == '0'){
			$row['total_order_value'] = 0.00 ;
		}
		return _e($row['total_order_value']);
	}
}
function count_total_activeplan_curmonth($pdo)
{	
	$firstday = date('Y-m-01');
	$lastday = date('Y-m-t') ;
	$query = "SELECT * FROM subscription_plan WHERE sub_status='1' and sub_date between '".$firstday."' and '".$lastday."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
	
}
function count_total_purchase_curmonth($pdo)
{	
	$firstday = date('Y-m-01');
	$lastday = date('Y-m-t') ;
	$query = "SELECT * FROM payments WHERE payment_status='succeeded' and created_date between '".$firstday."' and '".$lastday."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
	
}
function count_total_purchase_value_curmonth($pdo)
{	
	$firstday = date('Y-m-01');
	$lastday = date('Y-m-t') ;
	$query = "SELECT sum(amount) as total_order_value FROM payments WHERE payment_status='succeeded' and created_date between '".$firstday."' and '".$lastday."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		if($row['total_order_value'] == '' || $row['total_order_value'] == '0'){
			$row['total_order_value'] = 0.00 ;
		}
		return _e($row['total_order_value']);
	}
}
function count_total_activeplan($pdo)
{	
	$firstday = date('Y-m-01');
	$lastday = date('Y-m-t') ;
	$query = "SELECT * FROM subscription_plan WHERE sub_status='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
	
}
function count_total_purchase($pdo)
{	
	$firstday = date('Y-m-01');
	$lastday = date('Y-m-t') ;
	$query = "SELECT * FROM payments WHERE payment_status='succeeded'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
	
}
function count_total_purchase_value($pdo)
{	
	$query = "SELECT sum(amount) as total_order_value FROM payments WHERE payment_status='succeeded'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		if($row['total_order_value'] == '' || $row['total_order_value'] == '0'){
			$row['total_order_value'] = 0.00 ;
		}
		return _e($row['total_order_value']);
	}
}
?>