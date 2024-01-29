<?php
function userlang($txt){
    static $userlang = array(
        "xlan" => "russian",
        "self_destruct_text" => "Частная почтовая заметка самоуничтожится после открытия ссылки.",
        "note_heading" => "Анонимная личная заметка на почтовом индексе",
        "note_heading_password" => "Анонимная приватная заметка на почтовом индексе с паролем",
        "textarea_placeholder" => "Какая у тебя личная заметка...?",
        "create_note_btn" => "Создать личный почтовый индекс",
        "create_note_with_password_btn" => "Создать личную заметку Zip с паролем",
        "spam_msg" => "Спамер не допускается.",
        "empty_note_error" => "Необходимо указать личное примечание.",
        "empty_note_error_password" => "Укажите личное примечание, пароль и повторите ввод пароля.",
        "empty_note_password_error" => "Необходимо указать личное примечание и пароль.",
        "note_password_error" => "Неверный пароль. Попробуйте еще раз.",
        "password_error" => "Пароль и повторный ввод пароля не совпадают.",
        "note_heading_link" => "Ссылка на анонимную приватную заметку на почтовом индексе",
        "note_destroy_msg" => "Эта записка была уничтожена. Загрузите и скопируйте его перед закрытием окна или сменой языка/режима.",
        "create_pvt_note" => "Создайте свою личную заметку",
        "read_msg" => "Кажется, заметка была загружена, прочитана и уничтожена.",
        "password_heading" => "Пароль",
        "repassword_heading" => "Повторите ввод пароля",
        "password_msg_heading" => "Частная заметка Zip зашифрована паролем.",
        "enter_password" => "Введите пароль и откройте заметку",
        "copyright_heading" => "Авторские права",
        "all_right_reserved" => "Все права защищены.",
        "admin_login_heading" => "Вход в панель администратора",
        "username" => "Имя пользователя",
        "admin_incorrectlogin_msg" => "Либо неправильное имя пользователя, либо пароль. Попробуйте еще раз.",
        "empty_admin_error" => "Имя пользователя/пароль администратора не должно быть пустым.",
        "login" => "Авторизоваться",
        "notifications" => "Уведомления и ярлыки",
        "view" => "Вид",
        "total_private_note" => "Всего частных почтовых индексов",      
        "total_unreadprivate_note" => "Всего непрочитанных личных почтовых заметок",       
        "total_readprivate_note" => "Всего прочитано Zip личных заметок",        
        "total_banned_ip" => "Всего заблокированных IP-адресов пользователей",
        "logout" => "Выйти",
        "analysis" => "Анализ",
        "lifetime_notes" => "Пожизненные частные почтовые заметки",
        "thismonth_notes" => "Частные почтовые заметки этого месяца",
        "today_notes" => "Сегодня частные почтовые заметки",
        "wrong_password" => "Неверный пароль. Попробуйте еще раз.",
        "form_empty" => "Все поля обязательны для заполнения. Попробуйте еще раз.",
        "username_changed" => "Имя пользователя администратора успешно изменено.",
        "change_admin_username" => "Изменить имя администратора",
        "old_admin_username" => "Старое имя администратора",
        "new_admin_username" => "Новое имя администратора",
        "change" => "Сдача",
        "old_admin_password" => "Старый пароль администратора",
        "new_admin_password" => "Новый пароль администратора",
        "min_password" => "Пароль должен содержать не менее 8 символов, 1 символ в верхнем регистре, 1 символ в нижнем регистре и 1 цифру (пример — Test1234).",
        "change_admin_password" => "Изменить пароль администратора",
        "password_changed" => "Пароль администратора успешно изменен.",
        "read" => "Читать",
        "unread" => "Непрочитанный",
        "delete_note" => "Удалить примечание",
        "delete_note_with_ip" => "Удалить заметку и заблокировать IP-адрес пользователя",
        "view_note" => "Посмотреть примечание",
        "yes" => "Да",
        "no" => "Нет",
        "serial_number" => "С.№",
        "date" => "Дата",
        "note_id" => "Идентификатор заметки",
        "note_unique_id" => "Примечание Уникальный идентификатор",
        "user_ip" => "IP-адрес пользователя",
        "note" => "Примечание",
        "password_protected" => "Пароль защищен",
        "status" => "Статус",
        "action" => "Действие", 
        "unblock_ip" => "Разблокировать IP пользователя и удалить из черного списка.",
        "unblocked_ip" => "IP-адрес пользователя разблокирован и удален из черного списка.",
        "blocked_msg" => "Извини ! Этот сайт не для вас.",
        "max_limit" => "Максимальный лимит — ".ZIP_LIMIT." КБ",
        "zip_limit" => "Размер загруженного Zip-файла превышает ".ZIP_LIMIT." КБ. Попробуйте еще раз.",
        "should_be_zip" => "Загруженный файл не является zip. Загрузите ZIP-файл и повторите попытку.",
        "zip" => "Почтовый файл",
        "download" => "Скачать ZIP",
        "download_deleted" => "Почтовый индекс удален",
        "delete_temp_zip" => "Удалить все временные ZIP-файлы",
        "delete_temp_zip_success" => "Все временные Zip-файлы успешно удалены.",
        "note_deleted" => "Note & Zip успешно удалены.",
        "note_deleted_with_ip" => "Note и Zip успешно удалены, а IP-адрес пользователя заблокирован."
    );  
    return $userlang[$txt];
}

?>