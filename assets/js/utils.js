function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function htmlspecialchars(str) {
    var div = document.createElement('div');
    if (str) {
        div.appendChild(document.createTextNode(str));
        return div.innerHTML;
    }
    return '';
}
