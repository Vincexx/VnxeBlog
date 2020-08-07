<template>
    <div>
        <v-app>
            <v-card width="600" class="mx-auto">
                <v-card-title>Account Settings</v-card-title>

                <v-alert type="success" width="80%" class="mx-auto" v-show="message">
                    {{ message }}
                </v-alert>

                <v-card-text>

                    
                    <v-text-field
                        name="name"
                        label="Name"
                        id="name"
                        v-model="authUser.name"
                    ></v-text-field>

                    <v-text-field
                        name="email"
                        label="Email"
                        id="email"
                        v-model="authUser.email"
                    ></v-text-field>

                </v-card-text>

                <v-card-actions>
                    <v-btn color="success" @click="updateProfile()">Save</v-btn>
                    <!-- <v-spacer></v-spacer>
                    <v-btn color="primary">Change Password</v-btn> -->
                </v-card-actions>
            </v-card>
        </v-app>
    </div>
</template>

<script>
    export default {
       
        props : ["authUser", "config"],
        data() {
            return {
                message : '',
                dialog : false,
            }
        },
        methods : {
            updateProfile() {
                axios.put('/api/account/' + this.authUser.id, this.authUser, this.config)
                .then(res => {
                    this.message = res.data.message
                }).catch(err => console.log(err))
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>