jQuery(document).ready(function(a) {
    playerLoad();
    a("#buydvd").mousedown(function() { seeitonEbay() });
    if (a("#login").length) {
        a("#login-submit").click(function() {
            a(".login-wait,.login-error").hide();
            a(".login-wait").fadeIn().delay(3000);
            a(".login-wait").fadeOut();
            setTimeout(function() {
                a(".login-error").fadeIn();
                a("#username, #password").val("");
                a("#username").focus()
            }, 3500)
        })
    }
});

function playClick() {
    $(".movie-loading, .movie-loader").show();
    $("#playnow .fa-youtube-play").css("visibility", "hidden");
    setTimeout(function() {
        $(".movie-loader").hide();
        $(".movie-loader").after('<div class="nregister"><div class="nregister-wrapper"><div><i class="fa fa-warning"></i><div class="oops">Oops!</div></div><div class="oops-wrapper"><div><div>You must create a <span id="register" class="oops-target" onclick="regplayClick()">Free Account</span></div><div>in order to WATCH STREAMING</di></div></div><span id="regplay" onclick="regplayClick()"><i class="fa fa-plus"></i>Create FREE Account</span></div></div>')
    }, 3500)
}

function playTrailer(a) {
    a.preventDefault();
    $.colorbox({ href: $(".youtube").last().attr("href"), transition: "fade", iframe: true, innerHeight: "640px", innerHeight: "380px", scrolling: false, fixed: true })
}

function playerLoad() {
    if ($("#player").length) {
        $(".movie-loading").show();
        setTimeout(function() { $(".movie-loader").show() }, 1000);
        $("span#playnow").css("visibility", "visible");
        $(".movie-loading").hide()
    }
}

function playHover() { $(".entry-title").toggleClass("active") }

function regplayClick() { window.location.href = "register.php" }

function seeitonEbay() {
    var a = $(".entry-title").last().text();
    title = encodeURI(a), url = "https://www.play.com/Search.html?searchstring=" + title + "&searchsource=0&searchtype=r2alldvd";
    vig = "https://redirect.viglink.com?key=de5c74cb7dc1a38954a78ecab8d789eb&u=" + encodeURIComponent(url);
    window.open(vig)
}

function playLoad() {
    $(".movie-loading").hide();
    $(".fa-arrows-alt").click(function() {
        screenfull.request(document.getElementById("player"));
        $(this).toggleClass("fa-arrows-alt fa-compress")
    });
    $("a#playnow,.play,i.fa.fa-compress").click(function() { screenfull.exit() });
    $(".inline").colorbox({ inline: true, width: "40%" })
}

function playClear() { $("#player").load(function() {}) }

function secondsTimeSpanToHMS(c) {
    var b = Math.floor(c / 3600);
    c -= b * 3600;
    var a = Math.floor(c / 60);
    c -= a * 60;
    return b + ":" + (a < 10 ? "0" + a : a) + ":" + (c < 10 ? "0" + c : c)
};

// css
$('.category-menu li').hover((e) => {
    $('#' + e.target.id).addClass('hover');
}, (e) => {
    $('#' + e.target.id).removeClass('hover');
});

// global data
let ajaxTemp = [];
let intervalTemp;
// datatables
let t = $('#schedule-table').DataTable({
    "columns": [{
        "className": "text-center"
    }, {
        "className": "text-center"
    }, {
        "className": "text-center"
    }, {
        "className": "text-justify"
    }, {
        "className": "text-center"
    }, {
        "className": "text-center"
    }]
});
$('th.text-justify').removeClass('text-justify').addClass('text-center');
t.on('order.dt search.dt', function() {
    t.column(0, { search: 'applied', order: 'applied' }).nodes().each(function(cell, i) {
        cell.innerHTML = i + 1;
    });
}).draw();

