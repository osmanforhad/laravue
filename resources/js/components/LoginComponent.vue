<template>
    <v-app id="inspire">
        <v-content>
            <v-container class="fill-height" fluid>
<v-row align="center" justify="center">
<v-col cols="12" sm="8" md="4">

<v-card class="elevation-12">
<v-toolbar color="error" dark flat>
<v-tollbar-title>Login form</v-tollbar-title>
<v-spacer/>
</v-toolbar>

<v-card-text>
    <v-form>
        <v-text-field label="Login" v-model="email" name="login" prepend-icon="person" type="email"/>
        <v-text-field id="password" label="Password" v-model="password" name="password" prepend-icon="mdi-lock" type="password"/>
    </v-form>
</v-card-text>

<v-card-actions>
    <v-spacer/>
    <v-btn color="error" @click="login">Login</v-btn>
</v-card-actions>
</v-card>
</v-col>
</v-row>
            </v-container>
        </v-content>
    </v-app>
</template>

<script>
export default {
    data(){
        return{
            email: '',
            password: ''
        }
    },
    methods:{
        login: function(){
            localStorage.setItem('token', '48848484')
        }
    }
}
</script>

<style scoped>

</style>