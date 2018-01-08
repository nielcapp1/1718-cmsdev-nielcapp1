<template>
  <div class="contract-detail">
    <div class="container">
      <div class="col-12 content-block-cover">
          <img :src="vehicle.field_image_vehicle[0].url">
          <p>{{ vehicle.name[0].value}}</p>
      </div>
      <div class="col-12 content-block">
        <div class="col-6 content-block">  
          <div class="content-block-text-vehicle">
            <h4>Afgesloten op</h4>
            <p>Op <strong>{{ getCreateDay }}-{{ getCreateMonth}}-{{ getCreateYear }}</strong> om <strong>{{ getCreateHours }}u{{ getCreateMinutes }}</strong></p>
          </div>
        </div>
        <div class="col-6 content-block">  
          <div v-if="this.contract.created[0].value === this.contract.changed[0].value" class="content-block-text-vehicle">
            <h4>Verlengd op</h4>
            <p>Deze samenwerking werd niet verlengd.</strong></p>
          </div>
          <div v-if="this.contract.created[0].value !== this.contract.changed[0].value" class="content-block-text-vehicle">
            <h4>Verlengd op</h4>
            <p>Op <strong>{{ getChangeDay }}-{{ getChangeMonth}}-{{ getChangeYear }}</strong> om <strong>{{ getChangeHours }}u{{ getChangeMinutes }}</strong></p>
          </div>
        </div>
        <div class="col-6 content-block">  
          <div class="content-block-text-vehicle">
            <h4>Prijs</h4>
            <p>€ {{ contract.field_total_price[0].value }}</p>
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
            <h4>Ophalen</h4>
            <p>{{ vehicle.field_streetname_owner[0].value }} {{ vehicle.field_housenumber_owner[0].value }}<br>{{ vehicle.field_postalcode_owner[0].value }} {{ vehicle.field_city_owner[0].value }}<br><br>Op <strong>{{ getStartDay }}-{{ getStartMonth}}-{{ getStartYear }}</strong> om <strong>{{ getStartHours }}u{{ getStartMinutes }}</strong></p>
          </div>
        </div>
        <div class="col-6 content-block">  
          <div class="content-block-text-vehicle">
            <h4>Terugbrengen</h4>
            <p>{{ vehicle.field_streetname_owner[0].value }} {{ vehicle.field_housenumber_owner[0].value }}<br>{{ vehicle.field_postalcode_owner[0].value }} {{ vehicle.field_city_owner[0].value }}<br><br>Op <strong>{{ getEndDay }}-{{ getEndMonth}}-{{ getEndYear }}</strong> om <strong>{{ getEndHours }}u{{ getEndMinutes }}</strong></p>
          </div>
        </div>
      </div>
      <div class="col-12 content-spacer">
      </div>
    </div>
    <div v-if="convertTodate(contract.field_enddate[0].value) > getDateNow">
      <footer>
        <div class="button-wrapper">
          <router-link :to="{ name: 'ContractExtend', params: { contractId: contract.id[0].value }}">
            <div class="button button-left">
              Verlengen
            </div>
          </router-link>
          <router-link :to="{ name: 'ContractStop', params: { contractId: contract.id[0].value }}">
            <div class="button button-right">
              Beëindigen
            </div>
          </router-link>
        </div>
      </footer>
    </div>
  </div>
</template>

<script>
/* eslint-disable */
import axios from 'axios'
export default {
  name: 'contract-detail',
  data (){
    return {
      vehicle: [],
      contract: [],
      currentUser: '',
      message: '',
      errors: []
    }
  },
  computed: {
    getDateNow: function() {
      let dateNow = new Date();
      return dateNow;
    },
    getCreateDay: function () {
      return new Date(this.contract.created[0].value).getDate();
    },
    getCreateMonth: function () {
      return new Date(this.contract.created[0].value).getMonth()+1;
    },
    getCreateYear: function () {
      return new Date(this.contract.created[0].value).getFullYear();
    },
    getCreateHours: function () {
      return new Date(this.contract.created[0].value).getHours();
    },
    getCreateMinutes: function () {
      if(new Date(this.contract.created[0].value).getMinutes() < 10) {
        return '0' + new Date(this.contract.created[0].value).getMinutes();
      } 
      else {
      return new Date(this.contract.created[0].value).getMinutes();
      }
    },
    getChangeDay: function () {
      return new Date(this.contract.changed[0].value).getDate();
    },
    getChangeMonth: function () {
      return new Date(this.contract.changed[0].value).getMonth()+1;
    },
    getChangeYear: function () {
      return new Date(this.contract.changed[0].value).getFullYear();
    },
    getChangeHours: function () {
      return new Date(this.contract.changed[0].value).getHours();
    },
    getChangeMinutes: function () {
      if(new Date(this.contract.changed[0].value).getMinutes() < 10) {
        return '0' + new Date(this.contract.changed[0].value).getMinutes();
      } 
      else {
      return new Date(this.contract.changed[0].value).getMinutes();
      }
    },
    getEndDay: function () {
      return new Date(this.contract.field_enddate[0].value).getDate();
    },
    getEndMonth: function () {
      return new Date(this.contract.field_enddate[0].value).getMonth()+1;
    },
    getEndYear: function () {
      return new Date(this.contract.field_enddate[0].value).getFullYear();
    },
    getEndHours: function () {
      return new Date(this.contract.field_enddate[0].value).getHours()-1;
    },
    getEndMinutes: function () {
      if(new Date(this.contract.field_enddate[0].value).getMinutes() < 10) {
        return '0' + new Date(this.contract.field_enddate[0].value).getMinutes();
      } 
      else {
      return new Date(this.contract.field_enddate[0].value).getMinutes();
      }
    },
    getStartDay: function () {
      return new Date(this.contract.field_startdate[0].value).getDate();
    },
    getStartMonth: function () {
      return new Date(this.contract.field_startdate[0].value).getMonth()+1;
    },
    getStartYear: function () {
      return new Date(this.contract.field_startdate[0].value).getFullYear();
    },
    getStartHours: function () {
      return new Date(this.contract.field_startdate[0].value).getHours()-1;
    },
    getStartMinutes: function () {
      if(new Date(this.contract.field_startdate[0].value).getMinutes() < 10) {
        return '0' + new Date(this.contract.field_startdate[0].value).getMinutes();
      } 
      else {
      return new Date(this.contract.field_startdate[0].value).getMinutes();
      }
    }
  },
  methods: {
    convertTodate: function(date) {
      var date = new Date(date);
      date.setHours(date.getHours()-1);
      return date;
    },
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
    getContract: function(){
        let config = {
          headers: {
            'X-CSRF-Token': this.currentUser.csrf_token,
            'Authorization': localStorage.basicAuth
          },
        };
        axios.get('http://localhost/cargo/contracts/' + this.$route.params.contractId + '?_format=json', config)
        .then(response => {
          this.contract = response.data;
          this.checkIfAuthenticatedUserIsAllowed();
          let config = {
            headers: {
              'X-CSRF-Token': this.currentUser.csrf_token,
              'Authorization': localStorage.basicAuth
            },
          };
          axios.get('http://localhost/cargo/vehicles/' + this.contract.field_vehicle[0].target_id + '?_format=json', config)
          .then(response => {
            this.vehicle = response.data;
          })
          .catch(e => {
            this.errors.push(e)
            this.$router.replace({ name: 'Contracts'});
            location.reload();
          })
        })
        .catch(e => {
        this.errors.push(e)
        this.$router.replace({ name: 'Contracts'});
        location.reload();
      })
    }
  },
  mounted: function() {
    this.checkIfAuthenticated();
  }
}

</script>