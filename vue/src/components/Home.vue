<template>
  <div class="home">
    <div class="container">
      <div class="col-12 content-block-cover">
        <img src="../../static/img/ModelS.jpg">
        <p>CARGO</p>
      </div>
      <div class="col-12 content-block">
        <div class="content-block-text">
          <h4>Elektronische wagens</h4>
          <p>Maak kennis met onze elektronische wagens. De voertuigen van Tesla zijn van topkwaliteit. Bovendien is er een telkens een ruime keuze aan wagens.</p>
          <h4>Unieke rijervaring</h4>
          <p>De rijervaring die onze wagens bieden is ongezien. De geruisloze motor van een Tesla wagen brengt u overal naar toe zonder te betalen voor benzine.</p>
          <h4>Reviews</h4>
           <p>Lees <router-link to="/reviews"><span id="reviewlink">hier</span></router-link> alle reviews.</p>
        </div>
      </div>
      <div class="col-12 content-spacer">
      </div>
    </div>
    <div v-if="!actionsButton">
      <footer> 
        <div class="button-wrapper">
          <router-link to="/login">
            <div class="button button-left">
              Aanmelden
            </div>
          </router-link>
          <router-link to="/register">
            <div class="button button-right">
              Registreren
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
  name: 'home',
  data () {
    return {
      currentUser: '',
      actionsButton: '',
      errors: []
    }
  },
  mounted: function () {
    this.checkIfAuthenticated();
  },
  methods: {
    checkIfAuthenticated: function() {
      if (localStorage.currentUser === undefined) {
        this.actionsButton = false
      }
      else {
        this.currentUser = JSON.parse(localStorage.currentUser);
        this.actionsButton = true
      }
    },
  }
}
</script>