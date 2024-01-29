<?php include("header.php"); ?>
<div id="loaderCat"></div>
<div class="container-fluid justify-content-center text-center p-2 " style="background-color: <?php echo $headerBgColor ; ?>">
	<h2 style="color:<?php echo $headerHeadlineColor ?>;"><?php echo $headerHeadline ; ?></h2>
	<h4 style="color:<?php echo $oneBitcoinColor ; ?>">1 BTC = <span class="onebtc"></span> USD <i class="fa fa-refresh updateUsd" style="color:<?php echo $refreshUsd ; ?>; cursor:pointer;"></i></h4>
</div>
<div class="container-fluid justify-content-center text-center  " style="background-color: <?php echo $headerBgColor ; ?>">
	<div class="row">
		<div class="col-lg-3"></div>
		<div class="col-lg-6">
			<div class="row justify-content-center p-1">
				<form class="form-inline submitCurrency justify-content-center">
					<input type="text" name="amt" class="form-control amt" placeholder="<?php echo $placeHolder; ?>" required />
					<select name="currencyName" class="form-control currencyName rounded" required ></select>
					<input type="hidden" class="submitValue" name="submitValue" value="submitValue"  />
					<input type="submit" name="submit" value="<?php echo $submitText ; ?>" class="actionSubmit btn btn-md" style="cursor:pointer ; background:<?php echo $submitBtnBgColor ; ?> ; color:<?php echo $submitBtnTextColor ; ?>" />
				</form>
				<div class="col-lg-12"><h4 class="getCurrentValue"></h4></div>
			</div>
		</div>
		<div class="col-lg-3"></div>
	</div>
</div>
<div class="container mt-4" style="min-height:375px;">
	<div class="row text-center justify-content-center mt-2">
	<?php echo $adCode ; ?>
	</div>
	<div class="row text-center justify-content-center mt-2">
		<h3 style="color:<?php echo $bodyHeadlineColor ; ?>"><?php echo $bodyHeadline ; ?> <i class="fa fa-refresh updateBitcoinPrice" style="color:<?php echo $refreshBitcoinPrice ; ?>; cursor:pointer;"></i></h3>
	</div>
	<div class="row">
		<div class="col-lg-1"></div>
		<div class="col-lg-10"><div class="row allcurrency"></div></div>
		<div class="col-lg-1"></div>
	</div>
	<div class="row">
		<div class="col-lg-1"></div>
		<div class="col-lg-10"><div class="row allcurrencyUpdate"></div></div>
		<div class="col-lg-1"></div>
	</div>
</div>
<?php include("footer.php") ; ?>