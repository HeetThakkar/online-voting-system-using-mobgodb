function formSubmit(form) {
    var txt = `VOTED / मतदान किया <i class="fas fa-check fa-2x" style='color:darkgreen;'></i>`;
    document.getElementById("result").innerHTML = txt;
    setTimeout(function() {
        form.submit();
    }, 1000); // 1 seconds
    return false;
}