// bootstrap datepicker
// $('#start-date,#end-date').datepicker('setDate', new Date());
async function handleTrueData(nearestMode = false, changeState = false) {
    return new Promise((resolve, reject) => {
        let today = getTodayDate(new Date());
        let gendersport = $('#gender-sport').val();
        let state = $('#state').val();
        // if (state == 'all') {
        // $('#start-date,#end-date').datepicker('destroy');
        // $('#start-date,#end-date').datepicker({
        //     format: 'mm/dd/yyyy',
        //     autoclose: true,
        //     inline: true,
        //     // sideBySide: true,
        // });
        // $('#start-date').val(today);
        // $('#end-date').val(today);
        // $('#status-bar-start-date').html('');
        // $('#status-bar-end-date').html('');
        // resolve();
        // } else {
        let singleAjax = $.ajax({
            url: `${location.href.split('?')[0]}scraper/schedule/?date=${today}&gendersport=${gendersport}&state=${state}`,
            type: 'GET',
            beforeSend: () => {
                $('#status-bar-start-date').html('(Processing...)');
                $('#status-bar-end-date').html('(Processing...)');
            },
            success: (res) => {
                // true date
                $('#start-date,#end-date').datepicker('destroy');
                // console.log(res.truedate);
                $('#start-date,#end-date').datepicker({
                    format: 'mm/dd/yyyy',
                    autoclose: true,
                    inline: true,
                    // sideBySide: true,
                    beforeShowDay: (date) => {
                        let calenderDate = (date.getMonth() + 1) + '/' + date.getDate() + '/' + date.getFullYear();
                        if ($.inArray(calenderDate, res.truedate) > -1) {
                            return {
                                classes: 'date-highlighted',
                                tooltip: res.trueschedulecount[res.truedate.indexOf(calenderDate)] + ' schedule(s) available on this day'
                            };
                        } else {
                            return {
                                classes: '',
                                tooltip: ''
                            };
                        }
                    }
                });
                if (nearestMode) {
                    let nearestDate = detectNearestDate(today, res.truedate);
                    $('#start-date').val(nearestDate);
                    $('#end-date').val(nearestDate);
                    // $('#start-date,#end-date').datepicker("update", nearestDate);
                }
                if (res.truedate.length) {
                    $('#status-bar-start-date').html(`(minimum : ${handleCompareDate('min', today, res.truedate)})`);
                    $('#status-bar-end-date').html(`(maximum : ${handleCompareDate('max', today, res.truedate)})`);
                } else {
                    $('#status-bar-start-date').html('(No Schedules Available!)');
                    $('#status-bar-end-date').html('(No Schedules Available!)');
                }
                // true state

                let arrayState = [...$('#state > option')];
                let state;
                if (changeState) {
                    for (let i = arrayState.length - 1; i > 0; i--) {
                        state = arrayState[i].getAttribute('value');
                        if (!res.truestate.includes(state.toUpperCase())) {
                            arrayState[i].style.display = 'none';
                        } else {
                            $('#state').val(state);
                        }
                    }
                }
                resolve();
            },
            error: (e) => {
                console.error(e);
                reject(e);
            }
        });
        ajaxTemp.push(singleAjax);
        // }
    });
}

function detectNearestDate(chosenDate, arrayDate) {
    if (arrayDate.length) {
        arrayDate.push(chosenDate);
        arrayDate.sort((a, b) => new Date(a) - new Date(b));
        let res;
        let index = arrayDate.indexOf(chosenDate);
        switch (index) {
            case 0:
                res = arrayDate[1];
                break;
            case arrayDate.length - 1:
                res = arrayDate[arrayDate.length - 2];
                break;
            default:
                let diffLeft = new Date(chosenDate) - new Date(arrayDate[index - 1]);
                let diffRight = new Date(arrayDate[index + 1]) - new Date(chosenDate);
                if (diffLeft < diffRight) {
                    res = arrayDate[index - 1];
                } else {
                    res = arrayDate[index + 1];
                }
        }
        return res;
    } else {
        return chosenDate;
    }
}

function handleCompareDate(fun, chosenDate, arrayDate) {
    if (arrayDate.length) {
        arrayDate.sort((a, b) => new Date(a) - new Date(b));
        if (fun == 'min') {
            return arrayDate[0];
        } else if (fun == 'max') {
            return arrayDate[arrayDate.length - 1]
        }
    } else {
        return chosenDate;
    }
}

// custom scripts
async function handleLocalTopbar(modifyMode = false, data = null) {
    return new Promise((resolve, reject) => {
        let singleAjax;
        if (modifyMode) {
            singleAjax = $.ajax({
                url: location.href.split('?')[0] + 'sportData.json',
                type: 'GET',
                success: (res) => {
                    let oldTopbar = JSON.parse(localStorage.getItem('topbar'));
                    let newTopbar = JSON.parse(localStorage.getItem('topbar'));
                    newTopbar.sort(function(x, y) { return x == data ? -1 : y == data ? 1 : 0; });
                    for (let i = 0; i < 5; i++) {
                        $('.gender-sport')[i].setAttribute('id', newTopbar[i].replace(',', '-'));
                        $('.gender-sport')[i].innerHTML = '<span class="icon fa fa-play-circle-o"></span>' + res[newTopbar[i]];
                    }
                    localStorage.setItem('topbar', JSON.stringify(newTopbar));
                    let totalGenderSport = Object.keys(newTopbar).length;
                    handleMainImage(newTopbar.at(Math.floor(Math.random() * totalGenderSport)), '#img-sport-left');
                    handleMainImage(newTopbar.at(Math.floor(Math.random() * totalGenderSport)), '#img-sport-right');
                    resolve();
                },
                error: (e) => {
                    console.error(e);
                    reject(e);
                }
            });
        } else {
            singleAjax = $.ajax({
                url: location.href.split('?')[0] + 'topbar.json',
                type: 'GET',
                success: (res) => {
                    localStorage.setItem('topbar', JSON.stringify(res));
                    resolve();
                },
                error: (e) => {
                    console.error(e);
                    reject(e);
                }
            });
        }
        ajaxTemp.push(singleAjax);
    });
}

