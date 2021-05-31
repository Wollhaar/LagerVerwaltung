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
        strasse:     { title: "Straße",data: "strasse", },
        hausnummer:     { title: "Hausnummer",data: "hausnummer", },
        PLZ:     { title: "PLZ",data: "PLZ", },
        ort:     { title: "Ort",data: "ort", },
        datum:       { title: "Datum", data: "datum", },
        typ:     { title: "Typ", data: "typ", },
        bezeichnung: { title: "Bezeichnung", data: "bezeichnung", },
        beschreibung: { title: "Beschreibung", data: "beschreibung", },
        preis:     { title: "Preis", data: "preis", },
        gate:     { title: "Tor", data: "gate", },
        sender:     { title: "Absender", data: "sender", },
        receiver:   { title: "Empfänger", data: "receiver", },
        anzahl:     { title: "Anzahl", data: "anzahl", },
        artikelList:     { title: "Artikelliste", data: "artikelList", },
        action:     { title: "Aktion", data: "action", },
        lieferant:     { title: "Lieferant", data: "lieferant", },
        lager:     { title: "Lager", data: "lager", },
    };



function init() {
    default_link();
    check_session();
}

// script - requests --- BEGIN

function getter(data, what, action)
{
    const request = new Request('get', action, data);
    request.send([], what);
}

function load_data(data, what, action)
{
    const request = new Request('post', action);
    request.send(data, what);
}

function load_list(data, what)
{
    const request = new Request('get', 'all');
    request.send(data, what);
}

// script - requests --- END

function turnTheCogs()
{
    this[global_data.action](global_data.data);
}

function check_session()
{
    getter([], 'auth', 'check');
}

function login()
{
    let login_input = $('.login-field input');
    let data = getData(login_input, 'value');

    load_data(data, 'auth', 'login');
}

function logout()
{
    getter([], 'auth', 'logout');

}

// --- framework by: colleague --- BEGIN

function save_data() {
    let data = {};
    $('.modal-body input').each(function(){
        data[$(this).attr('name')] = $(this).val();
    });
    data = [data];
    load_data(data, data[0].what, 'edit');
}

// --- framework --- END

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
    $(side_menu).removeClass('d-none');

    $("[href$=logout]").click(function(e) {
        e.preventDefault();
        logout();
    });
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

    $("div[id^=DataTables]").remove();
}

function create(name) {
    return document.createElement(name);
}

function default_link() {
    $("a#header-link").attr('href', default_page);
}

function build_label(text, target = '') {
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

function fill_list()
{
    let data = global_data.data;
    let headers = Object.keys(data[0]);
    let what = global_data.what;

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
        if (selector === 'artikel' || selector === 'transaktion') {
            let input2 = build_input('lieferant', JSON.stringify(record.lieferant), 'hidden');
            record.lieferant = record.lieferant.name;
            $(table).append(input2);
        }
        if (selector === 'transaktion') {
            data_table.button().add( 2, {
                action: function() {
                    get_list(this, JSON.stringify(record));
                },
                text: 'Artikelliste'
            });

            let input3 = build_input('lager', JSON.stringify(record.lager), 'hidden');
            record.lager = record.lager.name;
            $(table).append(input3);
        }

        let input = build_input('record', JSON.stringify(record), 'hidden');
        $(table).append(input);

        data_table.row.add(record).draw();
    }
    $(table).append(build_input('table', selectors[selector], 'hidden'));
    activate_table();
}

function open_record(data) {
    let hidden = build_input('id', data.id, 'hidden');
    let hidden2 = build_input('what', global_data.what, 'hidden');
    delete data.id;

    let fields = build_form(data);
    fields.append(hidden);
    fields.append(hidden2);
    modal('Bearbeite ' + global_data.what, fields);
}

function open_list(btn)
{
    console.log(btn);
    console.log(btn.value);
}

function searchData(what)
{
    return $("input[type=hidden][value*=\"name\":\"" + what + "\"]");
}

function getData(data, what)
{
    return $(data).map(function() {
        return this[what];
    }).get();
}

function getFrom(data, what)
{
    let obj = Object();
    if (what === 'keys') {
        for (let element of Object.keys(data)) {
            obj[element.name] = element.value;
        }
    }
    if (what === 'values') {
        for (let element of Object.values(data)) {
            obj[element.name] = element.value;
        }
    }
    return obj;
}

function collectData(data)
{
    let obj = Object();
    for (let element of Object.values(data)) {
        obj[element.name] = element.value;
    }
    return obj;
}

function getByHeader(string)
{
    for (let key of Object.keys(selectors)) {
        if (string === selectors[key].header)
            return key;
    }
}

function build_form(data)
{
    let div = create('form');
    for (let keys of Object.keys(data)) {
        if (keys  === 'lieferant') data[keys] = data[keys].name;
        div.append(build_label(table_headers[keys].title));
        div.append(build_input(keys, data[keys], 'text', 'form-control'));
    }
    return div;
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

function modal(header, content, id = '') {
    let modal = $(".modal").clone();

    modal.id = id;
    $(modal).find(".modal-header h5").text(header);
    $(modal).find(".modal-body").html(content);

    $(modal).draggable();

    $("body").append(modal);
    $(modal).show();

    activate_modal();
}

function error(data)
{
    modal(data.title, data.message, global_data.info);
    $("#error_" + global_data.info).find(".modal-footer button.save").remove();
}

function info(header, content) {
    modal(header, content, 'info_' + global_data.info);
    let modal_window = $("#info_" + global_data.info);

    $(modal_window).find(".modal-footer button.save").remove();
}

// script - jQuery --- BEGIN

$(document).ready(function() {
    init();

    $("#side-menu button").click(function() {
        let value = $(this).val();
        load_list([], value);
    });

    $("[href$=login]").click(function(e) {
        e.preventDefault();
        $(".login-field").removeClass('d-none');
    });


    // --- jquery login ---
    $('.login-field input').ready(function () {
        $(this).keyup(function (event) {
            if (event.key === 'Enter') login();
        });
    });

});

function activate_table()
{
    $(".table-default table tr").click(function() {
        let what = getByHeader($(this).closest(".table-default").find('h5').html());
        getter({name: $(this).children().first().html()}, what, 'searchByName');
    });
}

function activate_modal()
{
    $(".modal button.save").click(function() {
        save_data();
        $(this).closest(".modal").remove();
    });
    $(".modal button[class$=close]").click(function() {
        $(this).closest(".modal").remove();
    });
}

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