<?php include("header.php") ; ?>
<div class="col-lg-12 mt-3 customBottomBorder">
    <h2 class="text-white text-start"> <i class="bi bi-gear-fill text-warning "></i> Post Count Visibility Settings</h2>
</div>
<div class="col-lg-4 mt-2">
    <form method="post" class="load_featured_index">
        <div class="card bg-dark text-white newShadow">
            <div class="card-header">
                <h6><i class="bi bi-laptop text-warning"></i> Featured Post on Index Page</h6>
            </div>
            <div class="card-body">
                <div class="col-lg-12 text-start">
                     <label class="text-muted">Demo Image</label>
                    <img src="<?php echo ADMIN_URL ; ?>ads/load_1.png" class="card-img-top img-fluid customBorder rounded demoImage">
                </div>
                <div class="col-lg-12 mt-4 text-start">
                    <label class="text-muted">How many Featured Posts will show* <br>(Better View : 2, 4, 6, 8)</label>
                    <input name="featureload" type="number" min="1" class="form-control bg-dark text-white customBorder" value="<?php echo featuredload_index($pdo) ; ?>" required>
                </div>
                <div class="col-lg-12 mt-4">
                    <div class="featuremessage"></div>
                    <input type="hidden" name="btn_action" value="featuredindex">
                    <button type="submit"  class="btn btn-sm btn-grey buttonfeaturedindex"><i class="bi bi-gear text-primary"></i> Save Setting</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="col-lg-4 mt-2">
    <form method="post" class="load_trending_index">
        <div class="card bg-dark text-white newShadow">
            <div class="card-header">
                <h6><i class="bi bi-laptop text-warning"></i> Trending Post on Index Page</h6>
            </div>
            <div class="card-body">
                <div class="col-lg-12 text-start">
                     <label class="text-muted">Demo Image</label>
                    <img src="<?php echo ADMIN_URL ; ?>ads/load_2.png" class="card-img-top img-fluid customBorder rounded demoImage">
                </div>
                <div class="col-lg-12 mt-4 text-start">
                    <label class="text-muted">How many Trending Posts will show* <br>(Better View : 2, 4, 6, 8)</label>
                    <input name="trendingload" type="number" min="1" class="form-control bg-dark text-white customBorder" value="<?php echo trendingload_index($pdo) ; ?>" required>
                </div>
                <div class="col-lg-12 mt-4">
                    <div class="trendingmessage"></div>
                    <input type="hidden" name="btn_action" value="trendingindex">
                    <button type="submit"  class="btn btn-sm btn-grey buttontrendingindex"><i class="bi bi-gear text-primary"></i> Save Setting</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="col-lg-4 mt-2">
    <form method="post" class="load_new_index">
        <div class="card bg-dark text-white newShadow">
            <div class="card-header">
                <h6><i class="bi bi-laptop text-warning"></i> New Post on Index Page</h6>
            </div>
            <div class="card-body">
                <div class="col-lg-12 text-start">
                     <label class="text-muted">Demo Image</label>
                    <img src="<?php echo ADMIN_URL ; ?>ads/load_3.png" class="card-img-top img-fluid customBorder rounded demoImage">
                </div>
                <div class="col-lg-12 mt-4 text-start">
                    <label class="text-muted">How many New Posts will show* <br>(Better View : 2, 4, 6, 8)</label>
                    <input name="newload" type="number" min="1" class="form-control bg-dark text-white customBorder" value="<?php echo newload_index($pdo) ; ?>" required>
                </div>
                <div class="col-lg-12 mt-4">
                    <div class="newmessage"></div>
                    <input type="hidden" name="btn_action" value="newindex">
                    <button type="submit"  class="btn btn-sm btn-grey buttonnewindex"><i class="bi bi-gear text-primary"></i> Save Setting</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="col-lg-4 mt-2">
    <form method="post" class="load_featured_sidebar">
        <div class="card bg-dark text-white newShadow">
            <div class="card-header">
                <h6><i class="bi bi-laptop text-warning"></i> Featured Post on Sidebar</h6>
            </div>
            <div class="card-body">
                <div class="col-lg-12 text-start">
                     <label class="text-muted">Demo Image</label>
                    <img src="<?php echo ADMIN_URL ; ?>ads/load_4.png" class="card-img-top img-fluid customBorder rounded demoImage">
                </div>
                <div class="col-lg-12 mt-4 text-start">
                    <label class="text-muted">How many Featured Posts will show*</label>
                    <input name="featureloadside" type="number" min="1" class="form-control bg-dark text-white customBorder mt-4" value="<?php echo featuredload_index_side($pdo) ; ?>" required>
                </div>
                <div class="col-lg-12 mt-4">
                    <div class="featuremessageside"></div>
                    <input type="hidden" name="btn_action" value="featuredindexside">
                    <button type="submit"  class="btn btn-sm btn-grey buttonfeaturedindexside"><i class="bi bi-gear text-primary"></i> Save Setting</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="col-lg-4 mt-2">
    <form method="post" class="load_trending_sidebar">
        <div class="card bg-dark text-white newShadow">
            <div class="card-header">
                <h6><i class="bi bi-laptop text-warning"></i> Trending Post on Sidebar</h6>
            </div>
            <div class="card-body">
                <div class="col-lg-12 text-start">
                     <label class="text-muted">Demo Image</label>
                    <img src="<?php echo ADMIN_URL ; ?>ads/load_5.png" class="card-img-top img-fluid customBorder rounded demoImage">
                </div>
                <div class="col-lg-12 mt-4 text-start">
                    <label class="text-muted">How many Trending Posts will show*</label>
                    <input name="trendingloadside" type="number" min="1" class="form-control bg-dark text-white customBorder mt-4" value="<?php echo trendingload_index_side($pdo) ; ?>" required>
                </div>
                <div class="col-lg-12 mt-4">
                    <div class="trendingmessageside"></div>
                    <input type="hidden" name="btn_action" value="trendingindexside">
                    <button type="submit"  class="btn btn-sm btn-grey buttontrendingindexside"><i class="bi bi-gear text-primary"></i> Save Setting</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="col-lg-4 mt-2">
    <form method="post" class="load_all_featured">
        <div class="card bg-dark text-white newShadow">
            <div class="card-header">
                <h6><i class="bi bi-laptop text-warning"></i> Post on Featured Page</h6>
            </div>
            <div class="card-body">
                <div class="col-lg-12 text-start">
                     <label class="text-muted">Demo Image</label>
                    <img src="<?php echo ADMIN_URL ; ?>ads/load_6.png" class="card-img-top img-fluid customBorder rounded demoImage">
                </div>
                <div class="col-lg-12 mt-4 text-start">
                    <label class="text-muted">How many Featured Posts will show*<br>(Default & When Load More Button Pressed)</label>
                    <input name="allfeaturedposts" type="number" min="1" class="form-control bg-dark text-white customBorder" value="<?php echo featuredload_featuredpage($pdo) ; ?>" required>
                </div>
                <div class="col-lg-12 mt-4">
                    <div class="allfeaturemessage"></div>
                    <input type="hidden" name="btn_action" value="allfeatured">
                    <button type="submit"  class="btn btn-sm btn-grey buttonallfeatured"><i class="bi bi-gear text-primary"></i> Save Setting</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="col-lg-4 mt-2">
    <form method="post" class="load_all_trending">
        <div class="card bg-dark text-white newShadow">
            <div class="card-header">
                <h6><i class="bi bi-laptop text-warning"></i> Post on Trending Page</h6>
            </div>
            <div class="card-body">
                <div class="col-lg-12 text-start">
                     <label class="text-muted">Demo Image</label>
                    <img src="<?php echo ADMIN_URL ; ?>ads/load_7.png" class="card-img-top img-fluid customBorder rounded demoImage">
                </div>
                <div class="col-lg-12 mt-4 text-start">
                    <label class="text-muted">How many Trending Posts will show*<br>(Default & When Load More Button Pressed)</label>
                    <input name="alltrendingposts" type="number" min="1" class="form-control bg-dark text-white customBorder" value="<?php echo trendingload_trendingpage($pdo) ; ?>" required>
                </div>
                <div class="col-lg-12 mt-4">
                    <div class="alltrendingmessage"></div>
                    <input type="hidden" name="btn_action" value="alltrending">
                    <button type="submit"  class="btn btn-sm btn-grey buttonalltrending"><i class="bi bi-gear text-primary"></i> Save Setting</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="col-lg-4 mt-2">
    <form method="post" class="load_all_new">
        <div class="card bg-dark text-white newShadow">
            <div class="card-header">
                <h6><i class="bi bi-laptop text-warning"></i> Post on New Page</h6>
            </div>
            <div class="card-body">
                <div class="col-lg-12 text-start">
                     <label class="text-muted">Demo Image</label>
                    <img src="<?php echo ADMIN_URL ; ?>ads/load_8.png" class="card-img-top img-fluid customBorder rounded demoImage">
                </div>
                <div class="col-lg-12 mt-4 text-start">
                    <label class="text-muted">How many New Posts will show*<br>(Default & When Load More Button Pressed)</label>
                    <input name="allnewposts" type="number" min="1" class="form-control bg-dark text-white customBorder" value="<?php echo newload_newpage($pdo) ; ?>" required>
                </div>
                <div class="col-lg-12 mt-4">
                    <div class="allnewmessage"></div>
                    <input type="hidden" name="btn_action" value="allnew">
                    <button type="submit"  class="btn btn-sm btn-grey buttonallnew"><i class="bi bi-gear text-primary"></i> Save Setting</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="col-lg-4 mt-2">
    <form method="post" class="load_all_search">
        <div class="card bg-dark text-white newShadow">
            <div class="card-header">
                <h6><i class="bi bi-laptop text-warning"></i> Post on Search Page</h6>
            </div>
            <div class="card-body">
                <div class="col-lg-12 text-start">
                     <label class="text-muted">Demo Image</label>
                    <img src="<?php echo ADMIN_URL ; ?>ads/load_9.png" class="card-img-top img-fluid customBorder rounded demoImage">
                </div>
                <div class="col-lg-12 mt-4 text-start">
                    <label class="text-muted">How many Search Posts will show*<br>(Default & When Load More Button Pressed)</label>
                    <input name="allsearchposts" type="number" min="1" class="form-control bg-dark text-white customBorder" value="<?php echo searchload_searchpage($pdo) ; ?>" required>
                </div>
                <div class="col-lg-12 mt-4">
                    <div class="allsearchmessage"></div>
                    <input type="hidden" name="btn_action" value="allsearch">
                    <button type="submit"  class="btn btn-sm btn-grey buttonallsearch"><i class="bi bi-gear text-primary"></i> Save Setting</button>
                </div>
            </div>
        </div>
    </form>
