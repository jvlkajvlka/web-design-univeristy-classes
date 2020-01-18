function currentDate() {
    setDay();
    setTime();
}

function setDay() {
    var t1 = new Date();
    z1 = "";
    z2 = "";
    if (t1.getDate() <= 9) {
        z1 = "0";
    }
    if (t1.getMonth() <= 9) {
        z2 = "0";
    }
    document.getElementById("iddata").value = t1.getFullYear() + "-" + z2 + (t1.getMonth() + 1) + "-" + z1 + t1.getDate();
}

function setTime() {
    var t1 = new Date();
    z1 = "";
    if (t1.getMinutes() <= 9) {
        z1 = "0";
    }
    document.getElementById("idtime").value = (t1.getHours()) + ":" + z1 + t1.getMinutes();
}

function checkDate() {
    var currDate = document.getElementById('iddata').value;

    var rgxDate = /^([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))$/gi;
    if (!rgxDate.test(currDate)) {
        setDay();
    }

    var now = new Date();
    var dateParts = currDate.split('-');
    var parsed = new Date(dateParts[0], parseInt(dateParts[1]) - 1, parseInt(dateParts[2]));

    if (parsed > now) {
        alert('Nie możesz podać daty z przyszłości!');
        setDay();
    }
}

function checkTime() {
    var currTime = document.getElementById('idtime').value;
    var rgxTime = /^([0-9]|0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/gi;
    if (!rgxTime.test(currTime)) {
        setTime();
    }

    var now = new Date();
    var timeParts = currTime.split(':');
    var parsed = new Date(now.getFullYear(), now.getMonth(), now.getDate(), parseInt(timeParts[0]), parseInt(timeParts[1]));

    if (parsed > now) {
        alert('Nie możesz podać czasu z przyszłości!');
        setTime();
    }
}

function listOfAttachments() {
    var attachments = document.getElementById('attachments');
    var numberOfLines = attachments.children.length; //ilosc linii w divie
    var fileNo = numberOfLines / 2; //ilosc inputów na pliki (- znaczniki br)

    var input = document.createElement('input');
    input.type = "file";
    input.name = "file" + fileNo;
    input.onchange = function () { listOfAttachments(); }; //wywołanie rekurencyjne

    attachments.appendChild(input);
    attachments.appendChild(document.createElement("br"));

}

function listOfStyles() {
    var list = "";
    for (var i = 0; (styl = document.getElementsByTagName("link")[i]); i++) {
        if (styl.getAttribute("title")) {
            title = styl.getAttribute("title");
            list += "<li><a href=\"#\" onclick=\"setStyle('" + title + "'); return false;\">" + title + "</a></li>";
        }
    }
    document.getElementById('ListStyles').innerHTML = "<p><h1>Wybierz styl:</p></h1><ul>" + list + "</ul>";
}
// Ustawienie stylu
function setStyle(styleTitle) {
    var style;
    for (var i = 0; (style = document.getElementsByTagName("link")[i]); i++) {
        if (style.getAttribute('title')) {
            style.disabled = true;
            if (style.getAttribute('title') == styleTitle) {
                style.disabled = false;
            }
        }
    }
}

//utwórz ciasteczko - ważne 5 dni od daty
function makeCookie(nameOfCookie, styleToRemeber) {
    var data = new Date();
    var days = 5;
    data.setTime(data.getTime() + (days * 24 * 60 * 60 * 1000));
    var expiration = "expires=" + data.toGMTString();
    document.cookie = nameOfCookie + "=" + styleToRemeber + ";" + expiration + ";";
}
//odczytuj ciasteczko: zwraca nazwę stylu
function readCookie(nameOfCookie) {
    var name = nameOfCookie + "="; //żeby odczytać nazwe stylu
    var cookie_arr = document.cookie.split(";");

    for (var i = 0; i < cookie_arr.length; i++) {
        var word = cookie_arr[i]; //wyrazy z tab ciastek
        while (word.charAt(0) == ' ') { //usunięcie białych znakow
            word = word.substring(1, word.length);
        }
        if (word.indexOf(name) == 0) {
            return word.substring(name.length, word.length);
        }
        return null;
    }
}
//odczytaj aktualny styl
function currentStyle() {
    var currentStyle;
    for (var i = 0; (currentStyle = document.getElementsByTagName("link")[i]); i++) {
        if (!currentStyle.disabled) {
            return currentStyle.getAttribute("title");
        }
    }
    return null;
}
//ładuje ciasteczko i ustawia styl strony 
function loadCookie() {
    var cookie = readCookie("style");
    if (cookie) {
        var styleTitle = cookie;
    } else {
        var styleTitle = currentStyle();
    }
    setStyle(styleTitle); //ustalenie styl strony
}

// ---------------------------------------------------- //
//ladujemy stronke, odczytujemy cookie i ustalamy styl 
window.onload = loadCookie();
//gdy opuszczamys stronę ->
window.onunload = function (e) {
    var title = currentStyle();
    makeCookie("style", title);
}
// przy ladowaniu z innych podstron
loadCookie();

















//-----------------------------------zad 2 ------------------------------------//
function stworzNowyPrzyciskZalacznika() {
    if (ilosc_pol_zalacznikow < MAX_ZALACZNIKOW) {
        ilosc_pol_zalacznikow++;

        var nowyPrzycisk = document.createElement('input');
        nowyPrzycisk.setAttribute("type", "file");
        nowyPrzycisk.setAttribute("name", "zalacznik" + ilosc_pol_zalacznikow);
        nowyPrzycisk.setAttribute("onclick", "stworzNowyPrzyciskZalacznika()");

        var nowa_linia = document.createElement('br');

        var pole_zalacznikow = document.getElementById("dodawanie_zalacznikow");
        pole_zalacznikow.appendChild(nowyPrzycisk);
        pole_zalacznikow.appendChild(nowa_linia);
    }
}

function stworzStyle() {
    var style = document.getElementsByTagName("link");
    var iloscStyli = style.length;
    console.log(iloscStyli);

    var spisTresci = document.getElementById("miejsce_na_style");

    for (i = 0; i < iloscStyli; i++) {
        var aktualnyElement = document.createElement('a');
        var nazwaStylu = style[i].title;

        aktualnyElement.innerHTML = nazwaStylu;
        aktualnyElement.setAttribute("onclick", "wybierzStyl(\"" + nazwaStylu + "\")");

        console.log("AA");
        spisTresci.appendChild(aktualnyElement);
        spisTresci.appendChild(document.createElement('br'));
    }


}

function wybierzStyl(nazwaStylu) {
    var listaStyli = document.getElementsByTagName("link");
    var iloscStyli = listaStyli.length;
    for (var i = 0; i < iloscStyli; i++) {
        var styl = listaStyli[i];
        if (styl.getAttribute("title") == nazwaStylu) {
            styl.disabled = false;
            console.log(styl.getAttribute("title") + " enabled");
        } else {
            styl.disabled = true;
            console.log(styl.getAttribute("title") + " disabled");
        }
    }

    ustawCiasteczko("style", nazwaStylu, 365);
}
