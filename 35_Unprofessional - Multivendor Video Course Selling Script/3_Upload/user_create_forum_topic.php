<?php include("header_session.php") ; ?>
<?php $webtitle = "Forum - Create Topic" ; ?>
<?php include("header_main.php") ; ?>
<?php include("navbar_index.php"); ?>
<?php include("sidebar_index.php"); ?>
<?php echo check_user_logged_in($pdo) ; ?>
<?php 
$nt = '1' ;
?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1 class="text-muted"><i class="fas fa-question-circle fa-lg"></i> Create Topic on Forum</h1>
      </div>
       
      <div class="card p-2">
          <form class="postForum" method="post" enctype="multipart/form-data">
          <div class="row p-2">
              <div class="col-lg-8">
                  <label class="text-muted">Title* (Max 100 Characters)</label> 
                  <input type="text" name="title" class="form-control" required autocomplete="off" autofocus maxlength="100" >
              </div>
              <div class="col-lg-4">
                  <label class="text-muted">Category*</label> 
                  <select class="form-control" name="forumCategory" required>
                      <option value="">Choose Forum Category</option>
                      <?php echo choose_forum_category($pdo) ; ?>
                  </select>
              </div>
              <div class="col-lg-12 mt-4">
                  <label class="text-muted">Description*</label>
                  <textarea name="description" id="item_message" class="form-control" autofocus required></textarea>
              </div>
              <div class="col-lg-12 mt-4 text-center forumMessage"></div>
              <div class="col-lg-12 mt-4 text-center">
                    <input type="hidden" name="btn_action" value="createForumTopic" >
                    <button type="submit" name="submit" class="btn btn-primary btn-md"><i class="fas fa-hand-pointer"></i> Post</button>
              </div>
          </div>
          </form>
        </div>
        
    </section>
</div>
<?php include("footer_main.php") ; ?>