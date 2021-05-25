class Request {
    slash = '/';
    url = this.slash + 'api'+ this.slash + 'index.php';

    constructor(method, action, options = []) {
        this.method = method;
        this.action = method + '_' + action;

        this.options = '?' + jQuery.param(options)
    }

    send(data, selector)
    {
        if (typeof data !== 'object') data = Object(data);

        $.ajax({
            type: this.method,
            url: this.url + '/' + selector + '/' + this.action + this.options,
            data: {
                data: data
            },
            success: function (content) {
                global_data = content;
                turnTheCogs();
            }
        });
    }
}