<template>
  <div>
      <section class="content mb-5">
         <div class="container">
            <div class="row justify-content-md-center">
               <div class="col-6">
                  <div class="card card-default">
                      <div class="card-body">
                        <form >
                           <div class="form-group row mb-3">
                              <label for="email" class="col-md-4 col-form-label text-md-right">Title</label>
                              <div class="col-md-6">
                                 <input id="title" type="text" class="form-control" v-model="title" required>
                              </div>
                           </div>
                           <div class="form-group row mb-3">
                              <label for="password" class="col-md-4 col-form-label text-md-right">Date</label>
                              <div class="col-md-6">
                                 <input id="date" type="date" class="form-control" v-model="date" required>
                              </div>
                           </div>
                           <div class="form-group row mb-3">
                              <label for="password" class="col-md-4 col-form-label text-md-right">Descrtiption</label>
                              <div class="col-md-6">
                                 <textarea id="description" type="text" class="form-control" v-model="description" required>
                                 </textarea>
                              </div>
                           </div>
                           <div class="form-group row mb-0">
                              <div class="col-md-6 offset-md-4">
                                 <button 
                                     type="submit"
                                     class="btn btn-primary"
                                     @click = "createPost()">
                                  Create Post
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

  import http from "../services/endPoints.js";
  export default {
    data() {
      return {
        title: null,
        date: null,
        description: null,
      }
    },
    mounted() {
      //
    },
    methods: {
      createPost() {
          var data = {
            title: this.title,
            date: this.date,
            description: this.description,
            user_id: localStorage.getItem('user_id')
          };
        http.createPost(data)
          .then(response => {
               this.$router.push({ name: 'Homepage' })
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

      .post-section{
      padding-bottom: 80px;
  }

  .title{
      padding-top:20px;
  }         
  
  .post{   
      padding: 20px;
      -webkit-box-shadow: 0px 0px 15px -1px #525252;
    }
  .post:hover{
      box-shadow: 11px 18px 26px 0px #525252;
  }
</style>