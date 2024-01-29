<?php 
include("database.php") ;
$search = filter_var($_GET['term'] , FILTER_SANITIZE_STRING) ;
if(!isset($_GET['term'])){
    header("location:".BASE_URL." ") ;
}
$webTitle = "Search Anonymous - ".$search ;
$metaDescription = "Hey ! Just Share Your Secret & Confessions to Our Anonymous World." ; 
include("head_common.php") ;
include("body_start.php") ;
?>
<div class="col-lg-9 offset-md-3 justify-content-center text-center p-2">
    <div class="row">
        
        <!-- Desktop Header Ad -->
        <?php include("header_ad.php") ; ?>
        
        <div class="col-lg-8 mt-3 p-md-3 pt-md-0">
            <div class="col-lg-12 p-1 pt-0 ms-md-2">
                <div class="card bg-dark newShadow">
                    <div class="card-header">
                        <form method="post" class="searchPost form-inline">
                           <div class="row">
                            <div class="col-lg-10">
                               <div class="form-group">
                                    <input required type="text" name="search_keyword" class="customBorder form-control bg-dark text-white" maxlength="100" placeholder="Search Anonymous Things ..." <?php if(isset($search)) { ?> value="<?php echo $search ; ?>" <?php } ?> >
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <input type="hidden" name="btn_action" value="manualUserSearch">
                                <button type="submit" class="btn btn-grey btn-md" id="action_log">Search</button>   
                            </div>
                            <div class="col-lg-12"><div class="search-messages"></div></div>
                           </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row p-1 pt-0 ms-md-1">
                <?php echo grab_search_default($pdo,$search) ; ?>
                
            </div>
            <div class="row p-1 pt-0 ms-md-1 jQueryLoadSearch mt-n4"></div>
        </div>
        <?php include("sidebar_right.php") ; ?>
        
    </div>
</div>
            
<?php include("body_end.php") ; ?>