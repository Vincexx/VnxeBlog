<template>
    <div>
        <v-app>
            <v-card width="600" class="mx-auto">
                <v-card-title>Profile</v-card-title>

                <v-alert type="success" width="80%" class="mx-auto" v-show="message">
                    {{ message }}
                </v-alert>

                <v-card-text class="text-center">

                    <v-avatar
                    size="avatarSize"
                    class="mb-5"
                    v-if="!profile.image"
                    >
                    <img src="/img/blankProfile.jpg" alt="alt" class="w-50">
                    </v-avatar>

                    <v-avatar
                    size="avatarSize"
                    class="mb-5"
                    v-if="profile.image"
                    >
                    <img :src="profile.image" alt="alt" class="w-50">
                    </v-avatar>

                    <div class="display-1">
                        {{ authUser.name }}
                    </div>

                    <div class="subtitle-1">
                        Works at <a href="">{{ profile ? profile.place_of_work : "Place of Work" }}</a>
                        as <a href="">{{ profile ? profile.work : "Work" }}</a>
                    </div>

                    <div class="subtitle-2">
                        "{{ profile ? profile.bio : "Bio" }}"
                    </div>
                    
                    <v-btn class="ma-2 mt-5" tile outlined color="success" @click.stop="dialog = true">
                       <v-icon left>mdi-pencil</v-icon> Edit Profile
                    </v-btn>

                </v-card-text>

                
            </v-card>
        </v-app>
        <EditProfile :dialog="dialog" :user_profile="profile" :config="config" :authUser="authUser" />
    </div>
</template>

<script>
import EditProfile from './children/EditProfile'
    export default {
        props : ["user_profile", "config", "authUser"],
        mounted () {
            this.$on('hide_dialog', () => {
                this.dialog = false
            })

            this.$on('profile_updated', (message) => {
                location.reload()
                this.dialog = false
                this.message = message  
                
            })
        },
        components : {
            EditProfile
        },
        data() {
            return {
                message : '',
                dialog : false,
            }
        },
        computed : {
            profile () {
                if(this.user_profile) {
                    return JSON.parse(this.user_profile)
                } else {
                    return null
                }
            }
        },
    }
</script>

<style lang="scss" scoped>

</style>