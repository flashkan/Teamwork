<template>
    <div>
        <div v-if="!check_old_password" class="input-group">
            <input v-model="old_password" type="password" class="form-control col-3">
            <div class="input-group-append">
                <button @click="checkOldPassMethod" class="btn btn-primary">Check Password</button>
            </div>
        </div>
        <div v-if="check_old_password">
            <input hidden name="_token" :value="csrf">
            <div class="form-group row">
                <div class="col-4">
                    <input id="password" v-model="new_password" type="password" class="form-control" name="password"
                           minlength="8" required placeholder="New Password">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-4">
                    <input id="password-confirm" v-model="new_password_confirmation" type="password"
                           class="form-control" name="password_confirmation" required minlength="8"
                           placeholder="Confirm New Password">
                </div>
            </div>
            <button @click="checkNewPass" class="btn btn-primary">Register</button>
        </div>
        <div class="alert alert-danger" v-if="errors.length">
            <b>Please correct the indicated errors:</b>
            <ul>
                <li v-for="error in errors">{{ error }}</li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['url', 'csrf'],
        data() {
            return {
                old_password: null,
                new_password: null,
                new_password_confirmation: null,
                check_old_password: false,
                errors: [],
            }
        },

        mounted() {
        },

        methods: {
            checkOldPassMethod() {
                axios
                    .put(this.url, {password: this.old_password})
                    .then(response => {
                        if (response.status === 200) {
                            return response.data;
                        }
                    })
                    .then((check) => {
                        this.errors = [];
                        this.check_old_password = check;
                        if (!this.check_old_password) {
                            this.old_password = null;
                            this.errors.push('Enter the correct password')
                        }
                    })
            },

            checkNewPass() {
                let pass = this.new_password;
                let passAgain = this.new_password_confirmation;
                this.errors = [];

                if (!(pass && passAgain)) {
                    this.errors.push('Enter new password');
                    return;
                }

                if (!(pass.length >= 8)) this.errors.push('Password must be at least 8 characters');
                if (!(passAgain.length >= 8)) this.errors.push('Password confirmation must be at least 8 characters');
                if (pass.toString() !== passAgain.toString())
                    this.errors.push('Password and Password confirmation must be the same');
                if (pass === this.old_password || passAgain === this.old_password)
                    this.errors.push('The new password must be different from the old');

                if (this.errors.length === 0) {
                    axios
                        .post(this.url, {
                            password: pass,
                            password_confirmation: passAgain,
                        })
                        .then(response => {
                            if (response.status === 200) {
                                return response.data;
                            }
                        })
                        .then(updated => {
                            if (updated) {
                                location.reload();
                            } else {
                                this.errors.push('Ups. Something went wrong');
                            }
                        })
                }
            }

        },
    }
</script>
