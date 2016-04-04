export default {

    parsePriority: function(model) {
        // parse priority
        if (model.name.search(/@high/) !== -1) {
            model.priority = 'high';
            model.name     = model.name.replace(/@high/, '');
        }
        if (model.name.search(/@normal/) !== -1) {
            model.priority = 'normal';
            model.name     = model.name.replace(/@normal/, '');
        }
        if (model.name.search(/@low/) !== -1) {
            model.priority = 'low';
            model.name     = model.name.replace(/@low/, '');
        }
    },

    parseIsDone: function(model) {
        // parse priority
        if (model.name.search(/@done/) !== -1) {
            model.isDone = true;
            model.name   = model.name.replace(/@done/, '');
        }
    },

    parseTask: function(model) {
        this.parsePriority(model);
        this.parseIsDone(model);
    }

}