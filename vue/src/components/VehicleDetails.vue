<template>
  <div class="vehicle-detail">
    <div class="container">
      <div class="col-12 content-block-cover">
          <img :src="vehicle.field_image_vehicle[0].url">
          <p>{{ vehicle.name[0].value }}</p>
      </div>
      <div class="col-12 content-block">
        <div class="col-6 content-block">  
          <div class="content-block-text-vehicle">
            <h4>Zitplaatsen</h4>
            <p>{{ vehicle.field_seats[0].value }}</p>
          </div>
        </div>
        <div class="col-6 content-block">  
          <div class="content-block-text-vehicle">
            <h4>Eigenaar</h4>
            <p>{{ vehicle.field_owner[0].value }}</p>
          </div>
        </div>
        <div class="col-6 content-block">  
          <div class="content-block-text-vehicle">
            <h4>Bouwjaar</h4>
            <p>{{ vehicle.field_model_year[0].value.substring(0,4) }}</p>
          </div>
        </div>
        <div class="col-6 content-block">  
          <div class="content-block-text-vehicle">
            <h4>Rijbewijs</h4>
            <p>{{ vehicle.field_driver_license[0].value }}</p>
          </div>
        </div>
        <div class="col-6 content-block">  
          <div class="content-block-text-vehicle">
            <h4>Prijs</h4>
            <p>€ {{ vehicle.field_price_per_hour[0].value }} per uur</p>
          </div>
        </div>
        <div class="col-6 content-block">  
          <div class="content-block-text-vehicle">
            <h4>Adres</h4>
            <p>{{ getAdress }}</p>
          </div>
        </div>
        <div class="col-12 content-spacer">
        </div>
      </div>
      
    </div>
    <footer>
      <div class="button-wrapper">
        <router-link to="/vehicles">
          <div class="button button-left">
            Terug
          </div>
        </router-link>
        <router-link :to="{ name: 'ContractCreate', query: { vehicleId: vehicle.id[0].value }}">
          <div class="button button-right">
            Huren
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
  name: 'vehicle-detail',
  data() {
    return {
      vehicle: [],
      currentUser: '',
      errors: []
    }
  },
  computed: {
    getAdress: function () {
      let adress = this.vehicle.field_streetname_owner[0].value + ' ' + this.vehicle.field_housenumber_owner[0].value + ', ' + this.vehicle.field_postalcode_owner[0].value + ' ' + this.vehicle.field_city_owner[0].value
      return adress 
    }
  }, 
  methods: {
    checkIfAuthenticated: function() {
      if (localStorage.currentUser === undefined) {
        this.$router.replace({ name: 'Home' });
      }
      else {
        this.currentUser = JSON.parse(localStorage.currentUser);
        this.getVehicle();
      }
    },
    getVehicle: function(){
      let config = {
        headers: {
          'X-CSRF-Token': this.currentUser.csrf_token,
          'Authorization': localStorage.basicAuth
        }
      };
      axios.get('http://localhost/cargo/vehicles/' + this.$route.params.vehicleId + '?_format=json', config)
      .then(response => {
        if (response.data.field_hired[0].value === true) {
          this.$router.replace({ name: 'Vehicles' });
        } else {
          this.vehicle = response.data;
        }
      })
      .catch(e => {
        this.errors.push(e)
        this.$router.replace({ name: 'Vehicles'});
        location.reload();
      })
    }
  },
  mounted: function () {
    this.checkIfAuthenticated();
  }
}

</script>