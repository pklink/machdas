<template>
    <a class="item" v-show="!editMode && !deleteMode">
        <div class="right floated content">
            <i class="write icon" @click="toggleEditMode"></i>
            <i class="trash icon" @click="toggleDeleteMode"></i>
        </div>
        <div class="content" @click="toggleIsDone">
            <div class="ui tiny red empty circular label" v-if="model.priority > 500"></div>
            <div class="ui tiny orange empty circular label" v-if="model.priority == 500"></div>
            <div class="ui tiny yellow empty circular label" v-if="model.priority < 500">&nbsp</div>
            <span v-show="!model.isDone">{{ model.name }}</span>
            <del v-show="model.isDone">{{ model.name }}</del>
        </div>
    </a>
    <div class="item" v-show="editMode">
        <div class="content">
            <div class="ui small transparent fluid input" v-show="editMode">
                <!--suppress HtmlFormInputWithoutLabel -->
                <input type="text" v-model="model.name" @keyup.enter="save" @keyup.esc="toggleEditMode">
            </div>
        </div>
    </div>
    <div class="item" v-show="deleteMode">
        <div class="right floated content">
            <i class="remove icon" @click="toggleDeleteMode"></i>
            <i class="checkmark icon" @click="delete"></i>
        </div>
        <div class="content">
            Do you really want want to delete this task?
        </div>
    </div>
</template>

<script type="text/babel">
    import taskService from '../../../../../services/task'
    import Utils from '../../../../../services/utils'

    // noinspection JSUnusedGlobalSymbols
    export default {

        props: ['model'],

        data() {
            return {
                deleteMode: false,
                editMode: false
            }
        },

        methods: {
            delete() {
                taskService.delete(this.model)
            },
            save() {
                Utils.parseTask(this.model)
                taskService.update(this.model.id, this.model)
            },
            toggleDeleteMode() {
                this.deleteMode = !this.deleteMode
            },
            toggleEditMode() {
                this.editMode = !this.editMode
            },
            toggleIsDone() {
                this.model.isDone = !this.model.isDone
                this.save()
            }
        }

    }
</script>