<template>
  <v-app id="inspire">
    <v-main>
      <v-container class="fill-height" fluid>
        <v-row align="center" justify="center">
          <v-col cols="12" sm="8" md="6">
            <v-card width="600" class="elevation-12">
                  <v-row>
                    <v-col cols="12" md="12">
                      <v-card-text class="mt-5">

                          <v-card-title
                            class="justify-center overline blue-grey--text text--accent-3"
                          ><h1>LOGIN ADMIN</h1></v-card-title>
                          <v-form>
                            <v-container>
                              <v-text-field
                                v-model="formLogin.email"
                                label="Email"
                                name="Email"
                                prepend-icon="mdi-email"
                                type="text"
                                color="blue-grey accent-3"
                                outlined
                                dense
                              />

                              <v-text-field
                                v-model="formLogin.password"
                                id="password"
                                label="Password"
                                name="password"
                                prepend-icon="mdi-lock"
                                type="password"
                                color="blue-grey accent-3"
                                outlined
                                dense
                              />
                              <div class="text-center">
                                <v-btn small color="blue-grey accent-3" @click.prevent="login" dark>LOGIN</v-btn>
                                <!-- <v-btn small dark :to="{ name: 'register' }">Register</v-btn> -->
                              </div>
                            </v-container>

                          </v-form>
                      </v-card-text>
                    </v-col>
                  </v-row>
            </v-card>
          </v-col>
        </v-row>
      </v-container>
    </v-main>
  </v-app>
</template>

<script>
export default {
    data() {
      return {
        formLogin: new Form({
          email: '',
          password: '',
        }),
      }
    },

    methods: {
      login() {
        this.$store.dispatch('Auth/login', this.formLogin);
      },
    },
};
</script>