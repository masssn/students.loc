window.onload = function () {
    var elems = document.getElementsByTagName('td');
    var get = window.location.search.replace('?', '').split('=');
    var s = decodeURI(get[1]);
    for (i = 0; i < elems.length; i++) {
        if (elems[i].innerText == s.charAt(0).toUpperCase() + s.substr(1)) {
            elems[i].style.backgroundColor = 'red';
            console.log(elems[i].style.borderColor);
        }
    }
}