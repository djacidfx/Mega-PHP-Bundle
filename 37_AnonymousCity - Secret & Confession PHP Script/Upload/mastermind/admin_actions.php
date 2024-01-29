<?php
include("database.php") ;
if($_POST['btn_action']){
    
    if($_POST['btn_action'] == 'header970') {
        if(!empty($_POST['header970code']) && !empty($_POST['header970status']) ) {
            $code = base64_encode($_POST['header970code']) ;
            $code = filter_var($code, FILTER_SANITIZE_STRING) ;
            $status = filter_var($_POST['header970status'] , FILTER_SANITIZE_NUMBER_INT) ;
            if($status == '1'){
                $status = '1' ;
            } else {
                $status = '0' ;
            }
            $upd = $pdo->prepare("update ot_ads set ad_code = '".$code."' , ad_status = '".$status."' where ad_id = '1'") ;
            $upd->execute() ;
            if($upd){
                echo "1" ;
            } else {
                echo "0" ;
            }
        } else {
            echo "0" ;
        }
    }
    
    if($_POST['btn_action'] == 'header320') {
        if(!empty($_POST['header320code']) && !empty($_POST['header320status']) ) {
            $code = base64_encode($_POST['header320code']) ;
            $code = filter_var($code, FILTER_SANITIZE_STRING) ;
            $status = filter_var($_POST['header320status'] , FILTER_SANITIZE_NUMBER_INT) ;
            if($status == '1'){
                $status = '1' ;
            } else {
                $status = '0' ;
            }
            $upd = $pdo->prepare("update ot_ads set ad_code = '".$code."' , ad_status = '".$status."' where ad_id = '2'") ;
            $upd->execute() ;
            if($upd){
                echo "1" ;
            } else {
                echo "0" ;
            }
        } else {
            echo "0" ;
        }
    }
    
    if($_POST['btn_action'] == 'btndesktopfeatured300') {
        if(!empty($_POST['desktopfeatured300_one']) && !empty($_POST['desktopfeatured300_two']) && !empty($_POST['desktopfeatured300status']) ) {
            $code = base64_encode($_POST['desktopfeatured300_one']) ;
            $code = filter_var($code, FILTER_SANITIZE_STRING) ;
            $code_two = base64_encode($_POST['desktopfeatured300_two']) ;
            $code_two = filter_var($code_two, FILTER_SANITIZE_STRING) ;
            $status = filter_var($_POST['desktopfeatured300status'] , FILTER_SANITIZE_NUMBER_INT) ;
            if($status == '1'){
                $status = '1' ;
            } else {
                $status = '0' ;
            }
            $upd = $pdo->prepare("update ot_ads set ad_code = '".$code."' , ad_status = '".$status."' where ad_id = '3'") ;
            $upd->execute() ;
            $updtwo = $pdo->prepare("update ot_ads set ad_code = '".$code_two."' , ad_status = '".$status."' where ad_id = '4'") ;
            $updtwo->execute() ;
            echo "1" ;
            
        } else {
            echo "0" ;
        }
    }
    
    if($_POST['btn_action'] == 'btnmobilefeatured300') {
        if(!empty($_POST['mobilefeatured300_one']) && !empty($_POST['mobilefeatured300status']) ) {
            $code = base64_encode($_POST['mobilefeatured300_one']) ;
            $code = filter_var($code, FILTER_SANITIZE_STRING) ;
            $status = filter_var($_POST['mobilefeatured300status'] , FILTER_SANITIZE_NUMBER_INT) ;
            if($status == '1'){
                $status = '1' ;
            } else {
                $status = '0' ;
            }
            $upd = $pdo->prepare("update ot_ads set ad_code = '".$code."' , ad_status = '".$status."' where ad_id = '7'") ;
            $upd->execute() ;
            echo "1" ;
            
        } else {
            echo "0" ;
        }
    }
    
    if($_POST['btn_action'] == 'btndesktoptrending300') {
        if(!empty($_POST['desktoptrending300_one']) && !empty($_POST['desktoptrending300_two']) && !empty($_POST['desktoptrending300status']) ) {
            $code = base64_encode($_POST['desktoptrending300_one']) ;
            $code = filter_var($code, FILTER_SANITIZE_STRING) ;
            $code_two = base64_encode($_POST['desktoptrending300_two']) ;
            $code_two = filter_var($code_two, FILTER_SANITIZE_STRING) ;
            $status = filter_var($_POST['desktoptrending300status'] , FILTER_SANITIZE_NUMBER_INT) ;
            if($status == '1'){
                $status = '1' ;
            } else {
                $status = '0' ;
            }
            $upd = $pdo->prepare("update ot_ads set ad_code = '".$code."' , ad_status = '".$status."' where ad_id = '5'") ;
            $upd->execute() ;
            $updtwo = $pdo->prepare("update ot_ads set ad_code = '".$code_two."' , ad_status = '".$status."' where ad_id = '6'") ;
            $updtwo->execute() ;
            echo "1" ;
            
        } else {
            echo "0" ;
        }
    }
    
    if($_POST['btn_action'] == 'btnmobiletrending300') {
        if(!empty($_POST['mobiletrending300_one']) && !empty($_POST['mobiletrending300status']) ) {
            $code = base64_encode($_POST['mobiletrending300_one']) ;
            $code = filter_var($code, FILTER_SANITIZE_STRING) ;
            $status = filter_var($_POST['mobiletrending300status'] , FILTER_SANITIZE_NUMBER_INT) ;
            if($status == '1'){
                $status = '1' ;
            } else {
                $status = '0' ;
            }
            $upd = $pdo->prepare("update ot_ads set ad_code = '".$code."' , ad_status = '".$status."' where ad_id = '8'") ;
            $upd->execute() ;
            echo "1" ;
            
        } else {
            echo "0" ;
        }
    }
    
    if($_POST['btn_action'] == 'sidebar600') {
        if(!empty($_POST['sidebar600code']) && !empty($_POST['sidebar600status']) ) {
            $code = base64_encode($_POST['sidebar600code']) ;
            $code = filter_var($code, FILTER_SANITIZE_STRING) ;
            $status = filter_var($_POST['sidebar600status'] , FILTER_SANITIZE_NUMBER_INT) ;
            if($status == '1'){
                $status = '1' ;
            } else {
                $status = '0' ;
            }
            $upd = $pdo->prepare("update ot_ads set ad_code = '".$code."' , ad_status = '".$status."' where ad_id = '9'") ;
            $upd->execute() ;
            if($upd){
                echo "1" ;
            } else {
                echo "0" ;
            }
        } else {
            echo "0" ;
        }
    }
    
    if($_POST['btn_action'] == 'sidebar300') {
        if(!empty($_POST['sidebar300code']) && !empty($_POST['sidebar300status']) ) {
            $code = base64_encode($_POST['sidebar300code']) ;
            $code = filter_var($code, FILTER_SANITIZE_STRING) ;
            $status = filter_var($_POST['sidebar300status'] , FILTER_SANITIZE_NUMBER_INT) ;
            if($status == '1'){
                $status = '1' ;
            } else {
                $status = '0' ;
            }
            $upd = $pdo->prepare("update ot_ads set ad_code = '".$code."' , ad_status = '".$status."' where ad_id = '10'") ;
            $upd->execute() ;
            if($upd){
                echo "1" ;
            } else {
                echo "0" ;
            }
        } else {
            echo "0" ;
        }
    }
    
    if($_POST['btn_action'] == 'commonfeatured300') {
        if(!empty($_POST['commonfeatured300code']) && !empty($_POST['commonfeatured300status']) ) {
            $code = base64_encode($_POST['commonfeatured300code']) ;
            $code = filter_var($code, FILTER_SANITIZE_STRING) ;
            $status = filter_var($_POST['commonfeatured300status'] , FILTER_SANITIZE_NUMBER_INT) ;
            if($status == '1'){
                $status = '1' ;
            } else {
                $status = '0' ;
            }
            $upd = $pdo->prepare("update ot_ads set ad_code = '".$code."' , ad_status = '".$status."' where ad_id = '11'") ;
            $upd->execute() ;
            if($upd){
                echo "1" ;
            } else {
                echo "0" ;
            }
        } else {
            echo "0" ;
        }
    }
    
    if($_POST['btn_action'] == 'commontrending300') {
        if(!empty($_POST['commontrending300code']) && !empty($_POST['commontrending300status']) ) {
            $code = base64_encode($_POST['commontrending300code']) ;
            $code = filter_var($code, FILTER_SANITIZE_STRING) ;
            $status = filter_var($_POST['commontrending300status'] , FILTER_SANITIZE_NUMBER_INT) ;
            if($status == '1'){
                $status = '1' ;
            } else {
                $status = '0' ;
            }
            $upd = $pdo->prepare("update ot_ads set ad_code = '".$code."' , ad_status = '".$status."' where ad_id = '12'") ;
            $upd->execute() ;
            if($upd){
                echo "1" ;
            } else {
                echo "0" ;
            }
        } else {
            echo "0" ;
        }
    }
    
    if($_POST['btn_action'] == 'makeOnlyUnfeaturedPost') {
        if(!empty($_POST['id'])) {
            $postId = filter_var($_POST['id'] , FILTER_SANITIZE_NUMBER_INT) ;
            $upd = $pdo->prepare("update ot_secrets set featured = '0' where id = '".$postId."'" ) ; 
            $upd->execute() ;
            echo "Post is Unfeatured Now." ;
        } else {
            echo "Id is missing. Try Again" ;
        }
    }
    
    if($_POST['btn_action'] == 'makeUnfeaturedTrendingPost') {
        if(!empty($_POST['id'])) {
            $postId = filter_var($_POST['id'] , FILTER_SANITIZE_NUMBER_INT) ;
            $upd = $pdo->prepare("update ot_secrets set featured = '0' , trending = '1' where id = '".$postId."'" ) ; 
            $upd->execute() ;
            echo "Post status changed from Featured to Trending." ;
        } else {
            echo "Id is missing. Try Again" ;
        }
    }
    
    if($_POST['btn_action'] == 'makeOnlyUntrendingPost') {
        if(!empty($_POST['id'])) {
            $postId = filter_var($_POST['id'] , FILTER_SANITIZE_NUMBER_INT) ;
            $upd = $pdo->prepare("update ot_secrets set trending = '0' where id = '".$postId."'" ) ; 
            $upd->execute() ;
            echo "Post is UnTrending Now." ;
        } else {
            echo "Id is missing. Try Again" ;
        }
    }
    
    if($_POST['btn_action'] == 'makeUnTrendingFeaturedPost') {
        if(!empty($_POST['id'])) {
            $postId = filter_var($_POST['id'] , FILTER_SANITIZE_NUMBER_INT) ;
            $upd = $pdo->prepare("update ot_secrets set featured = '1' , trending = '0' where id = '".$postId."'" ) ; 
            $upd->execute() ;
            echo "Post status changed from Trending to Featured." ;
        } else {
            echo "Id is missing. Try Again" ;
        }
    }
    
    if($_POST['btn_action'] == 'makeOnlyFeaturedPost') {
        if(!empty($_POST['id'])) {
            $postId = filter_var($_POST['id'] , FILTER_SANITIZE_NUMBER_INT) ;
            $upd = $pdo->prepare("update ot_secrets set featured = '1' where id = '".$postId."'" ) ; 
            $upd->execute() ;
            echo "Post is Featured Now." ;
        } else {
            echo "Id is missing. Try Again" ;
        }
    }
    
    if($_POST['btn_action'] == 'makeOnlyTrendingPost') {
        if(!empty($_POST['id'])) {
            $postId = filter_var($_POST['id'] , FILTER_SANITIZE_NUMBER_INT) ;
            $upd = $pdo->prepare("update ot_secrets set trending = '1' where id = '".$postId."'" ) ; 
            $upd->execute() ;
            echo "Post is Trending Now." ;
        } else {
            echo "Id is missing. Try Again" ;
        }
    }
    
    if($_POST['btn_action'] == 'deletePostComplete') {
        if(!empty($_POST['id'])) {
            $postId = filter_var($_POST['id'] , FILTER_SANITIZE_NUMBER_INT) ;
            $upd = $pdo->prepare("DELETE FROM `ot_secrets` where id = '".$postId."'" ) ; 
            $upd->execute() ;
            $updlove = $pdo->prepare("DELETE FROM `ot_secret_love` where love_post_id = '".$postId."'" ) ; 
            $updlove->execute() ;
            $updcomment = $pdo->prepare("DELETE FROM `ot_comments` where post_id = '".$postId."'" ) ; 
            $updcomment->execute() ;
            echo "Post is deleted." ;
        } else {
            echo "Id is missing. Try Again" ;
        }
    }
    
    if($_POST['btn_action'] == 'deletePostBlockComplete') {
        if(!empty($_POST['id']) && !empty($_POST['status'])) {
            $postId = filter_var($_POST['id'] , FILTER_SANITIZE_NUMBER_INT) ;
            $blockIp = base64_decode($_POST['status']) ;
            $blockIp = filter_var($blockIp, FILTER_VALIDATE_IP) ;
            $ins = $pdo->prepare("insert into ot_ip_blocked (blocked_ip) values ('".$blockIp."') ") ;
            $ins->execute() ;
            $upd = $pdo->prepare("DELETE FROM `ot_secrets` where id = '".$postId."'" ) ; 
            $upd->execute() ;
            $updlove = $pdo->prepare("DELETE FROM `ot_secret_love` where love_post_id = '".$postId."'" ) ; 
            $updlove->execute() ;
            $updcomment = $pdo->prepare("DELETE FROM `ot_comments` where post_id = '".$postId."'" ) ; 
            $updcomment->execute() ;
            echo "Post is deleted & User IP is Blocked." ;
        } else {
            echo "Id is missing. Try Again" ;
        }
    }
    
    if($_POST['btn_action'] == 'editPostSecret') {
        if(!empty($_POST['pid']) && !empty($_POST['title']) && !empty($_POST['description'])) {
            $postId = filter_var($_POST['pid'] , FILTER_SANITIZE_NUMBER_INT) ;
            $postDescription = base64_encode($_POST['description']) ;
            $postDescription = filter_var($postDescription , FILTER_SANITIZE_STRING) ;
            $postTitle = filter_var($_POST['title'], FILTER_SANITIZE_STRING) ;
            $postDuplicate = check_duplicate_title_byId($pdo,$postTitle,$postId) ;
            if($postDuplicate > 0) {
                echo "2" ;
            } else {
                if(check_post_id($pdo , $postId) == 0) {
                    echo "3" ;
                } else {
                    $upd = $pdo->prepare("update ot_secrets set title = '".$postTitle."' , description = '".$postDescription."' where id = '".$postId."'" ) ; 
                    $upd->execute() ;
                    echo "0" ;
                }
            }
            
        } else {
            echo "1" ;
        }
    }
    
    if($_POST['btn_action'] == 'postCommentReply') {
        if(!empty($_POST['cid']) && !empty($_POST['userComment'])) {
            $commentId = filter_var($_POST['cid'] , FILTER_SANITIZE_NUMBER_INT) ;
            $userComment = base64_encode($_POST['userComment']) ;
            $userComment = filter_var($userComment , FILTER_SANITIZE_STRING) ;
            $adminReply = base64_encode($_POST['adminReply']) ;
            $adminReply = filter_var($adminReply, FILTER_SANITIZE_STRING) ;
            $upd = $pdo->prepare("update ot_comments set comment = '".$userComment."' , admin_reply = '".$adminReply."' , comment_seen = '1' where comment_id = '".$commentId."'" ) ; 
            $upd->execute() ;
            echo "0" ;                
        } else {
            echo "1" ;
        }
    }
    
    if($_POST['btn_action'] == 'markOnlySeenComment') {
        if(!empty($_POST['id'])) {
            $commentId = filter_var($_POST['id'] , FILTER_SANITIZE_NUMBER_INT) ;
            $upd = $pdo->prepare("update ot_comments set comment_seen = '1' where comment_id = '".$commentId."'" ) ; 
            $upd->execute() ;              
        } 
    }
    
    if($_POST['btn_action'] == 'markOnlyUnSeenComment') {
        if(!empty($_POST['id'])) {
            $commentId = filter_var($_POST['id'] , FILTER_SANITIZE_NUMBER_INT) ;
            $upd = $pdo->prepare("update ot_comments set comment_seen = '0' where comment_id = '".$commentId."'" ) ; 
            $upd->execute() ;              
        } 
    }
    
    if($_POST['btn_action'] == 'deleteCommentComplete') {
        if(!empty($_POST['id'])) {
            $commentId = filter_var($_POST['id'] , FILTER_SANITIZE_NUMBER_INT) ;
            $upd = $pdo->prepare("delete from ot_comments where comment_id = '".$commentId."'" ) ; 
            $upd->execute() ;              
        } 
    }
    
    if($_POST['btn_action'] == 'deleteCommentBlockUser') {
        if(!empty($_POST['id']) && !empty($_POST['status']) ) {
            $commentId = filter_var($_POST['id'] , FILTER_SANITIZE_NUMBER_INT) ;
            $blockIp = base64_decode($_POST['status']) ;
            $blockIp = filter_var($blockIp, FILTER_VALIDATE_IP) ;
            $sel = $pdo->prepare("select * from ot_ip_blocked where blocked_ip = '".$blockIp."'") ;
            $sel->execute() ;
            $total = $sel->rowCount();
            if($total > 0){
                $del = $pdo->prepare("delete from ot_ip_blocked where blocked_ip = '".$blockIp."'" ) ; 
                $del->execute() ; 
            }            
            $ins = $pdo->prepare("insert into ot_ip_blocked (blocked_ip) values ('".$blockIp."') ") ;
            $ins->execute() ;
            $upd = $pdo->prepare("delete from ot_comments where comment_id = '".$commentId."'" ) ; 
            $upd->execute() ;              
        } 
    }
    
    if($_POST['btn_action'] == 'blockUserManualIPAddress') {
        if(!empty($_POST['userip'])) {
            $blockIp = filter_var($_POST['userip'] , FILTER_VALIDATE_IP) ;
            if(!empty($blockIp)){
                $sel = $pdo->prepare("select * from ot_ip_blocked where blocked_ip = '".$blockIp."'") ;
                $sel->execute() ;
                $total = $sel->rowCount();
                if($total > 0){
                    $del = $pdo->prepare("delete from ot_ip_blocked where blocked_ip = '".$blockIp."'" ) ; 
                    $del->execute() ;
                    
                } 
                $ins = $pdo->prepare("insert into ot_ip_blocked (blocked_ip) values ('".$blockIp."') ") ;
                $ins->execute() ;
                echo "0" ; 
            } else {
                echo "1" ;
            }
                         
        } else {
            echo "1" ;
        }
    }
    
    if($_POST['btn_action'] == 'deleteBlacklist') {
        if(!empty($_POST['status'])) {
            $blockIp = base64_decode($_POST['status']) ;
            $blockIp = filter_var($blockIp , FILTER_VALIDATE_IP) ;
            if(!empty($blockIp)){
                    $del = $pdo->prepare("delete from ot_ip_blocked where blocked_ip = '".$blockIp."'" ) ; 
                    $del->execute() ; 
                echo "User IP is unblocked & deleted from blacklist table" ;
            }
                         
        }
    }
    
    if($_POST['btn_action'] == 'featuredindex') {
        if(!empty($_POST['featureload'])) {
            $load = filter_var($_POST['featureload'] , FILTER_SANITIZE_NUMBER_INT) ;
            if($load >0){
               $upd = $pdo->prepare("update ot_loader set loading = '".$load."' where loader_id = '1'" ) ; 
                $upd->execute() ;    
                echo "1" ; 
            } else {
                echo "0" ;
            }
            
        } else {
            echo "0" ;
        }
    }
    
    if($_POST['btn_action'] == 'featuredindexside') {
        if(!empty($_POST['featureloadside'])) {
            $load = filter_var($_POST['featureloadside'] , FILTER_SANITIZE_NUMBER_INT) ;
            if($load >0){
               $upd = $pdo->prepare("update ot_loader set loading = '".$load."' where loader_id = '4'" ) ; 
                $upd->execute() ;    
                echo "1" ; 
            } else {
                echo "0" ;
            }
            
        } else {
            echo "0" ;
        }
    }
    
    if($_POST['btn_action'] == 'trendingindex') {
        if(!empty($_POST['trendingload'])) {
            $load = filter_var($_POST['trendingload'] , FILTER_SANITIZE_NUMBER_INT) ;
            if($load >0){
               $upd = $pdo->prepare("update ot_loader set loading = '".$load."' where loader_id = '2'" ) ; 
                $upd->execute() ;    
                echo "1" ; 
            } else {
                echo "0" ;
            }
            
        } else {
            echo "0" ;
        }
    }
    
    if($_POST['btn_action'] == 'trendingindexside') {
        if(!empty($_POST['trendingloadside'])) {
            $load = filter_var($_POST['trendingloadside'] , FILTER_SANITIZE_NUMBER_INT) ;
            if($load >0){
               $upd = $pdo->prepare("update ot_loader set loading = '".$load."' where loader_id = '5'" ) ; 
                $upd->execute() ;    
                echo "1" ; 
            } else {
                echo "0" ;
            }
            
        } else {
            echo "0" ;
        }
    }
    
    if($_POST['btn_action'] == 'newindex') {
        if(!empty($_POST['newload'])) {
            $load = filter_var($_POST['newload'] , FILTER_SANITIZE_NUMBER_INT) ;
            if($load >0){
               $upd = $pdo->prepare("update ot_loader set loading = '".$load."' where loader_id = '3'" ) ; 
                $upd->execute() ;    
                echo "1" ; 
            } else {
                echo "0" ;
            }
            
        } else {
            echo "0" ;
        }
    }
    
    if($_POST['btn_action'] == 'allfeatured') {
        if(!empty($_POST['allfeaturedposts'])) {
            $load = filter_var($_POST['allfeaturedposts'] , FILTER_SANITIZE_NUMBER_INT) ;
            if($load >0){
               $upd = $pdo->prepare("update ot_loader set loading = '".$load."' where loader_id = '6'" ) ; 
                $upd->execute() ;    
                echo "1" ; 
            } else {
                echo "0" ;
            }
            
        } else {
            echo "0" ;
        }
    }
    
    if($_POST['btn_action'] == 'alltrending') {
        if(!empty($_POST['alltrendingposts'])) {
            $load = filter_var($_POST['alltrendingposts'] , FILTER_SANITIZE_NUMBER_INT) ;
            if($load >0){
               $upd = $pdo->prepare("update ot_loader set loading = '".$load."' where loader_id = '7'" ) ; 
                $upd->execute() ;    
                echo "1" ; 
            } else {
                echo "0" ;
            }
            
        } else {
            echo "0" ;
        }
    }
    
    if($_POST['btn_action'] == 'allnew') {
        if(!empty($_POST['allnewposts'])) {
            $load = filter_var($_POST['allnewposts'] , FILTER_SANITIZE_NUMBER_INT) ;
            if($load >0){
               $upd = $pdo->prepare("update ot_loader set loading = '".$load."' where loader_id = '8'" ) ; 
                $upd->execute() ;    
                echo "1" ; 
            } else {
                echo "0" ;
            }
            
        } else {
            echo "0" ;
        }
    }
    
    if($_POST['btn_action'] == 'allsearch') {
        if(!empty($_POST['allsearchposts'])) {
            $load = filter_var($_POST['allsearchposts'] , FILTER_SANITIZE_NUMBER_INT) ;
            if($load >0){
               $upd = $pdo->prepare("update ot_loader set loading = '".$load."' where loader_id = '9'" ) ; 
                $upd->execute() ;    
                echo "1" ; 
            } else {
                echo "0" ;
            }
            
        } else {
            echo "0" ;
        }
    }
    
    if($_POST['btn_action'] == 'saveGaCode') {
        if(!empty($_POST['ga_code']) ) {
            $code = base64_encode($_POST['ga_code']) ;
            $code = filter_var($code, FILTER_SANITIZE_STRING) ;
            $userstatus = filter_var($_POST['user_status'] , FILTER_SANITIZE_NUMBER_INT) ;
            $adminstatus = filter_var($_POST['admin_status'] , FILTER_SANITIZE_NUMBER_INT) ;
            if($userstatus == '1'){
                $userstatus = '1' ;
            } else {
                $userstatus = '0' ;
            }
            
            if($adminstatus == '1'){
                $adminstatus = '1' ;
            } else {
                $adminstatus = '0' ;
            }
            
            $upd = $pdo->prepare("update ot_admin set ga_code = '".$code."' , user_on = '".$userstatus."' , admin_on = '".$adminstatus."' where id = '1'") ;
            $upd->execute() ;
            if($upd){
                echo "1" ;
            } else {
                echo "0" ;
            }
        } else {
            echo "0" ;
        }
    }
    
    if($_POST['btn_action'] == 'saveaboutus') {
        if(!empty($_POST['aboutus'])  && !empty($_POST['copyright']) ) {
            $code = base64_encode($_POST['aboutus']) ;
            $code = filter_var($code, FILTER_SANITIZE_STRING) ;
            $copyright = filter_var($_POST['copyright'] , FILTER_SANITIZE_STRING) ;
            $upd = $pdo->prepare("update ot_admin set about_us = '".$code."' , adm_name = '".$copyright."' where id = '1'") ;
            $upd->execute() ;
            if($upd){
                echo "1" ;
            } else {
                echo "0" ;
            }
        } else {
            echo "0" ;
        }
    }
    
    if($_POST['btn_action'] == 'saveextra') {
        if(!empty($_POST['blk'])  && !empty($_POST['love']) ) {
            $code = filter_var($_POST['blk'], FILTER_SANITIZE_STRING) ;
            $love = filter_var($_POST['love'] , FILTER_SANITIZE_STRING) ;
            $upd = $pdo->prepare("update ot_admin set block_msg = '".$code."' , love_msg = '".$love."' where id = '1'") ;
            $upd->execute() ;
            if($upd){
                echo "1" ;
            } else {
                echo "0" ;
            }
        } else {
            echo "0" ;
        }
    }
    
    if($_POST['btn_action'] == 'saveemail') {
        if(!empty($_POST['email'])  && !empty($_POST['password']) ) {
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL) ;
            $password = filter_var($_POST['password'] , FILTER_SANITIZE_STRING) ;
            $statement = $pdo->prepare("select * from ot_admin where id = '1'");
            $statement->execute() ;
            $result = $statement->fetchAll(PDO::FETCH_ASSOC); 
            $user_ok = $statement->rowCount();
            if($user_ok > 0) {
                foreach($result as $row){
                    $auth_pass = _e($row['adm_password']) ;
                }
            }
            //validate password
			if(password_verify($password, $auth_pass)) {            
                $upd = $pdo->prepare("update ot_admin set adm_email = '".$email."' where id = '1'") ;
                $upd->execute() ;
                if($upd){
                    echo "1" ;
                } else {
                    echo "0" ;
                }
            } else {
                echo "0" ;
            }
        } else {
            echo "0" ;
        }
    }
    
    if($_POST['btn_action'] == 'savepassword') {
        if(!empty($_POST['oldpass'])  && !empty($_POST['newpass']) && !empty($_POST['repass'])  ) {
            $oldpass = filter_var($_POST['oldpass'], FILTER_SANITIZE_STRING) ;
            $newpass = filter_var($_POST['newpass'], FILTER_SANITIZE_STRING) ;
            $repass = filter_var($_POST['repass'], FILTER_SANITIZE_STRING) ;
            
            $uppercase = preg_match('@[A-Z]@', $newpass);
            $lowercase = preg_match('@[a-z]@', $newpass);
            $number    = preg_match('@[0-9]@', $newpass);
            $statement = $pdo->prepare("select * from ot_admin where id = '1'");
            $statement->execute() ;
            $result = $statement->fetchAll(PDO::FETCH_ASSOC); 
            $user_ok = $statement->rowCount();
            if($user_ok > 0) {
                foreach($result as $row){
                    $auth_pass = _e($row['adm_password']) ;
                }
                if(password_verify($oldpass, $auth_pass)) {
                    if($newpass == $repass) {
                        //validate password
                        if(!$uppercase || !$lowercase || !$number || strlen($newpass) < 8) {
                            echo "3" ;
                        } else {
                            $update_password = $pdo->prepare("update ot_admin set adm_password = ? where id = '1'");
                            $update_password->execute(array(password_hash($newpass, PASSWORD_DEFAULT)));
                            
                            echo "1" ;
                        }
                    } else {
                        echo "2" ;
                    }
                } else {
                    echo "0" ;
                }
            }
        }
    }
    
}
?>