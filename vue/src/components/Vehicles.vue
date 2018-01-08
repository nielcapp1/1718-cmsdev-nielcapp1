<template>
  <div class="vehicle-list">
    <div class="container">
      <div class="vehicle-filter">
        <div class="search-icon">
          <img src="../../static/img/icons/search-icon.svg">
        </div>
        <input type="text" v-model="searchQuery" placeholder="Zoek op stad">
      </div>
        <div v-for="vehicle in filteredVehicles">
          <div v-if="vehicle.field_hired[0].value != true">
            <router-link :to="{ name: 'VehicleDetails', params: { vehicleId: vehicle.id[0].value }}">
              <div>
                <div class="col-6 content-block-global">  
                  <img :src="vehicle.field_image_vehicle[0].url">
                  <p>{{ vehicle.field_city_owner[0].value }}</p>
                </div>
                <div class="col-6 content-block-global"> 
                  <div class="content-block-text">
                    <h4>{{ vehicle.name[0].value }}</h4>
                    <p>€ {{ vehicle.field_price_per_hour[0].value }} per uur</p>
                  </div>
                  <br>         
                </div>
              </div>
            </router-link>
          </div>
          <div v-if="vehicle.field_hired[0].value === true">
            <div>
              <div class="col-6 content-block-global">  
                <img :src="vehicle.field_image_vehicle[0].url" class="vehicle-hired">
                <p>{{ vehicle.field_city_owner[0].value }}</p>
              </div>
              <div class="col-6 content-block-global"> 
                <div class="content-block-text">
                  <h4>{{ vehicle.name[0].value }}</h4>
                  <p>Deze wagen is reeds verhuurd.</p>
                </div>
                <br>         
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 content-block"> 
          <div v-if="vehicles.length === 0">
            <div class="content-block-text">
              <hr>
              <br>
              <h4>Er geen voertuigen beschikbaar.</h4>
              <br>
              <hr>
            </div>   
          </div>
        </div>
        <div class="col-12 content-spacer">
        </div>
    </div>
  </div>
</template>

<script>
/* eslint-disable */
import axios from 'axios'
export default {
  name: 'vehicles',
  data() {
    return {
      searchQuery: '',
      vehicles: [],
      vehiclesWithNoContract: [],
      contracts: [],
      currentUser: '',
      errors: []
    }
  }, 
  computed: {
    filteredVehicles: function () {
        let self = this
        return self.vehicles.filter(function (vehicle) {
        return vehicle.field_city_owner[0].value.indexOf(self.searchQuery) !== -1
      })
    }
  },
  methods: {
    checkIfAuthenticated: function() {
      if (localStorage.currentUser === undefined) {
        this.$router.replace({ name: 'Home' });
      }
      else {
        this.currentUser = JSON.parse(localStorage.currentUser);
        this.getVehicles();
        this.getContracts();
      }
    },
    getVehicles: function() {
      axios.get(`http://localhost/api/vehicles/?_format=json`)
      .then(response => {
        this.vehicles = response.data;
      })
      .catch(e => {
        this.errors.push(e)
      }) 
    },
    getContracts: function() {
      axios.get(`http://localhost/api/contracts/?_format=json`)
      .then(response => {
        this.contracts = response.data;
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