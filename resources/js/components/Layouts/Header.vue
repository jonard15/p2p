<template>
    <v-app-bar app dark color="#222E44">
        <v-app-bar-nav-icon @click.stop="$emit('toggle-drawer')"></v-app-bar-nav-icon>
        <v-spacer></v-spacer>
        <!-- <v-btn icon>
        <v-icon>mdi-bell</v-icon>
        </v-btn> -->
        
        <v-menu
        open-on-hover
        close-on-content-click
        
        >
        <template v-slot:activator="{ on }">
            <v-btn
            class="text-overline"
            color="white"
            text
            v-on="on"
            >
                <v-icon color="white" left>mdi-account-cog</v-icon>Super Admin<v-divider class="px-2" vertical></v-divider>
                <v-icon right>mdi-chevron-down</v-icon> 
            </v-btn>
        </template>
        <v-list>
          <v-list-item>
                <form @submit.prevent="logout" class="d-inline-flex align-center">
                    <v-btn text type="submit" class="sideButton">
                        <v-icon small>mdi-logout</v-icon>
                        <small>Logout</small>
                    </v-btn>
                </form>
          </v-list-item>
        </v-list>
        </v-menu>
    </v-app-bar>
</template>
<script>
export default {
      data: () => ({
  }),

    methods: {
      logout(){
          axios.post('logout').then((response) => {
              localStorage.removeItem('authUserData')
              this.$router.go('/login')
          }).catch((errors) => {
              console.log(errors)
          })
      }
    }
}
</script>
