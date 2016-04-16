<template>
    <a class="item">
        <div class="right floated content" v-show="!editMode">
            <i class="write icon" @click="edit"></i>
            <i class="trash icon" @click="showWarning"></i>
        </div>
        <div class="content" @click="toggle">
            <div class="ui tiny red empty circular label" v-show="!editMode" v-if="model.priority > 500"></div>
            <div class="ui tiny orange empty circular label" v-show="!editMode" v-if="model.priority == 500"></div>
            <div class="ui tiny yellow empty circular label" v-show="!editMode" v-if="model.priority < 500">&nbsp</div>
            <div class="ui small transparent fluid input" v-show="editMode">
                <!--suppress HtmlFormInputWithoutLabel -->
                <input type="text" v-model="model.name" @keyup.enter="save" @keyup.esc="cancel">
            </div>
            <span v-show="!model.isDone && !editMode">{{ model.name }}</span>
            <del v-show="model.isDone && !editMode">{{ model.name }}</del>
        </div>
        <div class="ui small modal">
            <div class="header">Delete Task</div>
            <div class="content">
                <p>Do you really want to delete this task?</p>
            </div>
            <div class="actions">
                <div class="ui black deny button">
                    Nope
                </div>
                <div class="ui red right labeled approve icon button" @click="delete">
                    Yep, delete it
                    <i class="trash icon"></i>
                </div>
            </div>
        </div>
    </a>
</template>

<script type="text/babel">
    import taskService from '../../../../../services/task'
    import Utils from '../../../../../services/utils'
    import eventEmitter from '../../../../../services/event-emitter'
    import $ from 'jquery'

    // noinspection JSUnusedGlobalSymbols
    export default {

        props:    ['model'],

        data() {
            return { editMode: false }
        },

        ready() {
            const modalEl = $(this.$el).find('.ui.modal')
            this._modal = (action) => {
                modalEl.modal(action)
            }
        },

        methods: {
            toggle() {
                this.model.isDone = !this.model.isDone
                this.save()
            },
            delete() {
                taskService.delete(this.model.id).then(() => {
                    eventEmitter.emit('tasks.deleted', this.model)
                })
            },
            edit() {
                this.editMode = true
                this.$nextTick(() => {
                    this.$el.getElementsByTagName('input')[0].focus()
                })
            },
            cancel() {
                this.editMode = false
            },
            save() {
                Utils.parseTask(this.model)

                taskService.update(this.model.id, this.model).then(() => {
                    eventEmitter.emit('tasks.updated')
                })
            },
            showWarning() {
                this._modal('show')
            }

        }

    }
</script>