</div>


<div class="col-lg-12 mt-3 customBottomBorder">
    <h2 class="text-white text-start"> <i class="bi bi-gear-fill text-warning "></i> Google Analytics & Footer Settings</h2>
</div>
<div class="col-lg-6 mt-2">
    <form method="post" class="gaCode">
        <div class="card bg-dark text-white newShadow">
            <div class="card-header">
                <h6><i class="bi bi-laptop text-warning"></i> Google Analytics Setting</h6>
            </div>
            <div class="card-body">
                <div class="col-lg-12 mt-2 text-start">
                    <label class="text-muted">Paste Google Analytics Javascript Code*</label>
                    <textarea name="ga_code" class="form-control bg-dark text-white customBorder" rows="8"><?php echo analytics_code($pdo) ; ?></textarea>
                </div>
                <div class="row">
                <div class="col-lg-6 mt-2 text-start">
                    <label class="text-muted ">For User Panel*</label>
                    <select name="user_status" class="form-control bg-dark text-white customBorder"> 
                        <option value="2" <?php if(analytics_user_status($pdo) == '0'){ ?> selected="selected" <?php } ?> >Turned Off</option>
                        <option value="1" <?php if(analytics_user_status($pdo) == '1'){ ?> selected="selected" <?php } ?>>Turned On</option>
                    </select>
                </div>
                
                <div class="col-lg-6 mt-2 text-start">
                    <label class="text-muted ">For Admin Panel*</label>
                    <select name="admin_status" class="form-control bg-dark text-white customBorder"> 
                        <option value="2" <?php if(analytics_admin_status($pdo) == '0'){ ?> selected="selected" <?php } ?> >Turned Off</option>
                        <option value="1" <?php if(analytics_admin_status($pdo) == '1'){ ?> selected="selected" <?php } ?>>Turned On</option>
                    </select>
                </div>
                </div>
                <div class="col-lg-12 mt-4">
                    <div class="gamessage"></div>
                    <input type="hidden" name="btn_action" value="saveGaCode">
                    <button type="submit"  class="btn btn-sm btn-grey buttonga"><i class="bi bi-gear text-primary"></i> Save Setting</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="col-lg-6 mt-2">
    <form method="post" class="aboutUsInfo">
        <div class="card bg-dark text-white newShadow">
            <div class="card-header">
                <h6><i class="bi bi-laptop text-warning"></i> Footer About Us & Copyright Name</h6>
            </div>
            <div class="card-body">
                <div class="col-lg-12 mt-2 text-start">
                    <label class="text-muted">About Us Info* (Max 300 Chars)</label>
                    <textarea name="aboutus" class="form-control bg-dark text-white customBorder" rows="8" maxlength="300"><?php echo about_us($pdo) ; ?></textarea>
                </div>
                <div class="col-lg-12 mt-2 text-start">
                    <label class="text-muted ">Coyright Name*</label>
                    <input name="copyright" type="text" maxlength="50" class="form-control bg-dark text-white customBorder" value="<?php echo copyright_name($pdo) ; ?>" >
                </div>   
                
                <div class="col-lg-12 mt-4">
                    <div class="aboutmessage"></div>
                    <input type="hidden" name="btn_action" value="saveaboutus">
                    <button type="submit"  class="btn btn-sm btn-grey buttonabout "><i class="bi bi-gear text-primary "></i> Save Setting</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="col-lg-12 mt-3 customBottomBorder">
    <h2 class="text-white text-start"> <i class="bi bi-gear-fill text-warning "></i> Extra Settings</h2>
