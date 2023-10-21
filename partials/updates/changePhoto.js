/* document.addEventListener('DOMContentLoaded', function() {
    function photo() {
        const img = document.getElementById('foto');
        const urlInput = document.getElementById('urlfoto');
        const url = urlInput.value;
        img.src = url;
    }

    const urlInput = document.getElementById('urlfoto');
    urlInput.addEventListener('input', photo);
}); */

function photo() {
    const img = document.getElementById('foto');
    const urlInput = document.getElementById('urlfoto');
    const url = urlInput.value;
    img.src = url;
}