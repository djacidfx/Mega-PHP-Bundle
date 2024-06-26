<?php
function userlang($txt){
    static $userlang = array(
        "xlan" => "kazakh",
        "self_destruct_text" => "Сілтеме ашылғаннан кейін жеке жазба өздігінен жойылады.",
        "note_heading" => "Анонимді жеке жазба",
        "note_heading_password" => "Құпия сөзбен анонимді жеке жазба",
        "textarea_placeholder" => "Сіздің жеке жазбаңыз қандай ...?",
        "create_note_btn" => "Жеке ескертпе жасау",
        "create_note_with_password_btn" => "Құпия сөзбен жеке жазба жасаңыз",
        "spam_msg" => "Спам жіберуге рұқсат етілмейді.",
        "empty_note_error" => "Жеке ескертпе бос болмауы керек.",
        "empty_note_error_password" => "Жеке ескертпе, Құпия сөз және Құпия сөзді қайта теру бос болмауы керек.",
        "empty_note_password_error" => "Жеке ескертпе мен құпия сөз бос болмауы керек.",
        "note_password_error" => "Құпия сөз қате. Қайтадан көріңіз.",
        "password_error" => "Құпия сөз және құпия сөзді қайта теру сәйкес келмейді.",
        "note_heading_link" => "Анонимді жеке ескертпе сілтемесі",
        "note_destroy_msg" => "Бұл жазба жойылды. Терезені жабу немесе тілді/режимді өзгерту алдында оны көшіріп алыңыз.",
        "create_pvt_note" => "Жеке жазбаңызды жасаңыз",
        "read_msg" => "Жазба оқылып, жойылған сияқты.",
        "password_heading" => "Құпия сөз",
        "repassword_heading" => "Құпия сөзін қайтадан теріңіз",
        "password_msg_heading" => "Жеке ескертпе құпия сөзбен шифрланған.",
        "enter_password" => "Құпия сөзді енгізіңіз және жазбаны ашыңыз",
        "copyright_heading" => "Авторлық құқық",
        "all_right_reserved" => "Барлық құқықтар сақталған.",
        "admin_login_heading" => "Әкімші тақтасына кіру",
        "username" => "Пайдаланушы аты",
        "admin_incorrectlogin_msg" => "Не қате пайдаланушы аты немесе құпия сөз. Қайтадан көріңіз.",
        "empty_admin_error" => "Әкімші пайдаланушы аты/пароль бос болмауы керек.",
        "login" => "Кіру",
        "notifications" => "Хабарландырулар және төте жолдар",
        "view" => "Көру",
        "total_private_note" => "Жалпы жеке жазбалар",      
        "total_unreadprivate_note" => "Жалпы оқылмаған жеке ескертпелер" ,       
        "total_readprivate_note" => "Жалпы оқылған жеке ескертпелер",        
        "total_banned_ip" => "Жалпы тыйым салынған пайдаланушы IP",
        "logout" => "Шығу",
        "analysis" => "Талдау",
        "lifetime_notes" => "Өмірлік жеке жазбалар",
        "thismonth_notes" => "Осы айдағы жеке жазбалар",
        "today_notes" => "Бүгінгі жеке жазбалар",
        "wrong_password" => "Құпия сөз қате. Қайтадан көріңіз.",
        "form_empty" => "Барлық өрістер міндетті болып табылады. Қайтадан көріңіз.",
        "username_changed" => "Әкімші пайдаланушы аты сәтті өзгертілді.",
        "change_admin_username" => "Әкімші пайдаланушы атын өзгерту",
        "old_admin_username" => "Ескі әкімші пайдаланушы аты",
        "new_admin_username" => "Жаңа әкімші пайдаланушы аты",
        "change" => "Өзгерту",
        "old_admin_password" => "Ескі әкімші құпия сөзі",
        "new_admin_password" => "Жаңа әкімші құпия сөзі",
        "min_password" => "Құпия сөз кем дегенде 8 таңбадан, 1 бас әріптен, 1 кіші әріптен және 1 саннан тұруы керек (Мысалы - Test1234).",
        "change_admin_password" => "Әкімші құпия сөзін өзгерту",
        "password_changed" => "Әкімші құпия сөзі сәтті өзгертілді.",
        "read" => "Оқыңыз",
        "unread" => "Оқылмаған",
        "delete_note" => "Жазбаны жою",
        "delete_note_with_ip" => "Ескертуді жою және пайдаланушы IP мекенжайын блоктау",
        "view_note" => "Жазбаны қарау",
        "yes" => "Иә",
        "no" => "Жоқ",
        "serial_number" => "С.Жоқ.",
        "date" => "Күн",
        "note_id" => "Ескертпе идентификаторы",
        "note_unique_id" => "Ескерту Бірегей идентификатор",
        "user_ip" => "Пайдаланушы IP",
        "note" => "Ескерту",
        "password_protected" => "Құпия сөзбен қорғалған",
        "status" => "Күй",
        "action" => "Әрекет",
        "note_deleted" => "Ескертпе сәтті жойылды.",
        "note_deleted_with_ip" => "Ескертпе сәтті жойылды және пайдаланушының IP мекенжайы бұғатталды.",  
        "unblock_ip" => "Пайдаланушы IP-ті блоктан шығару және қара тізімнен жою.",
        "unblocked_ip" => "Пайдаланушы IP блоктан шығарылды және қара тізімнен жойылды.",
        "blocked_msg" => "Кешіріңіз! Бұл веб-сайт сізге арналмаған."
    );  
    return $userlang[$txt];
}

?>