async function handleMainImage(gendersport, dom) {
    let singleAjax = $.ajax({
        url: location.href.split('?')[0] + 'scraper/metadata/?gendersport=' + gendersport,
        type: 'GET',
        beforeSend: () => {
            let num, text;
            intervalTemp = setInterval(function() {
                num = new Date().getSeconds() % 3 + 1;
                text = '.'.repeat(num) + '%20'.repeat(3 - num);
                $(dom).attr('src', 'https://dummyimage.com/768x554/000000/ffffff&text=Loading' + text);
            }, 1000);
        },
        success: (res) => {
            clearInterval(intervalTemp);
            if (res.status == 200) {
                if (res.image !== '' && res.image !== null) {
                    $(dom).attr('src', res.image);
                } else {
                    $(dom).attr('src', res.defaultImage);
                }
            } else {
                $(dom).attr('src', 'https://dummyimage.com/768x554/000000/ffffff&text=' + res.message);
                handleLog('warning', res.message);
            }
            let baseHeight = $('.img-sport')[0].clientHeight;
            $(dom).css('height', baseHeight + 'px');
        },
        error: (e) => {
            console.error(e);
        }
    });
    ajaxTemp.push(singleAjax);
}

async function loadMetadata(gendersport) {
    return new Promise((resolve, reject) => {
        let intervalTemp;
        let singleAjax = $.ajax({
            url: location.href.split('?')[0] + 'scraper/metadata/?gendersport=' + gendersport,
            type: 'GET',
            beforeSend: () => {
                $('.play-wrapper').css('visibility', 'hidden');
                $('.spinner-wrapper').css('visibility', 'visible');
                $('.top-menu').css('display', 'none');
                $('.loading-menu').css('display', '');
                let text, text2, num;
                $('#status-bar-all').html(handleIcon('loading') + ' Load metadata...');
                intervalTemp = setInterval(function() {
                    num = new Date().getSeconds() % 3 + 1;
                    text = '.'.repeat(num) + '%20'.repeat(3 - num);
                    text2 = '.'.repeat(num);
                    $('.img-sport').attr('poster', 'https://dummyimage.com/768x554/000000/ffffff&text=Loading' + text);
                    $('.img-desc').attr('src', 'https://dummyimage.com/768x554/000000/ffffff&text=Loading' + text);
                    $('.loading-label').html('Loading' + text2);
                }, 1000);
            },
            success: (res) => {
                $('.spinner-wrapper').css('visibility', 'hidden');
                $('.play-wrapper').css('visibility', 'visible');
                $('.top-menu').css('display', '');
                $('.loading-menu').css('display', 'none');
                clearInterval(intervalTemp);
                if (res.status == 200) {
                    if (res.image != '' && res.image !== null) {
                        $('.img-sport').attr('poster', res.image);
                        $('.img-desc').attr('src', res.image);
                    } else {
                        $('.img-sport').attr('poster', res.defaultImage);
                        $('.img-desc').attr('src', res.defaultImage);
                    }
                } else {
                    $('.img-sport').attr('poster', 'https://dummyimage.com/768x554/000000/ffffff&text=' + res.message);
                    $('.img-desc').attr('src', 'https://dummyimage.com/768x554/000000/ffffff&text=' + res.message);
                    handleLog('warning', res.message);
                }
                let baseHeight = $('.img-sport')[0].clientHeight;
                $('#img-sport-left').css('height', baseHeight + 'px');
                $('#img-sport-right').css('height', baseHeight + 'px');
                resolve();
            },
            error: (e) => {
                handleLog('error', e || e.getMessage());
                console.error(e);
                reject(e);
            }
        });
        ajaxTemp.push(singleAjax);
    });
}

// excecution data
async function beginExecution() {
    console.log('click start');
    showControlButton('stop');
}

async function abortExecution(force = true) {
    return new Promise((resolve, reject) => {
        try {
            clearInterval(intervalTemp);
            console.log('click stop');
            if (force) {
                $('#status-bar-all').html(handleIcon('abort') + ' Execution has been aborted!');
            } else {
                if (JSON.parse(localStorage.getItem('teams')).length == 0) {
                    $('#status-bar-all').html(handleIcon('empty') + ' No schedules available!');
                } else {
                    alert('Match not found!');
                    $('#status-bar-all').html(handleIcon('empty') + ' Match not found!');
                }
            }
            handleProgressBar('#progress-bar-url', 0, 1);
            handleProgressBar('#progress-bar-schedule', 0, 1);
            showControlButton('start');
            if (ajaxTemp.length) {
                Promise.all([ajaxTemp.forEach((v) => {
                    v.abort();
                })]).then(() => {
                    ajaxTemp = [];
                }).catch((e) => {
                    console.error(e);
                });
            }
            resolve();
        } catch (e) {
            console.error(e);
            reject();
        }
    });
}

