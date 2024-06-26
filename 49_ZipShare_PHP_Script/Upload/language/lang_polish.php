<?php
function userlang($txt){
    static $userlang = array(
        "xlan" => "polish",
        "total_zip_files" => "Całkowita liczba plików ZIP",      
        "total_active_zip_files" => "Całkowita liczba aktywnych plików ZIP" ,       
        "total_pending_zip_files" => "Całkowita liczba oczekujących plików ZIP",  
        "total_category" => "Całkowita kategoria",      
        "total_active_category" => "Całkowita aktywna kategoria" ,       
        "total_active_blog" => "Aktywne blogi łącznie" ,       
        "total_active_page" => "Aktywne strony łącznie" ,       
        "total_disable_category" => "Całkowita kategoria dezaktywacji",
        "total_disable_blog" => "Wszystkich dezaktywowanych blogów",
        "total_disable_page" => "Wszystkie strony nieaktywne",
        "sitemap" => "Mapa strony",
        "quick_link" => "Szybkie linki",
        "save" => "Ratować",
        "latest_blog" => "Najnowsze blogi",
        "blogs" => "Blogi",
        "about_us" => "O nas",
        "setting_saved" => "Ustawienie zostało pomyślnie zmienione.",
        "ad_setting" => "Ustawienia reklam",
        "ad_javascript" => "Wklej kod reklamy JavaScript Google — 300 x 250 pikseli",
        "analytic_javascript" => "Wklej kod analityczny Google Javascript",
        "ad_javascript_on" => "Włącz reklamę",
        "analytic_javascript_on" => "Włącz Google Analytics",
        "analytic_setting" => "Ustawienia analityczne",
        "max_char" => "Maksymalnie 200 znaków",
        "autoapprove_on" => "Automatyczne zatwierdzanie pliku zip",
        "main_setting" => "Ustawienie główne",
        "show_default_limit" => "Domyślny limit",
        "show_loadmore_limit" => "Załaduj więcej limitu",
        "upload_zip" => "Prześlij zip",
        "unlock_zip" => "Odblokuj zip",
        "make" => "Robić",
        "featured" => "Wyróżniony",
        "featured_zip" => "Zip jest teraz polecany, ale niepopularny.",
        "unfeatured" => "Niepolecane",
        "unfeatured_zip" => "Zip nie jest teraz polecany.",
        "popular" => "Popularny",
        "popular_zip" => "Zip jest teraz popularny, ale nie polecany.",
        "unpopular_zip" => "Zip jest teraz niepopularny.",
        "unpopular" => "Niepopularny",
        "zip_deleted" => "Zip został pomyślnie usunięty.",
        "delete_zip" => "Usuń zip",
        "delete_zip_with_ip" => "Usuń zip i zablokuj adres IP użytkownika",
        "zip_deleted_with_ip" => "Zip został usunięty, a użytkownik jest teraz zablokowany.",
        "view_all" => "Pokaż wszystkie",
        "sponsored" => "Sponsorowane",
        "zip_files" => "Pliki ZIP",
        "upload_zip_file" => "Prześlij anonimowy plik zip",
        "zip_title" => "Tytuł zip",
        "edit" => "Edytować",
        "delete" => "Usuwać",
        "category" => "Kategoria",
        "category_create" => "Utwórz kategorię",
        "duplicate_category_name" => "Nazwa kategorii musi być unikalna. Spróbuj ponownie.",
        "category_add" => "Dodaj kategorię",
        "category_edit" => "Edytuj kategorię",
        "category_deactivated" => "Kategoria & Wszystkie pliki zip należące do tej kategorii zostały wyłączone.",
        "category_activated" => "Kategoria i wszystkie pliki zip należące do tej kategorii zostały aktywowane.",
        "category_zip_deleted" => "Kategoria i wszystkie pliki ZIP należące do tej kategorii zostały usunięte.",
        "category_id" => "Identyfikator kategorii",
        "name" => "Nazwa",
        "activate" => "Aktywuj",
        "deactivate" => "Dezaktywować",
        "approve" => "Zatwierdzić",
        "approve_zip" => "Plik zip został zatwierdzony i dostępny.",
        "zip" => "Plik zip",
        "zip_title_unique" => "Tytuł zip musi być unikalny",
        "zipdescription" => "Opis (opcjonalnie )",
        "spam_msg" => "Spamer nie jest dozwolony.",
        "zip_title_error" => "Tytuł zipmusi być niepowtarzalny. Spróbuj ponownie, podając inną nazwę.",
        "category_error" => "Kategoria nie powinna być pusta. Spróbuj ponownie.",
        "zip_review" => "Plik ZIP został pomyślnie przesłany i oczekuje na sprawdzenie.",
        "download" => "Ściągnij",
        "description" => "Opis zip",
        "share_fb" => "Udostępnij na Facebooku",
        "share_tw" => "Podziel się na Twitterze",
        "share_ld" => "Udostępnij na Linkedin",
        "share_wp" => "Udostępnij na Whatsapp",
        "choose_category" => "Wybierz kategorię",
        "max_limit" => "Maksymalny limit — ".ZIP_LIMIT." KB",
        "blog_max_limit" => "Maksymalny limit — ".BLOG_IMAGE_LIMIT." KB — 1600 x 800 pikseli",
        "zip_limit" => "Przesłany plik ZIP jest większy niż ".ZIP_LIMIT." KB. Spróbuj ponownie.",
        "img_limit" => "Przesłany plik obrazu jest większy niż ".BLOG_IMAGE_LIMIT." KB. Spróbuj ponownie.",
        "img_dimension" => "Przesłany plik obrazu powinien mieć dokładnie 1600 x 800 pikseli. Spróbuj ponownie.",
        "should_be_zip" => "Przesłany plik nie jest skompresowany. Prześlij plik zip i spróbuj ponownie.",
        "should_be_image" => "Przesłany plik nie jest obrazem. Prześlij obraz png, jpg lub jpeg i spróbuj ponownie.",
        "load_more" => "Załaduj więcej",
        "search" => "Wyszukaj anonimowe pliki ZIP...",
        "no_search_found" => "Nie znaleźliśmy niczego z Twoim wyszukiwanym hasłem. Wypróbuj z różnymi słowami kluczowymi.",
        "blog_image" => "Obraz bloga",
        "pages" => "Strony",
        "singlepage" => "Strona",
        "blog" => "Blogi",
        "singleblog" => "Blog",
        "create_page" => "Stwórz stronę",
        "edit_page" => "Edytuj stronę",
        "active_page" => "Aktywne strony",
        "page_id" => "Identyfikator strony",
        "deactive_page" => "Strony nieaktywne",
        "page_activated" => "Strona została pomyślnie aktywowana i jest teraz dostępna.",
        "page_deactivated" => "Strona została pomyślnie dezaktywowana i ukryta.",
        "page_deleted" => "Strona została pomyślnie usunięta.",
        "create_blog" => "Utwórz bloga",
        "edit_blog" => "Edytuj bloga",
        "click_old_image" => "Kliknij na obrazek, by go powiększyć",
        "active_blog" => "Aktywne blogi",
        "deactive_blog" => "Nieaktywne blogi",
        "blog_id" => "Identyfikator bloga",
        "blog_name" => "Tytuł bloga",
        "blog_activated" => "Blog został pomyślnie aktywowany i dostępny.",
        "blog_deactivated" => "Blog został pomyślnie dezaktywowany i ukryty.",
        "blog_deleted" => "Blog został pomyślnie usunięty.",
        "blog_name_unique" => "(Tytuł bloga musi być unikalny i zawierać maksymalnie 100 znaków)",
        "blog_description" => "Opis bloga",
        "blog_short_description" => "Krótki opis bloga (maksymalnie 200 znaków - poprawia SEO)",
        "page_name" => "Nazwa strony",
        "page_description" => "Opis strony",
        "page_name_unique" => "(Nazwa strony musi być unikalna i zawierać maksymalnie 25 znaków)",
        "duplicate_page_name" => "Nazwa strony musi być niepowtarzalna. Spróbuj ponownie.",
        "duplicate_blog_name" => "Tytuł bloga musi być niepowtarzalny. Spróbuj ponownie.",
        "page_published" => "Strona została utworzona i opublikowana. Możesz znaleźć w Aktywnych stronach.",
        "page_edited" => "Strona została pomyślnie edytowana.",
        "blog_published" => "Blog został utworzony i opublikowany. Możesz znaleźć w Aktywnych Blogach.",
        "blog_edited" => "Blog został pomyślnie edytowany.",
        "empty_page_field" => "Pola strony nie mogą być puste. Spróbuj ponownie.",
        "zip_id" => "Zip Id",
        "active" => "Aktywny",
        "pending" => "W oczekiwaniu",
        "copyright_name" => "Nazwa praw autorskich",
        "password" => "Hasło",
        "self_destruct_text" => "Prywatna notatka ulegnie samozniszczeniu po otwarciu łącza.",
        "note_heading" => "Anonimowa prywatna notatka",
        "note_heading_password" => "Anonimowa prywatna notatka z hasłem",
        "textarea_placeholder" => "Jaka jest twoja prywatna notatka...?",
        "create_note_btn" => "Utwórz prywatną notatkę",
        "create_note_with_password_btn" => "Utwórz prywatną notatkę z hasłem",
        "spam_msg" => "Spamer nie jest dozwolony.",
        "empty_note_error" => "Notatka prywatna nie powinna być pusta.",
        "empty_note_error_password" => "Notatka prywatna, hasło i ponowne wpisanie hasła nie powinny być puste.",
        "empty_note_password_error" => "Prywatna notatka i hasło nie powinny być puste.",
        "note_password_error" => "Hasło jest nieprawidłowe. Spróbuj ponownie.",
        "password_error" => "Hasło i hasło ponownie wpisz nie pasują.",
        "note_heading_link" => "Anonimowy link do prywatnej notatki",
        "note_destroy_msg" => "Ta notatka została zniszczona. Skopiuj go przed zamknięciem okna lub zmianą języka / trybu.",
        "create_pvt_note" => "Utwórz swoją prywatną notatkę",
        "read_msg" => "Wygląda na to, że notatka została przeczytana i zniszczona.",
        "password_heading" => "Hasło",
        "repassword_heading" => "Wpisz ponownie hasło",
        "password_msg_heading" => "Prywatna notatka jest zaszyfrowana hasłem.",
        "enter_password" => "Wprowadź hasło i otwórz notatkę",
        "copyright_heading" => "prawa autorskie",
        "all_right_reserved" => "Wszelkie prawa zastrzeżone.",
        "admin_login_heading" => "Logowanie do panelu administracyjnego",
        "username" => "Nazwa użytkownika",
        "admin_incorrectlogin_msg" => "Albo nieprawidłowa nazwa użytkownika lub hasło. Spróbuj ponownie.",
        "empty_admin_error" => "Nazwa użytkownika/hasło administratora nie może być puste.",
        "login" => "Zaloguj sie",
        "notifications" => "Powiadomienia i skróty",
        "view" => "Pogląd",
        "total_private_note" => "Wszystkie prywatne notatki",      
        "total_unreadprivate_note" => "Całkowita liczba nieprzeczytanych prywatnych notatek" ,       
        "total_readprivate_note" => "Całkowite przeczytanie prywatnych notatek",        
        "total_banned_ip" => "Całkowity adres IP zbanowanego użytkownika",
        "logout" => "Wyloguj",
        "analysis" => "Analiza",
        "lifetime_notes" => "Dożywotnie prywatne notatki",
        "thismonth_notes" => "Notatki prywatne w tym miesiącu",
        "today_notes" => "Dzisiaj prywatne notatki",
        "wrong_password" => "Hasło jest nieprawidłowe. Spróbuj ponownie.",
        "form_empty" => "Wszystkie pola są obowiązkowe. Spróbuj ponownie.",
        "username_changed" => "Pomyślnie zmieniono nazwę użytkownika administratora.",
        "change_admin_username" => "Zmień nazwę użytkownika administratora",
        "old_admin_username" => "Stara nazwa użytkownika administratora",
        "new_admin_username" => "Nowa nazwa użytkownika administratora",
        "change" => "Zmiana",
        "old_admin_password" => "Stare hasło administratora",
        "new_admin_password" => "Nowe hasło administratora",
        "min_password" => "Hasło musi zawierać minimum 8 znaków, 1 wielką literę, 1 małą literę i 1 cyfrę (Przykład - Test1234) .",
        "change_admin_password" => "Zmień hasło administratora",
        "password_changed" => "Hasło administratora zostało pomyślnie zmienione.",
        "read" => "Czytać",
        "unread" => "nieprzeczytane",
        "delete_note" => "Usuń notatkę",
        "delete_note_with_ip" => "Usuń notatkę i zablokuj adres IP użytkownika",
        "view_note" => "Zobacz notatkę",
        "yes" => "tak",
        "no" => "Nie",
        "serial_number" => "Nr S",
        "date" => "Data",
        "note_id" => "Identyfikator notatki",
        "note_unique_id" => "Uwaga Unikalny identyfikator",
        "user_ip" => "IP użytkownika",
        "note" => "Notatka",
        "password_protected" => "Hasło chronione",
        "status" => "Status",
        "action" => "Akcja",
        "note_deleted" => "Notatka została pomyślnie usunięta.",
        "note_deleted_with_ip" => "Notatka została pomyślnie usunięta, a adres IP użytkownika został zablokowany.",  
        "unblock_ip" => "Odblokuj adres IP użytkownika i usuń z czarnej listy.",
        "unblocked_ip" => "IP użytkownika odblokowane i usunięte z czarnej listy.",
        "blocked_msg" => "Przepraszam ! Ta strona nie jest dla Ciebie."
    );  
    return $userlang[$txt];
}

?>