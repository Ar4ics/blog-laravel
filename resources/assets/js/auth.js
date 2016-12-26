export default {

    check(context, callback) {
        if (localStorage.getItem('id_token') !== null) {
            context.$http.get(
                '/api/profile'
            ).then(response => {
                console.log(response)
                context.$root.authenticated = true
                context.$root.user = response.data
                callback();

            }).catch(response => {
                console.log(response);
                localStorage.removeItem('id_token')
                context.$root.authenticated = false
                context.$root.user = null
                callback();
            })
        } else {
            context.$root.authenticated = false
            context.$root.user = null
            context.$http.defaults.headers.common['Authorization'] = ""
            callback();
        }



    },
    register(context, name, email, password, confirm) {
        context.$http.post(
            '/api/register',
            {
                name: name,
                email: email,
                password: password,
                password_confirmation: confirm
            }
        ).then(response => {
            context.success = true
            context.error = false
        }).catch(error => {
            let e = { ...error }
            context.response = e.response.data
            context.error = true
            context.success = false
        })
    },

    signin(context, email, password) {
        context.$http.post(
            '/api/login',
            {
                email: email,
                password: password
            }
        ).then(response => {
            console.log(response)
            context.error = false
            localStorage.setItem('id_token', response.data.meta.token)
            context.$http.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('id_token')

            context.$root.authenticated = true
            context.$root.user = response.data.user

            context.$router.push(
                { name: 'user', params: { name: response.data.user.name } }
            )
        }).catch(error => {
            console.log(error)
            context.error = true
        })
    },
    signout(context) {
        localStorage.removeItem('id_token')
        context.$root.authenticated = false
        context.$root.user = null
        context.$http.defaults.headers.common['Authorization'] = ""
        context.$router.push({
            name: 'home'
        })
    }
}