<?php
function userlang($txt){
    static $userlang = array(
        "xlan" => "japanese",
        "self_destruct_text" => "リンクが開かれると、プライベートzipノートは自己破壊します。",
        "note_heading" => "匿名のプライベートジップノート",
        "note_heading_password" => "パスワード付きの匿名のプライベートZipメモ",
        "textarea_placeholder" => "あなたのプライベートノートは何ですか...？",
        "create_note_btn" => "プライベートZipメモを作成する",
        "create_note_with_password_btn" => "パスワードでメモを作成する",
        "spam_msg" => "スパマーは許可されていません。",
        "empty_note_error" => "プライベートノートは空にしないでください。",
        "empty_note_error_password" => "プライベートノート、パスワードとパスワードの再入力は空にしないでください。",
        "empty_note_password_error" => "プライベートノートとパスワードは空にしないでください。",
        "note_password_error" => "パスワードが間違っています。再試行。",
        "password_error" => "パスワードとパスワードの再入力が一致しません。",
        "note_heading_link" => "匿名のプライベートジップノートリンク",
        "note_destroy_msg" => "このメモは破棄されました。ウィンドウを閉じる前、または言語/モードを変更する前に、ダウンロードしてコピーしてください。",
        "create_pvt_note" => "プライベートノートを作成する",
        "read_msg" => "メモがダウンロードされ、読み取られ、破棄されたようです。",
        "password_heading" => "パスワード",
        "repassword_heading" => "パスワードを再入力してください",
        "password_msg_heading" => "プライベートZipNoteはパスワードで暗号化されています。",
        "enter_password" => "パスワードを入力してメモを開く",
        "copyright_heading" => "著作権",
        "all_right_reserved" => "全著作権所有。",
        "admin_login_heading" => "管理パネルログイン",
        "username" => "ユーザー名",
        "admin_incorrectlogin_msg" => "ユーザー名またはパスワードが間違っています。再試行。",
        "empty_admin_error" => "管理者のユーザー名/パスワードは空にしないでください。",
        "login" => "ログイン",
        "notifications" => "通知とショートカット",
        "view" => "意見",
        "total_private_note" => "プライベートジップノートの合計",      
        "total_unreadprivate_note" => "未読のプライベートZipノートの合計",       
        "total_readprivate_note" => "合計読み取りZipプライベートノート",        
        "total_banned_ip" => "禁止されたユーザーIPの合計",
        "logout" => "ログアウト",
        "analysis" => "分析",
        "lifetime_notes" => "生涯プライベートジップノート",
        "thismonth_notes" => "今月のプライベートジップノート",
        "today_notes" => "今日のプライベートジップノート",
        "wrong_password" => "パスワードが間違っています。再試行。",
        "form_empty" => "すべてのフィールドは必須です。再試行。",
        "username_changed" => "管理者ユーザー名が正常に変更されました。",
        "change_admin_username" => "管理者ユーザー名の変更",
        "old_admin_username" => "古い管理者ユーザー名",
        "new_admin_username" => "新しい管理者ユーザー名",
        "change" => "変化する",
        "old_admin_password" => "古い管理者パスワード",
        "new_admin_password" => "新しい管理者パスワード",
        "min_password" => "パスワードには、8文字以上、大文字1文字、小文字1文字、数字1文字が含まれている必要があります（例-Test1234）。",
        "change_admin_password" => "管理者パスワードの変更",
        "password_changed" => "管理者パスワードが正常に変更されました。",
        "read" => "読む",
        "unread" => "未読",
        "delete_note" => "メモを削除",
        "delete_note_with_ip" => "メモを削除してユーザーIPをブロックする",
        "view_note" => "メモを見る",
        "yes" => "はい",
        "no" => "いいえ",
        "serial_number" => "S.No.",
        "date" => "日にち",
        "note_id" => "ノートID",
        "note_unique_id" => "一意のIDに注意してください",
        "user_ip" => "ユーザーIP",
        "note" => "ノート",
        "password_protected" => "守られたパスワード",
        "status" => "状態",
        "action" => "アクション", 
        "unblock_ip" => "ユーザーIPのブロックを解除し、ブラックリストから削除します。",
        "unblocked_ip" => "ユーザーIPのブロックが解除され、ブラックリストから削除されました。",
        "blocked_msg" => "ごめん ！このウェブサイトはあなたのためではありません。",
        "max_limit" => "最大制限-".ZIP_LIMIT." KB",
        "zip_limit" => "アップロードされたZipファイルが".ZIP_LIMIT."よりも大きいです。 KB。再試行。",
        "should_be_zip" => "アップロードされたファイルはzipではありません。 zipファイルをアップロードして再試行してください。",
        "zip" => "ZIPファイル",
        "download" => "Zipをダウンロード",
        "download_deleted" => "Zipが削除されました",
        "delete_temp_zip" => "すべての一時Zipファイルを削除する",
        "delete_temp_zip_success" => "すべてのTempZipファイルが正常に削除されました。",
        "note_deleted" => "Note＆Zipは正常に削除されました。",
        "note_deleted_with_ip" => "メモとZipは正常に削除され、ユーザーIPはブロックされています。"
    );  
    return $userlang[$txt];
}

?>