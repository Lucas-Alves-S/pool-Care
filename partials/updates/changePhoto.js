function photo() {
    const img = document.getElementById('foto');
    const urlInput = document.getElementById('urlfoto');
    const url = urlInput.value;
    img.src = url;
}