<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>URL Link / Text Encode & Decode - Online</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<meta name="description" content="URL Link / Text Encode & Decode - Online">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/all.min.css">
	<link rel="stylesheet" type="text/css" href="css/Latofont.css">
	<link rel="stylesheet" type="text/css" href="css/Niconnefont.css"> 
</head>

<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 col-md-12">
				<div class="row">
					<div class="col-lg-1 col-md-1"> </div>
					<div class="col-lg-7 col-md-7">
						<div class="col-lg-12 col-md-12">
							<div class="row">
								<div class="col-lg-12 col-md-12 text-center p-2">
									<!--Ad Space-->
									<img src="images/728.jpg" class="img-fluid"> 
								</div>
							</div>
							<div class="row ">
								<div class="col-lg-12 col-md-12  shadow bg-white rounded p-2">
									<div class="modal-header justify-content-center bg-white">
										<!--SITE Logo 300px*50px--> 
										<img src="images/siteLogo.png" class="img-fluid" alt="Logo"> 
									</div>
									<form action="" class="form-signin mt-1 " method="post" id="fetchText">
										<div class="form-group mt-2">
											<textarea name="myText" id="myText" rows="4" class="form-control" placeholder="Enter Link or Text" autofocus required></textarea>
										</div> 
									<span class="res">
									 <div class="form-group mt-2">
										<label>Click on the Box to Copy</label>
										<textarea name="newText" id="newText" rows="4" class="form-control" autofocus readonly="readonly" ></textarea>
									 </div>
								 	</span>
										<hr>
										<div class="col-lg-12 text-right mb-3 p-2">
											<input type="hidden" name="btn-action-pro" value="Fetch">
											<div class="remove-messages"></div>
											<div class="form-inline float-lg-right ">
												<div class="form-group mx-sm-3 mb-2 text-right">
													<select name="enc" class="selectPlan form-control" required>
														<option value="1">Encode</option>
														<option value="2">Decode</option>
													</select>
												</div> 
												&ensp;<button type="submit" class="btn btn-sm btn-success mb-2" id="action">Convert</button> 
												&ensp;<button type="button" class="btn btn-sm btn-danger mb-2" id="resetBtn">Reset</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-1 col-md-1"> </div>
					<div class="col-lg-3 col-md-3">
						<div class="p-3 text-center">
							<!--Ad Space-->
							<img src="images/300-600.jpg" class="img-fluid"> 
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="bg-white border-top text-dark text-center fixed-bottom p-1">
		<div class="row">
		<div class="col-lg-10 mt-2">
			Copyright &copy; <?php echo date("Y"); ?> 
            <a href="#" class="text-muted p-1">Company Name</a>. All Rights Reserved.
		</div> 
		<div class="col-lg-2">
			<?php include("share.php"); ?>
		</div>
		</div>
			
		</div>
	</div>
	<script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
	<script type="text/javascript" src="js/custom.js"></script>
</body>
</html>