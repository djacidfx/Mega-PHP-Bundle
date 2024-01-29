<?php
switch ($_SESSION['lang']) {
case 'english':
	include_once "lang_english.php";
	break;
case 'arabic':
	include_once "lang_arabic.php";
	break;
case 'afrikaans':
	include_once "lang_afrikaans.php";
	break;
case 'chinesesimplified':
	include_once "lang_chinesesimplified.php";
	break;
case 'chinesetraditional':
	include_once "lang_chinesetraditional.php";
	break;
case 'croatian':
	include_once "lang_croatian.php";
	break;
case 'czech':
	include_once "lang_czech.php";
	break;
case 'french':
	include_once "lang_french.php";
	break;
case 'german':
	include_once "lang_german.php";
	break;
case 'hindi':
	include_once "lang_hindi.php";
	break;
case 'dutch':
	include_once "lang_dutch.php";
	break;
case 'italian':
	include_once "lang_italian.php";
	break;
case 'japanese':
	include_once "lang_japanese.php";
	break;
case 'korean':
	include_once "lang_korean.php";
	break;
case 'kazakh':
	include_once "lang_kazakh.php";
	break;
case 'nepali':
	include_once "lang_nepali.php";
	break;
case 'polish':
	include_once "lang_polish.php";
	break;
case 'portuguese':
	include_once "lang_portuguese.php";
	break;
case 'russian':
	include_once "lang_russian.php";
	break;
case 'spanish':
	include_once "lang_spanish.php";
	break;
case 'swedish':
	include_once "lang_swedish.php";
	break;
case 'thai':
	include_once "lang_thai.php";
	break;
case 'turkish':
	include_once "lang_turkish.php";
	break;
case 'ukrainian':
	include_once "lang_ukrainian.php";
	break;
case 'urdu':
	include_once "lang_urdu.php";
	break;
case 'vietnamese':
	include_once "lang_vietnamese.php";
	break;
default:
	$_SESSION['lang'] = DEFAULT_LANGUAGE;
	include_once "lang_".DEFAULT_LANGUAGE.".php";
	break;
}
?>
