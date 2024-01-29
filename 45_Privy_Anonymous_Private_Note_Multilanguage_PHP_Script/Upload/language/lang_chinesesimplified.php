<?php
function userlang($txt){
    static $userlang = array(
        "xlan" => "chinesesimplified",
        "self_destruct_text" => "一旦打开链接，私人笔记将自毁。",
        "note_heading" => "匿名私人笔记",
        "note_heading_password" => "带密码的匿名私人笔记",
        "textarea_placeholder" => "你的私人笔记是什么……？",
        "create_note_btn" => "创建私人笔记",
        "create_note_with_password_btn" => "使用密码创建私人笔记",
        "spam_msg" => "垃圾邮件是不允许的。",
        "empty_note_error" => "私人笔记不应为空。",
        "empty_note_error_password" => "私人备注、密码和重新输入密码不应为空。",
        "empty_note_password_error" => "私人备注和密码不应为空。",
        "note_password_error" => "密码错误。再试一次。",
        "password_error" => "密码和重新输入密码不匹配。",
        "note_heading_link" => "匿名私人笔记链接",
        "note_destroy_msg" => "这张纸条被销毁了。在关闭窗口或更改语言/模式之前复制它。",
        "create_pvt_note" => "创建您的私人笔记",
        "read_msg" => "似乎笔记已被读取并销毁。",
        "password_heading" => "密码",
        "repassword_heading" => "重新输入密码",
        "password_msg_heading" => "私人笔记是密码加密的。",
        "enter_password" => "输入密码并打开备注",
        "copyright_heading" => "版权",
        "all_right_reserved" => "版权所有。",
        "admin_login_heading" => "管理面板登录",
        "username" => "用户名",
        "admin_incorrectlogin_msg" => "用户名或密码错误。再试一次。",
        "empty_admin_error" => "管理员用户名/密码不应为空。",
        "login" => "登录",
        "notifications" => "通知和快捷方式",
        "view" => "看法",
        "total_private_note" => "私人笔记总数",      
        "total_unreadprivate_note" => "未读私人笔记总数" ,       
        "total_readprivate_note" => "总阅读私人笔记",        
        "total_banned_ip" => "总禁止用户 IP",
        "logout" => "登出",
        "analysis" => "分析",
        "lifetime_notes" => "终身私人笔记",
        "thismonth_notes" => "本月私人笔记",
        "today_notes" => "今日私人笔记",
        "wrong_password" => "密码错误。再试一次。",
        "form_empty" => "所有字段均为必填项。再试一次。",
        "username_changed" => "管理员用户名已成功更改。",
        "change_admin_username" => "更改管理员用户名",
        "old_admin_username" => "旧管理员用户名",
        "new_admin_username" => "新管理员用户名",
        "change" => "改变",
        "old_admin_password" => "旧管理员密码",
        "new_admin_password" => "新的管理员密码",
        "min_password" => "密码必须包含至少 8 个字符、1 个大写字符、1 个小写字符和 1 个数字（示例 - Test1234）。",
        "change_admin_password" => "更改管理员密码",
        "password_changed" => "管理员密码更改成功。",
        "read" => "读",
        "unread" => "未读",
        "delete_note" => "删除笔记",
        "delete_note_with_ip" => "删除注释并阻止用户 IP",
        "view_note" => "查看注释",
        "yes" => "是的",
        "no" => "不",
        "serial_number" => "编号",
        "date" => "日期",
        "note_id" => "笔记编号",
        "note_unique_id" => "备注 唯一 ID",
        "user_ip" => "用户IP",
        "note" => "笔记",
        "password_protected" => "密码保护",
        "status" => "地位",
        "action" => "行动",
        "note_deleted" => "笔记已成功删除。",
        "note_deleted_with_ip" => "笔记已成功删除，用户IP已被屏蔽。",  
        "unblock_ip" => "取消阻止用户 IP 并从黑名单中删除。",
        "unblocked_ip" => "用户 IP 解锁并从黑名单中删除。",
        "blocked_msg" => "对不起 ！这个网站不适合你。"
    );  
    return $userlang[$txt];
}

?>