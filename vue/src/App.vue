<template>
  <div id="app">

      <div class="navigation">
      <div class="container">
        <div v-if="userIsAuthenticated">
            <router-link to="/profile">
              <div class="navigation-link">
                <img src="../static/img/Profielfoto.jpg">
              </div>
            </router-link>
            <router-link to="/vehicles">
              <div class="navigation-link">
                <img src="../static/img/Showroom.jpg">
              </div>
            </router-link>
            <router-link to="/contracts">
              <div class="navigation-link">
                <img src="../static/img/Contract.jpg">
              </div>
            </router-link>
          </div>
          <div class="navigation-logo">
            <router-link to="/">
              CARGO
            </router-link>
          </div>
      </div>
    </div>
    <main>
      <router-view></router-view>
    </main>
  </div>
</template>

<script>
export default {
  name: 'app',
  data () {
    return {
      userIsAuthenticated: false
    }
  },
  methods: {
    checkIfAuthenticated: function() {
      if (localStorage.currentUser != undefined) {
        this.userIsAuthenticated = true
      }
    }
  },
  mounted: function () {
    this.checkIfAuthenticated();
  }
}
</script>