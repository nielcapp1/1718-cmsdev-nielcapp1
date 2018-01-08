// Vue
import Vue from 'vue'

// Vue Router
import Router from 'vue-router'

// Home
import Home from '@/components/Home'

// User
import Login from '@/components/Login'
import Register from '@/components/Register'
import Profile from '@/components/Profile'
import ProfileEdit from '@/components/ProfileEdit'

// Vehicles
import Vehicles from '@/components/Vehicles'
import VehicleDetails from '@/components/VehicleDetails'

// Contracts
import Contracts from '@/components/Contracts'
import ContractCreate from '@/components/ContractCreate'
import ContractDetails from '@/components/ContractDetails'
import ContractExtend from '@/components/ContractExtend'
import ContractStop from '@/components/ContractStop'

// Reviews
import Reviews from '@/components/Reviews'
import ReviewCreate from '@/components/ReviewCreate'
import ReviewDelete from '@/components/ReviewDelete'
import ReviewEdit from '@/components/ReviewEdit'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'Home',
      component: Home
    },
    {
      path: '/profile',
      name: 'Profile',
      component: Profile
    },
    {
      path: '/profile/edit/:userId',
      name: 'ProfileEdit',
      component: ProfileEdit
    },
    {
      path: '/login',
      name: 'Login',
      component: Login
    },
    {
      path: '/register',
      name: 'Register',
      component: Register
    },
    {
      path: '/vehicles',
      name: 'Vehicles',
      component: Vehicles
    },
    {
      path: '/vehicles/details/:vehicleId',
      name: 'VehicleDetails',
      component: VehicleDetails
    },
    {
      path: '/contracts',
      name: 'Contracts',
      component: Contracts
    },
    {
      path: '/contract/details/:contractId',
      name: 'ContractDetails',
      component: ContractDetails
    },
    {
      path: '/contract/stop/:contractId',
      name: 'ContractStop',
      component: ContractStop
    },
    {
      path: '/contract/extend/:contractId',
      name: 'ContractExtend',
      component: ContractExtend
    },
    {
      path: '/contract/create',
      name: 'ContractCreate',
      component: ContractCreate
    },
    {
      path: '/reviews',
      name: 'Reviews',
      component: Reviews
    },
    {
      path: '/review/create',
      name: 'ReviewCreate',
      component: ReviewCreate
    },
    {
      path: '/review/delete/:reviewId',
      name: 'ReviewDelete',
      component: ReviewDelete
    },
    {
      path: '/review/edit/:reviewId',
      name: 'ReviewEdit',
      component: ReviewEdit
    }
  ]
})
