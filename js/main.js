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
async function handleTrueData(nearestMode = false) {
    let today = new Date().toLocaleDateString();
    let gendersport = $('#gender-sport').val();
    let state = $('#state').val();
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
            for (let i = 0; i < arrayState.length; i++) {
                if (!res.truestate.includes(arrayState[i].getAttribute('value').toUpperCase())) {
                    arrayState[i].setAttribute('disabled', 'disabled');
                }
            }
        },
        error: (e) => {
            console.error(e);
        }
    });
    ajaxTemp.push(singleAjax);
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
                    $('#img-desc').attr('src', 'https://dummyimage.com/768x554/000000/ffffff&text=Loading' + text);
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
                        $('#img-desc').attr('src', res.image);
                    } else {
                        $('.img-sport').attr('poster', res.defaultImage);
                        $('#img-desc').attr('src', res.defaultImage);
                    }
                } else {
                    $('.img-sport').attr('poster', 'https://dummyimage.com/768x554/000000/ffffff&text=' + res.message);
                    $('#img-desc').attr('src', 'https://dummyimage.com/768x554/000000/ffffff&text=' + res.message);
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

// async function changeParam(link) {
//     window.history.pushState('page2', 'Title', link);
//     $('.category-menu .child').removeClass('active');
//     $('#' + id).addClass('active');
//     let currentUrl = new URL(location.href).searchParams;
//     let gendersport = currentUrl.get("gendersport");

//     await loadSchedule(date, gendersport, state);
// }


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
                $('#status-bar-all').html(handleIcon('empty') + ' No schedules available!');
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
        console.log(startDate, endDate);
        let validDate = handleInvalidDate(startDate, endDate);
        console.log(validDate);
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
            location.href = '?gendersport=boys,football&state=al';
            // throw new Error('Gendersport is empty');
        }
        //state
        let state = $('#state').val();
        if (state === null || state.length === 0) {
            location.href = '?gendersport=boys,football&state=al';
            // throw new Error('State is empty');
        };
        //threads
        let threads = $('#threads').val();
        if (threads == '') throw new Error('Threads is empty');
        currentUrl.set('gendersport', gendersport);
        // currentUrl.set('startdate', convertDate(startDate, true));
        // currentUrl.set('enddate', convertDate(endDate, true));
        currentUrl.set('startdate', startDate);
        currentUrl.set('enddate', endDate);
        // currentUrl.set('stateArr', state.join(','));
        currentUrl.set('state', state);
        currentUrl.set('threads', threads);
        window.history.pushState('page2', 'Title', longUrl);
        handleProgressBar('#progress-bar-url', 0, 1);
        handleProgressBar('#progress-bar-schedule', 0, 1);
        await loadSchedule(allDate, gendersport, state, threads);
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
        $('.real-data').prop('disabled', false);
        setTimeout(() => {
            $('#status-bar-all').html('');
        }, 3000);
    } else {
        setTimeout(() => {
            $('.real-data').prop('disabled', true);
        }, 3000);
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
        // total = date.length * state.length,
        total = date.length,
        trueSchedule = 0,
        singleAjax;
    console.log(date);
    return new Promise(async(resolve, reject) => {
        $('#status-bar-url').html('(Processing...)');
        $('#true-schedule').html(trueSchedule);
        $('#status-bar-all').html(handleIcon('loading') + ' Load all possible url...');
        for (let x = 0; x < date.length; x++) {
            // for (let y = 0; y < state.length; y++) {
            if (localStorage.getItem('execution') == 'true') {
                try {
                    tasks.push(new Promise((resolve, reject) => {
                        singleAjax = $.ajax({
                            url: `${location.href.split('?')[0]}scraper/schedule/?date=${date[x]}&gendersport=${gendersport}&state=${state}`,
                            type: 'GET',
                            success: (res) => {
                                if (localStorage.getItem('execution') == 'true') {
                                    trueSchedule += res.total;
                                    $('#true-schedule').html(trueSchedule);
                                    handleLog('info', res.message);
                                    counter++;
                                    $('#status-bar-url').html(`(${counter} of ${total})`);
                                    handleProgressBar('#progress-bar-url', counter, total);
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
                    if (loop == date.length) {
                        await Promise.all(tasks).then((val) => {
                            if (localStorage.getItem('execution') == 'true') {
                                tasks = [];
                                allResult = allResult.concat(val);
                                console.log(loop + ' tasks success!');
                                $("#progress-bar-url > div").html("100% ✅");
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
            // }
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
                                            t.row.add([
                                                '',
                                                r.data.home,
                                                r.data.away,
                                                r.data.description,
                                                r.data.date,
                                                r.data.gendersport,
                                                r.data.state
                                            ]).draw(false);
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
        $('#loading-log').prepend(`<li style="color:black;"><small>${datetime}</small><div>${message}</div></li>`);
    } else if (status == 'warning') {
        $('#loading-log').prepend(`<li style="color: darkgoldenrod;"><small>${datetime}</small><div>${message}</div></li>`);
    } else if (status == 'error') {
        $('#loading-log').prepend(`<li style="color:red;"><small>${datetime}</small><div>${message}</div></li>`);
    }
    $('#loading-log').prop('scrollTop', 0);
}

function getDaysArray(start, end) {
    for (var arr = [], dt = new Date(start); dt <= end; dt.setDate(dt.getDate() + 1)) {
        arr.push(new Date(dt));
    }
    // return arr;
    return arr.map((v) => {
        return v.toLocaleDateString();
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

function handleIcon(icon) {
    let res;
    switch (icon) {
        case 'loading':
            $('#status-bar-all').css('color', 'black');
            res = '<i class="icon fa fa-spinner fa-pulse"></i>';
            break;
        case 'abort':
            $('#status-bar-all').css('color', 'red');
            res = '<i class="icon fa fa-stop"></i>';
            break;
        case 'empty':
            $('#status-bar-all').css('color', '#CCCC00');
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
    Promise.all(options.abort ? [await abortExecution()] : []).then(() => {
        handleTrueData(options.nearestMode);
    }).then(async() => {
        Promise.all(options.metadata ? [await loadMetadata(gendersport), await handleLocalTopbar(true, gendersport)] : []).then(() => {
            console.log('test');
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
    let currentUrl = new URL(location.href).searchParams;
    // let today = new Date().toISOString().split('T')[0];
    let today = new Date().toLocaleDateString();

    if (currentUrl.get("gendersport") === '' || currentUrl.get("gendersport") === null) {
        window.history.pushState('page2', 'Title', '?gendersport=boys,football&state=al');
        $('#gender-sport').val('boys-football');
    } else {
        // $('#' + currentUrl.get("gendersport").replace(',', '')).addClass('active');
        $('#gender-sport').val(currentUrl.get("gendersport"));
    }
    if (currentUrl.get('state') !== null) {
        $('#state').val(currentUrl.get('state'));
    } else {
        window.history.pushState('page2', 'Title', '?gendersport=boys,football&state=al');
        $('#gender-sport').val('boys,football');
    }
    if (currentUrl.get('startdate') === null) {
        $('#start-date').val(today);
        localStorage.setItem('start-date', today);
    } else {
        $('#start-date').val(currentUrl.get('startdate'));
        localStorage.setItem('start-date', currentUrl.get('startdate'));
    }
    if (currentUrl.get('enddate') === null) {
        $('#end-date').val(today);
        localStorage.setItem('end-date', today);
    } else {
        $('#end-date').val(currentUrl.get('enddate'));
        localStorage.setItem('end-date', currentUrl.get('enddate'));
    }
    // console.clear();
}

async function startUp() {
    // let currentUrl = new URL(location.href).searchParams;
    // let gendersport = currentUrl.get("gendersport");
    // handleLog('info', 'Loading metadata...');
    // await loadMetadata(gendersport);
    // handleLog('info', 'Loading topbar data...');
    await handleLocalTopbar();
    // if (gendersport) {
    //     await handleLocalTopbar(true, gendersport);
    // }
    await customStartUp();
    await loadData({ abort: false, nearestMode: true, metadata: true });
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
    $('#gender-sport,#state').focus(() => {
        abortExecution();
    }).change(async() => {
        loadData({ abort: true, nearestMode: true, metadata: true });
    });
    $('#start-date,#end-date,#threads').focus(() => {
        // let today = new Date().toLocaleDateString();
        // let validDate = handleInvalidDate($('#start-date').val(), $('#end-date').val());
        // handleTrueData();
        abortExecution();
    }).change(async() => {
        loadData({ abort: true, nearestMode: false, metadata: false });
    });
    $('.gender-sport').click((e) => {
        let gendersport = e.target.id;
        $('#gender-sport').val(gendersport.replace('-', ',')).trigger('change');
    });
    $('.date-highlighted').tooltip();
});