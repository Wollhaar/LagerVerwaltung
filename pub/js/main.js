let global_data = null;
let default_page = '/';

const selectors = {
    lieferant: { header: 'Lieferanten', value: 'lieferanten' },
    artikel: { header: 'Artikel', value: 'artikel' },
    lager: { header: 'Lager', value: 'lager' },
    transaktion: { header: 'Transaktionen', value: 'transaktion' },
}

const table_headers = {
        name:       { title: "Name", data: "name", },
        adresse:     { title: "Adresse",data: "adresse", },
        datum:       { title: "Datum", data: "datum", },
        typ:     { title: "Typ", data: "typ", },
        beschreibung: { title: "Beschreibung", data: "beschreibung", },
        preis:     { title: "Preis", data: "preis", },
        gate:     { title: "Tor", data: "gate", },
        sender:     { title: "Absender", data: "sender", },
        receiver:   { title: "Empfänger", data: "receiver", },
        anzahl:     { title: "Anzahl", data: "anzahl", },
        action:     { title: "Aktion", data: "action", },
        lieferant:     { title: "Lieferant", data: "lieferant", },
    };



function init() {
    // global_data = {user: {authenticated: true, first_name: 'David', last_name: 'Goraj'}}; // Test

    default_link();
    check_session();
    check_user();
}

function check_session()
{
    const request = new Request('session', 'get', 'check', {});
    request.send();
    global_data = request.get();
}

function load_data(data, what, action)
{
    const request = new Request('post', action);
    request.send(data, what);
}

function load_list(data, what)
{
    const request = new Request('get', 'All');
    request.send(data, what);
}

function turnTheCogs()
{
    this[global_data.action](global_data.data);
}

function login()
{
    let login_input = $('.login-area input');
    let data = getData(login_input);

    load_data(data, 'auth', 'login');
}

function logout()
{
    load_data([], 'auth', 'logout');
}

function check_user()
{
    let user = global_data.user;
    if (user.authenticated) {
        user_settings(user);
        $(".login-field").addClass('d-none');
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


function revert_user()
{
    let user_element = $("#user-field");
    $(user_element).text('');
    $(user_element).addClass('d-none');

    let login = $("#login-link");
    $(login).text('Login');
    $(login).attr('href', '/login');

    let side_menu = $("#side-menu");
    $(side_menu).addClass('d-none')
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
            '$(this).closest("input[name=record]"), ' +
            '$(this).closest("table").find("th"), ' +
            '$(this).closest(".table-default").find("input[name=table]")' +
        ')');
    $(btn).addClass('btn');

    return btn;
}

function fill_list()
{
    let data = global_data.data;
    let headers = Object.keys(data[0]);
    let what = data.what;
    delete data.what;

    headers.shift();
    headers.forEach(function (value, key) {
        headers[key] = table_headers[value];
    });

    put_into_table(data, headers, what)
}

function put_into_table(content, headerValues, selector) {
    let table = $(".table-default");

    if ($(table).hasClass("d-none")) $(table).removeClass("d-none");
    let head = create('h5');
    $(head).text(selectors[selector].header);
    $(table).html(head);

    let data_table = create('table');
    $(table).append(data_table);
    data_table = $(data_table).DataTable({columns: headerValues});

    for (let record of Object.values(content)) {
        console.log(decoder.decode(encoder.encode(record.beschreibung)));
        let data = record.toString();
        let input = build_input(data, 'record', 'hidden');
        // record['action'] = build_button(record['action']);

        data_table.row.add(record).draw();
    }
    $(table).append(build_input('table', selectors[selector], 'hidden'));
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

    // $(modal).draggable({
    //     handle: ".modal-header"
    // });

    $(modal).find(".modal-header h5").text(header);
    $(modal).find(".modal-body").html(content);

    $("body").append(modal);
    $(modal).show();

    $(".modal button[class$=close]").click(function() {
        $(this).closest(".modal").remove();
    });
}

function error(data)
{
    modal(data.title, data.message);
}

$(document).ready(function() {
    init();

    $("#side-menu button").click(function() {
        let value = $(this).val();
        // console.log('button: ' + value);
        load_list([], value);
    });

    $("[href$=login]").click(function(e) {
        e.preventDefault();
        $(".login-field").removeClass('d-none');
    });

    $("[href$=logout]").click(function(e) {
        e.preventDefault();
        logout();
    });


    // --- jquery login ---
    $('.login-field input').ready(function () {
        $(this).keyup(function (event) {
            if (event.key === 'Enter') login();
        });
    });
});

// --- extensions ---

// encoder/decoder - utf8 -- src:https://stackoverflow.com/questions/13356493/decode-utf-8-with-javascript#answer-40651656
let encoder = new TextEncoder();
let decoder = new TextDecoder('utf-8');

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