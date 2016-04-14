import Vue from 'vue';
import { TasksResource } from '../../../services/resources';
import Utils from '../../../services/utils';
import $ from 'jquery';

// noinspection JSUnusedGlobalSymbols
export default Vue.extend({

    template: require('./views/task.html'),
    props:    ['model'],

    data() {
        return { editMode: false };
    },

    ready() {
        const modalEl = $(this.$el).find('.ui.modal');
        this._modal = (action) => {
            modalEl.modal(action);
        };
    },

    methods: {
        toggle() {
            this.model.isDone = !this.model.isDone;
            this.save();
        },
        delete() {
            TasksResource.delete({ id: this.model.id }).then(() => {
                this.$dispatch('tasks.-', this.model);
            });
        },
        edit() {
            this.editMode = true;
            this.$nextTick(() => {
                this.$el.getElementsByTagName('input')[0].focus();
            });
        },
        cancel() {
            this.editMode = false;
        },
        save() {
            Utils.parseTask(this.model);

            TasksResource.update({ id: this.model.id }, this.model).then(() => {
                this.$dispatch('tasks.updated');
            });
        },
        showWarning() {
            this._modal('show');
        }

    }

});
