<template>
  <v-row justify="center">

    <v-dialog
      persistent
      v-model="showDialog"
      max-width="400"

    >
      <v-card>
        <v-card-title class="headline">Delete Category</v-card-title>

        <v-card-text>
            Are you sure you want to delete this category?
        </v-card-text>

        <v-card-actions>
          <v-spacer></v-spacer>

          <v-btn
            color="green darken-1"
            text
            @click="hideDialog()"
          >
            No
          </v-btn>

          <v-btn
            color="red darken-1"
            text
            @click="deleteCategory()"
          >
            Yes
          </v-btn>

        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-row>
</template>

<script>
  export default {
    props : ["dialog", "showDeleteModal", "category_id", "authUser"],
    data () {
        return {
          category : {
            id : '',
            name : '',
          },
          config : { 
            'headers': { 
              'Authorization': 'Bearer ' + this.authUser.api_token,
              'Accept' : 'application/json',
            } 
          },
        }
    },
    computed : {
      showDialog () {
          if (this.dialog) {
            return this.dialog
          } else if (this.showDeleteModal) {
            return this.showDeleteModal
          } else {
            return false
          }
      }
    },
    methods : {
      hideDialog() {
        this.$parent.$emit('hideDialog')
      },
      deleteCategory() {
        axios.delete('/api/categories/' + this.category_id, this.config)
        .then(res => {
          this.$parent.$emit('category_deleted')
          if(res.data.message) {
            this.$parent.$emit('cant_delete_category', res.data.message)
          }
        }).catch(err => console.log(err.data.response)) 

      }
    }
  }
</script>