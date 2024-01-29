<?php include("header.php") ; ?>
<?php  
$forum = "active" ;
$topicId = filter_var($_GET['topic_id'], FILTER_SANITIZE_NUMBER_INT) ;
$topicTitle = forum_title_by_id($pdo,$topicId) ;
$userId = forum_userid_by_titleid($pdo,$topicId) ; 
$username = username_by_id($pdo,$userId);
$upd = $pdo->prepare("update ot_forum_topic set topic_admin_seen = '1' where topic_id = '".$topicId."'");
$upd->execute() ;
?>
<?php include("sidebar.php") ; ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <div class="row">
            <div class="col-lg-12 border-bottom border-light"><h4 class="text-muted"><i class="fa fa-question-circle"></i> <?php echo $topicTitle ; ?></h4></div>
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
                    <div class="col-lg-12 mt-2">
                        <button class="btn btn-danger btn-md deleteTopic" id="<?php echo $topicId ; ?>">Delete</button>
                    </div>
                </div>
                <div class="col-lg-8">
                    <?php echo grab_all_badges_by_username($pdo,$username) ; ?>  
                </div>
                </div>
            </div>
          </div>
        </div>
        <?php echo show_forum_topic_solution_foradmin($pdo,$topicId) ; ?>
        <?php echo show_topic_allanswer_foradmin($pdo,$topicId); ?>
    </section>
</div>
<?php include("footer.php") ; ?>