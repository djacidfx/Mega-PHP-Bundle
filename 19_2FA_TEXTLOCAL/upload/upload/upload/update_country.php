<?php 
require_once('header.php'); 
$counTry = $pdo->prepare("SELECT country_name FROM country WHERE phonecode=?");
$counTry->execute(array($customer_countrycode));   
$counTry_result = $counTry->fetchAll(PDO::FETCH_ASSOC);
foreach($counTry_result as $myCountryName) 
	{
		$myCountry[] = $myCountryName['country_name'];
	} 
$mine = implode(", ", $myCountry);
if(isset($_POST['submit'])){
	$country  = filter_var($_POST['country_code'], FILTER_SANITIZE_NUMBER_INT) ;
	if( (empty($country)) ) {
		$_SESSION['update_country_message'] = 'Country cannot be empty.';	
	} else {
		$upd = $pdo->prepare("UPDATE customer_active SET user_countrycode=? WHERE user_id=?");
		$upd->execute(array($country,$id));
		$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		header("location:".$actual_link."");
	}
}
?>
<div class="app-title">
        <div>
          <h1><i class="fa fa-globe"></i> Manage Country</h1>
		  <p><?php echo _e($mine) ; ?></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
        </ul>
 </div>
  <div class="container mar-top">
	<div class="row">
		<div class="col-lg-12 col-md-12">
			<div class="row">
				<div class="col-lg-3 col-md-3"></div>
				<div class="col-lg-6 col-md-6">
					<div class="card">
                		<div class="card-header bg-secondary text-white text-center"><h4> Change Country</h4></div>
                		<div class="card-body">
						<?php 
					if(! empty($_SESSION['update_country_message'])){ ?>
						<div  class="alert alert-danger errorMessage">
						<button type="button" class="close float-right" aria-label="Close" >
						  <span aria-hidden="true" id="hide">&times;</span>
						</button>
				<?php
						echo $_SESSION['update_country_message'] ;
						unset($_SESSION['update_country_message']);
				?>
						</div>
			<?php } ?>
						<?php
						$country = $pdo->prepare("SELECT * FROM country WHERE active_country = ?");
							$country->execute(array(filter_var("1", FILTER_SANITIZE_NUMBER_INT)));
							$totalCountry = $country->rowCount();
							$result = $country->fetchAll(PDO::FETCH_ASSOC);
							if($totalCountry > 0){
							?>
								<form action="" method="post" >
									<?php $csrf->echoInputField(); ?>
									<div class="form-group">
                                  		<label for="username" class="control-label">Country*</label>
                                  		<select class="form-control form-control-sm" name="country_code" required>
										<option value="">Select Your Country</option>
								 		<?php
								 		foreach($result as $row)
										{
											$countryName = _e($row['country_name'])." (+"._e($row['phonecode']).")" ;
											echo "<option value="._e($row["phonecode"]).">"._e($countryName)."</option>";
										}
										?>
										</select>
									</div>
									<div class="form-group" align="center">
									  <input type="submit" class="btn btn-primary" name="submit" value="Save">
									</div>
								</form>
							<?php
							} else {
							?>
								<h3>Admin has disabled this feature.</h3>
								
						<?php
						}
						?>
						</div>
           			 </div>
				</div>
				<div class="col-lg-3 col-md-3"></div>
			</div>
		</div>
	</div>
</div>
<?php require_once('footer.php'); ?>
