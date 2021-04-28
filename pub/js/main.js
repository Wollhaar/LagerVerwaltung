global_data = null;
default_page = 'home';

function init() {
    default_link();
}

function create(name) {
    return document.createElement(name);
}

function default_link() {
    $("a#header-link").attr('href', default_page);
}

function build_input(attr, value, type) {
    let input = create('input');
    $(input).attr('type', type);
    $(input).attr('name', attr);
    $(input).val(value);
    $(input).addClass(type + '-values');

    return input;
}

function build_button(value) {
    let btn = create('button');
    $(btn).text(value);
    $(btn).attr('type', 'button');
    $(btn).attr('onclick', 'open_record($(this).closest("tr").children("input[type=hidden]"))');
    $(btn).addClass('btn');

    return btn;
}

function put_into_table(header, content) {
    let table = $(".table-default").clone();
    $(table).removeClass("table-default");
    $(table).addClass('table-' + header);
    $(table).find(".table-header").text(header);

    for (let record of Object.values(content)) {
        let row = create('tr');

        for (let data of Object.keys(record)) {
            let input = build_input(data, record[data], 'hidden');

            let cell = create('td');
            if (data === 'action') {
                $(cell).html(build_button(record[data]));
                row.append(cell);
                continue;
            }
            data = record[data];

            $(cell).text(data);
            row.append(input);
            row.append(cell);
        }
        $(table).find(".table-results").append(row);
    }

    $("#body").html(table);
    $(table).show();
}

function open_record(data) {
    let fields = build_fields(data);
    console.log(fields);

    modal('Bearbeite Datensatz', fields);
}

function getData(data)
{
    return $(data).map(function() {
        return this.value;
    }).get();
}

function build_fields(data)
{
    return $(data).map(function() {
        return build_input(this.name, this.value, 'text');
    }).get();
}

function modal(header, content) {
    let modal = $(".modal").clone();
    $(modal).find(".modal-header h5").text(header);
    $(modal).find(".modal-body").html(content);

    $("body").append(modal);
    $(modal).show();
}

$(document).ready(function() {
    init();

    $("#side-menu button").click(function() {
        let topic = $(this).text();
        // $("#body").html('');
        put_into_table(topic, {0:{name:'chuck tester', adress: 'Kuster-Straße 11', date: '03.11.20', sender: 'Kühne+Nagel', receiver: 'IBM', action: 'Öffnen'}, 1:{name: 'max tester', adress: 'Muster-Allee 14', date: '12.10.16', sender: 'Detlef Louis', receiver: 'BIM', action: 'Öffnen'}});
    });

    $("button[data-toggle=modal]").click(function() {
        modal('Test', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu.');
    });

    $(".modal button:contains(Close)").click(function() {
        $(this).closest(".modal").remove();
    });
});