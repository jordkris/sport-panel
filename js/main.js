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

// custom scripts
async function handleLocalTopbar(modifyMode = false, data = null) {
    if (modifyMode) {
        $.ajax({
            url: location.href.split('?')[0] + 'sportData.json',
            type: 'GET',
            success: (res) => {
                let oldTopbar = JSON.parse(localStorage.getItem('topbar'));
                let newTopbar = JSON.parse(localStorage.getItem('topbar'));
                newTopbar.sort(function(x, y) { return x == data ? -1 : y == data ? 1 : 0; });
                $('.top-menu').children().each((index, element) => {
                    let onclickAttr = element.getAttribute('onclick');
                    element.setAttribute('onclick', onclickAttr.replace(oldTopbar[index], newTopbar[index]));
                    element.innerHTML = element.innerHTML.replace(res[oldTopbar[index]], res[newTopbar[index]]);
                });
                localStorage.setItem('topbar', JSON.stringify(newTopbar));
                let totalGenderSport = Object.keys(newTopbar).length;
                handleMainImage(newTopbar.at(Math.floor(Math.random() * totalGenderSport)), '#img-sport-left');
                handleMainImage(newTopbar.at(Math.floor(Math.random() * totalGenderSport)), '#img-sport-right');
            },
            error: (e) => {
                console.error(e);
            }
        });
    } else {
        $.ajax({
            url: location.href.split('?')[0] + 'topbar.json',
            type: 'GET',
            success: (res) => {
                localStorage.setItem('topbar', JSON.stringify(res));
            },
            error: (e) => {
                console.error(e);
            }
        });
    }
}

