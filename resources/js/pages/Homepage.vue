<template>
  <div>
  <section class="post-section">
     <div class="container">
        <div class="row"  v-if="posts">       
          <div class="col-md-4" v-for="(post, index) in posts" :key="index">         
             <div class="post">        
                   <h4 class="title">{{post.title}}</h4>
                   <div>
                      Author: <i>{{post.user.name}}</i>
                      
                   <i class="date">{{post.date}}</i>
                   </div>
                    <button class="btn btn-info"  @click="singlePost(post.id)">Comments {{getCount(post.comments)}}</button>
                   <div v-if="post.user_id == userId">
                       <button class="btn btn-success mt-2"  @click="editPost(post.id)">Edit</button>
                       <button class="btn btn-danger mt-2" v-if="getCount(post.comments) == 0"  @click="deletePost(post.id)">Delete</button>   
                   </div>
              </div>
            </div>
             <div class="col-12 mt-4 pt-2" v-if="posts.length">
                    <ul class="pagination justify-content-center mb-0">
                        <li class="page-item"><a class="page-link" @click="prev" aria-label="Previous" >Prev</a></li>
                        <li class="page-item active"><a class="page-link" href="javascript:void(0)">{{ current }}</a></li>
                        <li class="page-item"><a class="page-link" @click="next()" aria-label="Next" >Next</a></li>
                    </ul>
                </div>
                         
          </div>
        </div>
  </section>
</div>
</template>

<script>
import http from "../services/endPoints.js";
import Pagination from 'v-pagination-3';

    export default {
    data() {
      return {
        posts: null,
        userId: localStorage.getItem('user_id'),
        current: 1,
        pageSize: null,   
      }
    },
    components: {
        Pagination
    },

    created(){
        this.getPosts();
    },

      computed: {
        indexStart() {
          return (this.current - 1) * this.pageSize;
        },
        indexEnd() {
          return this.indexStart + this.pageSize;
        },
        paginated() {
          return this.posts.slice(this.indexStart, this.indexEnd);
        }
      },

    methods: {
      getPosts(page=1) {
        http.getPosts(page)
          .then(response => {
              this.posts = response.data.data.data;
              this.pageSize = response.data.data.last_page;
          })
          .catch(e => {
            console.log(e);
          });
      },

           prev() {
            if(this.current != 1){
              this.current--;
              this.getPosts(this.current);
            }
              
        },
        next() {
          if(this.current != this.pageSize){
              this.current++;
              this.getPosts(this.current);
            }          
        },

      deletePost(id) {
        http.deletePost(id)
          .then(response => {
              this.getPosts();
          })
          .catch(e => {
            console.log(e);
          });
      },

      singlePost(id){
        this.$router.push({ name: 'SinglePost',  params: { id: id } })
      },

      editPost(id){
        this.$router.push({ name: 'EditPost',  params: { id: id } })
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

  .date{
    float:right;
  }

</style>