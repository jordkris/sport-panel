<?php
$id   = isset($_GET['id']) ? $_GET['id'] : null;
$q    = isset($_GET['q']) ? $_GET['q'] : null;
$v    = isset($_GET['v']) ? $_GET['v'] : null;
$do    = isset($_GET['do']) ? $_GET['do'] : null;

$page = isset($_GET['page']) ? $_GET['page'] : null;
$hostname	= $_SERVER['HTTP_HOST'];
$homeurl	= "https://$hostname";
$useragent	= $_SERVER['HTTP_USER_AGENT'];
$refferer	= $_SERVER['HTTP_REFERER'];
$path		= $_SERVER['REQUEST_URI'];
class _Ocim
{
	function canonical($seo = true, $base_url = false)
	{
		$s = empty($_SERVER["HTTPS"]) ? '' : (($_SERVER["HTTPS"] == "on") ? "s" : "");
		$sp = strtolower($_SERVER["SERVER_PROTOCOL"]);
		$protocol = substr($sp, 0, strpos($sp, "/")) . $s;
		$port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":" . $_SERVER["SERVER_PORT"]);

		if ($base_url) {
			return $protocol . "://" . $_SERVER['SERVER_NAME'] . $port . "/spoart-batu/";
		}

		if (!$seo) {
			$url = $protocol . "://" . $_SERVER['SERVER_NAME'] . $port . "/spoart-batu/" . $_SERVER['SCRIPT_NAME'];
			$url .= ($_SERVER['QUERY_STRING'] != '') ? '?' . $_SERVER['QUERY_STRING'] : '';
			return rtrim($url, "?&");
		}
		return $protocol . "://" . $_SERVER['SERVER_NAME'] . $port . "/spoart-batu/" . $_SERVER['REQUEST_URI'];
	}

	function home_url()
	{
		return $this->canonical(false, true);
	}
	function is_home()
	{
		$host = $this->home_url() . '/';
		if ($this->canonical == $host) {
			return true;
		} else {
			return false;
		}
	}
	function get_domain($url)
	{
		$pieces = parse_url($url);
		$domain = isset($pieces['host']) ? $pieces['host'] : '';
		if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
			return $regs['domain'];
		}
		return false;
	}
	function permalink($str, $delimiter = '-', $options = array())
	{
		// Make sure string is in UTF-8 and strip invalid UTF-8 characters
		$str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());

		$defaults = array(
			'delimiter' =>  $delimiter,
			'limit' => null,
			'lowercase' => true,
			'replacements' => array(),
			'transliterate' => true,
		);

		// Merge options
		$options = array_merge($defaults, $options);

		$char_map = array(
			// Latin
			'�' => 'A', '�' => 'A', '�' => 'A', '�' => 'A', '�' => 'A', '�' => 'A', '�' => 'AE', '�' => 'C',
			'�' => 'E', '�' => 'E', '�' => 'E', '�' => 'E', '�' => 'I', '�' => 'I', '�' => 'I', '�' => 'I',
			'�' => 'D', '�' => 'N', '�' => 'O', '�' => 'O', '�' => 'O', '�' => 'O', '�' => 'O', '&#336;' => 'O',
			'�' => 'O', '�' => 'U', '�' => 'U', '�' => 'U', '�' => 'U', '&#368;' => 'U', '�' => 'Y', '�' => 'TH',
			'�' => 'ss',
			'�' => 'a', '�' => 'a', '�' => 'a', '�' => 'a', '�' => 'a', '�' => 'a', '�' => 'ae', '�' => 'c',
			'�' => 'e', '�' => 'e', '�' => 'e', '�' => 'e', '�' => 'i', '�' => 'i', '�' => 'i', '�' => 'i',
			'�' => 'd', '�' => 'n', '�' => 'o', '�' => 'o', '�' => 'o', '�' => 'o', '�' => 'o', '&#337;' => 'o',
			'�' => 'o', '�' => 'u', '�' => 'u', '�' => 'u', '�' => 'u', '&#369;' => 'u', '�' => 'y', '�' => 'th',
			'�' => 'y',

			// Latin symbols
			'�' => '(c)',

			// Greek
			'&#913;' => 'A', '&#914;' => 'B', '&#915;' => 'G', '&#916;' => 'D', '&#917;' => 'E', '&#918;' => 'Z', '&#919;' => 'H', '&#920;' => '8',
			'&#921;' => 'I', '&#922;' => 'K', '&#923;' => 'L', '&#924;' => 'M', '&#925;' => 'N', '&#926;' => '3', '&#927;' => 'O', '&#928;' => 'P',
			'&#929;' => 'R', '&#931;' => 'S', '&#932;' => 'T', '&#933;' => 'Y', '&#934;' => 'F', '&#935;' => 'X', '&#936;' => 'PS', '&#937;' => 'W',
			'&#902;' => 'A', '&#904;' => 'E', '&#906;' => 'I', '&#908;' => 'O', '&#910;' => 'Y', '&#905;' => 'H', '&#911;' => 'W', '&#938;' => 'I',
			'&#939;' => 'Y',
			'&#945;' => 'a', '&#946;' => 'b', '&#947;' => 'g', '&#948;' => 'd', '&#949;' => 'e', '&#950;' => 'z', '&#951;' => 'h', '&#952;' => '8',
			'&#953;' => 'i', '&#954;' => 'k', '&#955;' => 'l', '&#956;' => 'm', '&#957;' => 'n', '&#958;' => '3', '&#959;' => 'o', '&#960;' => 'p',
			'&#961;' => 'r', '&#963;' => 's', '&#964;' => 't', '&#965;' => 'y', '&#966;' => 'f', '&#967;' => 'x', '&#968;' => 'ps', '&#969;' => 'w',
			'&#940;' => 'a', '&#941;' => 'e', '&#943;' => 'i', '&#972;' => 'o', '&#973;' => 'y', '&#942;' => 'h', '&#974;' => 'w', '&#962;' => 's',
			'&#970;' => 'i', '&#944;' => 'y', '&#971;' => 'y', '&#912;' => 'i',

			// Turkish
			'&#350;' => 'S', '&#304;' => 'I', '�' => 'C', '�' => 'U', '�' => 'O', '&#286;' => 'G',
			'&#351;' => 's', '&#305;' => 'i', '�' => 'c', '�' => 'u', '�' => 'o', '&#287;' => 'g',

			// Russian
			'&#1040;' => 'A', '&#1041;' => 'B', '&#1042;' => 'V', '&#1043;' => 'G', '&#1044;' => 'D', '&#1045;' => 'E', '&#1025;' => 'Yo', '&#1046;' => 'Zh',
			'&#1047;' => 'Z', '&#1048;' => 'I', '&#1049;' => 'J', '&#1050;' => 'K', '&#1051;' => 'L', '&#1052;' => 'M', '&#1053;' => 'N', '&#1054;' => 'O',
			'&#1055;' => 'P', '&#1056;' => 'R', '&#1057;' => 'S', '&#1058;' => 'T', '&#1059;' => 'U', '&#1060;' => 'F', '&#1061;' => 'H', '&#1062;' => 'C',
			'&#1063;' => 'Ch', '&#1064;' => 'Sh', '&#1065;' => 'Sh', '&#1066;' => '', '&#1067;' => 'Y', '&#1068;' => '', '&#1069;' => 'E', '&#1070;' => 'Yu',
			'&#1071;' => 'Ya',
			'&#1072;' => 'a', '&#1073;' => 'b', '&#1074;' => 'v', '&#1075;' => 'g', '&#1076;' => 'd', '&#1077;' => 'e', '&#1105;' => 'yo', '&#1078;' => 'zh',
			'&#1079;' => 'z', '&#1080;' => 'i', '&#1081;' => 'j', '&#1082;' => 'k', '&#1083;' => 'l', '&#1084;' => 'm', '&#1085;' => 'n', '&#1086;' => 'o',
			'&#1087;' => 'p', '&#1088;' => 'r', '&#1089;' => 's', '&#1090;' => 't', '&#1091;' => 'u', '&#1092;' => 'f', '&#1093;' => 'h', '&#1094;' => 'c',
			'&#1095;' => 'ch', '&#1096;' => 'sh', '&#1097;' => 'sh', '&#1098;' => '', '&#1099;' => 'y', '&#1100;' => '', '&#1101;' => 'e', '&#1102;' => 'yu',
			'&#1103;' => 'ya',

			// Ukrainian
			'&#1028;' => 'Ye', '&#1030;' => 'I', '&#1031;' => 'Yi', '&#1168;' => 'G',
			'&#1108;' => 'ye', '&#1110;' => 'i', '&#1111;' => 'yi', '&#1169;' => 'g',

			// Czech
			'&#268;' => 'C', '&#270;' => 'D', '&#282;' => 'E', '&#327;' => 'N', '&#344;' => 'R', '�' => 'S', '&#356;' => 'T', '&#366;' => 'U',
			'�' => 'Z',
			'&#269;' => 'c', '&#271;' => 'd', '&#283;' => 'e', '&#328;' => 'n', '&#345;' => 'r', '�' => 's', '&#357;' => 't', '&#367;' => 'u',
			'�' => 'z',

			// Polish
			'&#260;' => 'A', '&#262;' => 'C', '&#280;' => 'e', '&#321;' => 'L', '&#323;' => 'N', '�' => 'o', '&#346;' => 'S', '&#377;' => 'Z',
			'&#379;' => 'Z',
			'&#261;' => 'a', '&#263;' => 'c', '&#281;' => 'e', '&#322;' => 'l', '&#324;' => 'n', '�' => 'o', '&#347;' => 's', '&#378;' => 'z',
			'&#380;' => 'z',

			// Latvian
			'&#256;' => 'A', '&#268;' => 'C', '&#274;' => 'E', '&#290;' => 'G', '&#298;' => 'i', '&#310;' => 'k', '&#315;' => 'L', '&#325;' => 'N',
			'�' => 'S', '&#362;' => 'u', '�' => 'Z',
			'&#257;' => 'a', '&#269;' => 'c', '&#275;' => 'e', '&#291;' => 'g', '&#299;' => 'i', '&#311;' => 'k', '&#316;' => 'l', '&#326;' => 'n',
			'�' => 's', '&#363;' => 'u', '�' => 'z'
		);

		// Make custom replacements
		$str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);

		// Transliterate characters to ASCII
		if ($options['transliterate']) {
			$str = str_replace(array_keys($char_map), $char_map, $str);
		}

		// Replace non-alphanumeric characters with our delimiter
		$str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);

		// Remove duplicate delimiters
		$str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);

		// Truncate slug to max. characters
		$str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : strlen($str)), 'UTF-8');

		// Remove delimiter from ends
		$str = trim($str, $options['delimiter']);

		return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
	}
	function get_contents($url)
	{
		if (function_exists('curl_exec')) {
			$ch = curl_init();

			$header[0] = "Accept: text/xml,application/xml,application/xhtml+xml,";
			$header[0] .= "text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5";
			$header[] = "Cache-Control: max-age=0";
			$header[] = "Connection: keep-alive";
			$header[] = "Keep-Alive: 300";
			$header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
			$header[] = "Accept-Language: en-us,en;q=0.5";
			$header[] = "Pragma: ";

			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_ENCODING, "gzip,deflate");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
			curl_setopt($ch, CURLOPT_REFERER, "https://www.facebook.com");
			curl_setopt($ch, CURLOPT_AUTOREFERER, true);
			curl_setopt($ch, CURLOPT_TIMEOUT, 30);
			//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
			curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/" . rand(3, 5) . "." . rand(0, 3) . " (Windows NT " . rand(3, 5) . "." . rand(0, 2) . "; rv:2.0.1) Gecko/20100101 Firefox/" . rand(3, 5) . ".0.1");

			$url_get_contents_data = curl_exec($ch);
			curl_close($ch);
			if ($url_get_contents_data == false) {
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
				curl_setopt($ch, CURLOPT_HEADER, 0);
				//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
				curl_setopt($ch, CURLOPT_URL, $url);
				$url_get_contents_data = curl_exec($ch);
				curl_close($ch);
			}
		} elseif (function_exists('file_get_contents')) {
			$url_get_contents_data = @file_get_contents($url);
		} elseif (function_exists('fopen') && function_exists('stream_get_contents')) {
			$handle = fopen($url, "r");
			$url_get_contents_data = stream_get_contents($handle);
		} else {
			$url_get_contents_data = false;
		}
		return $url_get_contents_data;
	}
	function short($text, $len = 150, $more = '...')
	{
		$txt = ltrim(strip_tags($text));
		if (strlen($txt) > $len) {
			$text = substr($txt, 0, $len);
			$txt = substr($text, 0, strrpos($text, ' ')) . $more;
		}
		return $txt;
	}
	function remove_repeating_chars($object)
	{
		return preg_replace("/[^a-zA-Z0-9\s.?!\/]/", "", $object);
	}
	function fix_json($j)
	{
		$j = trim($j);
		$j = ltrim($j, '(');
		$j = rtrim($j, ')');
		$a = preg_split('#(?<!\\\\)\"#', $j);

		for ($i = 0; $i < count($a); $i += 2) {
			$s = $a[$i];
			$s = preg_replace('#([^\s\[\]\{\}\:\,]+):#', '"\1":', $s);
			$a[$i] = $s;
		}

		$j = implode('"', $a);

		return $j;
	}
	function slugify($text, $strict = false)
	{
		$text = html_entity_decode($text, ENT_QUOTES, 'UTF-8');
		// replace non letter or digits by -
		$text = preg_replace('~[^\\pL\d.]+~u', ' ', $text);

		// trim
		$text = trim($text, ' ');
		setlocale(LC_CTYPE, 'en_GB.utf8');
		// transliterate
		if (function_exists('iconv')) {
			$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
		}

		// lowercase
		$text = strtolower($text);
		// remove unwanted characters
		$text = preg_replace('~[^-\w.]+~', ' ', $text);
		if (empty($text)) {
			return 'empty_$';
		}
		if ($strict) {
			$text = str_replace(".", "_", $text);
		}
		return $text;
	}
	function removeDuplicates($sSearch, $sReplace, $sSubject)
	{
		$i = 0;
		do {
			$sSubject = str_replace($sSearch, $sReplace, $sSubject);
			$pos = strpos($sSubject, $sSearch);

			$i++;
			if ($i > 100) {
				die('removeDuplicates() loop error');
			}
		} while ($pos !== false);
		return $sSubject;
	}
	function strposa($haystack, $needle, $offset = 0)
	{
		if (is_array($needle)) :
			foreach ($needle as $query) {
				if (!empty($query)) :
					if (strpos((string) $haystack, $query, $offset) !== false) return true; // stop on first true result
				endif;
			}
		endif;
		return false;
	}
}
