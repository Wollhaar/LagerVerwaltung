let global_data = null;
let default_page = 'home';

function init() {
    global_data = {user: {authenticated: true, first_name: 'David', last_name: 'Goraj'}}; // Test

    default_link();
    // check_session();
    check_user();
}

function check_session()
{
    const request = new Request('session', 'get', 'check', {});
    request.send();
    global_data = request.get();
}

function check_user()
{
    let user = global_data.user;
    if (user.authenticated) {
        user_settings(user);
    }
}

function user_settings(user)
{
    let user_element = $("#user-field");
    $(user_element).text(user.first_name + ' ' + user.last_name);
    $(user_element).removeClass('d-none');

    let login = $("#login-link");
    $(login).text('Logout');
    $(login).attr('href', '/logout');

    let side_menu = $("#side-menu");
    $(side_menu).removeClass('d-none')
}

function create(name) {
    return document.createElement(name);
}

function default_link() {
    $("a#header-link").attr('href', default_page);
}

function build_label(text, target) {
    let label = create('label');
    $(label).attr('for', target);
    $(label).text(text);

    return label;
}

function build_input(attr, value, type, class_names = '') {
    let input = create('input');
    $(input).attr('type', type);
    $(input).attr('name', attr);
    $(input).val(value);
    $(input).addClass(type + '-values');
    $(input).addClass(class_names);

    return input;
}

function build_button(value) {
    let btn = create('button');
    $(btn).text(value);
    $(btn).attr('type', 'button');
    $(btn).attr('onclick', 'open_record(' +
        '$(this).closest("tr").find("input[type=hidden]"), ' +
        '$(this).closest("table").find("th"), ' +
        '$(this).closest(".table-results").find("input[name=table]")' +
        ')');
    $(btn).addClass('btn');

    return btn;
}

function put_into_table(attr, content) {
    let table = $(".table-default").clone();
    let class_name = 'table-' + attr.value;

    $(table).removeClass("table-default");
    $(table).addClass(class_name);
    $(table).find(".table-header").text(attr.header);

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
    $(table).find(".table-results").append(build_input('table', attr.value, 'hidden'));

    $("#body").html(table);
    $(table).show();
}

function open_record(data, label, table) {
    let fields = build_fields(data, 'text').mergeElements(
            build_labels(
                getData(label, 'innerText'),
                getData(data, 'name')
            )
        );
    fields.mergeElements(build_fields(data, 'hidden'), 1);

    let name = table[0].value;
    fields = fields.build('div');
    fields.push(table.clone());
    modal('Bearbeite ' + name, fields);
}

function getData(data, what)
{
    return $(data).map(function() {
        return this[what];
    }).get();
}

function build_fields(data, type)
{
    return $(data).map(function() {
        return build_input(this.name, this.value, type, 'form-control');
    }).get();
}

function build_labels(data, targets)
{
    return $(data).map(function(key) {
        if (!targets[key]) return;
        return build_label(data[key], targets[key].name);
    }).get();
}

function modal(header, content) {
    let modal = $(".modal").clone();
    $(modal).find(".modal-header h5").text(header);
    $(modal).find(".modal-body").html(content);

    $("body").append(modal);
    $(modal).show();

    $(".modal button[class$=close]").click(function() {
        $(this).closest(".modal").remove();
    });
}

$(document).ready(function() {
    init();

    $('#data-table').DataTable( {
        data: {},
        columns: [
            {
                title: "Name",
                data: "name",
            },
            { title: "Adresse",data: "name", },
            { title: "Datum", data: "date", },
            { title: "Absender", data: "sender", },
            { title: "Empfänger", data: "receiver", },
            { title: "Aktion", data: "action", }
        ]
    } );
    $("#side-menu button").click(function() {

        let dataSet = [{name:'chuck tester', adress: 'Kuster-Straße 11', date: '03.11.20', sender: 'Kühne+Nagel', receiver: 'IBM', action: 'Öffnen'}, {name: 'max tester', adress: 'Muster-Allee 14', date: '12.10.16', sender: 'Detlef Louis', receiver: 'BIM', action: 'Öffnen'}];
        let topic = Object;
        topic.header = $(this).text();
        topic.value = $(this).val();
        // put_into_table(topic, {0:{name:'chuck tester', adress: 'Kuster-Straße 11', date: '03.11.20', sender: 'Kühne+Nagel', receiver: 'IBM', action: 'Öffnen'}, 1:{name: 'max tester', adress: 'Muster-Allee 14', date: '12.10.16', sender: 'Detlef Louis', receiver: 'BIM', action: 'Öffnen'}});


    });

    $("");
});


// --- override - prototypes ---

// --- Array - script

Array.prototype.build = function(what)
{
    let array = this;
    let built = [];

    Object.keys(this).forEach(function(key) {
        if (key % 3) return;
        let element = create(what);

        element.append(array[key++]);
        element.append(array[key++]);
        element.append(array[key]);
        built.push(element);
    });
    return built;
}
Array.prototype.mergeElements = function(array, level = 0)
{
    let i = 0;
    let arr = this;
    Object.keys(array).forEach(function(key) {
        arr.splice(i, 0, array[key]);
        i+=2 + level;
    });
    return this;
}


// jQuery - script

// src: https://stackoverflow.com/questions/67346415/jquery-don%C2%B4t-accept-property-cause-given-string-and-not-object/67346454#answer-67346574
!(($) => {
    $.fn.getArr = function(what) {
        return this.map(function() {
            return $(this)[what]()
        }).get();
    }
})(jQuery)