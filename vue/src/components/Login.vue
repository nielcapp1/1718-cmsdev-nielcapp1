<template>
  <div class="login">
    <div class="container">
      <form id="loginForm" v-on:submit.prevent="login">    
          <div class="col-12 content-block"> 
            <div class="content-block-text">
              <h2>Aanmelden</h2>
            </div>
            <div class="content-block-text">
              <hr>
              <br>
              <h4>Gebruikersnaam</h4>
              <input type="text" class="validate" v-model="username" autocapitalize="off" autocorrect="off" placeholder="gebruikersnaam" required>
            </div>
            <div class="content-block-text">
              <h4>Wachtwoord</h4>
              <input type="password" class="validate" v-model="password" placeholder="wachtwoord" required>
            </div>
          </div> 
      </form>    
    </div>
    <div class="col-12 content-spacer">
    </div>
    <footer>
      <div class="button-wrapper">
        <button form="loginForm" type="submit" class="button-mid">
          Aanmelden
        </button>
      </div> 
    </footer>
  </div>
</template>

<script>
import axios from 'axios'
export default {
  name: 'login',
  data (){
    return {
      username: '',
      password: '',
      csrfToken: '',
      errors: []
    }
  },
  methods: {
    checkIfAuthenticated: function() {
      if (localStorage.currentUser != undefined) {
        this.$router.replace({ name: 'Home' });
      }
    },
    login: function() {
      let config = {
        headers: {
          'Content-type': 'application/json',
        },
      };
      axios.post(`http://localhost/user/login?_format=json`, 
      {
        "name": this.username,
        "pass": this.password
      },
      config)
      .then(response => {
        if(response.status===200) {
            let basicAuth = 'Basic ' + btoa(this.username + ':' + this.password);
            localStorage.setItem('basicAuth', basicAuth);
            let currentUser = JSON.stringify(response.data);
            localStorage.setItem('currentUser', currentUser);
            this.$router.replace({ name: 'Home' });
            location.reload();
        }
      })
      .catch(e => {
        this.errors.push(e)
      })
    }
  },
  mounted: function () {
    this.checkIfAuthenticated();
  }
}
</script>