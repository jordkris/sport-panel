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
            } else {
                $(dom).attr('src', 'https://dummyimage.com/768x554/000000/ffffff&text=' + res.message);
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
            } else {
                $('.img-sport').attr('src', 'https://dummyimage.com/768x554/000000/ffffff&text=' + res.message);
            }
            let baseHeight = $('.img-sport')[0].clientHeight;
            $('#img-sport-left').css('height', baseHeight + 'px');
            $('#img-sport-right').css('height', baseHeight + 'px');
        },
        error: (e) => {
            console.error(e);
        }
    });
    let topbar = JSON.parse(localStorage.getItem('topbar'));
    let totalGenderSport;
    if (topbar) {
        totalGenderSport = Object.keys(topbar).length;
        handleMainImage(topbar.at(Math.floor(Math.random() * totalGenderSport)), '#img-sport-left');
        handleMainImage(topbar.at(Math.floor(Math.random() * totalGenderSport)), '#img-sport-right');
    } else {
        $.ajax({
            url: location.href.split('?')[0] + 'topbar.json',
            type: 'GET',
            success: (res) => {
                totalGenderSport = Object.keys(res).length;
                handleMainImage(res.at(Math.floor(Math.random() * totalGenderSport)), '#img-sport-left');
                handleMainImage(res.at(Math.floor(Math.random() * totalGenderSport)), '#img-sport-right');
                localStorage.setItem('topbar', JSON.stringify(res));
            },
            error: (e) => {
                console.error(e);
            }
        });
    }
}


async function changeParam(link) {
    window.history.pushState('page2', 'Title', link);
    let currentUrl = new URL(location.href).searchParams;
    let date = currentUrl.get('date');
    let gendersport = currentUrl.get("gendersport");
    let state = currentUrl.get('state');
    // let gendersport = link.split('gendersport=')[1];
    handleLocalTopbar(true, gendersport);
    loadMetadata(gendersport);
    await loadSchedule(date, gendersport, state);
}



// datatables
async function loadSchedule(date, gendersport, state) {
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
    t.clear().draw();
    $('th.text-justify').removeClass('text-justify').addClass('text-center');
    $.ajax({
        url: `${location.href.split('?')[0]}scraper/schedule/?date=${date}&gendersport=${gendersport}&state=${state}`,
        type: 'GET',
        success: (res) => {
            if (res.status == 200) {
                try {
                    let tasks = [],
                        val;
                    let thread = 5;
                    for (let i = 0; i < res.data.length; i++) {
                        val = res.data[i];
                        console.log(val, i);
                        tasks.push(new Promise(async(resolve, reject) => {
                            $.ajax({
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
                                        resolve();
                                    }
                                },
                                error: (e) => {
                                    reject(e);
                                }
                            });
                        }));
                        if (i % thread == 0) {
                            await Promise.all(tasks).then((val) => {
                                console.log((i + 1) + ' tasks success!');
                            });
                            tasks = [];
                        }
                        if (i == res.data.length - 1) {
                            await Promise.all(tasks).then((val) => {
                                console.log((i + 1) + ' tasks success!');
                            });
                            tasks = [];
                        }
                    }
                    t.on('order.dt search.dt', function() {
                        t.column(0, { search: 'applied', order: 'applied' }).nodes().each(function(cell, i) {
                            cell.innerHTML = i + 1;
                        });
                    }).draw();
                } catch (e) {
                    console.error(e);
                }
            }
        },
        error: (e) => {
            console.error(e);
        }
    });
}

async function startUp() {
    let currentUrl = new URL(location.href).searchParams;
    let date = currentUrl.get('date');
    let gendersport = currentUrl.get("gendersport");
    let state = currentUrl.get('state');
    await loadMetadata(gendersport);
    await handleLocalTopbar();
    if (gendersport) {
        await handleLocalTopbar(true, gendersport);
    }
    await loadSchedule(date, gendersport, state);
}

$(document).ready(function() {
    startUp();
});