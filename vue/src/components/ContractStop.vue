<template>
  <div class="contract-stop">
    <div class="container">     
      <form id="stopContractForm" v-on:submit="stopContract">
        <div class="col-12 content-block">
          <div class="content-block-text">
            <h2>Verlengen</h2>
          </div>
          <div class="content-block-text">
            <hr>
            <br>
            <h4>Ben u zeker dat u dit contract wilt beeïndigen voor €{{ getFinalTotalPrice }}?</h4>
            <p class="info">De prijs werd berekend op basis van het aantal effectief gehuurde uren en de annulatie kosten, die €20 bedragen.</p>
            <br>
            <hr>
          </div>
        </div>
      </form>
      <div class="col-12 content-spacer">
      </div>
      <footer>
        <div class="button-wrapper">
          <button form="stopContractForm" type="submit" class="button-mid">
            Beëndigen
          </button>
        </div>
      </footer> 
    </div>
  </div>
</template>

<script>
import axios from 'axios'
export default {
  name: 'contract-stop',
  data (){
    return {
      currentEndDate: '',
      endDate: '',
      startDate: '',
      convertEndDate: '',
      convertStartDate: '',
      convertCurrentDate: '',
      totalHours: '',
      totalPrice: '',
      newTotalPrice: '',
      terms: '',
      contract: [],
      vehicle: [],
      vehiclePricePerHour: '',
      currentUser: JSON.parse(localStorage.currentUser),
      errors: []
    }
  },
  computed: {
    getFinalTotalPrice: function() {

      // Replace '-' with '/'.
      let replacer = this.startDate.replace(/-/g , "/");

      // Replace 'T' with ' '.
      this.convertStartDate = replacer.substring(0,10)+' '+replacer.substring(11);

      // Convert string to date.
      var startDate = new Date (this.convertStartDate);
      startDate.setHours(startDate.getHours());

      // Get the date from now
      var nowDate = new Date();

      // Get date from the date now
      if(nowDate.getDate() < 10) {
        var dayNow = '0' + nowDate.getDate();
      }
      else {
        var dayNow = nowDate.getDate();
      }

      // Get month from the date now
      if(nowDate.getMonth() < 10) {
        var monthNow = '0' + nowDate.getMonth()+1;
      }
      else {
        var monthNow = nowDate.getMonth()+1;
      }

      // Get year from the date now
      var yearNow = nowDate.getFullYear();
      
      // Get hours from the date now
      if(nowDate.getHours() < 10) {
        var hourNow = '0' + nowDate.getHours();
      }
      else {
        var hourNow = nowDate.getHours();
      }

      // Get minutes from the date now
      if(nowDate.getMinutes() < 10) {
        var minuteNow = '0' + nowDate.getMinutes();
      }
      else {
        var minuteNow = nowDate.getMinutes();
      }

      // Combine every time partical.
      this.convertCurrentDate = yearNow + '-' + monthNow + '-' + dayNow+ 'T' + hourNow + ':' + minuteNow;

      // Date now is before the start date? ...
      if (startDate >= nowDate) {
        this.newTotalPrice = 20
        return this.newTotalPrice;
      } 
      // Date now is after the start date? ...
      else {

        // Calculate the Minutes.
        let minutes = nowDate - startDate;

        // Calculate the Total Hours based on the Minutes.
        this.totalHours = (minutes/1000)/60/60;

        // Calculate the Total Price based on the Price Per Hour and the Total Hours.
        // Round the Total Price.
        this.totalPrice = Math.round(this.vehiclePricePerHour * this.totalHours)

        // Total Price is not a Number? ...
        if (isNaN(this.totalPrice)) {
          this.totalPrice = ''
          return this.totalPrice;
        }
        // Total Price is a Number? ...
        else {
          if (this.totalPrice === 0) {
          }
          else {
            // New Total Price based on hours hired + €20 annulation cost
            this.newTotalPrice = this.totalPrice + 20;
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
  created: function(){
      this.getContract();
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
          this.endDate = response.data.field_enddate[0].value
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
    getVehicle: function() {
      let config = {
        headers: {
          'X-CSRF-Token': this.currentUser.csrf_token,
          'Authorization': localStorage.basicAuth
        }
      };
      axios.get('http://localhost/cargo/vehicles/' + this.contract.field_vehicle[0].target_id + '?_format=json',
      config)
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
    stopContract: function(event){
      event.preventDefault();
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
              "value": this.convertCurrentDate+":00+00:00",
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