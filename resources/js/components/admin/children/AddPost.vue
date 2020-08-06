<template>
  <v-row justify="center">

    <v-dialog
        persistent
      v-model="dialog"
      max-width="500"
    >
      <v-card>
        <v-card-title class="headline" v-show="!edit">Add Post</v-card-title>
        <v-card-title class="headline" v-show="edit">Edit Post</v-card-title>

        <v-card-text>

            <v-text-field
                name="name"
                label="Title"
                id="id"
                v-model="post.title"
            ></v-text-field>

            <v-select

                :items="categories"
                item-text="name"
                item-value="id"
                label="Select Categories"
                v-model="post.category_id"

            ></v-select>

            <v-textarea
            clearable
            clear-icon="x"
            label="Description"
            v-model="post.description"   
            ></v-textarea>

            <div v-if="post.image" class="mb-2">
              <v-img :src="'/storage/' + post.image" alt="image" v-if="edit">
              </v-img>
            </div>

            <v-file-input
              label="Upload Image"
              filled
              prepend-icon="mdi-camera"
            
              name="image"
              id="image"
              show-size
              v-model="file"
            ></v-file-input>


        

        </v-card-text>

        <v-card-actions>
          <v-spacer></v-spacer>

          <v-btn
            color="green darken-1"
            text
            @click="hideAddPostDialog()"
          >
            Close
          </v-btn>

          <v-btn
            color="green darken-1"
            text
            @click="!edit ? addPost() : updatePost()"
          >
            Save
          </v-btn>
        </v-card-actions>
        
      </v-card>
    </v-dialog>
  </v-row>
</template>

<script>
  export default {
    props : ["showAddDialog", "authUser", "edit", "showPost"],
    data () {
        return {
            file : null,
            categories : [],
            config : { 
                'headers': { 
                  'Authorization': 'Bearer ' + this.authUser.api_token,
                  'Accept' : 'application/json',
                  'Content-Type' : 'multipart/form-data'
                } 
            },
            form : new FormData(),
            updateForm : new FormData(),
            addingPost : {
                user_id : '',
                category_id : '',
                title : '',
                description : '',
                image : '',
            }
        }
    },
    computed : {
        dialog() {
            if(this.showAddDialog) {
                return this.showAddDialog
            } else {
                return false
            }
        },
        post () {
          if(this.edit) {
            return this.showPost
          } else {
            return this.addingPost
          }

        }

    },
    created() {
        this.fetchCategories()
    },
    methods : {
        fetchCategories() {
            axios.get('/api/categories', this.config)
            .then(res => this.categories = res.data)
            .catch(err => console.log(err))
        },
        hideAddPostDialog() {
            this.$parent.$emit('hide_add_post_dialog');
        },
        addPost() {
            this.post.user_id = this.authUser.id
            this.form.append('user_id', this.post.user_id);
            this.form.append('category_id', this.post.category_id);
            this.form.append('title', this.post.title);
            this.form.append('description', this.post.description);
            this.form.append('image', this.file);


            axios.post('/api/posts', this.form, this.config)
            .then(res => {

                this.addingPost.user_id = ''
                this.addingPost.category_id = ''
                this.addingPost.title = ''
                this.addingPost.description = ''
                this.addingPost.image = ''
                this.file = null

                this.$parent.$emit('post_added')
            }).catch(err => console.log(err))
        },
        updatePost() {
          let post = {
            user_id : this.post.user_id,
            category_id : this.post.category_id,
            title : this.post.title,
            description : this.post.description,
            image : this.post.image
          }
        
          axios.put('/api/posts/' + this.showPost.id, post, this.config)
          .then(res => {
            console.log(res.data)
          }).catch(err => console.log(err))

        }
      

    }
  }
</script>