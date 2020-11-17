<template>
  <v-app id="inspire">
    <v-main>
      <v-container class="fill-height" fluid>
        <v-row align="center" justify="center">
          <v-col cols="12" sm="8" md="4">
            <v-card class="elevation-12">
              <v-toolbar color="error" dark flat>
                <v-toolbar-title>Login</v-toolbar-title>
                <v-spacer />
              </v-toolbar>

              <v-card-text>
                <v-progress-linear
                  :active="loading"
                  :indeterminate="loading"
                  absolute
                  bottom
                  color="deep-purple accent-4"
                ></v-progress-linear>

                <v-form ref="form" v-model="valid">
                  <v-text-field
                    color="error"
                    label="Login"
                    v-model="email"
                    :rules="emailRules"
                    name="login"
                    prepend-icon="person"
                    type="email"
                    required
                  />
                  <v-text-field
                    color="error"
                    id="password"
                    label="Password"
                    v-model="password"
                    name="password"
                    prepend-icon="mdi-lock"
                    type="password"
                    :counter="8"
                    required
                  />
                </v-form>
              </v-card-text>

              <v-card-actions>
                <v-spacer />
                <v-btn color="error" :disabled="!valid" @click="login"
                  >Login</v-btn
                >
              </v-card-actions>
            </v-card>
            <v-snackbar v-model="snackbar">
              {{ text }}

              <template v-slot:action="{ attrs }">
                <v-btn
                  color="pink"
                  text
                  v-bind="attrs"
                  @click="snackbar = false"
                >
                  Close
                </v-btn>
              </template>
            </v-snackbar>
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
      valid: true,
      email: "",
     emailRules: [
        v => !!v || 'E-mail is required',
        v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
      ],
      password: "",
      passwordRules: [
         (v) => !!v || "Password is required",
      ],
      loading: false,
      snackbar: false,
      text: "",
    };
  },
  methods: {
    login: function () {
      // Add a request interceptor
      axios.interceptors.request.use(
        (config) => {
          this.loading = true;
          return config;
        },
        (error) => {
          // Do something with request error
          this.loading = false;
          return Promise.reject(error);
        }
      );

      // Add a response interceptor
      axios.interceptors.response.use(
        (response) => {
          this.loading = false;
          return response;
        },
        (error) => {
          // Any status codes that falls outside the range of 2xx cause this function to trigger
          // Do something with response error
          this.loading = false;
          return Promise.reject(error);
        }
      );
      axios
        .post("/api/login", { email: this.email, password: this.password })
        .then((res) => {
          localStorage.setItem("token", res.data.token);
          localStorage.setItem("loggedIn", true);
          this.$router
            .push("/admin")
            .then((res) => console.log("LoggedIn Successfuly"))
            .catch((err) => console.log(err));
        })
        .catch((err) => {
          this.text = err.response.data.status;
          this.snackbar = true;
        });
    },
  },
};
</script>

<style scoped>
</style>