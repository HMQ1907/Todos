<template>
  <div class="row todo-content">
    <div class="col-md-6">
      <div class="todo-list not-done">
        <h1>TODOS</h1>
        <div class="input-group mb-3">
          <input
            v-model="textContent"
            type="text"
            class="form-control"
            placeholder="Enter content"
          />
          <div class="input-group-append">
            <button
              @click="addTodo"
              class="btn btn-outline-secondary"
              type="button"
              id="button-addon2"
            >
              Add
            </button>
          </div>
        </div>
        <hr />
        <ul class="list-unstyled" v-for="(item, index) in todos" :key="item.id">
          <li class="ui-state-default li-items mt-1">
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <input
                    v-model="item.checked"
                    type="checkbox"
                    aria-label="Radio button for following text input"
                    :checked="item.checked"
                  />
                </div>
              </div>
              <input
                v-bind:class="{ 'done-task': item.done }"
                type="text"
                class="form-control"
                v-model="item.content"
              />
              <div class="input-group-append remove-icon">
                <span @click="deleteTask(index)" class="input-group-text"
                  >&#10060;</span
                >
              </div>
            </div>
          </li>
        </ul>
        <hr />
        <div class="todo-footer row">
          <div class="col-md-6">
            <div @click="checkAll(true)" class="form-check form-check-inline">
              &#9989;
              <label class="form-check-label" for="inlineRadio1"
                >Check all</label
              >
            </div>
            <div @click="checkAll(false)" class="form-check form-check-inline">
              &#10062;
              <label
                @click="checkAll(false)"
                class="form-check-label"
                for="inlineRadio2"
                >UnCheck all</label
              >
            </div>
          </div>
          <div class="col-md-6 save-all">
            <div class="form-check form-check-inline save-all">
              <button
                @click="doneAll()"
                type="button"
                class="btn btn-success btn-sm"
              >
                DONE ALL &#10004;
              </button>
            </div>
            <div class="form-check form-check-inline save-all">
              <button
                @click="deleteAll()"
                type="button"
                class="btn btn-dark btn-sm"
              >
                DEL ALL &#10006;
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Todos',
  data () {
    return {
      todos: [
        { id: 1, content: 'Content 1', done: false, checked: true },
        { id: 2, content: 'Content 2', done: true, checked: false },
        { id: 3, content: 'Content 3', done: false, checked: false }
      ],
      textContent: '',
      idContent: 2
    }
  },
  methods: {
    addTodo () {
      if (this.textContent.trim().length === 0) {
        alert('Please enter content')
      } else {
        this.idContent++
        this.todos.push({
          id: this.idContent,
          content: this.textContent,
          done: false,
          checked: false
        })
        this.textContent = ''
      }
    },
    deleteTask (index) {
      if (confirm('Are you sure delete this task?')) {
        this.todos.splice(index, 1)
      }
    },
    checkAll (flag) {
      this.todos.forEach((item) => {
        item.checked = flag
      })
    },
    doneAll () {
      if (confirm('Are you sure done all task ?')) {
        this.todos.forEach((item) => {
          if (item.checked) {
            item.done = true
          }
        })
      }
    },
    deleteAll () {
      if (confirm('Are you sure delete all task ?')) {
        this.todos = this.todos.filter((item) => {
          return !item.checked
        })
      }
    }
  }
}
</script>

<style scoped>
.todo-content {
  display: flex;
  justify-content: center;
}

.todo-list h1 {
  margin-top: 20px;
  padding-bottom: 20px;
  text-align: center;
  font-weight: bold;
}

.todo-footer {
  background-color: #d2e8ca;
  padding: 10px 20px 15px;
}

#done-items li {
  padding: 10px 0;
  border-bottom: 1px solid #ddd;
  text-decoration: line-through;
}

.done-task {
  text-decoration: line-through;
  color: orange;
}

.form-check-inline {
  cursor: pointer;
}

.remove-icon span {
  cursor: pointer;
}

.save-all {
  float: right;
}
</style>
