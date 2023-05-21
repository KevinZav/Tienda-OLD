window.print();

window.addEventListener("afterprint", function(event) {
    window.close();
});