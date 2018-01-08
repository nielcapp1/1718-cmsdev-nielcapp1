<template>
  <div class="contract-extend">
    <div class="container">
      <form id="extendContractForm" v-on:submit.prevent="extendContract" data-toggle="validator">
        <div class="col-12 content-block">
          <div class="content-block-text">
            <h2>Verlengen</h2>
          </div>
          <div v-if="errorMessage" class="content-block-text">
            <hr>
            <br>
            <h4>Opgelet</h4>
            <p class="info">{{ errorMessage }}</p>
          </div>

          <div class="content-block-text">
            <hr>
            <br>
            <h4>Huidig einduur</h4>
            <p class="info">Op {{ new Date(this.contract.field_enddate[0].value).getDate() }}-{{ getMonth }}-{{ getFullYear }} om {{ getHours }}u{{ getMinutes }}</p>
            <br>
            <hr>
          </div>
          <div class="content-block-text">
            <h4>Tot wanneer wilt u de huur verlengen?</h4>
            <input type="datetime-local" v-model="endDate" required>
          </div>
          <div class="content-block-text">
            <h4>Prijs</h4>
            <p>{{ getNewTotalPrice }}</p>
          </div>
        </div>
      </form>
      <div class="col-12 content-spacer">
      </div>
      <footer>
        <div v-if="errorMessage">
          <div class="button-wrapper">
            <button form="extendContractForm" type="submit" class="button-mid">
              Verlengen
            </button>
          </div>
        </div>
        <div v-if="!errorMessage">
          <div class="button-wrapper">
            <button form="extendContractForm" type="submit" class="button-mid">
              Verlengen
            </button>
          </div>
        </div>
      </footer>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
export default {
  name: 'contract-extend',
  data (){
    return {
      currentEndDate: '',
      endDate: '',
      startDate: '',
      convertEndDate: '',
      convertCurrentDate: '',
      totalHours: '',
      totalPrice: '',
      newTotalPrice: '',
      terms: '',
      errorMessage: '',
      contract: [],
      vehicle: [],
      vehiclePricePerHour: '',
      currentUser: JSON.parse(localStorage.currentUser),
      errors: [],
      message: ''
    }
  },
  computed: {
    getNewTotalPrice: function() {

      // Replace '-' with '/'.
      let replacer1 = this.endDate.replace(/-/g , "/");
      let replacer2 = this.currentEndDate.replace(/-/g , "/");

      // Replace 'T' with ' '.
      this.convertEndDate = replacer1.substring(0,10)+' '+replacer1.substring(11);
      this.convertCurrentDate = replacer2.substring(0,10)+' '+replacer2.substring(11);

      // Convert string to date.
      let endDate = new Date (this.convertEndDate);
      let currentEndDate = new Date (this.convertCurrentDate);
      currentEndDate.setHours(currentEndDate.getHours() - 1);
      
      // Get the date from now
      let nowDate = new Date();

      if (currentEndDate > endDate) {
        this.errorMessage = "Het einduur is later gepland dan het vorige einduur. Gelieve dit te wijzigen."
        this.totalPrice = ''
        return this.totalPrice;
      } 
      else {
        // Make the Error Message empty.
        this.errorMessage = ""

        // Calculate the Minutes.
        let minutes = endDate - currentEndDate;

        // Calculate the Total Hours based on the Minutes.
        this.totalHours = (minutes/1000)/60/60;

        // Calculate the Total Price based on the Price Per Hour and the Total Hours.
        // Round the Total Price.
        this.totalPrice = Math.round(this.vehiclePricePerHour * this.totalHours)

        // Total Price is not a Number? ...
        if (isNaN(this.totalPrice)) {
          this.totalPrice = ''
          return this.totalPrice;
          // return this.errorMessage
        }
        // Total Price is a Number? ...
        else {
          if (this.totalPrice === 0) {
            this.errorMessage = "Het startuur ligt te dicht van het einduur. Gelieve dit te wijzigen"
          }
          else {
            this.newTotalPrice = this.totalPrice + this.contract.field_total_price[0].value;
            return this.newTotalPrice;
          }
        }
      }  
    },
    getFullYear: function () {
      return new Date(this.contract.field_enddate[0].value).getFullYear();
    },
    getMonth: function () {
      return new Date(this.contract.field_enddate[0].value).getMonth()+1;
    },
    getHours: function () {
      return new Date(this.contract.field_enddate[0].value).getHours()-1;
    },
    getMinutes: function () {
      if(new Date(this.contract.field_enddate[0].value).getMinutes() < 10) {
        return '0' + new Date(this.contract.field_enddate[0].value).getMinutes();
      } 
      else {
        return new Date(this.contract.field_enddate[0].value).getMinutes();
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
        this.getContract();
      }
    },
    checkIfAuthenticatedUserIsAllowed: function() {
      if(this.currentUser.current_user.uid != this.contract.user_id[0].target_id) {
        this.$router.replace({ name: 'Contracts' });
      }
    },
    checkIfDateIsInPast: function() {
        let currentEndDate = new Date(this.contract.field_enddate[0].value);
        let dateNow = new Date();
        dateNow.setHours(dateNow.getHours()+1);
        if(currentEndDate < dateNow) {
          this.$router.replace({ name: 'Home' });
        }
    },
    getVehicle: function() {
      let config = {
        headers: {
          'X-CSRF-Token': this.currentUser.csrf_token,
          'Authorization': localStorage.basicAuth
        }
      };
      axios.get('http://localhost/cargo/vehicles/' + this.contract.field_vehicle[0].target_id + '?_format=json', config)
      .then(response => {
        this.vehicle = response.data;
        this.vehiclePricePerHour = response.data.field_price_per_hour[0].value;
      })
      .catch(e => {
        this.errors.push(e)
        this.$router.replace({ name: 'Contracts'});
        location.reload();
      })
    },
    getContract: function(){
      let config = {
        headers: {
          'X-CSRF-Token': this.currentUser.csrf_token,
          'Authorization': localStorage.basicAuth
        }
      };
      axios.get('http://localhost/cargo/contracts/' + this.$route.params.contractId + '?_format=json', config)
      .then(response => {
        this.contract = response.data;
        this.currentEndDate = response.data.field_enddate[0].value
        this.startDate = response.data.field_startdate[0].value
        this.checkIfAuthenticatedUserIsAllowed();
        this.checkIfDateIsInPast();
        this.getVehicle();
      })
      .catch(e => {
        this.errors.push(e)
        this.$router.replace({ name: 'Contracts'});
        location.reload();
      })
    },
    extendContract: function(){
      let config = {
        headers: {
          'Accept': 'json',
          'Content-type': 'application/json',
          'X-CSRF-Token': this.currentUser.csrf_token,
          'Authorization': localStorage.basicAuth
        }
      };
      axios.patch(`http://localhost/cargo/contracts/` + this.$route.params.contractId, 
      {
        "name": [
            {
                "value": this.contract.name[0].value
            }
        ],
        "field_terms": [
            {
                "value": true
            }
        ],
        "field_startdate": [
            {
              "value": this.contract.field_startdate[0].value,
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
                  "value": this.newTotalPrice
              }
          ],
          "field_vehicle": [
            {
                "target_id":  this.contract.field_vehicle[0].target_id,
                "target_type": this.contract.field_vehicle[0].target_type,
                "target_uuid": this.contract.field_vehicle[0].target_uuid,
                "url": this.contract.field_vehicle[0].url
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
    }
  },
  mounted: function () {
    this.checkIfAuthenticated();
  }
}
</script>