async function autoExecution() {
    try {
        //url
        let longUrl = new URL(location.href);
        let currentUrl = longUrl.searchParams;
        //date
        let startDate = $('#start-date').val();
        let endDate = $('#end-date').val();
        if (startDate == '') throw new Error('Start date is empty');
        if (endDate == '') throw new Error('End date is empty');
        let validDate = handleInvalidDate(startDate, endDate);
        startDate = validDate.startDate;
        endDate = validDate.endDate;
        // if (new Date(startDate) > new Date(endDate)) {
        //     $('#start-date').val(endDate).trigger('focusout');
        //     throw new Error('Start date must be less than or equal to end date');
        // };

        let allDate = getDaysArray(new Date(startDate), new Date(endDate));
        //gendersport
        let gendersport = $('#gender-sport').val();
        if (gendersport === '' || gendersport === null) {
            location.href = '?gendersport=boys,football';
            // throw new Error('Gendersport is empty');
            // gendersport = 'boys,football';
        } else {
            if (currentUrl.get('gendersport') !== gendersport) {
                location.href = '?gendersport=' + gendersport;
            }
        }
        //state
        let state = $('#state').val();
        if (state === null || state.length === 0) {
            // location.href = '?gendersport=boys%2Cfootball&state=al';
            // throw new Error('State is empty');
            state = 'all';
        }
        let stateArr = Object.keys(JSON.parse(localStorage.getItem('state-data')));
        if (state !== 'all') {
            stateArr = [state];
        }
        //threads
        let threads = $('#threads').val();
        if (threads == '') throw new Error('Threads is empty');
        // currentUrl.set('gendersport', gendersport);
        // currentUrl.set('startdate', convertDate(startDate, true));
        // currentUrl.set('enddate', convertDate(endDate, true));
        // currentUrl.set('startdate', startDate);
        // currentUrl.set('enddate', endDate);
        // currentUrl.set('stateArr', state.join(','));
        // currentUrl.set('state', state);
        // currentUrl.set('threads', threads);
        // window.history.pushState('page2', 'Title', longUrl);
        localStorage.setItem('state', state);
        localStorage.setItem('start-date', startDate);
        localStorage.setItem('end-date', endDate);
        localStorage.setItem('threads', threads);
        handleProgressBar('#progress-bar-url', 0, 1);
        handleProgressBar('#progress-bar-schedule', 0, 1);
        await loadSchedule(allDate, gendersport, stateArr, threads);
        // return { gendersport: gendersport, state: stateArr, startdate: startdate, enddate: enddate, threads: threads };
    } catch (e) {
        console.error(e);
    }
}

//auto check
setInterval(() => {
    if (localStorage.getItem('execution') === 'false') {
        handleProgressBar('#progress-bar-url', 0, 1);
        handleProgressBar('#progress-bar-schedule', 0, 1);
        $('#status-bar-url').html('');
        $('#status-bar-schedule').html('');
        showControlButton('start');
        // $('.real-data').prop('disabled', false);
        setTimeout(() => {
            $('#status-bar-all').html('');
        }, 3000);
    } else {
        // setTimeout(() => {
        //     $('.real-data').prop('disabled', true);
        // }, 3000);
    }
}, 1000)

$('#start-loading').click(() => {
    beginExecution();
});
$('#stop-loading').click(() => {
    abortExecution();
});

