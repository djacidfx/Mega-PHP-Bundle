<?php
function userlang($txt){
    static $userlang = array(
        "xlan" => "korean",
        "self_destruct_text" => "개인 우편 번호는 링크가 열리면 자동으로 파기됩니다.",
        "note_heading" => "익명의 개인 우편 번호",
        "note_heading_password" => "비밀번호가 있는 익명의 개인 우편 번호",
        "textarea_placeholder" => "당신의 개인 메모는 무엇입니까 ... ?",
        "create_note_btn" => "비공개 우편 번호 만들기",
        "create_note_with_password_btn" => "비밀번호로 개인용 우편번호 만들기",
        "spam_msg" => "스패머는 허용되지 않습니다.",
        "empty_note_error" => "비공개 메모는 비워둘 수 없습니다.",
        "empty_note_error_password" => "개인 메모, 비밀번호 및 비밀번호 재입력은 비워둘 수 없습니다.",
        "empty_note_password_error" => "개인 메모 및 비밀번호는 비워둘 수 없습니다.",
        "note_password_error" => "비밀번호가 잘못되었습니다. 다시 시도하십시오.",
        "password_error" => "비밀번호와 비밀번호 재입력이 일치하지 않습니다.",
        "note_heading_link" => "익명의 개인 우편번호 링크",
        "note_destroy_msg" => "이 메모는 폐기되었습니다. 창을 닫거나 언어/모드를 변경하기 전에 다운로드 및 복사하십시오.",
        "create_pvt_note" => "개인 메모 만들기",
        "read_msg" => "메모를 다운로드하고 읽고 파괴한 것 같습니다.",
        "password_heading" => "비밀번호",
        "repassword_heading" => "비밀번호 재입력",
        "password_msg_heading" => "Private Zip Note는 비밀번호로 암호화되어 있습니다.",
        "enter_password" => "비밀번호 입력 및 메모 열기",
        "copyright_heading" => "저작권",
        "all_right_reserved" => "판권 소유.",
        "admin_login_heading" => "관리자 패널 로그인",
        "username" => "사용자 이름",
        "admin_incorrectlogin_msg" => "잘못된 사용자 이름 또는 비밀번호입니다. 다시 시도하십시오.",
        "empty_admin_error" => "관리자 사용자 이름/비밀번호는 비워둘 수 없습니다.",
        "login" => "로그인",
        "notifications" => "알림 및 바로가기",
        "view" => "보다",
        "total_private_note" => "총 개인 우편 번호",      
        "total_unreadprivate_note" => "읽지 않은 총 개인 Zip 메모",       
        "total_readprivate_note" => "총 읽기 Zip 개인 메모",        
        "total_banned_ip" => "총 차단 사용자 IP",
        "logout" => "로그 아웃",
        "analysis" => "분석",
        "lifetime_notes" => "평생 개인 우편 번호",
        "thismonth_notes" => "이달의 개인 우편번호",
        "today_notes" => "오늘의 개인 우편번호",
        "wrong_password" => "비밀번호가 잘못되었습니다. 다시 시도하십시오.",
        "form_empty" => "모든 필드는 필수입니다. 다시 시도하십시오.",
        "username_changed" => "관리자 사용자 이름이 성공적으로 변경되었습니다.",
        "change_admin_username" => "관리자 사용자 이름 변경",
        "old_admin_username" => "이전 관리자 사용자 이름",
        "new_admin_username" => "새 관리자 사용자 이름",
        "change" => "변화",
        "old_admin_password" => "이전 관리자 비밀번호",
        "new_admin_password" => "새 관리자 비밀번호",
        "min_password" => "비밀번호는 최소 8자, 대문자 1자, 소문자 1자 및 숫자 1자를 포함해야 합니다(예제 - Test1234).",
        "change_admin_password" => "관리자 비밀번호 변경",
        "password_changed" => "관리자 비밀번호가 성공적으로 변경되었습니다.",
        "read" => "읽다",
        "unread" => "읽히지 않는",
        "delete_note" => "메모 삭제",
        "delete_note_with_ip" => "메모 삭제 및 사용자 IP 차단",
        "view_note" => "메모 보기",
        "yes" => "예",
        "no" => "아니",
        "serial_number" => "S.No.",
        "date" => "날짜",
        "note_id" => "메모 ID",
        "note_unique_id" => "참고 고유 ID",
        "user_ip" => "사용자 IP",
        "note" => "메모",
        "password_protected" => "암호로 보호됨",
        "status" => "상태",
        "action" => "동작",
        "note_deleted" => "메모가 성공적으로 삭제되었습니다.",
        "note_deleted_with_ip" => "메모가 성공적으로 삭제되었으며 사용자 IP가 차단되었습니다.",  
        "unblock_ip" => "사용자 IP 차단을 해제하고 블랙리스트에서 삭제합니다.",
        "unblocked_ip" => "사용자 IP가 차단 해제되고 블랙리스트에서 삭제되었습니다.",
        "blocked_msg" => "죄송합니다 ! 이 웹사이트는 당신을 위한 것이 아닙니다.",
        "max_limit" => "최대 한도 - ".ZIP_LIMIT." KB",
        "zip_limit" => "업로드한 Zip 파일이 ".ZIP_LIMIT."보다 큽니다. KB 다시 시도하십시오.",
        "should_be_zip" => "업로드된 파일은 zip이 아닙니다. zip 파일을 업로드하고 다시 시도하십시오.",
        "zip" => "압축 파일",
        "download" => "Zip 다운로드",
        "download_deleted" => "우편번호가 삭제됨",
        "delete_temp_zip" => "모든 임시 Zip 파일 삭제",
        "delete_temp_zip_success" => "모든 임시 Zip 파일이 성공적으로 삭제되었습니다.",
        "note_deleted" => "메모 및 우편번호가 성공적으로 삭제되었습니다.",
        "note_deleted_with_ip" => "참고 및 Zip이 성공적으로 삭제되고 사용자 IP가 차단되었습니다."
    );  
    return $userlang[$txt];
}

?>