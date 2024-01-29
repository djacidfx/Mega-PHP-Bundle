<?php
$body = '
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="'.ADMIN_URL.'css/main.css">
</head>
<body>
<center>
<table style="border:1px dotted #00CCFF; min-width:300px;">
<tr>
<td  colspan="2">
<center> <img src="'.BASE_URL.'img/logo.png" ></center>
</td>
</tr>
<td width="50%" style="border:1px solid #00CC33;">
User Name 
</td>
<td style="border:1px solid #00CC33;" >
'.$userName.'
</td>
</tr>
</tr>
<tr >
<td width="50%" style="border:1px solid #00CC33;">
User Email 
</td>
<td style="border:1px solid #00CC33;">
'.$userEmail.'
</td>
</tr>
<tr >
<td width="50%" style="border:1px solid #00CC33;">
Plan Name 
</td>
<td style="border:1px solid #00CC33;">
'.$planName.'
</td>
</tr>
<tr >
<td width="50%" style="border:1px solid #00CC33;">
Plan Amount 
</td>
<td style="border:1px solid #00CC33;">
$'.$planAmount.'
</td>
</tr>
<tr >
<td width="50%" style="border:1px solid #00CC33;">
Paid Amount 
</td>
<td style="border:1px solid #00CC33;">
$'.$planAmount.'
</td>
</tr>
<tr >
<td width="50%" style="border:1px solid #00CC33;">
Bonus Amount 
</td>
<td style="border:1px solid #00CC33;">
$'.$bonusAmount.'
</td>
</tr>
<tr >
<td width="50%" style="border:1px solid #00CC33;">
Credit Amount 
</td>
<td style="border:1px solid #00CC33;">
$'.$itemPrice.'
</td>
</tr>
<tr >
<td width="50%" style="border:1px solid #00CC33;">
User Wallet Amount 
</td>
<td style="border:1px solid #00CC33;">
$'.$newWallet.'
</td>
</tr>
<tr >
<td width="50%" style="border:1px solid #00CC33;">
Transaction ID 
</td>
<td style="border:1px solid #00CC33;">
'.$txn_id.'
</td>
</tr>
<tr >
<td width="50%" style="border:1px solid #00CC33;">
Method 
</td>
<td style="border:1px solid #00CC33;">
'.$payMe.'
</td>
</tr>
</table>
</center>
</body>
</html>';
?>
