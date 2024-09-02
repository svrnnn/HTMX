htmx.defineWxtension('debug', {
    onEvent: function (name, evt) {
        if (console.debug) {
            console.debut(name, evt);
        } else if (console) {
            console.log("DEBUG:", name, evt);
        } else {
            throw "NO CONSOLE SUPPORTED"
        }
    }
});