async function handleMainImage(gendersport, dom) {
    let tempInterval;
    $.ajax({
        url: location.href.split('?')[0] + 'scraper/metadata/?gendersport=' + gendersport,
        type: 'GET',
        beforeSend: () => {
            let num, text;
            tempInterval = setInterval(function() {
                num = new Date().getSeconds() % 3 + 1;
                text = '.'.repeat(num) + '%20'.repeat(3 - num);
                $(dom).attr('src', 'https://dummyimage.com/768x554/000000/ffffff&text=Loading' + text);
            }, 1000);
        },
        success: (res) => {
            clearInterval(tempInterval);
            if (res.status == 200) {
                if (res.image !== '' && res.image !== null) {
                    $(dom).attr('src', res.image);
                } else {
                    $(dom).attr('src', res.defaultImage);
                }
                handleLog('success', 'Success load image from ' + res.source);
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
}

async function loadMetadata(gendersport) {
    let tempInterval;
    $.ajax({
        url: location.href.split('?')[0] + 'scraper/metadata/?gendersport=' + gendersport,
        type: 'GET',
        beforeSend: () => {
            $('.top-menu').css('display', 'none');
            $('.loading-menu').css('display', '');
            let text, text2, num;
            tempInterval = setInterval(function() {
                num = new Date().getSeconds() % 3 + 1;
                text = '.'.repeat(num) + '%20'.repeat(3 - num);
                text2 = '.'.repeat(num);
                $('.img-sport').attr('src', 'https://dummyimage.com/768x554/000000/ffffff&text=Loading' + text);
                $('.loading-label').html('Loading' + text2);
            }, 1000);
        },
        success: (res) => {
            $('.top-menu').css('display', '');
            $('.loading-menu').css('display', 'none');
            clearInterval(tempInterval);
            if (res.status == 200) {
                if (res.image != '' && res.image !== null) {
                    $('.img-sport').attr('src', res.image);
                } else {
                    $('.img-sport').attr('src', res.defaultImage);
                }
                handleLog('success', 'Success load image from ' + res.source);
            } else {
                $('.img-sport').attr('src', 'https://dummyimage.com/768x554/000000/ffffff&text=' + res.message);
                handleLog('warning', res.message);
            }
            let baseHeight = $('.img-sport')[0].clientHeight;
            $('#img-sport-left').css('height', baseHeight + 'px');
            $('#img-sport-right').css('height', baseHeight + 'px');
        },
        error: (e) => {
            handleLog('error', e || e.getMessage());
            console.error(e);
        }
    });
    // let topbar = JSON.parse(localStorage.getItem('topbar'));
    // let totalGenderSport;
    // if (topbar) {
    //     totalGenderSport = Object.keys(topbar).length;
    //     handleMainImage(topbar.at(Math.floor(Math.random() * totalGenderSport)), '#img-sport-left');
    //     handleMainImage(topbar.at(Math.floor(Math.random() * totalGenderSport)), '#img-sport-right');
    // } else {
    //     $.ajax({
    //         url: location.href.split('?')[0] + 'topbar.json',
    //         type: 'GET',
    //         success: (res) => {
    //             totalGenderSport = Object.keys(res).length;
    //             handleMainImage(res.at(Math.floor(Math.random() * totalGenderSport)), '#img-sport-left');
    //             handleMainImage(res.at(Math.floor(Math.random() * totalGenderSport)), '#img-sport-right');
    //             localStorage.setItem('topbar', JSON.stringify(res));
    //         },
    //         error: (e) => {
    //             console.error(e);
    //         }
    //     });
    // }
}

async function changeParam(link) {
    window.history.pushState('page2', 'Title', link);
    let currentUrl = new URL(location.href).searchParams;
    let gendersport = currentUrl.get("gendersport");
    handleLocalTopbar(true, gendersport);
    loadMetadata(gendersport);
    // await loadSchedule(date, gendersport, state);
}

// excecution data
let execution = false;
let ajaxTemp;

async function beginExecution() {
    try {
        let currentUrl = new URL(location.href).searchParams;
        let startDate = $('#start-date').val();
        let endDate = $('#end-date').val();
        if (startDate == '') throw new Error('Start date is empty');
        if (endDate == '') throw new Error('End date is empty');
        if (startDate > endDate) throw new Error('Start date must be less than or equal to end date');
        let allDate = getDaysArray(new Date(startDate), new Date(endDate));
        let gendersport = currentUrl.get("gendersport");
        let stateArr = $('#state').val();
        if (stateArr === null || stateArr.length === 0) throw new Error('State is empty');
        await loadSchedule(allDate, gendersport, stateArr);
    } catch (e) {
        showControlButton('start');
        handleLog('error', e || e.getMessage());
    }
}

function abortExecution() {
    execution = false;
    if (ajaxTemp !== undefined) {
        ajaxTemp.abort();
    }
    handleProgressBar(0);
}

$('#start-loading').click(() => {
    console.log('click start');
    showControlButton('stop');
    beginExecution();
});
$('#stop-loading').click(() => {
    console.log('click stop');
    showControlButton('start');
    abortExecution();
});

async function loadSchedule(date, gendersport, state) {
    handleLog('info', 'Loading schedule...');
    execution = true;
    let allResult = [],
        result, tasks, val, thread = 5,
        counter = 0,
        total = 0;
    while (execution) {
        t.clear().draw();
        for (let x = 0; x < date.length; x++) {
            for (let y = 0; y < state.length; y++) {
                try {
                    result = await new Promise((resolve, reject) => {
                        $.ajax({
                            url: `${location.href.split('?')[0]}scraper/schedule/?date=${date[x]}&gendersport=${gendersport}&state=${state[y]}`,
                            type: 'GET',
                            success: (res) => {
                                if (res.status == 200) {
                                    handleLog('info', res.message);
                                    resolve(res);
                                } else {
                                    reject(res.message);
                                }
                            },
                            error: (e) => {
                                handleLog('error', e || e.getMessage());
                                console.error(e);
                                reject(e);
                            }
                        });
                    });
                    allResult.push(await result);
                    total += await result.total;
                    console.log(await result);
                } catch (err) {
                    handleLog('error', err || err.getMessage());
                    console.error(err);
                }
            }
        }
        try {
            throw new Error('custom error');
            tasks = [];
            for (let i = 0; i < total; i++) {
                result = await allResult[i];
                if (execution) {
                    val = await result.data[i];
                    console.log(await val);
                    tasks.push(new Promise((resolve, reject) => {
                        ajaxTemp = $.ajax({
                            url: `${location.href.split('?')[0]}scraper/schedule/?date=${date}&gendersport=${gendersport}&state=${state}&index=${val.index}&url=${val.url}`,
                            type: 'GET',
                            success: (r) => {
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
                                    counter++;
                                    handleProgressBar(Math.round((counter / result.data.length) * 10000) / 100);
                                    resolve();
                                } else {
                                    reject(r.message);
                                }
                            },
                            error: (e) => {
                                console.log(e);
                                reject(e);
                            }
                        });
                    }));
                    if (i % thread == 0) {
                        await Promise.all(tasks).then((val) => {
                            tasks = [];
                            console.log(counter + ' tasks success!');
                        }).catch((e) => {
                            throw new Error(e);
                        });
                    }
                    if (i == result.data.length - 1) {
                        await Promise.all(tasks).then((val) => {
                            tasks = [];
                            console.log(counter + ' tasks success!');
                            $(".progress-bar-striped > div").html(value + "% ✅");
                            showControlButton('start');
                        }).catch((e) => {
                            throw new Error(e);
                        });

                    }
                } else {
                    throw new Error('Execution aborted');
                }
            }
        } catch (err) {
            showControlButton('start');
            handleLog('error', err || err.getMessage());
            console.error(err);
        }
        await delay(86400000);
    }
}

// utility
function delay(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

async function handleProgressBar(value) {
    $(".progress-bar-striped > div").html(value + "%");
    $(".progress-bar-striped > div").css('width', value + "%");
}

function showControlButton(status) {
    if (status == 'start') {
        $('#start-loading').css('display', '');
        $('#stop-loading').css('display', 'none');
    } else {
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
        $('#loading-log').prepend(`<li style="color:yellow;"><small>${datetime}</small><div>${message}</div></li>`);
    } else if (status == 'error') {
        $('#loading-log').prepend(`<li style="color:red;"><small>${datetime}</small><div>${message}</div></li>`);
    }
    $('#loading-log').prop('scrollTop', 0);
}

function getDaysArray(start, end) {
    for (var arr = [], dt = new Date(start); dt <= end; dt.setDate(dt.getDate() + 1)) {
        arr.push(new Date(dt));
    }
    return arr.map((v) => {
        let date = v.toISOString().slice(0, 10).split('-');
        return [date[1], date[2], date[0]].join('/');
    });
}

function convertDate(date) {
    let tempDate = date.split('/');
    return [tempDate[2], tempDate[1], tempDate[0]].join('-');
}

$('#clear-log').click(() => {
    $('#loading-log').empty();
});

//start up
function customStartUp() {
    let currentUrl = new URL(location.href).searchParams;
    let today = new Date().toISOString().split('T')[0];
    if (currentUrl.get('state') !== null) {
        $('#state').select2({ width: '100%' }).val(currentUrl.get('state').split(',')).trigger('change');
    } else {
        $('#state').select2({ width: '100%' });
    }
    if (currentUrl.get('startdate') === null) {
        $('#start-date').val(today);
    } else {
        $('#start-date').val(convertDate(currentUrl.get('startdate')));
    }
    if (currentUrl.get('enddate') === null) {
        $('#end-date').val(today);
    } else {
        $('#end-date').val(convertDate(currentUrl.get('enddate')));

    }
    console.clear();
}

async function startUp() {
    let currentUrl = new URL(location.href).searchParams;
    let gendersport = currentUrl.get("gendersport");
    handleLog('info', 'Loading metadata...');
    await loadMetadata(gendersport);
    handleLog('info', 'Loading topbar data...');
    await handleLocalTopbar();
    if (gendersport) {
        await handleLocalTopbar(true, gendersport);
    }
    customStartUp();
    // await loadSchedule(date, gendersport, state);
}

$(document).ready(function() {
    startUp();
});