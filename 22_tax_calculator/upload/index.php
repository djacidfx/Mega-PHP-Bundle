<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>GST Tax Calculator</title>
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      <meta name="description" content="GST Tax Calculator">
      <link rel="stylesheet" type="text/css" href="css/main.css">
      <link rel="stylesheet" type="text/css" href="css/all.min.css">
      <link rel="stylesheet" type="text/css" href="css/custom.css">
      <link rel="stylesheet" type="text/css" href="css/Latofont.css">
      <link rel="stylesheet" type="text/css" href="css/Niconnefont.css">
   </head>
   <body>
      <div class="container-fluid">
         <div class="row">
            <div class="col-lg-12 col-md-12">
               <div class="col-lg-12 col-md-12 text-center p-2">
                  <!--Ad Space-->
                  <img src="images/ad1.png" class="img-fluid">
               </div>
               <div class="row">
                  <div class="col-lg-3 col-md-3 p-1 mt-5 text-center">
                     <!--Ad Space-->
                     <img src="images/ad2.png" class="img-fluid"> 
                  </div>
                  <div class="col-lg-6 col-md-6 p-1">
                     <div id="logreg-forms" class="shadow-lg">
                        <div class="modal-header justify-content-center bg-white mt-n3">
                           <img src="images/siteLogo.png" class="img-fluid"  alt="Logo">
                        </div>
                        <form action="" class="form-signin" method="post" id="fetchTax">
                           <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                 <span class="input-group-text">Amount&ensp;</span>
                              </div>
                              <input type="text" name="amount" id="amount" class="form-control" placeholder="e.g. 1000"  autofocus > 
                           </div>
                           <div class="input-group mb-3">
                              <select name="gst" class="selectPlan form-control" required >
                                 <option value="1">Add GST</option>
                                 <option value="2">Remove GST</option>
                              </select>
                           </div>
                           <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                 <span class="input-group-text">Tax %&ensp;</span>
                              </div>
                              <input type="text" name="tax" id="tax" class="form-control" placeholder="e.g. 5" required autofocus > 
                           </div>
                           <div class="resl">
                              <div class="input-group mb-3">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text">TAX Amount&ensp;</span>
                                 </div>
                                 <input type="text" name="taxamount" id="taxamount" class="form-control"  autofocus readonly="readonly" > 
                              </div>
                              <div class="input-group mb-3">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text">NET Amount&ensp;</span>
                                 </div>
                                 <input type="text" name="netamount" id="netamount" class="form-control"  autofocus readonly="readonly" > 
                              </div>
                           </div>
                           <div class="col-lg-12 text-center mb-3">
                              <input type="hidden" name="btn-action-pro" value="Fetch" >
                              <div class="remove-messages"></div>
                              <button type="submit" class="btn btn-sm btn-success" id="action">Calculate Tax</button>
                           </div>
                        </form>
                        <div id="loader"></div>
                     </div>
                  </div>
                  <div class="col-lg-3 col-md-3 p-1 mt-5 text-center">
                     <!--Ad Space-->
                     <img src="images/ad2.png" class="img-fluid"> 
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="bg-white border-top text-dark text-center fixed-bottom p-2"><span>Copyright &copy; <?php echo date("Y"); ?> <a href="#" class="text-muted">Company Name</a>. All Rights Reserved.</span></div>
      </div>
      <script type="text/javascript" src="js/jquery-3.5.1.min.js"></script>
      <script type="text/javascript" src="js/custom.js"></script>
   </body>
</html>

