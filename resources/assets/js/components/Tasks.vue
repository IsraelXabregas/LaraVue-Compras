<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-2">
                <div class="card bg-light">
                    <h5 class="card-header bg-secondary text-white text-center">Lista de Compras</h5>
                    <div class="card-body">
                        <div class="alert alert-danger text-center" v-if="!tasks.length">Nenhum item inserido.</div>
                        <div class="input-group mb-4">
                            <input v-model="task.name" class="form-control"
                                   @keydown.enter="create" placeholder="Insira um novo item">
                            <span class="input-group-btn">
                                <button class="btn btn-success ml-2" @click="create">Add</button>
                            </span>
                        </div>
                        <ul class="list-group">
                            <li class="list-group-item" v-for="task in tasks" :key="task.id"
                                :class="{ done: task.completed, 'text-muted': task.completed }">
                                <div class="checkbox">
                                    <label>
                                        <input v-model="task.completed" class="mr-1" type="checkbox"
                                               @click="done(task)">{{ task.name }}
                                    </label>
                                    <div class="float-right">
                                        <a href="#" @click.prevent="remove(task)">x</a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer" v-if="tasks.length">
                        <span class="badge badge-primary">Há {{ tasks.length }} item(s)</span>
                        <span class="badge badge-danger">Falta(m) {{ remainingTasks() }} item(s)</span>
                        <span class="badge badge-success">{{ completedTasks() }} item(s) adquirido(s)</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            this.fetchData();
        },
        data() {
            return {
                tasks: [],
                task: {
                    name: '',
                },
            }
        },
        methods: {
            fetchData() {
                axios.get('api/tasks')
                    .then((res) => {
                        this.tasks = res.data;
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            },
            create() {
                if (this.task.name) {
                    axios.post('api/tasks', this.task)
                        .then((res) => {
                            this.tasks.unshift(res.data);
                            this.task.name = '';
                        })
                        .catch((err) => {
                            console.log(err);
                        });
                } else {
                    alert('Insira um item.');
                }
            },
            done(task) {
                let uri = `api/tasks/${task.id}`;
                axios.put(uri, {
                    completed: !task.completed,
                })
                    .then((res) => {
                        this.fetchData();
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            },
            remove(task) {
                let uri = `api/tasks/${task.id}`;
                axios.delete(uri)
                    .then((res) => {
                        const taskIndex = this.tasks.indexOf(task);
                        this.tasks.splice(taskIndex, 1);
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            },
            remainingTasks() {
                return this.tasks.filter(task => {
                    return !task.completed
                }).length;
            },
            completedTasks() {
                return this.tasks.filter(task => {
                    return task.completed
                }).length;
            },
        },

    }
</script>

<style>
    .done label {
        text-decoration: line-through;
    }
</style>