async function getAllUrl(date, gendersport, state, threads) {
    handleLog('info', 'Get all URL(s)...');
    let allResult = [],
        loop = 1,
        counter = 0,
        tasks = [],
        total = (localStorage.getItem('state') == 'all') ? state.length : state.length * date.length,
        // total = date.length,
        trueSchedule = 0,
        singleAjax;
    return new Promise(async(resolve, reject) => {
        $('#status-bar-url').html('(Processing...)');
        $('#true-schedule').html(trueSchedule);
        $('#status-bar-all').html(handleIcon('loading') + ' Load all possible url...');
        for (let x = 0; x < state.length; x++) {
            if (localStorage.getItem('state') == 'all') {
                $('#state').val(state[x].toLowerCase());
                await handleTrueData(true, false);
                date = [$('#start-date').val()];
            }
            for (let y = 0; y < date.length; y++) {
                if (localStorage.getItem('execution') == 'true') {
                    try {
                        tasks.push(new Promise((resolve, reject) => {
                            singleAjax = $.ajax({
                                url: `${location.href.split('?')[0]}scraper/schedule/?date=${date[y]}&gendersport=${gendersport}&state=${state[x]}`,
                                type: 'GET',
                                success: (res) => {
                                    if (localStorage.getItem('execution') == 'true') {

                                        handleLog('info', res.message);
                                        counter++;
                                        $('#status-bar-url').html(`(${counter} of ${total})`);
                                        handleProgressBar('#progress-bar-url', counter, total);
                                        // TODO : handle total filtered by match
                                        let teams = JSON.parse(localStorage.getItem('teams'));
                                        if (teams.length > 0) {
                                            res.data = res.data.filter((v) => {
                                                return (teams.includes(v.home) && teams.includes(v.away)) || (teams.includes(v.identicHome) && teams.includes(v.identicAway));
                                            });
                                            res.total = res.data.length;
                                        }
                                        trueSchedule += res.total;
                                        $('#true-schedule').html(trueSchedule);
                                        resolve(res);
                                    } else {
                                        reject('Execution aborted');
                                    }
                                    // if (res.status == 200) {
                                    // total += res.total;
                                    // } else {
                                    // }
                                },
                                error: (e) => {
                                    if (e.statusText === 'abort') {
                                        reject('Execution aborted');
                                    }
                                    console.error(e);
                                }
                            });
                            ajaxTemp.push(singleAjax);
                        }));
                        if (loop % threads == 0) {
                            await Promise.all(tasks).then((val) => {
                                if (localStorage.getItem('execution') == 'true') {
                                    tasks = [];
                                    allResult = allResult.concat(val);
                                    console.log(loop + ' tasks success!');
                                } else {
                                    handleProgressBar('#progress-bar-url', 0, 1);
                                    handleProgressBar('#progress-bar-schedule', 0, 1);
                                    reject('Execution has been aborted');
                                }
                            }).catch((e) => {
                                console.error(e);
                            });
                        }
                        if (loop == total) {
                            await Promise.all(tasks).then((val) => {
                                if (localStorage.getItem('execution') == 'true') {
                                    tasks = [];
                                    allResult = allResult.concat(val);
                                    console.log(loop + ' tasks success!');
                                    $("#progress-bar-url > div").html("100% ✅");
                                    if (localStorage.getItem('state') === 'all') $('#state').val('all');
                                    setTimeout(() => {
                                        resolve(allResult);
                                    }, 3000);
                                } else {
                                    handleProgressBar('#progress-bar-url', 0, 1);
                                    handleProgressBar('#progress-bar-schedule', 0, 1);
                                    reject('Execution has been aborted');
                                }
                            }).catch((e) => {
                                console.error(e);
                            });
                        }
                    } catch (err) {
                        handleLog('error', err);
                        console.error(err);
                    } finally {
                        loop++;
                    }
                } else {
                    handleProgressBar('#progress-bar-url', 0, 1);
                    handleProgressBar('#progress-bar-schedule', 0, 1);
                    reject('Execution has been aborted');
                }
            }
        }
    });
}

