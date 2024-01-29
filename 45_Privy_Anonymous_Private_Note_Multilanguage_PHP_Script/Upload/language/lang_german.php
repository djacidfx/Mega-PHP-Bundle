<?php
function userlang($txt){
    static $userlang = array(
        "xlan" => "german",
        "self_destruct_text" => "Die private Notiz zerstört sich selbst, sobald der Link geöffnet wird.",
        "note_heading" => "Anonyme private Notiz",
        "note_heading_password" => "Anonyme private Notiz mit Passwort",
        "textarea_placeholder" => "Was ist Ihre private Notiz ... ?",
        "create_note_btn" => "Private Notiz erstellen",
        "create_note_with_password_btn" => "Private Notiz mit Passwort erstellen",
        "spam_msg" => "Spammer sind nicht erlaubt.",
        "empty_note_error" => "Private Notiz sollte nicht leer sein.",
        "empty_note_error_password" => "Private Notiz, Passwort & Passwort erneut eingeben sollten nicht leer sein.",
        "empty_note_password_error" => "Private Notiz & Passwort sollten nicht leer sein.",
        "note_password_error" => "Passwort ist falsch. Versuchen Sie es nochmal.",
        "password_error" => "Passwort und Passwort erneut eingeben stimmen nicht überein.",
        "note_heading_link" => "Anonymer privater Notiz-Link",
        "note_destroy_msg" => "Diese Notiz wurde vernichtet. Kopieren Sie es, bevor Sie das Fenster schließen oder die Sprache / den Modus ändern.",
        "create_pvt_note" => "Erstellen Sie Ihre private Notiz",
        "read_msg" => "Es scheint, dass die Notiz gelesen und zerstört wurde.",
        "password_heading" => "Passwort",
        "repassword_heading" => "Passwort erneut eingeben",
        "password_msg_heading" => "Private Note ist passwortverschlüsselt.",
        "enter_password" => "Geben Sie das Passwort ein und öffnen Sie die Notiz",
        "copyright_heading" => "Urheberrechte",
        "all_right_reserved" => "Alle Rechte vorbehalten.",
        "admin_login_heading" => "Anmeldung im Admin-Panel",
        "username" => "Nutzername",
        "admin_incorrectlogin_msg" => "Entweder falscher Benutzername oder Passwort. Versuchen Sie es nochmal.",
        "empty_admin_error" => "Der Admin-Benutzername / das Passwort dürfen nicht leer sein.",
        "login" => "Anmeldung",
        "notifications" => "Benachrichtigungen und Verknüpfungen",
        "view" => "Sicht",
        "total_private_note" => "Total private Notizen",      
        "total_unreadprivate_note" => "Gesamtzahl ungelesener privater Notizen" ,       
        "total_readprivate_note" => "Insgesamt gelesene private Notizen",        
        "total_banned_ip" => "Gesamte gesperrte Benutzer-IP",
        "logout" => "Ausloggen",
        "analysis" => "Analyse",
        "lifetime_notes" => "Lebenslange private Notizen",
        "thismonth_notes" => "Diesen Monat Private Notizen",
        "today_notes" => "Heute Private Notizen",
        "wrong_password" => "Passwort ist falsch. Versuchen Sie es nochmal.",
        "form_empty" => "Alle Felder sind Pflichtfelder. Versuchen Sie es nochmal.",
        "username_changed" => "Admin-Benutzername erfolgreich geändert.",
        "change_admin_username" => "Ändern Sie den Admin-Benutzernamen",
        "old_admin_username" => "Alter Admin-Benutzername",
        "new_admin_username" => "Neuer Admin-Benutzername",
        "change" => "Ändern",
        "old_admin_password" => "Altes Admin-Passwort",
        "new_admin_password" => "Neues Admin-Passwort",
        "min_password" => "Das Passwort muss mindestens 8 Zeichen enthalten, 1 Großbuchstabe, 1 Kleinbuchstabe und 1 Zahl (Beispiel - Test1234) .",
        "change_admin_password" => "Admin-Passwort ändern",
        "password_changed" => "Admin-Passwort erfolgreich geändert.",
        "read" => "Lesen",
        "unread" => "Ungelesen",
        "delete_note" => "Notiz löschen",
        "delete_note_with_ip" => "Löschen Sie die Notiz und blockieren Sie die Benutzer-IP",
        "view_note" => "Hinweis anzeigen",
        "yes" => "Ja",
        "no" => "Nein",
        "serial_number" => "S.Nr.",
        "date" => "Datum",
        "note_id" => "Hinweis-ID",
        "note_unique_id" => "Beachten Sie die eindeutige ID",
        "user_ip" => "Benutzer-IP",
        "note" => "Notiz",
        "password_protected" => "Passwortgeschützt",
        "status" => "Status",
        "action" => "Handlung",
        "note_deleted" => "Hinweis wurde erfolgreich gelöscht.",
        "note_deleted_with_ip" => "Hinweis wurde erfolgreich gelöscht und Benutzer-IP wurde gesperrt.",  
        "unblock_ip" => "Entsperren Sie die Benutzer-IP und löschen Sie sie von der Blacklist.",
        "unblocked_ip" => "Benutzer-IP entsperrt und von der Blacklist gelöscht.",
        "blocked_msg" => "Es tut uns leid ! Diese Website ist nichts für Sie."
    );  
    return $userlang[$txt];
}

?>