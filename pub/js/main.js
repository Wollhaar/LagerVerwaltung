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
        '$(this).closest("tr").children("input[type=hidden]"), ' +
        '$(this).closest("table").find("th"), ' +
        '$(this).closest(".table-results").find("input[name=table]")' +
        ')');
    $(btn).addClass('btn');

    return btn;
}

function put_into_table(header, content) {
    let table = $(".table-default").clone();
    let class_name = 'table-' + header;

    $(table).removeClass("table-default");
    $(table).addClass(class_name);
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
    $(table).find(".table-results").append(build_input('table', header, 'hidden'));

    $("#body").html(table);
    $(table).show();
}

function open_record(data, label, table) {
    let fields = build_fields(data).mergeElements(build_labels(getText(label), data));
    let name = table[0].value;

    fields = fields.build('div');
    fields.push(table);
    console.log(fields);
    modal('Bearbeite ' + name, fields);
}

function getData(data)
{
    return $(data).map(function() {
        return this.value;
    }).get();
}

function getAttr(data)
{
    return $(data).map(function() {
        return this.name;
    }).get();
}

function getText(data)
{
    return $(data).map(function() {
        return this.innerText;
    }).get();
}

function build_fields(data)
{
    return $(data).map(function() {
        return build_input(this.name, this.value, 'text', 'form-control');
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

    $(".modal button:contains(Schließen)").click(function() {
        $(this).closest(".modal").remove();
    });
});


// --- override - prototypes ---

// --- Array - script

Array.prototype.build = function(what)
{
    let array = this;
    let built = [];

    Object.keys(this).forEach(function(key) {
        let div = create(what);
        div.append(array[key++])
        div.append(array[key])
        built.push(div);
    });
    return built;
}
Array.prototype.mergeElements = function(array)
{
    let i = 0;
    let arr = this;
    Object.keys(array).forEach(function(key) {
        arr.splice(i, 0, array[key]);
        i+=2;
    });
    return this;
}