async function getAllSchedule(allUrl, threads) {
    handleLog('info', 'Get all Schedule(s)...');
    let counter = 0,
        tasks = [],
        total = allUrl.reduce((a, b) => {
            return a + b.total;
        }, 0),
        trueData = allUrl.filter(v => v.status == 200),
        singleAjax;
    return new Promise(async(resolve, reject) => {
        tasks = [];
        $('#status-bar-schedule').html('(Processing...)');
        $('#status-bar-all').html(handleIcon('loading') + ' Load all available schedules...');
        for (let i = 0; i < trueData.length; i++) {
            for (let j = 0; j < trueData[i].data.length; j++) {
                if (localStorage.getItem('execution') == 'true') {
                    try {
                        tasks.push(new Promise((resolve, reject) => {
                            singleAjax = $.ajax({
                                url: `${location.href.split('?')[0]}scraper/schedule/?date=${trueData[i].date}&gendersport=${trueData[i].gendersport}&state=${trueData[i].state}&index=${trueData[i].data[j].index}&url=${trueData[i].data[j].url}`,
                                type: 'GET',
                                success: (r) => {
                                    if (localStorage.getItem('execution') == 'true') {
                                        if (r.status == 200) {
                                            let home = handleHtmlTeams({
                                                icon: r.data.homeIcon,
                                                name: r.data.home,
                                                mascot: r.data.homeMascot,
                                                score: r.data.homeScore
                                            });
                                            let away = handleHtmlTeams({
                                                icon: r.data.awayIcon,
                                                name: r.data.away,
                                                mascot: r.data.awayMascot,
                                                score: r.data.awayScore
                                            });
                                            t.row.add([
                                                '',
                                                home,
                                                away,
                                                r.data.description,
                                                r.date,
                                                handleLinkTeams(r)
                                            ]).draw(false);
                                            if (JSON.parse(localStorage.getItem('teams')).length > 0) {
                                                $('p#description').text(r.data.description);
                                            }
                                            handleLog('info', r.message);
                                            counter++;
                                            $('#status-bar-schedule').html(`(${counter} of ${total})`);
                                            handleProgressBar('#progress-bar-schedule', counter, total);
                                            resolve();
                                        } else {
                                            reject(r.message);
                                        }
                                    } else {
                                        reject('Execution aborted');
                                    }
                                },
                                error: (e) => {
                                    if (e.statusText === 'abort') {
                                        reject('Execution aborted');
                                    }
                                    console.error(e);
                                }
                            });
                            ajaxTemp.push(singleAjax);
                        }));
                        if (j % threads == 0) {
                            await Promise.all(tasks).then((val) => {
                                if (localStorage.getItem('execution') == 'true') {
                                    tasks = [];
                                    console.log(counter + ' tasks success!');
                                } else {
                                    handleProgressBar('#progress-bar-url', 0, 1);
                                    handleProgressBar('#progress-bar-schedule', 0, 1);
                                    throw new Error('Execution aborted');
                                }
                            }).catch((e) => {
                                reject(e);
                            });
                        }
                        if (j == trueData[i].data.length - 1) {
                            await Promise.all(tasks).then((val) => {
                                if (localStorage.getItem('execution') == 'true') {
                                    tasks = [];
                                    console.log(counter + ' tasks success!');
                                    if (counter == total) {
                                        $('#status-bar-all').html(handleIcon('done') + ' Done');
                                        $("#progress-bar-schedule  > div").html("100% ✅");
                                        setTimeout(() => {
                                            showControlButton('start');
                                            resolve();
                                        }, 3000);
                                    }
                                } else {
                                    handleProgressBar('#progress-bar-url', 0, 1);
                                    handleProgressBar('#progress-bar-schedule', 0, 1);
                                    throw new Error('Execution aborted');
                                }
                            }).catch((e) => {
                                throw new Error(e);
                            });
                        }
                    } catch (e) {
                        reject(e);
                    }
                } else {
                    handleProgressBar('#progress-bar-url', 0, 1);
                    handleProgressBar('#progress-bar-schedule', 0, 1);
                    reject('Execution aborted');
                }
            }
        }
    });
}

async function loadSchedule(date, gendersport, state, threads) {
    localStorage.setItem('execution', 'true');

    while (localStorage.getItem('execution')) {
        t.clear().draw();
        // let allUrl = new Promise((resolve, reject) => {

        // resolve(allResult);
        // });
        let allUrl = await getAllUrl(date, gendersport, state, threads);
        clearInterval(intervalTemp);
        let total = allUrl.reduce((a, b) => {
            return a + b.total;
        }, 0);
        if (total > 0) {
            await getAllSchedule(await allUrl, threads);
        } else {
            abortExecution(false);
        }

        await delay(86400000);
    }
}

