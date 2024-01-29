<?php include("header_session.php") ; ?>
<?php 
$topicId = filter_var($_GET['topic_id'], FILTER_SANITIZE_NUMBER_INT) ; 
$topicTitle = forum_title_by_id($pdo,$topicId) ;
$userId = forum_userid_by_titleid($pdo,$topicId) ; 
$username = username_by_id($pdo,$userId);
checking_active_forumtopic($pdo,$topicId) ;
$nt = '3' ;
?>
<?php $webtitle = "Forum Topic - ".$topicTitle ; ?>
<?php include("header_main.php") ; ?>
<?php include("navbar_index.php"); ?>
<?php include("sidebar_index.php"); ?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <div class="row">
            <div class="col-lg-12 border-bottom border-light"><h4 class="text-muted"><i class="fas fa-question-circle fa-lg"></i> <?php echo $topicTitle ; ?></h4></div>
            <div class="col-lg-12  border-bottom border-light p-5">
                <?php echo topicdescription_by_id($pdo,$topicId) ; ?>
            </div>
            <div class="col-lg-12 p-2">
                <div class="row">
                <div class="col-lg-4 text-center">
                    <div class="col-lg-12">
                    <img src="<?php echo BASE_URL.get_user_profilepic_name_url_username($pdo,$username) ; ?>" class="img-fluid w-25 rounded-circle">
                    </div>
                    <div class="col-lg-12 mt-2">
                        <p>@<?php echo $username ; ?></p>
                    </div>
                    <div class="col-lg-12 mt-2">
                        <a href=" <?php echo BASE_URL.'user/'.$username ; ?>" class="btn btn-sm btn-primary">View Profile</a><?php echo topicsolved_by_id($pdo,$topicId) ; ?>
                    </div>
                    <div class="col-lg-12 mt-2">
                        Posted On : <?php echo grab_topic_date($pdo,$topicId) ; ?>
                    </div>
                </div>
                <div class="col-lg-8">
                    <?php echo grab_all_badges_by_username($pdo,$username) ; ?>  
                </div>
                </div>
            </div>
        </div>
      </div>
        <?php echo show_forum_topic_solution($pdo,$topicId) ; ?>
        <?php echo show_topic_answer_default($pdo,$topicId) ; ?>
        <div class="jQueryMoreTopicReplies"></div>
        <div class=" userAnswer"></div>
    <form method="post" class="topicReplySubmit">
    <div class="section-header">
    
     <div class="row w-100 ml-1 mr-1">
         <div class="col-lg-12">
            <textarea class="form-control textareaVeryLarge " name="topicReply" placeholder="Post Your Reply...."></textarea>
         </div>
         <div class="col-lg-12 text-center mt-3">
             <?php if(!empty($_SESSION['unprofessional']['id'])){ ?> 
             <input type="hidden" name="btn_action" value="SubmitForumReply">
             <input type="hidden" name="topicId" value="<?php echo $topicId ; ?>" >
             <button type="submit" class="btn btn-primary btn-md" >Post Your Reply</button>
             <?php } else { ?> 
             <a href="<?php echo BASE_URL ; ?>login" class="btn btn-md btn-danger">Login to Post Reply</a>
             <?php } ?>
         </div>
     </div>
    
    </div>
    </form>
    </section>
</div>
<?php include("footer_main.php") ; ?>