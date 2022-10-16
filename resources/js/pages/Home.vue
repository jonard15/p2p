<template>
  <v-card
    color="grey lighten-4"
    flat
    tile
  >
    <v-toolbar dense>
      <!-- <v-app-bar-nav-icon></v-app-bar-nav-icon> -->

      <v-toolbar-title>Home</v-toolbar-title>

      <v-spacer></v-spacer>

      <v-btn href="/admin/login" text>
        Admin
      </v-btn>

      <v-btn href="/subscriber/login" text>
        Subscriber
      </v-btn>

    </v-toolbar>
  </v-card>
</template>