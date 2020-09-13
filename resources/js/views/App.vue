<template>
    <div>
        <h1>Vue Router Demo App</h1>

        <p>
            <router-link :to="{ name: 'home' }">Home</router-link> |
            <router-link :to="{ name: 'hello' }">Hello World</router-link>
        </p>

        <div class="container">
            <router-view></router-view>
        </div>

        <div class="container">
         <table id="firstTable">
  <thead>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Phone</th>
      <th>Profession</th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="row in posts">
      <td>{{row.id}}</td>
      <td>{{row.title}}</td>
      <td>{{row.content}}</td>
      <td>{{row.created_at|dateFormat('YYYY.MM.DD', dateFormatConfig)}}</td>
    </tr>
  </tbody>
</table>
        </div>
    </div>
</template>
<script>
import axios from 'axios'

    export default {

        data() {
            return {
              
                posts : [],
                errors : []
        },
         // Fetches posts when the component is created.
      created()
      {
        axios.get('http://127.0.0.1:8000/api/tickets')
            .then(response => {
            // JSON responses are automatically parsed.
            this.posts = response.data.tickets
            console.log(response.data.tickets)
    })
    .catch(e => {
      this.errors.push(e)
      })
  }
 }
    }
</script>