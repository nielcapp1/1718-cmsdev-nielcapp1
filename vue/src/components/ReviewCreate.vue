<template>
  <div class="review-create">
    <div class="container">
      <form id="reviewCreateForm" v-on:submit.prevent="createReview">    
          <div class="col-12 content-block"> 
            <div class="content-block-text">
              <h2>Review plaatsen</h2>
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
          <button form="reviewCreateForm" type="submit" disabled class="button-mid">
            Bevestig
          </button>
        </div>
        <div v-if="rating">
          <button form="reviewCreateForm" type="submit" class="button-mid">
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
  name: 'review-create',
  data (){
    return {
      title: '',
      rating: '',
      body: '',
      name: '',
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
        this.getFullnameUser()
      }
    },
    getFullnameUser: function() {
      let config = {
        headers: {
          'Authorization': localStorage.basicAuth
        }
      };
      axios.get('http://localhost/user/' + this.currentUser.current_user.uid+ '?_format=json',
      config)
      .then(response => {
        this.name = response.data.field_firstname_user[0].value + ' ' + response.data.field_lastname_user[0].value;
      })
      .catch(e => {
        this.errors.push(e)
      })
    },
    createReview: function() {
      let config = {
        headers: {
          'Content-type': 'application/json',
          'X-CSRF-Token': this.currentUser.csrf_token,
          'Authorization': localStorage.basicAuth
        }
      };
      axios.post(`http://localhost/entity/reviews`, 
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
        if(response.status===201) {
          this.$router.replace({ name: 'Reviews'});
          location.reload();
        }
      })
      .catch(e => {
        this.errors.push(e)
      })
    }
  },
  mounted: function () {
    this.checkIfAuthenticated();
  },
}
</script>