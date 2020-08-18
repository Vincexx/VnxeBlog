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

          
            <div v-if="post.image && !previewImage" class="mb-2">
              <v-img :src="post.image_path_aws" alt="image" v-if="edit">
              </v-img>
            </div>

            <div v-if="previewImage" class="mb-2">
              <v-img :src="previewImage" alt="image" width="100%" height="250px">
              </v-img>
            </div>

            <v-file-input
             class="mt-2"
              label="Upload Image"
              filled
              prepend-icon="mdi-camera"
              clearable
              name="image"
              id="image"
              show-size
              @change="fileChange"
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
        
            previewImage : '',
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
                this.previewImage = ''

                this.$parent.$emit('post_added')
            }).catch(err => console.log(err))
        },
        updatePost() {
          const form = new FormData()

          form.append('user_id', this.authUser.id);
          form.append('category_id', this.post.category_id);
          form.append('title', this.post.title);
          form.append('description', this.post.description);
          form.append('image', this.file);
          form.append('_method', 'PUT');
        
          axios.post('/api/posts/' + this.showPost.id, form, this.config)
          .then(res => {
            this.previewImage = ''
            this.$parent.$emit('post_updated')
          }).catch(err => console.log(err))

        },
        fileChange(e) {
          this.file = e
          this.previewImage = URL.createObjectURL(e)

        }
      

    }
  }
</script>