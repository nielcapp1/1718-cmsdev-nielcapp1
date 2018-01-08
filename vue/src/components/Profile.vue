<template>
  <div class="profile">
    <div class="container">
      <div class="col-12 content-block-profilepicture">
        <img src="../../static/img/Profielfoto.jpg">
        <p>{{ user.field_firstname_user[0].value }} {{ user.field_lastname_user[0].value }}</p>
      </div>
      <div class="col-12 content-block">
        <div class="content-block-text">
          <h4>Persoonlijke gegevens</h4>
          <p>{{ user.field_birthdate[0].value }}<br>Rijbewijs: {{ user.field_driver_license_user[0].value }}</p>
          <h4>Adres</h4>
          <p>{{ user.field_streetname_user[0].value }} {{ user.field_housenumber_user[0].value }}<br>{{ user.field_postalcode_user[0].value }} {{ user.field_city_user[0].value }}</p>
          <h4>Contactgegevens</h4>
          <p>{{ user.mail[0].value }}<br>{{ user.field_telephone_user[0].value }}</p>
        </div>
      </div>
      <div class="col-12 content-spacer">
      </div>
    </div>
    <footer>
      <div class="button-wrapper">
        <button class="button-left" v-on:click="logout">
            Afmelden
        </button>
        <router-link :to="{ name: 'ProfileEdit', params: { userId: user.uid[0].value }}">
          <div class="button button-right">
            Bewerken
          </div>
        </router-link>
      </div>
    </footer>
  </div>
</template>

<script>
/* eslint-disable */
import axios from 'axios'
export default {
  name: 'home',
  data () {
    return {
      currentUser: '',
      user: '', 
      errors: []
    }
  },
  methods: {
    checkIfAuthenticated: function() {
      if (localStorage.currentUser === undefined) {
        this.$router.replace({ name: 'Home' });
      }
      else {
        this.currentUser = JSON.parse(localStorage.currentUser);
        this.getUser();
      }
    },
    logout: function() {
      localStorage.clear();
      this.$router.replace({ name:'Home' })
      location.reload();
    },
    getUser: function() {
      let config = {
        headers: {
          'X-CSRF-Token': this.currentUser.csrf_token,
          'Authorization': localStorage.basicAuth
        }
      };
      axios.get(`http://localhost/user/` + this.currentUser.current_user.uid + `?_format=json`, config)
      .then(response => {
        this.user = response.data;
      })
      .catch(e => {
        this.errors.push(e)
        this.$router.replace({ name: 'Home'});
        location.reload();
      }) 
    }
  },
  mounted: function () {
    this.checkIfAuthenticated();
  }
}
</script>