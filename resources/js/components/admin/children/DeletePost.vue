<template>
  <v-row justify="center">

    <v-dialog
      persistent
      v-model="showDialog"
      max-width="400"

    >
      <v-card>
        <v-card-title class="headline">Delete Post</v-card-title>

        <v-card-text>
            Are you sure you want to delete this post?
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
            @click="deletePost()"
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
    props : ["showDeleteDialog", "post_id", "authUser"],
    data () {
        return {
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
          if (this.showDeleteDialog) {
            return this.showDeleteDialog
          } else {
            return false
          }
      }
    },
    methods : {
      hideDialog() {
        this.$parent.$emit('deleteHideDialog')
      },
      deletePost() {
        axios.delete('/api/posts/' + this.post_id, this.config)
        .then(res => {
          this.$parent.$emit('post_deleted')
        }).catch(err => console.log(err)) 

      }
    }
  }
</script>