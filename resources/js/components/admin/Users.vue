<template>
    <div>
         <v-card class="mx-auto" width="1000px" v-show="authUser.role === 'admin'">
            <v-card-title>
                Users
                <v-spacer></v-spacer>
                <v-icon color="success" @click.stop="dialog=true">mdi-plus</v-icon>
            </v-card-title>


            <v-divider></v-divider>

            <v-data-table
            :headers="headers"
            :items-per-page="50"
            :items="users"
            >
            
                   <template v-slot:item.actions="{ item }">
                     
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

        <v-container>
            <v-alert
                border="right"
                colored-border
                type="error"
                elevation="2"
                v-show="authUser.role !== 'admin'"
                >
                Unauthorized action.
            </v-alert>
        </v-container>

    </div>
</template>

<script>
    export default {
        props : ["config", "authUser"],
        data() {
            return {
                users : [],
                headers: [
                    { text: 'Name', value: 'name' },
                    { text: 'Email', value: 'email' },
                    { text: 'Number of Posts', value: 'posts.length' },
                    { text: 'Role', value: 'role' },
                    { text: 'Actions', value: 'actions', sortable: false },
                ],
            }
        },
        created() {
            this.fetchUsers()
        },
        methods : {
            fetchUsers() {
                axios.get('/api/users', this.config)
                .then(res => this.users = res.data)
                .catch(err => console.log(err))
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>