$("#your_button").click(function (event) {
    // if you use an hyperlink like I do
    event.preventDefault();
    $(this).blur();
    var hideAll = true;
    $(".panel-details").each(function () {
        if (!$(this).hasClass("in")) {
            hideAll = false;
        }
    });
    $(".panel-details").collapse(hideAll ? "hide" : "show");
});


