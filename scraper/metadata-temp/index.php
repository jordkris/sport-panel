<?php

date_default_timezone_set("Asia/Jakarta");
set_time_limit(0);
require '../../vendor/simple_html_dom/simple_html_dom.php';

function getParam($param)
{
    if (isset($_GET[$param])) {
        return $_GET[$param];
    } else {
        throw new Exception('Please provide a ' . $param . ' parameter!');
    }
}
function isTrueGenderSport($genderSport)
{
    return isset($GLOBALS['sportData'][$genderSport]);
}

set_error_handler(function ($errno, $errstr, $errfile, $errline) {
    $GLOBALS['currentError'] = $errstr;
});

$GLOBALS['sportData'] = json_decode(file_get_contents('../../sportData.json'), true);
$GLOBALS['result'] = new stdClass();
$GLOBALS['result']->status = 500;
$GLOBALS['result']->message = 'Internal server error';
$GLOBALS['result']->elapsedTime = microtime(true);
$GLOBALS['result']->image = '';
$GLOBALS['result']->defaultImage = '';
try {
    $genderSport = strtolower(getParam('genderSport'));
    if (!isTrueGenderSport($genderSport)) {
        throw new Exception('Invalid gender sport!');
    }
    $gender = explode(',', $genderSport)[0];
    $sport = explode(',', $genderSport)[1];
    $url = 'https://www.maxpreps.com/';
    switch ($sport) {
        case 'crosscountry':
            $url .= 'cross-country';
            break;
        case 'flagfootball':
            $url .= 'flag-football';
            break;
        case 'icehockey':
            $url .= 'ice-hockey';
            break;
        case 'fieldhockey':
            $url .= 'field-hockey';
            break;
        case 'indoortrackfield':
            $url .= 'indoor-track-field';
            break;
        case 'skisnowboard':
            $url .= 'ski-snowboard';
            break;
        case 'trackfield':
            $url .= 'track-field';
            break;
        case 'waterpolo':
            $url .= 'water-polo';
            break;
        case 'wheelchairsports':
            $url .= 'wheelchair-sports';
            break;
        case 'bassfishing':
            $url .= 'bass-fishing';
            break;
        case 'canoepaddling':
            $url .= 'canoe-paddling';
            break;
        case 'danceteam':
            $url .= 'dance-team';
            break;
        case 'beachvolleyball':
            $url .= 'beach-volleyball';
            break;
        case 'slowpitchsoftball':
            $url .= 'slow-pitch-softball';
            break;
        default:
            $url .= $sport;
    }
    $url .= '/';
    switch ($gender) {
        case 'girls':
            $temp = ['badminton', 'beachvolleyball', 'fieldhockey', 'gymnastics', 'slow-pitch-softball', 'softball', 'volleybal'];
            if (!in_array($sport, $temp)) {
                $url .= 'girls';
            }
            break;
        case 'co-ed':
            $temp = ['badminton'];
            if (in_array($sport, $temp)) {
                $url .= 'co-ed';
            }
            break;
        default:
            $temp = ['badminton', 'gymnastics', 'volleyball'];
            if (in_array($sport, $temp)) {
                $url .= 'boys';
            }
    }
    $document = file_get_html($url);
    echo $document;
    die;
    $s = $document->find('.eyClGn');
    foreach ($s as $elm) {
        echo $elm->innertext().PHP_EOL;
    }
    $img = $document->find('.bKqBtd img', 0)->src;
    if ($img) {
        $GLOBALS['request']->image = $img;
    } else {
        $GLOBALS['request']->image = $document->find('.article-wrapper img', 0)->src;
    }
    $GLOBALS['result']->defaultImage = file_get_html('https://maxpreps.com')->find('img', 1)->src;
    $GLOBALS['result']->status = 200;
    $GLOBALS['result']->message = 'Successfully load data';
} catch (Exception $e) {
    $GLOBALS['result']->message = $e->getMessage();
} catch (Error $e) {
    $GLOBALS['result']->message = $e->getMessage();
} finally {
    restore_error_handler();
    $GLOBALS['result']->elapsedTime = round(microtime(true) - $GLOBALS['result']->elapsedTime, 3) . ' s';
    header('Content-Type: application/json');
    echo json_encode($GLOBALS['result'], JSON_PRETTY_PRINT);
}