</div>

<div class="col-lg-6 mt-2">
    <form method="post" class="extraInfo">
        <div class="card bg-dark text-white newShadow">
            <div class="card-header">
                <h6><i class="bi bi-laptop text-warning"></i> Love & Block Message</h6>
            </div>
            <div class="card-body">
                <div class="col-lg-12 mt-2 text-start">
                    <label class="text-muted">User Blocked Message* (Max 250 Chars)</label>
                    <textarea name="blk" class="form-control bg-dark text-white customBorder" rows="8" maxlength="250"><?php echo block_message($pdo) ; ?></textarea>
                </div>
                <div class="col-lg-12 mt-2 text-start">
                    <label class="text-muted ">Already Love Message*</label>
                    <input name="love" type="text" maxlength="100" class="form-control bg-dark text-white customBorder" value="<?php echo already_loved_message($pdo) ; ?>" >
                </div>   
                
                <div class="col-lg-12 mt-4">
                    <div class="extramessage"></div>
                    <input type="hidden" name="btn_action" value="saveextra">
                    <button type="submit"  class="btn btn-sm btn-grey buttonextra"><i class="bi bi-gear text-primary "></i> Save Setting</button>
                </div>
            </div>
        </div>
    </form>
</div>



<div class="col-lg-6 mt-2">
    <div class="row">
        <div class="col-lg-12">
            <form method="post" class="changeEmail">
                <div class="card bg-dark text-white newShadow">
                    <div class="card-header">
                        <h6><i class="bi bi-laptop text-warning"></i> Change Email</h6>
                    </div>
                    <div class="card-body">
                        <div class="col-lg-12 mt-2 text-start">
                            <label class="text-muted">Email*</label>
                            <input name="email" type="email" maxlength="50" class="form-control bg-dark text-white customBorder" value="<?php echo admin_email($pdo) ; ?>" >
                        </div>
                        <div class="col-lg-12 mt-2 text-start">
                            <label class="text-muted ">Password*</label>
                            <input name="password" type="password" maxlength="100" class="pass form-control bg-dark text-white customBorder" value="" >
                        </div>   

                        <div class="col-lg-12 mt-4">
                            <div class="emailmessage"></div>
                            <input type="hidden" name="btn_action" value="saveemail">
                            <button type="submit"  class="btn btn-sm btn-grey buttonemail"><i class="bi bi-gear text-primary "></i> Change Email</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        
        <div class="col-lg-12 mt-2">
            <form method="post" class="changePassword">
                <div class="card bg-dark text-white newShadow">
                    <div class="card-header">
                        <h6><i class="bi bi-laptop text-warning"></i> Change Password</h6>
                    </div>
                    <div class="card-body">
                        <div class="col-lg-12 mt-2 text-start">
                            <label class="text-muted">Old Password*</label>
                            <input name="oldpass" type="password" maxlength="50" class="form-control bg-dark text-white customBorder" value="" >
                        </div>
                        <div class="col-lg-12 mt-2 text-start">
                            <small class="text-muted">Password must contain minimum 8 characters, 1 Uppercase character, 1 Lowercase character & 1 number.</small>
                            <br>
                            <label class="text-muted ">New Password*</label>                        
                            <input name="newpass" type="password" maxlength="100" class="pass form-control bg-dark text-white customBorder" value="" >
                        </div>
                        
                        <div class="col-lg-12 mt-2 text-start">
                            <label class="text-muted ">Confirm New Password*</label>
                            <input name="repass" type="text" maxlength="100" class="pass form-control bg-dark text-white customBorder" value="" >
                        </div> 

                        <div class="col-lg-12 mt-4">
                            <div class="passmessage"></div>
                            <input type="hidden" name="btn_action" value="savepassword">
                            <button type="submit"  class="btn btn-sm btn-grey buttonpass"><i class="bi bi-gear text-primary "></i> Change Password</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        
    </div>
</div>

<?php include("footer.php") ; ?>