var pollXhr = null;
var checkbox = document.querySelector('#chatOn');
var chatRoom = document.querySelector('.chatRoom');
var usernameInput = document.querySelector('#username');
var messageInput = document.querySelector('#message');
var sendButton = document.querySelector('.buttontoSend');
var chatForm = document.querySelector('.formofChat');

checkbox.addEventListener('change', onCheckbox);
chatForm.addEventListener('submit', onMessageSubmit)


function onCheckbox(event) {
    setChatOn(event.target.checked);
}


function setChatOn(enabled) {
    usernameInput.disabled = !enabled;
    messageInput.disabled = !enabled;
    sendButton.disabled = !enabled;

    if (enabled) {
        fetchCurrentMessages();
        pollMessages();
    } else {
        //off czat, usun wiadomosci i end pool
        setChatText('');
        pollXhr.abort();
    }
}


function fetchCurrentMessages() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'poll.php?fetch=true');
    xhr.send();

    // Wykonuje się po odebraniu odpowiedzi od serwera
    xhr.onload = function () {
        if (xhr.status != 200) {
            alert('Błąd ' + xhr.status + ': ' + xhr.statusText);
        } else {
            // Ustawiamy wiadomości w chacie na te zwrócone przez serwer
            setChatText(xhr.responseText);
        }
    };

    xhr.onerror = function () {
        alert('Błąd podczas wysyłania zapytania');
    };
}

function setChatText(messages) {
    chatRoom.value = messages;
}

function onMessageSubmit(event) {
    event.preventDefault();

    if (!usernameInput.value || !messageInput.value) {
        alert('Wypełnij pola Nick i Wiadomość');
        return;
    }

    var formData = new FormData(event.target);
    var xhr = new XMLHttpRequest();

    xhr.open('POST', 'chat_load.php');
    xhr.send(formData);

    chatRoom.value += usernameInput.value + ': ' + messageInput.value;

    messageInput.value = '';
}


function pollMessages() {
    pollXhr = new XMLHttpRequest();
    pollXhr.open('GET', 'poll.php');
    pollXhr.send();

    pollXhr.onload = function () {
        if (pollXhr.status != 200) {
            alert('Błąd ' + pollXhr.status + ': ' + pollXhr.statusText);
        } else {
            // Ustawiamy wiadomości w chatboxie
            setChatText(pollXhr.responseText);
            // Otwieramy połączenie ponownie
            pollMessages();
        }
    };

    pollXhr.onerror = function () {
        alert('Błąd z wysłaniem zapytania');
        pollMessages();
    };
}