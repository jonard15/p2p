<template>
  <v-app light>
    <v-toolbar class="white">
     <v-toolbar-side-icon><img width="80" src="https://i0.wp.com/saheicoretechnologies.com/wp-content/uploads/2022/07/cropped-logjpgh-removebg.png?fit=1055%2C1055" alt="Vuetify.js" height="100%"></v-toolbar-side-icon>
      <v-toolbar-title class="mx-0">Cygnus</v-toolbar-title>
      <p>Beta</p>
      <v-spacer></v-spacer>
      <v-toolbar-items>
        <v-btn href="/admin/login" text class="indigo lighten-2">Admin Page</v-btn>
        <v-btn href="/subscriber/login" text class="blue lighten-2">Subscriber Page</v-btn>
      </v-toolbar-items>
    </v-toolbar>
    <v-content>
      <section>
        <v-parallax src="https://static.vecteezy.com/system/resources/previews/002/862/709/original/cygnus-constellation-with-beautiful-bright-stars-on-the-background-of-cosmic-sky-illustration-free-vector.jpg" height="600">
          <v-layout column align-center justify-center class="white--text">
            <h1 class="white--text mb-2 display-1 text-xs-center" style="font-weight: 900; text-shadow: 3px 2px #000000">Welcome To Cygnus Application</h1>
            <!-- <div class="white--text subheading mb-3 text-xs-center" style="font-weight: 900; text-shadow: 2px 2px #000000"></div> -->
          </v-layout>
        </v-parallax>
      </section>
    </v-content>
</v-app>
</template>

<script>
export default {
};
</script>

<style scoped>
.finedTitle {
  font-weight: 900;
  text-shadow: 2px 2px #000000;
}

.social-icon {
  font-size: 21px;
  color: white;
}
</style>
