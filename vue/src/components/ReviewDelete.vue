<template>
  <div class="review-delete">
    <div class="container">
      <div class="col-12 content-block"> 
        <div class="content-block-text">
          <h2>Review verwijderen</h2>
          <br>
          <hr>
        </div>
        <div class="content-block-text">
          <h4>Bent u zeker dat u deze review wil verwijderen?</h4>
          <br>
          <p class="info"><i>"{{ review.field_body[0].value }}"</i></p>
          <br>
          <hr>
        </div>
      </div>
      <div class="col-12 content-spacer">
      </div>
    </div>
    <footer>
      <div class="button-wrapper">
        <button v-on:click="deleteReview" class="button-mid">
          Delete
        </button>
      </div>
    </footer>
  </div>
</template>

<script>
import axios from 'axios'
export default {
  name: 'review-delete',
  data (){
    return {
      review: '',
      currentUser: '',
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
        this.getReview();
      }
    },
    getReview: function(){
      let config = {
        headers: {
          'X-CSRF-Token': this.currentUser.csrf_token,
          'Authorization': localStorage.basicAuth
        }
      };
      axios.get('http://localhost/cargo/reviews/' + this.$route.params.reviewId + '?_format=json',
      config)
      .then(response => {
        this.review = response.data
        this.checkIfAuthenticatedUserIsAllowed();
      })
      .catch(e => {
        this.errors.push(e)
        this.$router.replace({ name: 'Reviews'});
        location.reload();
      })
    },
    deleteReview: function() {
      let config = {
        headers: {
          'Content-type': 'application/json',
          'X-CSRF-Token': this.currentUser.csrf_token,
          'Authorization': localStorage.basicAuth
        }
      };
      axios.delete(`http://localhost/cargo/reviews/` + this.$route.params.reviewId +  `?_format=json`,
      config)
      .then(response => {
        this.$router.replace({ name: 'Reviews'});
        location.reload();
      })
      .catch(e => {
        this.errors.push(e)
        console.log(e.response);
      })
    },
    checkIfAuthenticatedUserIsAllowed: function() {
      if(this.currentUser.current_user.uid != this.review.user_id[0].target_id) {
        this.$router.replace({ name: 'Reviews' });
      }
    },
  },
  mounted: function () {
    this.checkIfAuthenticated();
  }
}
</script>