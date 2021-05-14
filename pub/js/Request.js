class Request {
    slash = '/';
    url = this.slash + 'api'+ this.slash + 'index.php';

    constructor(method, action) {
        this.method = method;
        this.action = method + '_' + action;
    }

    send(data, selector)
    {
        if (typeof data !== 'object') data = Object(data);

        $.ajax({
            type: this.method,
            url: this.url + '/' + selector + '/' + this.action,
            data: {
                data: data // to musi byc array ---> get_All jako akcja i pusta array jako dane
            },
            success: function (content) {
                //json decode content
                global_data = content;
                turnTheCogs();

                // typ danych - array, wartosc, modal, info...

                // spawdzam tym i wykonuje funkcje z selektorem. Selektrot czyli pijemnik z ID gdzie maja trafic moje dane
            }
        });
        /*
        let data = $[this.method](this.path + this.slash + this.what + this.slash + this.action,
            this.data
        , function(data, success) {
            if (success && data.search('Fatal error') === -1) {
                return data;
            }
            else {
                console.log('Loading Data failed');
                console.log(data);
            }
        });
        console.log(data);
        this.save(data);*/
    }

    save(data)
    {
        this.response = JSON.parse(data);
    }

    get()
    {
        return this.response;
    }



}