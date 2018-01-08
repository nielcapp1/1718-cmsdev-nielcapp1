<template>
  <div class="contract-create">
    <div class="container">
      <div class="col-12 content-block-cover">
          <img :src="vehicle.field_image_vehicle[0].url">
          <p>{{ vehicle.name[0].value }}</p>
      </div>
      <form id="createContractForm" v-on:submit.prevent="createContract" data-toggle="validator">
        <div class="col-12 content-block">
          <div v-if="errorMessage" class="content-block-text">
            <hr>
            <br>
            <h4>Opgelet</h4>
            <p class="info">{{ errorMessage }}</p>
            <br>
            <hr>
          </div>
          <div class="content-block-text">
            <h4>Wanneer wilt u starten met de huur?</h4>
            <input type="datetime-local" v-model="startDate" required>
          </div>
          <div class="content-block-text">
            <h4>Wanneer wilt u stoppen met de huur?</h4>
            <input type="datetime-local" v-model="endDate" required>
          </div>
          <div class="content-block-text">
            <h4>Ik ga akkoord met de voorwaarden die te lezen zijn op:<br><span>www.cargo.be/voorwaarden</span></h4>
            <p class="term-label"><input type="checkbox" v-model="terms" required>Akkoord</p>
          </div>
          <div class="content-block-text">
            <h4>Prijs</h4>
            <p v-if="calculatePrice">€ {{ calculatePrice }}</p>
          </div>
        </div>
      </form>
      <div class="col-12 content-spacer">
      </div>
      <footer>
        <div v-if="errorMessage">
          <div class="button-wrapper">
            <button form="createContractForm" type="submit" class="button-mid">
              Huren
            </button>
          </div>
        </div>
        <div v-if="!errorMessage">
          <div class="button-wrapper">
            <button form="createContractForm" type="submit" class="button-mid">
              Huren
            </button>
          </div>
        </div>
      </footer>
    </div>
  </div>
</template>

