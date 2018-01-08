<template>
  <div class="profile-edit">
    <div class="container">
        <form id="editUserForm" v-on:submit.prevent="editUser">    
            <div class="col-12 content-block"> 
              <div class="content-block-text">
                <h2>Profiel bewerken</h2>
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
          <button form="editUserForm" type="submit" class="button-mid">
            Bevestig
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
  name: 'profile-edit',
  data () {
    return {
      firstname: '',
      lastname: '',
      mail: '',
      driverlicense: '',
      birthdate: '',
      streetname: '',
      housenumber: '',
      postalcode: '',
      city: '',
      telephone:'',
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
    checkIfAuthenticatedUserIsAllowed: function() {
      if(this.currentUser.current_user.uid != this.user.uid[0].value) {
        this.$router.replace({ name: 'Profile' });
      }
    },
    getUser: function() {
      let config = {
        headers: {
          'X-CSRF-Token': this.currentUser.csrf_token,
          'Authorization': localStorage.basicAuth
        }
      };
      axios.get(`http://localhost/user/` + this.$route.params.userId + `?_format=json`, config)
      .then(response => {
        this.user = response.data
        this.checkIfAuthenticatedUserIsAllowed();
        this.firstname = response.data.field_firstname_user[0].value
        this.lastname = response.data.field_lastname_user[0].value
        this.mail = response.data.mail[0].value
        this.driverlicense = response.data.field_driver_license_user[0].value
        this.birthdate = response.data.field_birthdate[0].value
        this.streetname = response.data.field_streetname_user[0].value
        this.housenumber = response.data.field_housenumber_user[0].value
        this.postalcode = response.data.field_postalcode_user[0].value
        this.city = response.data.field_city_user[0].value
        this.telephone = response.data.field_telephone_user[0].value
      })
      .catch(e => {
        this.errors.push(e)
        this.$router.replace({ name: 'Home'});
        location.reload();
      }) 
    },
    editUser: function() {
      let config = {
        headers: {
          'Content-type': 'application/json',
          'X-CSRF-Token': this.currentUser.csrf_token,
          'Authorization': localStorage.basicAuth
        }
      };
      axios.patch(`http://localhost/user/` + this.user.uid[0].value, 
      {
        "mail": [
          {
            "value":this.mail
          }
        ],
        "field_birthdate": [
          {
            "value": this.birthdate
          }
        ],
        "field_city_user": [
          {
            "value": this.city,
            "format": "basic_html"
          }
        ],
        "field_driver_license_user": [
          {
            "value": this.driverlicense,
          }
        ],
        "field_firstname_user": [
          {
            "value": this.firstname,
            "format": "basic_html"
          }
        ],
        "field_housenumber_user": [
          {
            "value": this.housenumber,
            "format": "basic_html"
          }
        ],
        "field_lastname_user": [
          {
            "value": this.lastname,
            "format": "basic_html"
          }
        ],
        "field_postalcode_user": [
          {
            "value": this.postalcode,
            "format": "basic_html"
          }
        ],
        "field_streetname_user": [
          {
            "value": this.streetname,
            "format": "basic_html"
          }
        ],
        "field_telephone_user": [
          {
            "value": this.telephone,
            "format": "basic_html"
          }
        ]
      }, 
      config)
      .then(response => {
        this.$router.replace({ name: 'Profile'});
        location.reload();
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