// utility
function delay(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

async function handleProgressBar(id, value, total) {
    let percent = Math.round((value / total) * 10000) / 100;
    $(id + " > div").html(percent + "%");
    $(id + " > div").css('width', percent + "%");
}

function showControlButton(status) {
    if (status == 'start') {
        localStorage.setItem('execution', 'false');
        $('#start-loading').css('display', '');
        $('#stop-loading').css('display', 'none');
    } else {
        localStorage.setItem('execution', 'true');
        $('#start-loading').css('display', 'none');
        $('#stop-loading').css('display', '');
    }
}

function handleLog(status, message) {
    // let datetime = moment.unix(Date.now()).format('YYYY-MM-DD HH:mm:ss');
    // let datetime = new Date().toJSON().split('.')[0].split('T').join(' ');
    let datetime = new Date().toLocaleString();
    if (status == 'success') {
        $('#loading-log').prepend(`<li style="color:green;"><small>${datetime}</small><div>${message}</div></li>`);
    } else if (status == 'info') {
        $('#loading-log').prepend(`<li style="color:#fff;"><small>${datetime}</small><div>${message}</div></li>`);
    } else if (status == 'warning') {
        $('#loading-log').prepend(`<li style="color: darkgoldenrod;"><small>${datetime}</small><div>${message}</div></li>`);
    } else if (status == 'error') {
        $('#loading-log').prepend(`<li style="color:red;"><small>${datetime}</small><div>${message}</div></li>`);
    }
    $('#loading-log').prop('scrollTop', 0);
}

function handleHtmlTeams(data) {
    return `
    <div class="row">
        <div class="col-lg-12">
            <div class="magic-box">
                <img src="${data.icon}" class="magic-image" />
            </div>
            <div>${data.name} (${data.mascot})</div>
            <div>${data.score}</div>
        </div>
    </div>`;
}

function handleLinkTeams(r) {
    let replaceWithPlus = (data) => {
        return data.replaceAll(' ', '+');
    };
    return `
    <ul>
        <ol>
            <a href="${location.href.split('?')[0]}?gendersport=${r.gendersport}&match=${r.data.match}" class="btn btn-success">
                <i class="icon fa fa-external-link-alt"></i> Main
            </a>
        </ol>
        <ol>
            <a href="${location.href.split('?')[0]}?gendersport=${r.gendersport}&match=${replaceWithPlus(r.data.home + ' vs ' + r.data.away)}" class="btn btn-primary">
                <i class="icon fa fa-external-link-alt"></i> Alternative 1
            </a>
        </ol>
        <ol>
            <a href="${location.href.split('?')[0]}?gendersport=${r.gendersport}&match=${replaceWithPlus(r.data.away + ' vs ' + r.data.home)}" class="btn btn-info">
                <i class="icon fa fa-external-link-alt"></i> Alternative 2
            </a>
        </ol>
        <ol>
            <a href="${r.data.url}" target="_blank" class="btn btn-warning">
                <i class="icon fa fa-external-link-alt"></i> Source
            </a>
        </ol>
    </ul>`;
}

function getDaysArray(start, end) {
    for (var arr = [], dt = new Date(start); dt <= end; dt.setDate(dt.getDate() + 1)) {
        arr.push(new Date(dt));
    }
    // return arr;
    return arr.map((v) => {
        return getTodayDate(v);
        // let date = v.toISOString().slice(0, 10).split('-');
        // return [date[1], date[2], date[0]].join('/');
    });
}

function convertDate(date, reverse = false) {
    let tempDate, year, month, day;
    if (reverse) {
        tempDate = date.split('-');
        year = tempDate[0];
        month = tempDate[1];
        day = tempDate[2];
        return [month, day, year].join('/');
    } else {
        tempDate = date.split('/');
        month = parseInt(tempDate[0]);
        day = parseInt(tempDate[1]);
        year = tempDate[2];
        return [year, month < 10 ? '0' + month : month, day < 10 ? '0' + day : day].join('-');
    }
}

function handleInvalidDate(startDate, endDate) {
    let prevStartDate = localStorage.getItem('start-date');
    let prevEndDate = localStorage.getItem('end-date');
    let caseDate = -1;
    if (new Date(startDate) > new Date(endDate)) {
        // $('#end-date').attr('min', startdate);
        if (startDate !== prevStartDate) {
            caseDate = 1;
            $('#end-date').val(startDate);
            localStorage.setItem('start-date', startDate);
        } else if (endDate !== prevEndDate) {
            caseDate = 2;
            $('#start-date').val(endDate);
            localStorage.setItem('end-date', endDate);
        } else {
            caseDate = 3;
            throw new Error('Unwanted error : date not change');
        }
    }
    return { startDate: $('#start-date').val(), endDate: $('#end-date').val(), case: caseDate };
}

function getTodayDate(date) {
    let day = date.getDate();
    let month = date.getMonth() + 1;
    let year = date.getFullYear();
    return [month < 10 ? '0' + month : month, day < 10 ? '0' + day : day, year].join('/');
}

function handleIcon(icon) {
    let res;
    switch (icon) {
        case 'loading':
            $('#status-bar-all').css('color', '#fff');
            res = '<i class="icon fa fa-spinner fa-pulse"></i>';
            break;
        case 'abort':
            $('#status-bar-all').css('color', 'red');
            res = '<i class="icon fa fa-stop"></i>';
            break;
        case 'empty':
            $('#status-bar-all').css('color', 'red');
            res = '<i class="icon fa fa-exclamation-triangle"></i>';
            break;
        case 'done':
            $('#status-bar-all').css('color', 'green');
            res = '<i class="icon fa fa-check-circle"></i>';
            break;
    }
    return res;
}

$('#clear-log').click(() => {
    $('#loading-log').empty();
});

//on change
async function loadData(options) {
    // { abort: false, nearestMode: true, metadata: false }
    let gendersport = $('#gender-sport').val();
    // let startDate = $('#start-date').val();
    // let endDate = $('#end-date').val();
    // let task1 = [],
    //     task2 = [];
    // if (abort) task1.push();
    // if (metadata)
    Promise.all(options.abort ? [await abortExecution()] : []).then(async() => {
        $('.real-data').prop('disabled', true);
        Promise.all(options.metadata ? [await handleTrueData(options.nearestMode, options.changeState), await loadMetadata(gendersport), await handleLocalTopbar(true, gendersport)] : [await handleTrueData(options.nearestMode, options.changeState)]).then(() => {
            $('.real-data').prop('disabled', false);
            autoExecution();
        }).catch(() => {
            console.error(e);
        });
        // setTimeout(() => {
        // }, 5000);
    }).catch((e) => {
        console.error(e);
    });
}


//start up
async function customStartUp() {
    showControlButton('stop');
    let currentUrl = new URL(location.href).searchParams;
    let today = getTodayDate(new Date());

    // gendersport
    if (currentUrl.get('gendersport') === '' || currentUrl.get('gendersport') === null) {
        location.href = '?gendersport=boys,football';
        // $('#gender-sport').val('boys,football');
        // localStorage.setItem('gender-sport', 'boys,football');
    } else {
        // $('#' + currentUrl.get("gendersport").replace(',', '')).addClass('active');
        $('#gender-sport').val(currentUrl.get('gendersport'));
    }

    // state
    if (localStorage.getItem('state') === null) {
        // window.history.pushState('page2', 'Title', '?gendersport=boys,football&state=al');
        $('#state').val('all');
        localStorage.setItem('state', 'all');
    } else {
        $('#state').val(localStorage.getItem('state'));
    }

    // date
    if (localStorage.getItem('start-date') === null) {
        $('#start-date').val(today);
        localStorage.setItem('start-date', today);
    }
    // else {
    //     $('#start-date').val(localStorage.getItem('start-date'));
    // }
    if (localStorage.getItem('end-date') === null) {
        $('#end-date').val(today);
        localStorage.setItem('end-date', today);
    }
    // else {
    //     $('#end-date').val(localStorage.getItem('end-date'));
    // }

    //match
    if (currentUrl.get('match') === '' || currentUrl.get('match') === null) {
        localStorage.setItem('teams', JSON.stringify([]));
        localStorage.setItem('is-match', 'true');
    } else {
        // format checking
        let match = currentUrl.get('match').toLowerCase();
        if (match.includes(' vs ')) {
            let teams = match.split(' vs ');
            if (teams[0] != '' && teams[1] != '') {
                localStorage.setItem('is-match', 'true');
                localStorage.setItem('teams', JSON.stringify(teams));
            } else {
                localStorage.setItem('is-match', 'false');
            }
        } else {
            localStorage.setItem('is-match', 'false');
        }
    }
    console.log(JSON.parse(localStorage.getItem('teams')));

    // threads
    if (localStorage.getItem('threads') === null) {
        $('#threads').val(4);
        localStorage.setItem('threads', 4);
    } else {
        $('#threads').val(localStorage.getItem('threads'));
    }

    // console.clear();
}

async function startUp() {
    // let currentUrl = new URL(location.href).searchParams;
    // let gendersport = currentUrl.get("gendersport");
    // handleLog('info', 'Loading metadata...');
    // await loadMetadata(gendersport);
    // handleLog('info', 'Loading topbar data...');
    // if (gendersport) {
    //     await handleLocalTopbar(true, gendersport);
    // }
    await handleLocalTopbar();
    await customStartUp();
    if (localStorage.getItem('is-match') == 'true') {
        await loadData({ abort: false, nearestMode: true, changeState: false, metadata: true });
    } else {
        alert('Incorrect format for "match" parameter! Example : "match=Team+A+vs+Team+B". Substring "+vs+" must required!');
        let gendersport = $('#gender-sport').val();
        await loadMetadata(gendersport);
        await handleLocalTopbar(true, gendersport);
        showControlButton('start');
    }
    // await loadSchedule(date, gendersport, state);
}

$(document).ready(() => {
    startUp();
    // $('.real-data').focus(async() => {
    //     abortExecution();
    // }).focusout(async() => {
    //     loadData(true);
    // });;
    // $('.real-data').change(async() => {
    //     loadData(true);
    // });
    $('#gender-sport').focus(() => {
        abortExecution();
    }).change(async() => {
        loadData({ abort: true, nearestMode: true, changeState: true, metadata: false });
    });
    $('#state').focus(() => {
        abortExecution();
    }).change(async() => {
        loadData({ abort: true, nearestMode: true, changeState: false, metadata: false });
    });
    $('#start-date,#end-date,#threads').focus(() => {
        // let today = new Date().toLocaleDateString();
        // let validDate = handleInvalidDate($('#start-date').val(), $('#end-date').val());
        // handleTrueData();
        abortExecution();
    }).change(async() => {
        loadData({ abort: true, nearestMode: false, changeState: false, metadata: false });
    });
    $('.gender-sport').click((e) => {
        let gendersport = e.target.id;
        $('#gender-sport').val(gendersport.replace('-', ',')).trigger('change');
    });
    $('.date-highlighted').tooltip();
});