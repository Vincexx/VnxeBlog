<template>
  <v-row justify="center">

    <v-dialog
      persistent
      v-model="showDialog"
      max-width="290"

    >
      <v-card>
        <v-card-title class="headline" v-show="!edit">Add Category</v-card-title>
        <v-card-title class="headline" v-show="edit">Edit Category</v-card-title>

        <v-card-text>
            <v-text-field
              name="name"
              label="Category Name"
              id="id"
              v-model="category.name"
            ></v-text-field>
        </v-card-text>

        <v-card-actions>
          <v-spacer></v-spacer>

          <v-btn
            color="green darken-1"
            text
            @click="hideDialog()"
          >
            Cancel
          </v-btn>

          <v-btn
            color="green darken-1"
            text
            @click="!edit ? addCategory() : updateCategory()"
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
    props : ["dialog", "edit", "showCategory", "authUser"],
    data () {
        return {
          config : { 
              'headers': { 
                'Authorization': 'Bearer ' + this.authUser.api_token,
                'Accept' : 'application/json',
              } 
          },
          addingCategory : {
              id : '',
              name : ''
          }
        }
    },
    computed : {
      category () {
        if(this.edit) {
            return this.showCategory
        } else {
            return this.addingCategory
        }
        // return { id : '', name : '' }
      },
      showDialog () {
          if(this.dialog) {
            return this.dialog
          } else {
            return false
          }
      },
    },
    methods : {
      hideDialog() {
        this.$parent.$emit('hideDialog')
      },
      addCategory() {
        axios.post('/api/categories', this.category, this.config)
        .then(res => {
          this.$parent.$emit('category_added')
          this.addingCategory.name = ''
        }).catch(err => console.log(err)) 
      },
      updateCategory() {
        axios.put('/api/categories/' + this.showCategory.id, this.category, this.config)
        .then(res => {
          this.$parent.$emit('category_updated')
          this.category.name = ''
        }).catch(err => console.log(err)) 
      },
    }
  }
</script>