<template>
  <v-layout align-center justify-center>
    <v-flex xs12 sm8 md4>
      <v-alert
        v-model="alert"
        dismissible
        :type= "alertType"
      >
        {{alertMessage}}
      </v-alert>
      <v-card class="elevation-12">
        <!-- Header card -->
        <v-toolbar dark color="teal accent-4">
          <v-toolbar-title><img src="../assets/Logo.png" height="40"></v-toolbar-title>
          <v-spacer></v-spacer>
        </v-toolbar>
        <!-- formulario -->
        <form @submit.prevent="auth">
          <v-card-text>
            <v-text-field color="teal accent-4" prepend-icon="fa-user" name="login" label="Usuario" type="text" autocomplete="off" v-model="form.username"></v-text-field>
            <v-text-field color="teal accent-4" id="password" prepend-icon="fa-lock" name="password" label="Contraseña" type="password" v-model="form.password"></v-text-field>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn type="submit" dark color="teal accent-4">Login</v-btn>
          </v-card-actions>
        </form> <!-- Fin form-->
      </v-card>
    </v-flex>
  </v-layout>
</template>

<script>
  import axios from 'axios';

  export default {
    name: 'Login',
    data(){
      return {
        form:{
          username: '',
          password: ''
        },
        alert: false,
        alertType: "error",
        alertMessage: ""
      }
    },
    methods: {
      auth(){
        this.$store.dispatch('login');
        const vm = this;
        axios.post('http://payroll.com.local/api/auth/login', this.$data.form)
          .then( async (res) => {
            if (res.data.error) {
              console.log(res.data.error);
            }else{
              await this.$store.commit('loginSuccess', {
                user: res.data.user,
                token: res.data.user.token,
                isAdmin: res.data.isAdmin
              });

              vm.$router.push({path: '/'});
            }

          })
          .catch((error) => {
            console.log(error);
            this.alertMessage = "¡Usuario o Contraseña incorrecta!";
            this.alert = true;
            this.$store.commit('loginFailed', {error})
          });
      }
    }
  }
</script>
