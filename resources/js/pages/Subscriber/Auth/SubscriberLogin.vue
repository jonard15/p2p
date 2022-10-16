<template>
<div align="center" justify="center">
    <!-- <v-dialog  v-model="dialog" persistent > -->
        <!-- <v-toolbar
        flat
        color="teal"
        dark
        >
        <v-toolbar-title class="mx-0 flex text-center font-weight-black headline mt-3">MEMBER LOGIN</v-toolbar-title>
        </v-toolbar> -->
        <!-- <v-divider></v-divider> -->
            <br><br>
            <v-card class="flex text-center px-4" style="width:500px !important;">
              <alert :alert="alert" type="error" :alert_text="alert_text" />
              <v-img class="ml-3 mb-5" contain height="180px" src="/logo.png"></v-img>
                  <v-chip
                    class="ma-4 pa-5 font-weight-black overline"
                    color="#103164"
                    label
                    text-color="white"
                  >
                        <v-icon left>
                      mdi-account
                    </v-icon>
                    MEMBER LOGIN
                  </v-chip>
              <v-card-text>
                <v-form>
                  <v-text-field
                    solo
                    @keyup.enter="login"
                    v-model="formLogin.user_name"
                    label="UserName"
                    name="UserName"
                    prepend-icon="mdi-email"
                    type="text"
                    color="green"
                  />
                  <v-text-field
                    solo
                    @keyup.enter="login"
                    v-model="formLogin.password" 
                    :append-icon="showpassword ? 'mdi-eye' : 'mdi-eye-off'" 
                    :rules="passwordRules" 
                    :type="showpassword ? 'text' : 'password'" 
                    name="input-10-2" label="Password" 
                    @click:append="showpassword = !showpassword"
                    prepend-icon="mdi-lock"
                    color="green"
                  />
                <v-btn block outlined color="indigo" :disabled="formLogin.processing || !formLogin.user_name || !formLogin.password" @click="login"> <v-icon left>mdi-lock</v-icon>LOG IN</v-btn><br>
                <v-btn block outlined color="blue" @click.prevent="register" dark> <v-icon left>fa-solid fa-registered</v-icon>Register</v-btn><br>
                <!-- <v-btn block color="deep-purple" v-show="shown" @click="installPWA" dark><v-icon left>fa-solid fa-download</v-icon>Tampco Member App</v-btn> -->
                </v-form>
              </v-card-text>

            </v-card>
    <!-- </v-dialog> -->
</div>

</template>

<script>
export default {
    data() {
      return {
        dialog:true,
        alert:false,
        alert_text: '',
        formLogin: new Form({
          user_name: '',
          password: '',
        }),
        shown: false,
        showpassword: false,
        passwordRules: [
          v => !!v || 'Password is required',
        ],
      }
    },
  beforeMount() {
    window.addEventListener('beforeinstallprompt', (e) => {
      e.preventDefault()
      this.installEvent = e
      this.shown = true
    })
  },

    methods: {
    dismissPrompt() {
      this.shown = false
    },
    login() {
          const checkAccount = axios.post("checkAccount", this.formLogin)
          .then(res => {
            if(res.status == 200){
              return res.data.user_name
            }
          });
          const mem_user_name = async () => {
          const check_user_name = await checkAccount;
          if(check_user_name) {
            axios.post('login', this.formLogin)
            .then(res => {
              location.reload();
              var userData = {
                "token": res.data.token,
                "userId": res.data.user.id,
                }
              localStorage.setItem("mobileUserData", JSON.stringify(userData));
            })
            .catch(error =>                 
                  this.alert = true,
                  setTimeout(()=>{
                  this.alert=false
                  },2000),
                  this.alert_text = 'Wrong username or password'
                  )
          }else{
                  this.alert = true,
                  setTimeout(()=>{
                  this.alert=false
                  },2000)
                  this.alert_text = 'No Accounts Found'
          }

          };
          mem_user_name();

    },
    register(){
     this.$router.push('/register')
    },
    installPWA() {
      this.installEvent.prompt()
      this.installEvent.userChoice.then((choice) => {
        this.dismissPrompt() // Hide the prompt once the user's clicked
        if (choice.outcome === 'accepted') {
          // Do something additional if the user chose to install
        } else {
          // Do something additional if the user declined
        }
      })
    },
    },
};
</script>