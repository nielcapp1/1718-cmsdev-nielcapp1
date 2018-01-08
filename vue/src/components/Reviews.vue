<template>
  <div class="reviews">
    <div class="container">
      <div class="col-12 content-block-cover">
        <img src="../../static/img/Reviews.jpg">
        <p>Reviews</p>
      </div>
      <div class="col-12 content-block">
        <div v-if="reviews.length === 0">
          <div class="content-block-text">
            <hr>
            <br>
            <h4 class="info">Er zijn nog geen reviews beschikbaar.</h4>
            <br>
            <hr>
          </div>
        </div>
        <div v-for="review in reviews">
          <div class="col-12 content-block">  
            <div class="content-block-text-vehicle">
              <div class="rating-value">
                {{ review.field_rating[0].value }}
              </div>
              <div class="rating-title">
                <h4>{{ review.name[0].value }} <span>door</span> {{ review.field_full_name_user[0].value }}</h4>
              </div>
              <div class="rating-body">
                <p>{{ review.field_body[0].value }}</p>
                <div v-if="currentUser != false">
                  <div v-show="currentUser.current_user.uid == review.user_id[0].target_id">
                    <router-link :to="{ name: 'ReviewEdit', params: { reviewId: review.id[0].value }}">
                      <button class="review-button">
                        Bewerken
                      </button>
                    </router-link>
                    <router-link :to="{ name: 'ReviewDelete', params: { reviewId: review.id[0].value }}">
                      <button class="review-button">
                        Verwijderen
                      </button>
                    </router-link>
                  </div>
                </div>
              </div>  
            </div>
          </div>
        </div>
        <div class="col-12 content-spacer">
        </div>
      </div>
    </div>
    <div v-if="currentUser != false">
      <footer>
        <div class="button-wrapper">
          <router-link to="review/create">
            <div class="button button-mid">
              Voeg een review toe
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
  name: 'reviews',
  data() {
    return {
      reviews: [],
      currentUser: '',
      errors: []
    }
  },
  methods: {
    checkIfAuthenticated: function() {
      if (localStorage.currentUser === undefined) {
        this.currenUser = false
      }
      else {
        this.currentUser = JSON.parse(localStorage.currentUser);
      }
    },
    getReviews: function() {
      axios.get(`http://localhost/api/reviews/?_format=json`)
      .then(response => {
        this.reviews = response.data;
      })
      .catch(e => {
        this.errors.push(e)
      }) 
    },
  },
  mounted: function () {
    this.checkIfAuthenticated();
    this.getReviews();
  }
}

</script>