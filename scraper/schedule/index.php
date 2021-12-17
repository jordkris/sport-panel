<?php
date_default_timezone_set("Asia/Jakarta");
set_time_limit(0);
require '../../vendor/simple_html_dom/simple_html_dom.php';

$GLOBALS['sportData'] = json_decode(file_get_contents('../../sportData.json'),true);
$GLOBALS['stateData'] = json_decode(file_get_contents('../../stateData.json'),true);

function getParam($param)
{
    if (isset($_GET[$param])) {
        return $_GET[$param];
    } else {
        throw new Exception('Please provide a ' . $param . ' parameter!');
    }
}

function isContains($string, $substring)
{
    if (strpos($string, $substring) !== false) {
        return true;
    } else {
        return false;
    }
}

function isTrueDate($date)
{
    $dateArr = explode('/', $date);
    if (count($dateArr) == 3) {
        $month = $dateArr[0];
        $day = $dateArr[1];
        $year = $dateArr[2];
        if (checkdate($month, $day, $year)) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function trimZeroPrefixDate($date)
{
    $dateArr = explode('/', $date);
    return implode('/', [ltrim($dateArr[0], '0'), ltrim($dateArr[1], '0'), $dateArr[2]]);
}

function isTrueGenderSport($gendersport)
{
    return isset($GLOBALS['sportData'][$gendersport]);
}

function isTrueState($state)
{
    return isset($GLOBALS['stateData'][$state]);
}

function dateToText($date)
{
    $dateArr = explode('/', $date);
    $year = $dateArr[2];
    $month = $dateArr[0] < 10 ? '0' . $dateArr[0] : $dateArr[0];
    $day = $dateArr[1] < 10 ? '0' . $dateArr[1] : $dateArr[1];
    return date("M jS, Y", strtotime(implode('-', [$year, $month, $day])));
}

function prt($string)
{
    echo $string . PHP_EOL;
}

set_error_handler(function ($errno, $errstr, $errfile, $errline) {
    $GLOBALS['currentError'] = $errstr;
});

function getScheduleUrl($i, $document)
{
    $singleRes = new stdClass();
    $contest = $document->find('[data-teams]', $i)->find('.teams > li > .name');
    $linkData = $document->find('[data-teams]', $i)->find('a.c-c');
    $link =  $linkData != [] ? $linkData : 'link not found';
    if (!($link == 'link not found')) {
        $link = $linkData[0]->href;
    }
    if (count($contest) == 2) {
        $home = html_entity_decode(trim($contest[0]->text()));
        $away = html_entity_decode(trim($contest[1]->text()));
        if (!(strtolower($home) == 'tba' || strtolower($away) == 'tba')) {
            $singleRes->index = $i;
            $singleRes->url = $link;
            return $singleRes;
        }
    }
    return new stdClass();
}

function getSingleScheduleData($i, $document, $date, $gendersport, $state, $url)
{
    $singleRes = new stdClass();
    $contest = $document->find('[data-teams]', $i)->find('.teams > li > .name');
    if (count($contest) == 2) {
        $singleRes->home = html_entity_decode(trim($contest[0]->text()));
        $singleRes->away = html_entity_decode(trim($contest[1]->text()));
        if (!(strtolower($singleRes->home) == 'tba' || strtolower($singleRes->away) == 'tba')) {
            $singleRes->description = html_entity_decode(file_get_html($url)->find('p.contest-description', 0)->text());
            $singleRes->date = dateToText($date);
            $singleRes->gendersport = $GLOBALS['sportData'][$gendersport];
            $singleRes->state = $GLOBALS['stateData'][$state];
            $singleRes->url = $url;
            return $singleRes;
        }
    }
    return new stdClass();
}
$GLOBALS['result'] = new stdClass();
$GLOBALS['result']->status = 500;
$GLOBALS['result']->message = 'Internal server error';
$GLOBALS['result']->elapsedTime = microtime(true);
$GLOBALS['result']->source = '';
$GLOBALS['result']->total = 0;
$GLOBALS['result']->data = [];
try {
    $date = getParam('date');
    $gendersport = strtolower(getParam('gendersport'));
    $state = strtoupper(getParam('state'));

    if (isTrueDate($date)) {
        $date = trimZeroPrefixDate($date);
    } else {
        throw new Exception('Invalid date. date parameter must be MM/DD/YYYY!');
    }
    if (!isTrueGenderSport($gendersport)) {
        throw new Exception('Invalid gender sport. gendersport parameter must included in this array : [' . implode(' ', array_keys($GLOBALS['sportData'])) . ']');
    }
    if (!isTrueState($state)) {
        throw new Exception('Invalid state. state parameter must included in this array : [' . implode(' ', array_keys($GLOBALS['stateData'])) . ']');
    }
    $url = 'https://www.maxpreps.com/list/schedules_scores.aspx?date=' . $date . '&gendersport=' . $gendersport . '&state=' . $state;
    $document = file_get_html($url);
    $availableDate = [];
    foreach ($document->find('.month li > a') as $element) {
        $filterData = explode('&', explode('?', $element->href)[1]);
        $availableDate[] = explode('=', $filterData[0])[1];
    }
    if (in_array($date, $availableDate)) {
        if (!(count($document->find('.no-data')) > 0)) {
            $teams = $document->find('[data-teams]');
            if (count($teams) > 0) {
                $cup = trim($document->find('header h1', 0)->text());
                if (isContains($cup, 'Schedule')) {
                    $cup = str_replace('Schedule', '', $cup);
                }

                if (isset($_GET['index']) && isset($_GET['url'])) {
                    $GLOBALS['result']->total = 1;
                    $GLOBALS['result']->data = getSingleScheduleData($_GET['index'], $document, $date, $gendersport, $state, $_GET['url']);
                    $GLOBALS['result']->message = 'Successfully load data';
                } else {
                    $res = [];
                    for ($i = 0; $i < count($teams); $i++) {
                        array_push($res, getScheduleUrl($i, $document, $date, $gendersport, $state));
                    }
                    $GLOBALS['result']->data = array_values(array_filter($res, function ($val) {
                        return $val != new stdClass();
                    }));
                    $GLOBALS['result']->message = 'Successfully load data ('.$date.' | '.$gendersport.' | '.$state.')';
                    // $GLOBALS['result']->data = $res;
                }
                $GLOBALS['result']->status = 200;
                $GLOBALS['result']->source = $url;
            } else {
                $GLOBALS['result']->message = 'No teams found';
            }
        } else {
            $GLOBALS['result']->message = 'No cup available';
        }
    } else {
        $GLOBALS['result']->message = 'No schedules available';
    }
} catch (Exception $e) {
    $GLOBALS['result']->message = $e->getMessage();
    if (isset($GLOBALS['currentError'])) {
        $GLOBALS['result']->message .= ', ' . $GLOBALS['currentError'];
    }
} catch (Error $e) {
    $GLOBALS['result']->message = $e->getMessage();
} finally {
    restore_error_handler();
    $GLOBALS['result']->elapsedTime = round(microtime(true) - $GLOBALS['result']->elapsedTime, 3) . ' s';
    if (!isset($_GET['index']) || !isset($_GET['url'])) $GLOBALS['result']->total = count($GLOBALS['result']->data);
    header('Content-Type: application/json');
    echo json_encode($GLOBALS['result'], JSON_PRETTY_PRINT);
}