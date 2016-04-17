<template>
    <div class="ui grid">
        <div class="thirteen wide column" v-show="!editMode && !deleteMode">
            <h2 class="ui header">
                <i class="tasks icon"></i>
                <span class="content" @dblclick="toggleEditMode">{{ model.name }}</span>
            </h2>
        </div>
        <div class="three wide right aligned column" v-show="!editMode && !deleteMode">
            <button class="ui small icon button" @click="toggleEditMode">
                <i class="pencil icon"></i>
            </button>
            <button class="ui small icon button" @click="toggleDeleteMode">
                <i class="trash icon"></i>
            </button>
        </div>
        <div class="sixteen wide column" v-show="deleteMode">
            <div class="ui warning message">
                <div class="ui grid">
                    <div class="ten wide column">Do you really want to delete this card?</div>
                    <div class="six wide right aligned column">
                        <i class="large remove link icon" @click="toggleDeleteMode"></i>
                        <i class="large checkmark link icon" @click="delete"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="sixteen wide column" v-show="editMode">
            <div class="ui fluid large input">
                <!--suppress HtmlFormInputWithoutLabel -->
                <input type="text" v-model="model.name" @keyup.enter="save" @keyup.esc="toggleEditMode" v-focus-model="editMode">
            </div>
        </div>
        <div class="sixteen wide column">
            <tasks :models="models"></tasks>
        </div>
    </div>
</template>

<script type="text/babel">
    import cardService from '../../../services/card'
    import taskService from '../../../services/task'
    import Tasks from './card/tasks'
    import eventEmitter from '../../../services/event-emitter'
    import { focusModel } from 'vue-focus'

    export default {

        directives: {
            focusModel
        },

        init() {
            this.refreshCallback = () => this.refresh()
        },

        components: {
            tasks: Tasks
        },

        destroyed() {
            eventEmitter.off('tasks.created', this.refreshCallback)
            eventEmitter.off('tasks.updated', this.refreshCallback)
        },

        ready() {
            eventEmitter.on('tasks.created', this.refreshCallback)
            eventEmitter.on('tasks.updated', this.refreshCallback)
        },

        data() {
            return {
                editMode: false,
                deleteMode: false,
                model:  {},
                models: []
            }
        },

        methods: {
            delete() {
                cardService.delete(this.model).then(() => {
                    this.$router.go({ name: 'cards' })
                })
            },
            toggleEditMode() {
                this.editMode = !this.editMode
            },
            toggleDeleteMode() {
                this.deleteMode = !this.deleteMode
            },
            loadModels() {
                return taskService.queryByCardId(this.$route.params.id)
            },
            refresh() {
                this.loadModels().then((response) => {
                    this.models = response
                })
            },
            save() {
                cardService.update(this.model)
                this.editMode = false
            }
        },

        route: {

            data(transition) {
                const id = transition.to.params.id

                return {
                    model:  cardService.get(id),
                    models: taskService.queryByCardId(id)
                }
            },

            canReuse: false,
            waitForData: true

        }

    }
</script>