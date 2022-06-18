<template>
  <div>
  <section class="post-section">
     <div class="container" v-if="post != null">
        <div class="row" > 
          <h4 class="title">{{post.title}}</h4>
                   <div>
                      Author: <i>{{post.user.name}}</i>
                      
                   <i class="date">{{post.date}}</i>
                   </div>
                   <p >
                      {{post.description}}
                   </p>     
             <button 
                  type="info"
                  class="btn btn-info col-md-2 mt-5"
                   @click = "leaveComment()">
                   Comment 
               </button>

            <div class="row" v-if="commentForm">
              <div class="col-md-4 mt-3">
                <textarea id="comment" type="text" class="form-control " v-model="comment" required>
                </textarea>        
                <button 
                    type="submit"
                    class="btn btn-primary mt-2"
                    @click = "createComment()">
                    Leave Comment 
                </button>  
              </div>
            
            </div>
               
           
          <p class="mt-3">
              Comments: {{getCount(post.comments)}}
          </p>   
          <hr>   
            <div v-for="comment in post.comments" key="post.id">
              <p>
                {{comment.comment_text}}
              </p>
            </div>         
          
         
             
          </div>
        </div>
  </section>
</div>
</template>

<script>
import http from "../services/endPoints.js";    
import store from '../store'
    export default {
    data() {
      return {
        post: null, 
        comment: null,
        isLogged: store.state.isLoggedIn,    
        commentForm: false,
      }
    },

    created(){
        this.getPost();
    },

    methods: {
      getPost() {
        http.singlePost(this.$route.params.id)
          .then(response => {
              this.post = response.data.data;
          })
          .catch(e => {
            console.log(e);
          });
      },

      leaveComment(){
        if(this.isLogged){
          this.commentForm = true;
        }
        else{
           this.$router.push({ name: 'Login' })
        }
      },

      createComment() {
          var data = {
            comment: this.comment,
            post_id: this.post.id,
            user_id:  parseInt(localStorage.getItem('user_id'))
          };
        http.createComment(data)
          .then(response => {
                this.$router.go(this.$router.currentRoute)

          })
          .catch(e => {
            console.log(e);
          });
      },

      getCount(comments){
        return comments.length;
      }
    },
  }
</script>

<style scoped lang="scss" >
 
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