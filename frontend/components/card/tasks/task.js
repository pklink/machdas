import Vue from "vue";
import {TasksResource} from "../../../services/resources";
import Utils from "../../../services/utils";
import $ from "jquery";

//noinspection JSUnusedGlobalSymbols
export default Vue.extend({

    template: require('./views/task.html'),
    props:    ['model'],

    data: function() {
        return { editMode: false };
    },

    ready: function() {
        const modalEl = $(this.$el).find('.ui.modal');
        this._modal = (action) => {
            modalEl.modal(action)
        };
    },

    methods: {
        toggle: function() {
            this.model.isDone = !this.model.isDone;
            this.save();
        },
        delete: function () {
            TasksResource.delete({ id: this.model.id }).then(() => {
                this.$dispatch('tasks.-', this.model);
            });
        },
        edit: function() {
            this.editMode = true;
            this.$nextTick(() => {
                this.$el.getElementsByTagName('input')[0].focus();
            });
        },
        cancel: function() {
            this.editMode = false;
        },
        save: function() {
            Utils.parseTask(this.model);

            TasksResource.update({ id: this.model.id }, this.model).then(() => {
                this.$dispatch('tasks.updated');
            });
        },
        showWarning: function() {
            this._modal('show');
        }

    }

});