<template>
  <v-app id="inspire">
    <v-navigation-drawer
      v-model="drawer"
      app
      color="white"
    >
      <v-list dense>

        <v-list-item link @click="homepage()">
            <v-list-item-action>
                <v-icon>mdi-arrow-left</v-icon>
            </v-list-item-action>
            <v-list-item-content>
                <v-list-item-title>
                  <div class="subtitle-1">
                    Homepage
                  </div>
                </v-list-item-title>
            </v-list-item-content>
        </v-list-item>

         <v-list-item link>
            <v-list-item-content>
                <v-list-item-title class="text-center">
                  <v-avatar
                    size="avatarSize"
                  
                  >
                    <img src="/img/blankProfile.jpg" alt="alt" class="w-50" v-if="!profile.image">
                    <img :src="'/storage/' + profile.image" alt="alt" class="w-50" v-if="profile.image">
                  </v-avatar>

                  <div class="regular mt-3 mb-5">
                    {{ authuser.name }}
                  </div>

                </v-list-item-title>
            </v-list-item-content>
        </v-list-item>

        <router-link :to="{ name: 'dashboard' }">
            <v-list-item link>
                <v-list-item-action>
                    <v-icon>mdi-home</v-icon>
                </v-list-item-action>
                <v-list-item-content>
                    <v-list-item-title>Dashboard</v-list-item-title>
                </v-list-item-content>
            </v-list-item>
        </router-link>

        <router-link :to="{ name: 'profile' }">
            <v-list-item link>
                <v-list-item-action>
                    <v-icon>mdi-face-profile</v-icon>
                </v-list-item-action>
                <v-list-item-content>
                    <v-list-item-title>Profile</v-list-item-title>
                </v-list-item-content>
            </v-list-item>
        </router-link>


        <router-link :to="{ name: 'users' }" v-show="authuser.role === 'admin'">
            <v-list-item link>
                <v-list-item-action>
                    <v-icon>mdi-account-group</v-icon>
                </v-list-item-action>
                <v-list-item-content>
                    <v-list-item-title>Users</v-list-item-title>
                </v-list-item-content>
            </v-list-item>
        </router-link>

        <router-link :to="{ name: 'categories' }">
            <v-list-item link>
                <v-list-item-action>
                    <v-icon>mdi-cart</v-icon>
                </v-list-item-action>
                <v-list-item-content>
                    <v-list-item-title>Categories</v-list-item-title>
                </v-list-item-content>
            </v-list-item>
        </router-link>

        <router-link :to="{ name: 'posts' }">
            <v-list-item link>
                <v-list-item-action>
                    <v-icon>mdi-post</v-icon>
                </v-list-item-action>
                <v-list-item-content>
                    <v-list-item-title>Posts</v-list-item-title>
                </v-list-item-content>
            </v-list-item>
        </router-link>

        <router-link :to="{ name: 'account' }">
            <v-list-item link>
                <v-list-item-action>
                    <v-icon>mdi-account-settings</v-icon>
                </v-list-item-action>
                <v-list-item-content>
                    <v-list-item-title>Account Settings</v-list-item-title>
                </v-list-item-content>
            </v-list-item>
        </router-link>

      </v-list>
    </v-navigation-drawer>

    <v-app-bar
      app
      color="white"
    >
      <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
      <v-toolbar-title>
        VNXE BLOG
      </v-toolbar-title>

        <v-spacer></v-spacer>

        <v-btn icon color="green" width="100px" @click="logout()">
          <div class="regular">Logout</div>
          <v-icon>mdi-cached</v-icon>
        </v-btn>

    </v-app-bar>

    <v-main>
        <router-view 
        :authUser="authuser"
        :config="config"
        :user_posts="user_posts"
        :user_profile="user_profile"
        :users_count="users_count"
        :categories_count="categories_count"
        :posts_count="posts_count"
        ></router-view>
    </v-main>

    <v-footer
      color="white"
      app
    >
      <span>Charles Pitagan &copy; {{ new Date().getFullYear() }}</span>
    </v-footer>
  </v-app>
</template>

<script>
  export default {
    props: ["authuser", "user_posts", "user_profile", "users_count", "categories_count", "posts_count"],
    data () {
      return {
        drawer: null,
        config : { 
            'headers': { 
              'Authorization': 'Bearer ' + this.authuser.api_token,
              'Accept' : 'application/json',
            } 
        },
        profile : JSON.parse(this.user_profile),
      }
    },
    methods : {
        logout() {
            axios.post('/logout')
            .then(res => {
                console.log(res);
                window.location.href = '/'
            }).catch(err => console.log(err))

        },
        homepage() {
          window.location.href = '/'
        }
    }
  }
</script>