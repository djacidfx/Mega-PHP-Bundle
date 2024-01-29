<?php
$gad = $pdo->prepare("select  ad_code from ot_admin where id = '1' and ad_on = '1'") ;
$gad->execute();
$totalGad = $gad->rowCount();
$resultd = $gad->fetchAll();
if($totalGad > 0) {
	foreach($resultd as $rowd) {
		$GAD = base64_decode($rowd['ad_code']);
		?>
		<div class="card w-100 rounded post-shadow">
		<img src="<?php echo BASE_URL."/img/728_ad.png" ; ?>" class="img-fluid pointerCursor" />
		<?php
		//echo $GAD ;
		?>
		</div>
		<?php
	}
}
?>