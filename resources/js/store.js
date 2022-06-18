import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        isLoggedIn: localStorage.getItem('token'),
        userId:  localStorage.getItem('user_id'),
    },
  
    mutations: {
        loginUser (state) {
            state.isLoggedIn = true
        },
        logoutUser (state) {
            state.isLoggedIn = false
        },

        getUserId (state) {
            return state.userId;
        }
    }
})