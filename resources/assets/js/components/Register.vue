<template>
    <div>
        <div class="column" v-if="error && !success">
            <p class="notification is-danger">Ошибка при регистрации</p>
        </div>
        <div class="column" v-if="success">
            <p class="notification is-success">Регистрация успешно завершена</p>
        </div>
        <form class="column" autocomplete="off" @submit.prevent="register" v-if="!success">

            <label>Имя</label>
            <p class="control">
                <input type="text" class="input" v-model="name" required>
                <span class="help is-danger" v-if="error && response.hasOwnProperty('name')">{{ response.name[0] }}</span>
            </p>



            <label>Почта</label>
            <p class="control">
                <input type="email" class="input" v-model="email" required>
                <span class="help is-danger" v-if="error && response.hasOwnProperty('email')">{{ response.email[0] }}</span>
            </p>

            <label>Пароль</label>
            <p class="control">
                <input type="password" class="input" v-model="password" required>
                <span class="help is-danger" v-if="error && response.hasOwnProperty('password')">{{ response.password[0] }}</span>
            </p>

            <label>Повторите пароль</label>
            <p class="control">
                <input type="password" class="input" v-model="password_confirmation" required>
            </p>

            <p class="control">
                <button type="submit" class="button is-success">Зарегаться</button>
            </p>
        </form>
    </div>
</template>

<script>
    import auth from '../auth'

    export default {
        data() {
            return {
                email: "",
                name: "",
                password: "",
                password_confirmation: "",
                success: false,
                error: false,
                response: {}
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
            register(event) {
                auth.register(this, this.name, this.email, this.password, this.password_confirmation)

            }
        }
    }
</script>