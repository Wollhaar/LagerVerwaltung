global_data = null;
default_page = 'home';

function init() {
    default_link();
}

function default_link() {
    $("a#header-link").attr('href', default_page);
}

function modal(header, content) {
    let modal = $(".modal").clone();
    $(modal).find(".modal-header h5").text(header);
    $(modal).find(".modal-body p").text(content);

    $("body").append(modal);
    $(modal).show();
}

$(document).ready(function() {
    init();

    $(".modal button:contains(Close)").click(function() {

    });
});