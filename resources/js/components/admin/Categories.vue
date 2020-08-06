<template>
    <div>
        <v-card class="mx-auto" width="600px">
            <v-card-title>
                Categories
                <v-spacer></v-spacer>
                <!-- <v-icon color="success" @click.stop="dialog=true">mdi-plus</v-icon> -->

                <v-btn class="mx-2" fab dark color="indigo" @click.stop="dialog = true">
                  <v-icon dark>mdi-plus</v-icon>
                </v-btn>
                
            </v-card-title>

            <v-alert type="error" v-show="errorMessage">
              {{ errorMessage }}
            </v-alert>

            <v-divider></v-divider>

            <v-data-table
            :headers="headers"
            :items-per-page="5"
            :items="categories"
            >
            
                   <template v-slot:item.actions="{ item }">
                      <v-icon
                          color="primary"
                          small
                          class="mr-2"
                          @click.stop="dialog = true, edit = true,
                          editCategory(item.id)"
                      >
                          mdi-pencil
                      </v-icon>
                      <v-icon
                      color="red"
                          small
                          @click.stop="showDeleteModal=true, category_id=item.id"
                      >
                          mdi-delete
                      </v-icon>

                  </template>


            </v-data-table>
        </v-card> 
        <AddCategory :dialog="dialog" :edit="edit" :showCategory="category" :authUser="authUser" />
        <DeleteCategory :showDeleteModal="showDeleteModal" 
                        :category_id="category_id"
                        :authUser="authUser" />
    </div>
</template>

<script>
  import AddCategory from "./children/AddCategory.vue"
  import DeleteCategory from "./children/DeleteCategory.vue"
  export default {
    components : {
        AddCategory,
        DeleteCategory
    },
    mounted () {
      this.$on('hideDialog', () => {
         this.dialog = false
         this.showDeleteModal = false
         this.edit = false
         this.category = ''
      }),

      this.$on('category_added', () => {
         this.dialog = false
         this.fetchCategories()
         this.errorMessage = ''
         this.category = {}
      })

      this.$on('category_deleted', () => {
         this.showDeleteModal = false
         this.fetchCategories()
         this.category_id = ''
         this.errorMessage = ''
      })

      this.$on('cant_delete_category', (error) => {
        this.errorMessage = error
      })

      this.$on('category_updated', () => {
         this.dialog = false
         this.edit = false
         this.category_id = ''
         this.fetchCategories()
         this.errorMessage = ''
      })

    },
    props : ["authUser"],
    data () {
      return {
        config : { 
            'headers': { 
              'Authorization': 'Bearer ' + this.authUser.api_token,
              'Accept' : 'application/json',
            } 
        },
        errorMessage : '',
        edit : false,
        category_id : '',
        showDeleteModal : false,
        dialog : false,
        categories : [],
        category : {
          id : '',
          name : ''
        },
        search: '',
        headers: [
          { text: 'Category Name', value: 'name' },
          { text: 'Number of Posts', value: 'posts.length' },
          { text: 'Actions', value: 'actions', sortable: false },
        ],
    
      }
    },
    created() {
        this.fetchCategories()
    },
    methods: {
        fetchCategories() {
            axios.get('/api/categories', this.config)
            .then(res => this.categories = res.data)
            .catch(err => console.log(err))
        },
        editCategory(id) {
            axios.get('/api/categories/' + id, this.config)
            .then(res => this.category = res.data)
            .catch(err => console.log(err))
        }
    }
    
  }
</script>