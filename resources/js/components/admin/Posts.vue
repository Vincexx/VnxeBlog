<template>
  <div>
      <v-app>
        <v-card class="mx-auto" width="1000px">
          <v-card-title>
              Posts

              <v-spacer></v-spacer>

              <!-- <v-icon color="success" @click.stop="showAddDialog = true">mdi-plus</v-icon> -->
               <v-btn class="mx-2" fab dark color="indigo" @click.stop="showAddDialog = true">
                  <v-icon dark>mdi-plus</v-icon>
              </v-btn>
              
          </v-card-title>
          <v-data-table
            :headers="headers"
            :items="posts"
            :items-per-page="5"
          >

              <template v-slot:item.image="{ item }">
                  <div>
                    <v-img :src="'/storage/' + item.image" alt="image" width="100px" height="60px" class="m-2"></v-img>
                  </div>
              </template>
              

              <template v-slot:item.actions="{ item }">
                    <v-icon
                        small
                        class="mr-2"
                        color="primary"
                        @click.stop="showAddDialog = true, edit = true,
                        editPost(item.id)"
                    >
                        mdi-pencil
                    </v-icon>

                    <v-icon
                        color="red"
                        small
                        @click.stop="showDeleteDialog = true, post_id=item.id"
                    >
                        mdi-delete
                    </v-icon>

                </template>
          
          </v-data-table>
        </v-card>
      </v-app>
      <DeletePost :showDeleteDialog="showDeleteDialog" :post_id="post_id" :authUser="authUser"/>
      <AddPost 
      :showAddDialog="showAddDialog"
      :authUser="authUser"
      :edit="edit"
      :showPost="post"
      />
  </div>
</template>

<script>
import DeletePost from "./children/DeletePost.vue"
import AddPost from "./children/AddPost.vue"
  export default {
    mounted() {
      this.$on('deleteHideDialog', () => {
          this.showDeleteDialog = false
      })

      this.$on('post_deleted', () => {
          this.showDeleteDialog = false
          this.post_id = ''
          this.fetchPosts()
      })

      this.$on('hide_add_post_dialog', () => {
         this.showAddDialog = false
         this.edit = false
      })

      this.$on('post_added', () => {
          
          this.showAddDialog = false
          this.fetchPosts()
      })

      this.$on('post_updated', () => {
          this.showAddDialog = false
          this.edit = false
          this.fetchPosts()
         
      })

    },
    components : {
      DeletePost,
      AddPost
    },
    props : ["authUser", "user_posts"],
    data () {
      return {
        edit : false,
        showAddDialog : false,
        post_id : '',
        showDeleteDialog : false,
        posts : [],
        post : {
          user_id : '',
          category_id : '',
          title : '',
          description : ''
        },
        search: '',
        headers: [
          { text: 'Image', value: 'image', sortable: false },
          { text: 'Title', value: 'title' },
          { text: 'Category', value: 'category.name' },
          { text: 'Created At', value: 'created_at' },
          { text: 'Actions', value: 'actions', sortable: false },
        ],
        config : { 
            'headers': { 
              'Authorization': 'Bearer ' + this.authUser.api_token,
              'Accept' : 'application/json',
            } 
        },
    
      }
    },
    created() {
        this.fetchPosts()
    },
    methods: {
        fetchPosts() {
            if(this.authUser.role === 'admin') {
                axios.get('/api/posts', this.config)
                .then(res => this.posts = res.data)
                .catch(err => console.log(err))
            } else {
              this.posts = this.user_posts
            }
        },
        editPost(id) {
          axios.get('/api/posts/' + id, this.config)
            .then(res => this.post = res.data)
            .catch(err => console.log(err))
        }
    }
  }
</script>