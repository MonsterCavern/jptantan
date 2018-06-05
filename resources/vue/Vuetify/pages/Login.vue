<template lang="html">
    <v-container fluid fill-height>
        <v-layout align-center justify-center>
            <v-flex xs12 sm8 md4>
                <v-card class="elevation-12">
                    <v-toolbar dark color="primary">
                        <v-toolbar-title>Login</v-toolbar-title>
                    </v-toolbar>
                    <v-card-text>
                        <v-form>
                            <v-text-field v-model="account" prepend-icon="person" label="Login" type="text" name="account" v-validate="'required'"></v-text-field>
                            <span v-show="errors.has('account')" color="danger" >{{ errors.first('account') }}</span>
                            <v-text-field v-model="password" prepend-icon="lock" label="Password" name="password"
                                          :append-icon="e ? 'visibility' : 'visibility_off'" 
                                          :append-icon-cb="() => (e = !e)"
                                          :type="e ? 'text' : 'password'"
                                          :counter="25"
                                          v-validate="'required|min:6|max:16'"
                                          >
                            </v-text-field>
                            <span v-show="errors.has('password')"  >{{ errors.first('password') }}</span>
                        </v-form>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn @click="onSubmit" color="primary">Login</v-btn>
                    </v-card-actions>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
</template>

<script>
import Vue from 'vue'
import VeeValidate, { Validator } from 'vee-validate'

Vue.use(VeeValidate)

export default {
    data() {
        return {
            account: 'google@local.com',
            password: 'google',
            e: false
        }
    },
    props: [],
    methods: {
        onSubmit() {
            this.$validator.validate().then(result => {
                if (result) {
                    this.$axios.post('/login', { account: this.account, password: this.password }).then(response => {
                        this.$log(response)
                        let data = response.data.data
                        this.$store.commit('setUser', data)
                        this.$router.push({ path: '/auth/user' })
                    })
                }
            })
        }
    }
}
</script>

<style lang="css">
</style>
