<template>
  <v-row justify="center">

    <v-dialog
      persistent
      v-model="showDeleteModal"
      max-width="400"

    >
      <v-card>
        <v-card-title class="headline">Delete User</v-card-title>

        <v-card-text>
            Are you sure you want to delete this user?
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
            @click="deleteUser()"
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
    props : ['showDeleteModal', 'user_id'],
    data () {
        return {
          
        }
    },
    methods : {
      hideDialog() {
        this.$parent.$emit('hide_dialog')
      },
      deleteUser() {
          axios.delete('/api/users/' + this.user_id)
          .then(res => {
              this.$parent.$emit('user_deleted')
          }).catch(err => console.log(err))
      }
    }
  }
</script>