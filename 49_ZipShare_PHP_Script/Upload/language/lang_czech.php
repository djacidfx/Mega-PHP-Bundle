<?php
function userlang($txt){
    static $userlang = array(
        "xlan" => "czech",
        "total_zip_files" => "Celkový počet souborů ZIP",      
        "total_active_zip_files" => "Celkový počet aktivních souborů ZIP" ,       
        "total_pending_zip_files" => "Celkový počet nevyřízených souborů ZIP",  
        "total_category" => "Celková kategorie",      
        "total_active_category" => "Celkem aktivní kategorie" ,       
        "total_active_blog" => "Celkem aktivních blogů" ,       
        "total_active_page" => "Celkový počet aktivních stránek" ,       
        "total_disable_category" => "Celkem deaktivní kategorie",
        "total_disable_blog" => "Celkem deaktivní blogy",
        "total_disable_page" => "Celkem neaktivních stránek",
        "sitemap" => "Sitemap",
        "quick_link" => "Rychlé odkazy",
        "save" => "Uložit",
        "latest_blog" => "Nejnovější blogy",
        "blogs" => "Blogy",
        "about_us" => "O nás",
        "setting_saved" => "Nastavení bylo úspěšně změněno.",
        "ad_setting" => "Nastavení reklam",
        "ad_javascript" => "Vložte kód reklamy Google Javascript – 300 x 250 pixelů",
        "analytic_javascript" => "Vložte analytický kód Google Javascript",
        "ad_javascript_on" => "Zapnout reklamu",
        "analytic_javascript_on" => "Zapněte Google Analytics",
        "analytic_setting" => "Analytické nastavení",
        "max_char" => "Maximálně 200 znaků",
        "autoapprove_on" => "Automatické schválení souboru zip",
        "main_setting" => "Hlavní nastavení",
        "show_default_limit" => "Výchozí limit",
        "show_loadmore_limit" => "zatížení více limit",
        "upload_zip" => "Nahrát zip",
        "unlock_zip" => "Odemkněte Zip",
        "make" => "Udělat",
        "featured" => "Nejlepší",
        "featured_zip" => "Zip je doporučený, ale nyní neoblíbený.",
        "unfeatured" => "Bez funkce",
        "unfeatured_zip" => "Zip je nyní bez funkce.",
        "popular" => "Populární",
        "popular_zip" => "Zip je populární, ale nyní není k dispozici.",
        "unpopular_zip" => "Zip je nyní neoblíbený.",
        "unpopular" => "Nepopulární",
        "zip_deleted" => "Zip byl úspěšně smazán.",
        "delete_zip" => "Smazat Zip",
        "delete_zip_with_ip" => "Smazat zip a blokovat IP uživatele",
        "zip_deleted_with_ip" => "Zip je smazán a uživatel je nyní zablokován.",
        "view_all" => "Zobrazit vše",
        "sponsored" => "Sponzorováno",
        "zip_files" => "Soubory zip",
        "upload_zip_file" => "Nahrajte anonymní soubor ZIP",
        "zip_title" => "Název zip",
        "edit" => "Upravit",
        "delete" => "Vymazat",
        "category" => "Kategorie",
        "category_create" => "Vytvořit kategorii",
        "duplicate_category_name" => "Název kategorie musí být jedinečný. Zkus to znovu.",
        "category_add" => "Přidat kategorii",
        "category_edit" => "Upravit kategorii",
        "category_deactivated" => "Kategorie & Všechny soubory zip patřící do této kategorie byly deaktivovány.",
        "category_activated" => "Kategorie & Všechny soubory zip patřící do této kategorie byly aktivovány.",
        "category_zip_deleted" => "Kategorie & Všechny soubory zip patřící do této kategorie byly smazány.",
        "category_id" => "ID kategorie",
        "name" => "název",
        "activate" => "aktivovat",
        "deactivate" => "Deaktivovat",
        "approve" => "Schválit",
        "approve_zip" => "Soubor ZIP byl schválen a aktivní.",
        "zip" => "Soubor zip",
        "zip_title_unique" => "Název zip musí být jedinečný",
        "zipdescription" => "Popis (Dobrovolný )",
        "spam_msg" => "Spammer není povolen.",
        "zip_title_error" => "Název zip musí být jedinečný. Zkuste to znovu s jiným jménem.",
        "category_error" => "Kategorie by neměla být prázdná. Zkus to znovu.",
        "zip_review" => "Soubor ZIP byl úspěšně nahrán a čeká na kontrolu.",
        "download" => "Stažení",
        "description" => "Popis zipu",
        "share_fb" => "Sdílet na Facebooku",
        "share_tw" => "Sdílejte na Twitteru",
        "share_ld" => "Sdílet na Linkedin",
        "share_wp" => "Sdílejte na Whatsapp",
        "choose_category" => "Vyberte kategorii",
        "max_limit" => "Maximální limit – ".ZIP_LIMIT." KB",
        "blog_max_limit" => "Maximální limit – ".BLOG_IMAGE_LIMIT." KB – 1600 x 800 pixelů",
        "zip_limit" => "Nahraný soubor ZIP je větší než ".ZIP_LIMIT." KB. Zkus to znovu.",
        "img_limit" => "Nahraný soubor obrázku je větší než ".BLOG_IMAGE_LIMIT." KB. Zkus to znovu.",
        "img_dimension" => "Nahraný soubor obrázku by měl mít přesně 1600 x 800 pixelů. Zkus to znovu.",
        "should_be_zip" => "Nahraný soubor není zip. Nahrajte prosím soubor zip a zkuste to znovu.",
        "should_be_image" => "Nahraný soubor není obrázek. Nahrajte obrázek ve formátu png, jpg nebo jpeg a zkuste to znovu.",
        "load_more" => "Načíst další",
        "search" => "Prohledat anonymní soubory ZIP...",
        "no_search_found" => "Nenašli jsme nic s vaším hledaným výrazem. Zkuste použít různá klíčová slova.",
        "blog_image" => "Obrázek blogu",
        "pages" => "Stránky",
        "singlepage" => "Strana",
        "blog" => "Blogy",
        "singleblog" => "Blog",
        "create_page" => "Vytvořit stránku",
        "edit_page" => "Upravit stránku",
        "active_page" => "Aktivní stránky",
        "page_id" => "ID stránky",
        "deactive_page" => "Deaktivní stránky",
        "page_activated" => "Stránka byla úspěšně aktivována a nyní je aktivní.",
        "page_deactivated" => "Stránka byla nyní úspěšně deaktivována a skryta.",
        "page_deleted" => "Stránka byla úspěšně smazána.",
        "create_blog" => "Vytvořit blog",
        "edit_blog" => "Upravit blog",
        "click_old_image" => "Kliknutím na obrázek přiblížíte",
        "active_blog" => "Aktivní blogy",
        "deactive_blog" => "Deaktivní blogy",
        "blog_id" => "ID blogu",
        "blog_name" => "Název blogu",
        "blog_activated" => "Blog byl úspěšně aktivován a nyní je aktivní.",
        "blog_deactivated" => "Blog byl nyní úspěšně deaktivován a skrytý.",
        "blog_deleted" => "Blog byl úspěšně smazán.",
        "blog_name_unique" => "(Název blogu musí být jedinečný a max. 100 znaků)",
        "blog_description" => "Popis blogu",
        "blog_short_description" => "Krátký popis blogu (max. 200 znaků – zvyšuje SEO)",
        "page_name" => "Název stránky",
        "page_description" => "Popis stránky",
        "page_name_unique" => "(Název stránky musí být jedinečný a max. 25 znaků)",
        "duplicate_page_name" => "Název stránky musí být jedinečný. Zkus to znovu.",
        "duplicate_blog_name" => "Název blogu musí být jedinečný. Zkus to znovu.",
        "page_published" => "Stránka je vytvořena a publikována. Najdete v Active Pages.",
        "page_edited" => "Stránka byla úspěšně upravena.",
        "blog_published" => "Blog je vytvořen a publikován. Najdete v Aktivní blogy.",
        "blog_edited" => "Blog byl úspěšně upraven.",
        "empty_page_field" => "Pole stránky nesmí být prázdné. Zkus to znovu.",
        "zip_id" => "PSČ",
        "active" => "Aktivní",
        "pending" => "čekající",
        "copyright_name" => "Copyright Name",
        "password" => "Heslo",
        "self_destruct_text" => "Soukromá poznámka se po otevření odkazu sama zničí.",
        "note_heading" => "Anonymní soukromá poznámka",
        "note_heading_password" => "Anonymní soukromá poznámka s heslem",
        "textarea_placeholder" => "Jaká je vaše soukromá poznámka...?",
        "create_note_btn" => "Vytvořit soukromou poznámku",
        "create_note_with_password_btn" => "Vytvořte soukromou poznámku s heslem",
        "spam_msg" => "Spammer není povolen.",
        "empty_note_error" => "Soukromá poznámka by neměla být prázdná.",
        "empty_note_error_password" => "Soukromá poznámka, heslo a heslo znovu zadejte nesmí být prázdné.",
        "empty_note_password_error" => "Soukromá poznámka a heslo by nemělo být prázdné.",
        "note_password_error" => "Heslo je špatné. Zkus to znovu.",
        "password_error" => "Heslo a znovu zadejte heslo se neshodují.",
        "note_heading_link" => "Anonymní odkaz na soukromou poznámku",
        "note_destroy_msg" => "Tato poznámka byla zničena. Před zavřením okna nebo změnou jazyka/režimu jej zkopírujte.",
        "create_pvt_note" => "Vytvořte si soukromou poznámku",
        "read_msg" => "Zdá se, že poznámka byla přečtena a zničena.",
        "password_heading" => "Heslo",
        "repassword_heading" => "Zadejte heslo znovu",
        "password_msg_heading" => "Soukromá poznámka je zašifrována heslem.",
        "enter_password" => "Zadejte heslo a otevřete poznámku",
        "copyright_heading" => "autorská práva",
        "all_right_reserved" => "Všechna práva vyhrazena.",
        "admin_login_heading" => "Přihlášení do panelu administrátora",
        "username" => "uživatelské jméno",
        "admin_incorrectlogin_msg" => "Buď špatné uživatelské jméno nebo heslo. Zkus to znovu.",
        "empty_admin_error" => "Uživatelské jméno / heslo správce by nemělo být prázdné.",
        "login" => "Přihlásit se",
        "notifications" => "Upozornění a zkratky",
        "view" => "Pohled",
        "total_private_note" => "Celkem soukromých poznámek",      
        "total_unreadprivate_note" => "Celkový počet nepřečtených soukromých poznámek" ,       
        "total_readprivate_note" => "Celkem přečtené soukromé poznámky",        
        "total_banned_ip" => "Celková IP adresa zakázaného uživatele",
        "logout" => "Odhlásit se",
        "analysis" => "Analýza",
        "lifetime_notes" => "Doživotní soukromé poznámky",
        "thismonth_notes" => "Tento měsíc Soukromé poznámky",
        "today_notes" => "Dnes soukromé poznámky",
        "wrong_password" => "Heslo je špatné. Zkus to znovu.",
        "form_empty" => "Všechna pole jsou povinná. Zkus to znovu.",
        "username_changed" => "Uživatelské jméno správce úspěšně změněno.",
        "change_admin_username" => "Změnit uživatelské jméno správce",
        "old_admin_username" => "Staré uživatelské jméno správce",
        "new_admin_username" => "Nové uživatelské jméno správce",
        "change" => "Změna",
        "old_admin_password" => "Staré heslo správce",
        "new_admin_password" => "Nové heslo správce",
        "min_password" => "Heslo musí obsahovat minimálně 8 znaků, 1 velké písmeno, 1 malé písmeno a 1 číslo (příklad - Test1234) .",
        "change_admin_password" => "Změnit heslo správce",
        "password_changed" => "Heslo správce úspěšně změněno.",
        "read" => "Číst",
        "unread" => "Nepřečtený",
        "delete_note" => "Smazat poznámku",
        "delete_note_with_ip" => "Smazat poznámku a blokovat IP uživatele",
        "view_note" => "Zobrazit poznámku",
        "yes" => "Ano",
        "no" => "Ne",
        "serial_number" => "č.v.",
        "date" => "datum",
        "note_id" => "ID poznámky",
        "note_unique_id" => "Poznámka Jedinečné ID",
        "user_ip" => "IP uživatele",
        "note" => "Poznámka",
        "password_protected" => "Chráněno heslem",
        "status" => "Postavení",
        "action" => "Akce",
        "note_deleted" => "Poznámka byla úspěšně smazána.",
        "note_deleted_with_ip" => "Poznámka byla úspěšně smazána a IP uživatele byla zablokována.",  
        "unblock_ip" => "Odblokujte IP uživatele a odstraňte z černé listiny.",
        "unblocked_ip" => "IP uživatele odblokována a odstraněna z černé listiny.",
        "blocked_msg" => "Promiňte ! Tento web není pro vás."
    );  
    return $userlang[$txt];
}

?>