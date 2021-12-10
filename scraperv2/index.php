<?php
require_once  __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
date_default_timezone_set("Asia/Jakarta");
use Nesk\Puphpeteer\Puppeteer;
use Nesk\Rialto\Data\JsFunction;

class Scraper
{
    function __construct()
    {
        $this->headless = false;
        $this->args = ['--start-maximized','--auto-open-devtools-for-tabs'];
        $this->puppeteer = new Puppeteer;
    }

    function initBrowser() {
        $this->print('Open browser');
        $this->browser = $this->puppeteer->launch([
            'headless' => false,
            'args' => ['--start-maximized']
        ]);
    }

    function toDo() {
        $this->page = $this->browser->newPage();
        $date = date('d/m/Y');
        $genderSport = 'boys,baseball';
        $state = 'al';
        $this->page->goto('https://www.maxpreps.com/list/schedules_scores.aspx?date='.$date.'&gendersport='.$genderSport.'&state='.$state);
        // $this->page->click('div#navbar-spy > ul > li:nth-child(2) > a:nth-child(1)');
    }

    function start() {
        $this->initBrowser();
        $this->print('Success open browser');
        $this->toDo();
        $this->page->waitFor(3000);
    }

    function print($string) {
        echo '<script>console.log("['.date('Y-m-d H:i:s.').substr(gettimeofday()["usec"],0,3).'] '.$string.'")</script>'.PHP_EOL;
    }
}

$scraperTool = new Scraper();
$scraperTool->start();
// $page = $browser->newPage();
// $page->goto('https://example.com');
// // Get the "viewport" of the page, as reported by the page.
// $dimensions = $page->evaluate(JsFunction::createWithBody("
//     return {
//         width: document.documentElement.clientWidth,
//         height: document.documentElement.clientHeight,
//         deviceScaleFactor: window.devicePixelRatio
//     };
// "));

// printf('Dimensions: %s', print_r($dimensions, true));

// $browser->close();
