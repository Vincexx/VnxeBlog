<template>
    <div>
        <v-app>
            <v-container grid-list-xs>
                <v-row>
                    <v-col v-show="authUser.role === 'admin'" cols="12" md="4"> 
                        <v-card color="red lighten-4">
                            <v-card-title>Users</v-card-title>

                            <v-card-text>
                                12
                            </v-card-text>
                        </v-card>
                    </v-col>
                     <v-col cols="12" md="4">
                        <v-card color="pink lighten-4">
                            <v-card-title>Categories</v-card-title>

                            <v-card-text>
                                12
                            </v-card-text>
                        </v-card>
                    </v-col>
                     <v-col cols="12" md="4">
                        <v-card color="purple lighten-4">
                            <v-card-title>Posts</v-card-title>

                            <v-card-text>
                                12
                            </v-card-text>
                        </v-card>
                    </v-col>
                     <v-col cols="12" md="4">
                        <v-card color="blue lighten-4">
                            <v-card-title>Comments</v-card-title>

                            <v-card-text>
                                12
                            </v-card-text>
                        </v-card>
                    </v-col>
                </v-row>
            </v-container>
        </v-app>
    </div>
</template>

<script>
    export default {
        props : ["authUser"],
    }
</script>

<style lang="scss" scoped>

</style>