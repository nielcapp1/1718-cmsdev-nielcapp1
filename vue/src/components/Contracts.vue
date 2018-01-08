<template>
  <div class="contracts">
    <div class="container">
      <div class="col-12 content-block">
        <div class="content-block-text">
          <h2>Contracten</h2>
          <br>
          <hr>
          <br>
        </div>
        <div class="content-block-text-vehicle">
          <div v-if="contracts.length === 0">
            <div class="content-block-text">
              <hr>
              <br>
              <h4 class="info">U heeft nog geen voertuigen gehuurd.</h4>
              <br>
              <hr>
            </div>   
          </div>
          <h4>Lopende contracten</h4>
          <div v-for="contract in contracts">
            <div v-show="currentUser.current_user.uid == contract.user_id[0].target_id">
              <div v-if="convertTodate(contract.field_enddate[0].value) > getDateNow">
                <router-link :to="{ name: 'ContractDetails', params: { contractId: contract.id[0].value }}">
                <div class="contract-link contract-true">
                  {{ contract.name[0].value }} #{{ contract.id[0].value }}
                </div>
                </router-link>
              </div>
            </div>
          </div>
          <br>
          <hr>
          <br>
        </div>
      </div>
      <div class="col-12 content-block">
        <div class="content-block-text-vehicle">
          <h4>Afgelopen contracten</h4>
          <div v-for="contract in contracts">
            <div v-show="currentUser.current_user.uid == contract.user_id[0].target_id">
              <div v-if="convertTodate(contract.field_enddate[0].value) < getDateNow">
                <router-link :to="{ name: 'ContractDetails', params: { contractId: contract.id[0].value }}">
                  <div class="contract-link contract-false">
                    {{ contract.name[0].value }} #{{ contract.id[0].value }}
                  </div>
                </router-link>
              </div>
            </div>
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
  name: 'contracts',
  data (){
    return {
      contracts: [],
      currentUser: '',
      errors: []
    }
  },
  computed:{ 
    getDateNow: function() {
      let dateNow = new Date();
      return dateNow;
    }
  },
  methods: {
    checkIfAuthenticated: function() {
      if (localStorage.currentUser === undefined) {
        this.$router.replace({ name: 'Home' });
      }
      else {
        this.currentUser = JSON.parse(localStorage.currentUser);
        this.getContracts();
      }
    },
    convertTodate: function(date) {
      var date = new Date(date);
      date.setHours(date.getHours()-1);
      return date;
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