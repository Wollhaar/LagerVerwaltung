class Request {
    slash = '/';
    path = this.slash + 'api'+ this.slash + 'index.php';
    response;

    constructor(what, method, action, data) {
        this.what = what;
        this.method = method;
        this.action = action;

        if (typeof data !== 'object') data = Object(data);
        this.data = data;
    }

    send()
    {
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
        this.save(data);
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