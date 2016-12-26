<template>
  <div v-if="success" class="container">
    <div class="column">
      <nav class="nav">
        <div class="nav-left">
          <router-link @click.native="reset" class="nav-item" to="/">
            Простой Блог
          </router-link>
        </div>

        <span class="nav-toggle" @click="toggle">
          <span></span>
          <span></span>
          <span></span>
        </span>

        <div class="nav-right nav-menu" ref="menu" :class="{'is-active': isActive}">
          <router-link class="nav-item" @click.native="reset" to="/posts">Посты</router-link>
          <router-link class="nav-item" @click.native="reset" to="/tags">Теги</router-link>
          <router-link class="nav-item" @click.native="reset" to="/register" v-if="!$root.authenticated">Регистрация</router-link>
          <router-link class="nav-item" @click.native="reset" to="/login" v-if="!$root.authenticated">Войти</router-link>
          <router-link class="nav-item" @click.native="reset" v-if="$root.authenticated" :to="{ name: 'user', params: { name: $root.user.name }}">
            {{ $root.user.name }}
          </router-link>
          <a class="nav-item" @click="reset" v-if="$root.authenticated" v-on:click.prevent="signout">Выйти</a>


        </div>
      </nav>
      <div>
        <transition>
          <router-view></router-view>
        </transition>
      </div>
    </div>
  </div>
</template>

<script>
  import auth from '../auth'

  export default {
    data() {
      return {
        success: false,
        isActive: false
      }
    },


    created() {
     auth.check(this, () => {
       this.success = true;
     })
    },


    methods: {

      signout() {
        auth.signout(this)
      },

      toggle(e) {
        this.isActive = !this.isActive;
      },
      reset(e) {
        this.isActive = false;
      }
      
    }
  }
</script>