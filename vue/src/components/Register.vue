<template>
  <div class="register">
    <div class="container">
      <form id="registerForm" v-on:submit.prevent="registerUser">    
          <div class="col-12 content-block"> 
            <div class="content-block-text">
              <h2>Registeren</h2>
            </div>
            <div class="content-block-text">
              <hr>
              <br>
              <h4>Voornaam</h4>
              <input type="text" v-model="firstname" placeholder="voornaam" required>
            </div>
            <div class="content-block-text">
              <h4>Familienaam</h4>
              <input type="text" v-model="lastname" placeholder="familienaam" required>
            </div>
            <div class="content-block-text">
              <hr>
              <br>
              <h4>Gebruikersnaam</h4>
              <input type="text" v-model="username" placeholder="gebruikersnaam" required>
            </div>
            <div class="content-block-text">
              <h4>Wachtwoord</h4>
              <input type="password" v-model="password" placeholder="wachtwoord" required>
            </div>
            <div class="content-block-text">
              <hr>
              <br>
              <h4>Straat</h4>
              <input type="text" v-model="streetname" placeholder="straat" required>
            </div>
            <div class="content-block-text">
              <h4>Huisnummer</h4>
              <input type="text" v-model="housenumber" placeholder="huisnummer" required>
            </div>
            <div class="content-block-text">
              <h4>Postcode</h4>
              <input type="text" v-model="postalcode" placeholder="postcode" required>
            </div>
            <div class="content-block-text">
              <h4>Stad</h4>
              <input type="text" v-model="city" placeholder="stad" required>
            </div>
            <div class="content-block-text">
              <hr>
              <br>
              <h4>Geboortedatum</h4>
              <input type="date" v-model="birthdate" required>
            </div>
            <div class="content-block-text">
              <h4>Mail</h4>
              <input type="mail" v-model="mail" placeholder="mail" required>
            </div>
            <div class="content-block-text">
              <h4>Telefoon</h4>
              <input type="text" v-model="telephone" placeholder="telefoon" required>
            </div>
            <div class="content-block-text">
              <hr>
              <br>
              <h4>Rijbewijs</h4>
              <select v-model="driverlicense" required>
                <option value="" disabled selected>rijbewijs</option>
                <option>Categorie AM</option>
                <option>Categorie A</option>
                <option>Categorie B</option>
                <option>Categorie C</option>
                <option>Categorie D</option>
                <option>Categorie G</option>
              </select>
            </div>
          </div> 
      </form>    
    </div>
    <div class="col-12 content-spacer">
    </div>
    <footer>
      <div class="button-wrapper">
        <button form="registerForm" type="submit" class="button-mid">
          Registeren
        </button>
      </div> 
    </footer>
    </div>    
  </div>
</template>

<script>
/* eslint-disable */
import axios from 'axios'
export default {
  name: 'register',
  data (){
    return {
      firstname: '',
      lastname: '',
      username: '',
      mail: '',
      password: '',
      driverlicense: '',
      birthdate: '',
      streetname: '',
      housenumber: '',
      postalcode: '',
      city: '',
      telephone:'',
      currentUser: '',
      errorMessage: 'Deze gebruikersnaam of é-mailadres zijn al reeds in gebruik.',
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
              console.log(response);
          }
        })
        .catch(e => {
          this.errors.push(e)
          console.log(e.response);
        });
    },
    registerUser: function() {
      let config = {
            headers: {
          'Content-type': 'application/json',
          'X-CSRF-Token': '_Rnx7ykxD-Oaj4V1N0y-eSmYHlPgVnOIQGtQpVyMvqE',
        }
      };
      axios.post(`http://localhost/user/register?_format=json`, 
      {
        "name": { 
          "value": this.username
        },
        "pass": { 
          "value": this.password
        },
        "field_firstname_user": { 
          "value": this.firstname
        },
        "field_lastname_user": {
          "value": this.lastname
        },
        "field_birthdate": {
          "value": this.birthdate
        },
        "field_streetname_user": {
          "value": this.streetname
        },
        "field_housenumber_user": {
          "value": this.housenumber
        },
        "field_city_user": {
          "value": this.city
        },
        "field_postalcode_user": {
          "value": this.postalcode
        },
        "field_telephone_user": {
          "value": this.telephone
        },
        "mail": { 
          "value": this.mail 
        },
        "field_driver_license_user": {
          "value": this.driverlicense
        }

      }, 
      config)
      .then(response => {
        if(response.status === 200) {
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
              this.$router.replace({ name: 'Profile' });
            }   
          })
          .catch(e => {
            this.errors.push(e)
            console.log(e.response);
          })
        }
      })
      .catch(e => {
        this.errors.push(e);
        console.log(e.response);
      })
    }
  },
  mounted: function () {
    this.checkIfAuthenticated();
  }
}

</script>