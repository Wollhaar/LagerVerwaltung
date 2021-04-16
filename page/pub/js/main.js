global_data = null;
default_page = 'home';

function modal(header, content) {
    let modal = $(".modal").clone();
    $(modal).find(".modal-header").text(header);
    $(modal).find(".modal-body").text(content);

    $("body").append(modal);
    $(modal).show();
}
