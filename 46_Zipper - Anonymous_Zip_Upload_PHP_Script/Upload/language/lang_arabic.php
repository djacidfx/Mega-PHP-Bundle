<?php
function userlang($txt){
    static $userlang = array(
        "xlan" => "arabic",
        "self_destruct_text" => "سيتم تدمير ملاحظة مضغوطة خاصة ذاتيًا بمجرد فتح الرابط.",
        "note_heading" => "ملاحظة مضغوطة خاصة مجهولة",
        "note_heading_password" => "ملاحظة مضغوطة خاصة مجهولة مع كلمة مرور",
        "textarea_placeholder" => "ما هي ملاحظتك الخاصة ...؟",
        "create_note_btn" => "إنشاء ملاحظة مضغوطة خاصة",
        "create_note_with_password_btn" => "قم بإنشاء ملاحظة مضغوطة خاصة بكلمة مرور",
        "spam_msg" => "غير مسموح بمرسل سبامر.",
        "empty_note_error" => "يجب ألا تكون الملاحظة الخاصة فارغة.",
        "empty_note_error_password" => "يجب ألا تكون الملاحظة الخاصة وكلمة المرور وإعادة كتابة كلمة المرور فارغة.",
        "empty_note_password_error" => "يجب ألا تكون الملاحظة الخاصة وكلمة المرور فارغة.",
        "note_password_error" => "كلمة السر خاطئة. حاول مرة أخري.",
        "password_error" => "كلمة المرور وإعادة كتابة كلمة المرور غير متطابقتين.",
        "note_heading_link" => "رابط ملاحظة مضغوط خاص مجهول",
        "note_destroy_msg" => "تم إتلاف هذه المذكرة. قم بتنزيله وانسخه قبل إغلاق النافذة أو تغيير اللغة / الوضع.",
        "create_pvt_note" => "قم بإنشاء ملاحظتك الخاصة",
        "read_msg" => "يبدو أنه تم تنزيلها وقراءتها وتدميرها.",
        "password_heading" => "كلمه السر",
        "repassword_heading" => "أعد إدخال كلمة السر",
        "password_msg_heading" => "ملاحظة Zip الخاصة مشفرة بكلمة مرور.",
        "enter_password" => "أدخل كلمة المرور وافتح ملاحظة",
        "copyright_heading" => "حقوق النشر",
        "all_right_reserved" => "كل الحقوق محفوظة.",
        "admin_login_heading" => "تسجيل الدخول إلى لوحة الإدارة",
        "username" => "اسم المستخدم",
        "admin_incorrectlogin_msg" => "إما اسم مستخدم أو كلمة مرور خاطئة. حاول مرة أخري.",
        "empty_admin_error" => "يجب ألا يكون اسم المستخدم / كلمة المرور الخاصين بالمسؤول فارغين.",
        "login" => "تسجيل الدخول",
        "notifications" => "الإخطارات والاختصارات",
        "view" => "رأي",
        "total_private_note" => "مجموع الملاحظات البريدية الخاصة",      
        "total_unreadprivate_note" => "إجمالي ملاحظات الرمز البريدي الخاصة غير المقروءة",       
        "total_readprivate_note" => "إجمالي قراءة الرمز البريدي الملاحظات الخاصة",        
        "total_banned_ip" => "إجمالي عنوان IP المستخدم المحظور",
        "logout" => "تسجيل خروج",
        "analysis" => "التحليلات",
        "lifetime_notes" => "ملاحظات مضغوطة خاصة مدى الحياة",
        "thismonth_notes" => "ملاحظات Zip الخاصة لهذا الشهر",
        "today_notes" => "اليوم ملاحظات Zip الخاصة",
        "wrong_password" => "كلمة السر خاطئة. حاول مرة أخري.",
        "form_empty" => "كل الحقول إلزامية. حاول مرة أخري.",
        "username_changed" => "تم تغيير اسم المستخدم الخاص بالمسؤول بنجاح.",
        "change_admin_username" => "تغيير اسم المستخدم المسؤول",
        "old_admin_username" => "اسم المستخدم المسؤول القديم",
        "new_admin_username" => "اسم مستخدم مسؤول جديد",
        "change" => "يتغيرون",
        "old_admin_password" => "كلمة مرور المسؤول القديمة",
        "new_admin_password" => "كلمة مرور المسؤول الجديدة",
        "min_password" => "يجب أن تحتوي كلمة المرور على 8 أحرف على الأقل ، وحرف كبير واحد ، وحرف صغير واحد ، ورقم واحد (مثال - Test1234).",
        "change_admin_password" => "تغيير كلمة مرور المسؤول",
        "password_changed" => "تم تغيير كلمة مرور المسؤول بنجاح.",
        "read" => "اقرأ",
        "unread" => "غير مقروء",
        "delete_note" => "حذف الملاحظة",
        "delete_note_with_ip" => "حذف الملاحظة وحظر عنوان IP الخاص بالمستخدم",
        "view_note" => "مشاهدة الملاحظة",
        "yes" => "نعم",
        "no" => "لا",
        "serial_number" => "S. لا.",
        "date" => "تاريخ",
        "note_id" => "معرف الملاحظة",
        "note_unique_id" => "لاحظ معرّف فريد",
        "user_ip" => "IP المستخدم",
        "note" => "ملحوظة",
        "password_protected" => "محمية بكلمة مرور",
        "status" => "حالة",
        "action" => "عمل",  
        "unblock_ip" => "قم بإلغاء حظر عنوان IP الخاص بالمستخدم وحذفه من القائمة السوداء.",
        "unblocked_ip" => "تم إلغاء حظر عنوان IP الخاص بالمستخدم وحذفه من القائمة السوداء.",
        "blocked_msg" => "آسف ! هذا الموقع ليس لك.",
        "max_limit" => "الحد الأقصى - ".ZIP_LIMIT." كيلو بايت",
        "zip_limit" => "الملف المضغوط الذي تم تحميله أكبر من ".ZIP_LIMIT." كيلو بايت. حاول مرة أخرى.",
        "should_be_zip" => "الملف الذي تم تحميله ليس مضغوطًا. يرجى تحميل ملف مضغوط وحاول مرة أخرى.",
        "zip" => "ملف مضغوط",
        "download" => "تنزيل Zip",
        "download_deleted" => "تم حذف الرمز البريدي",
        "delete_temp_zip" => "احذف جميع ملفات Temp Zip",
        "delete_temp_zip_success" => "تم حذف جميع ملفات Temp Zip بنجاح.",
        "note_deleted" => "تم حذف الملاحظات والرمز البريدي بنجاح.",
        "note_deleted_with_ip" => "تم حذف الملاحظة والرمز البريدي بنجاح وتم حظر المستخدم IP."
    );  
    return $userlang[$txt];
}

?>