<script>
/* eslint-disable */
import axios from 'axios'
export default {
  name: 'contact-create',
  data (){
    return {
      startDate: '',
      endDate: '',
      totalPrice: '',
      terms: '',
      errorMessage: '',
      currentUser: '',
      vehicle: [],
      errors: []
    }
  },
  created: function(){
    
  },
  mounted: function () {
    this.checkIfAuthenticated();
  },
  computed: {
    calculatePrice: function () {
        // Replace '-' with '/'.
        let replacedEndDate = this.endDate.replace(/-/g , "/");
        let replacedStartDate = this.startDate.replace(/-/g , "/");
        // Convert dates to a usefull string.
        let convertEndDate = replacedEndDate.substring(0,10)+' '+replacedEndDate.substring(11);
        let convertStartDate = replacedStartDate.substring(0,10)+' '+replacedStartDate.substring(11);
        // Convert string to a date.
        let endDate = new Date (convertEndDate);
        let startDate = new Date (convertStartDate);
        // Get the current date
        let nowDate = new Date()
        // Stardate is in the past? ...
        if (startDate <= nowDate) {
          this.errorMessage = "De start datum ligt in het verleden."
          this.totalPrice = ''
          return this.totalPrice;
        }
        //  End Date is before the Start Date? ...
        else if (startDate > endDate) {
          this.errorMessage = "Het startuur is later gepland dan het einduur. Gelieve dit te wijzigen."
          this.totalPrice = ''
          return this.totalPrice;
        } 
        else {
          // Make the Error Message empty.
          this.errorMessage = ""
          // Calculate the Minutes.
          let minutes = endDate - startDate;
          // Calculate the Total Hours based on the Minutes.
          let totalHours = (minutes/1000)/60/60;
          // Calculate the Total Price based on the Price Per Hour and the Total Hours.
          // Round the Total Price.
          this.totalPrice = Math.round(this.vehicle.field_price_per_hour[0].value * totalHours)
          // Total Price is not a Number? ...
          if (isNaN(this.totalPrice)) {
            this.totalPrice = ''
            return this.totalPrice;
          }
          // Total Price is a Number? ...
          else {
            if (this.totalPrice === 0) {
              this.errorMessage = "Het startuur ligt te dicht van het einduur. Gelieve dit te wijzigen"
            }
            else {
              return this.totalPrice;
            }
          }
        }
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
    updateVehicleHiredStatus: function(){
      let config = {
        headers: {
          'Accept': 'json',
          'Content-type': 'application/json',
          'X-CSRF-Token': this.currentUser.csrf_token,
          'Authorization': localStorage.basicAuth
        }
      };
      axios.patch(`http://localhost/cargo/vehicles/` + this.vehicle.id[0].value + `?_format=json`,
      {
        "name": [
            {
                "value": this.vehicle.name[0].value
            }
        ],
        "field_city_owner": [
            {
                "value": this.vehicle.field_city_owner[0].value,
                "format": "basic_html"
            }
        ],
        "field_driver_license": [
            {
                "value": this.vehicle.field_driver_license[0].value
            }
        ],
        "field_hired": [
            {
                "value": true
            }
        ],
        "field_housenumber_owner": [
            {
                "value": this.vehicle.field_housenumber_owner[0].value
            }
        ],
        "field_image_vehicle": [
            {
                "target_id": this.vehicle.field_image_vehicle[0].target_id,
                "alt": this.vehicle.field_image_vehicle[0].alt,
                "title": "",
                "width": this.vehicle.field_image_vehicle[0].width,
                "height": this.vehicle.field_image_vehicle[0].height,
                "target_type": this.vehicle.field_image_vehicle[0].target_type,
                "target_uuid": this.vehicle.field_image_vehicle[0].target_uuid,
                "url": this.vehicle.field_image_vehicle[0].url
            }
        ],
        "field_model_year": [
            {
                "value": this.vehicle.field_model_year[0].value,
                "format": "Y-m-d\\TH:i:sP"
            }
        ],
        "field_owner": [
            {
                "value": this.vehicle.field_owner[0].value,
                "format": "basic_html"
            }
        ],
        "field_postalcode_owner": [
            {
                "value": this.vehicle.field_postalcode_owner[0].value
            }
        ],
        "field_price_per_hour": [
            {
                "value": this.vehicle.field_price_per_hour[0].value
            }
        ],
        "field_seats": [
            {
                "value": this.vehicle.field_seats[0].value
            }
        ],
        "field_streetname_owner": [
            {
                "value": this.vehicle.field_streetname_owner[0].value,
                "format": "basic_html"
            }
        ],
        "field_telephone_owner": [
            {
                "value": this.vehicle.field_telephone_owner[0].value,
                "format": "basic_html"
            }
        ]        
      }, 
      config)
      .then(response => {
        this.$router.replace({ name: 'Contracts'});
        location.reload();
      })
      .catch(e => {
        this.errors.push(e)
      })
    },
    getVehicle: function(){
      let config = {
        headers: {
          'X-CSRF-Token': this.currentUser.csrf_token,
          'Authorization': localStorage.basicAuth
        }
      };
      axios.get('http://localhost/cargo/vehicles/' + this.$route.query.vehicleId+ '?_format=json',
      config)
      .then(response => {
        console.log(response)
        if(response.status === 200) {
          this.vehicle = response.data;
        }
      })
      .catch(e => {
        this.errors.push(e)
        this.$router.replace({ name: 'Contracts'});
        location.reload();
      })
    },
    createContract: function() {
      let config = {
        headers: {
          'Content-type': 'application/json',
          'X-CSRF-Token': this.currentUser.csrf_token,
          'Authorization': localStorage.basicAuth
        }
      };
      axios.post(`http://localhost/entity/contracts`, 
      {
        "name": [
            {
                "value": "Contract"
            }
        ],
        "field_terms": [
            {
                "value": true
            }
        ],
        "field_startdate": [
            {
                "value": this.startDate+":00+00:00",
                  "format": "Y-m-d\\TH:i:sP"
            }
        ],
        "field_enddate": [
            {
                "value": this.endDate+":00+00:00",
                  "format": "Y-m-d\\TH:i:sP"
            }
        ],
          "field_total_price": [
              {
                  "value": this.totalPrice
              }
          ],
          "field_vehicle": [
            {
                "target_id": this.$route.query.vehicleId,
                "target_type": "vehicles",
                "target_uuid": this.vehicle.uuid[0].value,
                "url": "/api/vehicles/"+this.$route.query.vehicleId
            }
          ]
      }, 
      config)
      .then(response => {
        if(response.status===201) {
          this.updateVehicleHiredStatus();
        }
      })
      .catch(e => {
        this.errors.push(e);
        console.log(e.response);
      })
    }
  }
}

</script>