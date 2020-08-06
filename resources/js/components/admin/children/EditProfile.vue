<template>
  <v-row justify="center">

    <v-dialog
        persistent
      v-model="dialog"
      max-width="500"
    >
      <v-card>
        <v-card-title class="regular">Edit Profile</v-card-title>

        <v-card-text>

            <v-avatar
            size="avatarSize"
            class="mb-5 d-flex justify-content-center"
            >

            <img src="/img/blankProfile.jpg" alt="alt" class="w-50" v-show="!profile.image">
            <img :src="'/storage/' + profile.image" alt="alt" class="w-50" v-if="profile.image">
            
            </v-avatar>

            <v-file-input
              label="Upload Image"
              filled
              prepend-icon="mdi-camera"
              @change="fileChange"
              name="image"
              id="image"
              show-size
            ></v-file-input>

            <v-text-field
              name="place_of_work"
              label="Place of Work"
              id="place_of_work"
              v-model="profile.place_of_work"
            ></v-text-field>

            <v-text-field
              name="work"
              label="Work"
              id="work"
              v-model="profile.work"
            ></v-text-field>


             <v-text-field
              name="bio"
              label="Bio"
              id="bio"
              v-model="profile.bio"
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
            @click="updateProfile()"
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
        props : ["dialog", "user_profile", "config", "authUser"],
        data() {
          return {
            previewImage : '',
          }
        },
        computed : {
            profile() {
                return this.user_profile
            }
        },
        methods : {
            hideDialog() {
                this.$parent.$emit('hide_dialog')
                
            },
            updateProfile() {
                const form = new FormData()
                form.append('image', this.profile.image)
                form.append('bio', this.profile.bio)
                form.append('work', this.profile.work)
                form.append('place_of_work', this.profile.place_of_work)
                form.append('_method', 'PUT')

                const config = { 
                        'headers': { 
                          'Authorization': 'Bearer ' + this.authUser.api_token,
                          'Accept' : 'application/json',
                          'Content-Type' : 'multipart/form-data',
                        },               
                      }

                axios.post('/api/profile/' + this.profile.id, form, config)
                .then(res => {
                    this.$parent.$emit('profile_updated', res.data.message)
                }).catch(err => console.log(err))

            },
            fileChange (e) {
              this.profile.image = e
            }

        }
  }
</script>