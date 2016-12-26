<template>
    <div>
        <div class="column" v-if="error">
            <p class="notification is-danger">Неверные данные</p>
        </div>
        <form class="column" v-on:submit.prevent="signin">

            <label>Почта</label>
            <p class="control">
                <input type="email" class="input" v-model="email" required>
            </p>

            <label>Пароль</label>
            <p class="control">
                <input type="password" class="input" v-model="password" required>
            </p>

            <p class="control">
                <button type="submit" class="button is-info">Зайти</button>
            </p>
        </form>
    </div>
</template>
<script>
    import auth from '../auth';

    export default {
        data() {
            return {
                email: "",
                password: "",
                error: false
            }
        },
        created() {
            if (this.$root.authenticated) {
                this.$router.push({
                    name: 'home'
                })
            }
        },

        methods: {
            signin(event) {
                auth.signin(this, this.email, this.password)
            }
        }
    }
</script>