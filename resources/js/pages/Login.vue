<template>
  <div>
      <section class="content mb-5">
         <div class="container">
            <div class="row justify-content-md-center">
               <div class="col-6">
                  <div class="card card-default">
                      <div class="card-body mb-3">
                        <form >
                           <div class="form-group row mb-3">
                              <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
                              <div class="col-md-6">
                                 <input id="email" type="email" class="form-control" v-model="email" required>
                              </div>
                           </div>
                           <div class="form-group row mb-3">
                              <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                              <div class="col-md-6">
                                 <input id="password" type="password" class="form-control" v-model="password" required>
                              </div>
                           </div>
                           <div class="form-group row mb-0">
                              <div class="col-md-6 offset-md-4">
                                 <button 
                                     type="submit"
                                     class="btn btn-primary"
                                     @click = "login()">
                                  Login
                                 </button>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
   </div>
</template>
<script>
  import store from '../store'
  import http from "../services/endPoints.js";
  export default {
    data() {
      return {
        email: null,
        password: null,
        success: false,
        has_error: false,
        error: '',
      }
    },
    mounted() {
      //
    },
    methods: {
      login() {
          var data = {
            email: this.email,
            password: this.password
          };
        http.login(data)
          .then(response => {
              store.commit('loginUser')
              localStorage.setItem('token', response.data.token)
              localStorage.setItem('user_id', response.data.user_id)
              this.$router.replace( { name: 'Homepage' },
               () => {
                  this.$router.go(0);
               }
);
          })
          .catch(e => {
            console.log(e);
          });
      }
    }
  }
</script>

<style scoped lang="scss" >
    .content{
        margin-top: 100px;;
    }
</style>