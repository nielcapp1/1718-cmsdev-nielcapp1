<template>
  <div class="review-edit">
    <div class="container">
      <form id="reviewEditForm" v-on:submit.prevent="editReview">    
          <div class="col-12 content-block"> 
            <div class="content-block-text">
              <h2>Review bewerken</h2>
            </div>
            <div class="content-block-text">
              <hr>
              <br>
              <h4>Titel</h4>
              <input type="text" v-model="title" placeholder="titel" required></input>
            </div>
            <div class="content-block-text">
              <h4 for="naam">Rating</h4>
              <label><input type="radio" value="1"  v-model="rating" /><span>1</span></label>
              <label><input type="radio" value="2" v-model="rating" /><span>2</span></label>
              <label><input type="radio" value="3" v-model="rating" /><span>3</span></label>
              <label><input type="radio" value="4" v-model="rating" /><span>4</span></label>
              <label><input type="radio" value="5" v-model="rating" /><span>5</span></label>
              <br>
              <br>
            </div>
            <div class="content-block-text">
              <h4>Bericht</h4>
              <textarea type="text" v-model="body" placeholder="bericht" required></textarea>
            </div>
          </div> 
      </form>    
    </div>
    <div class="col-12 content-spacer">
    </div>
    <footer>
      <div class="button-wrapper">
        <div v-if="!rating">
          <button form="reviewEditForm" type="submit" disabled class="button-mid">
            Bevestig
          </button>
        </div>
        <div v-if="rating">
          <button form="reviewEditForm" type="submit" class="button-mid">
            Bevestig
          </button>
        </div>
      </div> 
    </footer>
  </div>
</template>

<script>
import axios from 'axios'
export default {
  name: 'review-edit',
  data (){
    return {
      title: '',
      rating: '',
      body: '',
      name: '',
      review: [],
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
    checkIfAuthenticatedUserIsAllowed: function() {
      if(this.currentUser.current_user.uid != this.review.user_id[0].target_id) {
        this.$router.replace({ name: 'Reviews' });
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
        this.title = response.data.name[0].value
        this.rating = response.data.field_rating[0].value
        this.body = response.data.field_body[0].value
        this.name = response.data.field_full_name_user[0].value
        this.checkIfAuthenticatedUserIsAllowed();
      })
      .catch(e => {
        this.errors.push(e)
        this.$router.replace({ name: 'Reviews'});
        location.reload();
      })
    },
    editReview: function(){
      let config = {
        headers: {
          'Accept': 'json',
          'Content-type': 'application/json',
          'X-CSRF-Token': this.currentUser.csrf_token,
          'Authorization': localStorage.basicAuth
        }
      };
      axios.patch(`http://localhost/cargo/reviews/` + this.$route.params.reviewId, 
      {
        "name": [
            {
                "value": this.title
            }
        ],
        "field_rating": [
            {
                "value": this.rating
            }
        ],
        "field_body": [
            {
                "value": this.body
            }
        ],
        "field_full_name_user": [
            {
                "value": this.name
            }
        ]  
      }, 
      config)
      .then(response => {
        this.$router.replace({ name: 'Reviews'});
        location.reload();
      })
      .catch(e => {
        this.errors.push(e)
        console.log(e.response);
        console.log(this.currentUser.csrf_token);
      })
    }
  },
  mounted: function () {
    this.checkIfAuthenticated();
  }
}
</script>