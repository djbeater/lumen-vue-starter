<template>
  <div>
    <!--
    <div class="top-right links">
      <template v-if="authenticated">
        <router-link :to="{ name: 'home' }">
          {{ $t('home') }}
        </router-link>
      </template>
      <template v-else>
        <router-link :to="{ name: 'login' }">
          {{ $t('login') }}
        </router-link>
        <router-link :to="{ name: 'register' }">
          {{ $t('register') }}
        </router-link>
      </template>
    </div>
  -->

    <div class="text-center">
      <!--
      <div class="title mb-4">
        {{ title }}
      </div>
    -->

  <div class="form-group">
    <input type="text" class="form-control" v-model="hashtagCatcher">
  </div>

<div class="row">
  <div class="card-group">
    <div v-for="post in posts" :class="post.admin == true ? 'col-sm-12' : 'col-sm-6'">
      <div :class="post.admin == true ? 'card w-100' : 'card w-80'">
        <img class="card-img-top img-fluid" :src="post.image" alt="Card image cap">
        <div class="card-block">
          <h5 class="card-title">
            <div class="user-image-container ">
              <div class="user-image-container-inner debugg">
              </div>
              <div class="username-container">
                <img
                  class="user-image rounded-circle"
                  :src="post.userImage"
                  style="margin-top: 10px;">
                  <span class="user-name">{{ post.user }}</span>
                  <span class="username">{{ post.userName }}</span>
                  <span class="pull-right"><img :src="post.socialIcon" style="height: 50px;"></span>
              </div>
            </div>
          </h5>
          <p class="card-text">
            <h1 v-if="post.admin">{{ post.text }}</h1>
            <span v-else>{{ post.text }}</span>
          </p>
          <p class="card-text">
            <small class="text-muted">Last updated 3 mins ago</small>
          </p>
        </div>
      </div>
    </div>

  <!--
    <div v-if="!post.admin" class="col-sm-6">
    <div class="card-group">
      <div class="card w-75">
        <img class="card-img-top img-fluid" :src="post.image" alt="Card image cap">
        <div class="card-block">
          <h5 class="card-title">
            <div class="user-image-container ">
              <div class="user-image-container-inner debugg">
              </div>
              <div class="username-container">
                <img
                  class="user-image rounded-circle"
                  :src="post.userImage"
                  style="margin-top: 10px;">
                  <span class="user-name">{{ post.user }}</span>
                  <span class="username">{{ post.userName }}</span>
                  <span class="pull-right"><img :src="post.socialIcon" style="height: 50px;"></span>
              </div>
            </div>
          </h5>
          <p class="card-text">
            {{ post.text }}
          </p>
          <p class="card-text">
            <small class="text-muted">Last updated 3 mins ago</small>
          </p>
        </div>
      </div>
    </div>
  </div>
-->

</div>

  <!--
  <div class="col-sm-6">

  <div class="card-column">
  <div class="card">
    <img class="card-img-top img-fluid" src="https://picsum.photos/600/600/?random" alt="Card image cap">
    <div class="card-block">
      <h5 class="card-title">
        <div class="user-image-container ">
          <div class="user-image-container-inner debugg">
          </div>
          <div class="username-container">
            <img
              class="user-image rounded-circle"
              src="https://pbs.twimg.com/profile_images/961345599948906496/uCw2Ben__normal.jpg"
              style="margin-top: 10px;">
              <span class="user-name">DiscoNakts</span>
              <span class="username">@disconakts</span>
          </div>
        </div>
      </h5>
      <p class="card-text">

      </p>
      <p class="card-text">
        <small class="text-muted">Last updated 3 mins ago</small>
      </p>
    </div>
  </div>
</div>

</div>

<div class="col-sm-6">

<div class="card-column">
<div class="card">
  <img class="card-img-top img-fluid" src="https://loremflickr.com/600/600" alt="Card image cap">
  <div class="card-block">
    <h5 class="card-title">
      <div class="user-image-container">
          <div class="username-container">
            <img
              class="user-image rounded-circle"
              src="https://pbs.twimg.com/profile_images/872159308884168709/AZ5YUbNx_normal.jpg"
              style="margin-top: 10px;">
          </div>
      </div>
      <span class="user-name">Raivis Šulcs</span>
      <span class="username">@McRaivii</span>
    </h5>
    <p class="card-text">
      Beidzot saņēmām atbildi - cik maksā piens litrā? 👍😂 Atbilde nav iepriecinoša 🙄😎😂 / dienaszaglis… https://www.instagram.com/p/BAZ9NgnrHR3/
    </p>
    <p class="card-text">
      <small class="text-muted">Last updated 8 mins ago</small>
    </p>
  </div>
</div>
</div>

</div>
-->


<!--
<div class="col-sm-6">
<div class="card">
  <img class="card-img-top img-fluid" src="https://loremflickr.com/400/400" alt="Card image cap">
  <div class="card-block">
    <h4 class="card-title">
      <img
        class="rounded-circle"
        src="https://pbs.twimg.com/profile_images/872159308884168709/AZ5YUbNx_normal.jpg"
        style="margin-top: 10px;">
      Raivis Šulcs
    </h4>
    <h6 class="card-title">@McRaivii</h6>
    <p class="card-text">
      Beidzot saņēmām atbildi - cik maksā piens litrā? 👍😂 Atbilde nav iepriecinoša 🙄😎😂 / dienaszaglis… https://www.instagram.com/p/BAZ9NgnrHR3/
    </p>
    <p class="card-text"><small class="text-muted">Last updated 1 min ago</small></p>
  </div>
</div>
</div>
-->
  <!--
  <div class="card p-3">
    <blockquote class="card-block card-blockquote">
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
      <footer>
        <small class="text-muted">
          Someone famous in <cite title="Source Title">Source Title</cite>
        </small>
      </footer>
    </blockquote>
  </div>
-->
  <!--
  <div class="card col-xs-6">
    <img class="card-img-top img-fluid" src="https://picsum.photos/400/400/?random" alt="Card image cap">
    <div class="card-block">
      <h4 class="card-title">Card title</h4>
      <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
  </div>
-->


<!--

</div>
-->

  <!--
  <div class="card">
    <img class="card-img-top img-fluid" src="https://picsum.photos/400/400/?random" alt="Card image cap">
    <div class="card-block">
      <h4 class="card-title">Card titleee</h4>
      <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
  </div>
-->

  <!--
  <div class="card card-inverse card-primary p-3 text-center">
    <blockquote class="card-blockquote">
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat.</p>
      <footer>
        <small>
          Someone famous in <cite title="Source Title">Source Title</cite>
        </small>
      </footer>
    </blockquote>
  </div>

  <div class="card text-center">
    <div class="card-block">
      <h4 class="card-title">Card title</h4>
      <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
  </div>

  <div class="card">
    <img class="card-img img-fluid" src="https://picsum.photos/400/400/?random" alt="Card image">
  </div>

  <div class="card p-3 text-right">
    <blockquote class="card-blockquote">
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
      <footer>
        <small class="text-muted">
          Someone famous in <cite title="Source Title">Source Title</cite>
        </small>
      </footer>
    </blockquote>
  </div>

  <div class="card">
    <div class="card-block">
      <h4 class="card-title">Card title</h4>
      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
      <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
  </div>
-->

</div>

    <!--
      <div class="links">
        <a href="https://laravel.com/docs">Documentation</a>
        <a href="https://laracasts.com">Laracasts</a>
        <a href="https://laravel-news.com">News</a>
        <a href="https://forge.laravel.com">Forge</a>
        <a href="https://github.com/laravel/laravel">GitHub</a>
      </div>
    -->
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import axios from 'axios';

export default {
  layout: 'MainLayout',

  metaInfo () {
    return { title: this.$t('home') }
  },

  computed: mapGetters({
    authenticated: 'auth/check'
  }),

  /*
  computed: {
    // a computed getter
    catchHashtags: function () {
      // `this` points to the vm instance
      return this.message.split('').reverse().join('')
    }
  },
  */

  data: () => ({
    title: window.config.appName,
    posts: [
      /*
      {
        userImage: 'https://pbs.twimg.com/profile_images/961345599948906496/uCw2Ben__normal.jpg',
        userName: '',
        user: 'Admin',
        text: 'Šis ir niknais Admins Eqqquuuaaaddoor!!',
        image: 'https://picsum.photos/1200/600/?random',
        socialIcon: 'https://www.seeklogo.net/wp-content/uploads/2015/11/twitter-logo.png',
        createdAt: 'Tue Mar 06 06:57:48 +0000 2018',
        admin: true,
      },
      */

      /*
      {
        userImage: 'https://pbs.twimg.com/profile_images/961345599948906496/uCw2Ben__normal.jpg',
        userName: '@disconakts',
        user: 'DiscoNakts',
        text: 'Aiziet konkurss! Spied "patīk" un "dalies" DiscoNakts FB, Instagram, Twitter vai Draugiem kontā un laimē vienu no 3 ekskluzīviem ielūgumiem uz pasākumu! Piektdien, 09. martā pulksten 19:00 rezultāti tiks apkopoti un paziņoti uzvarētāji! Aiziet- Tāda nakts- DiscoNakts 2018',
        image: 'https://picsum.photos/600/600/?random',
        socialIcon: 'https://www.seeklogo.net/wp-content/uploads/2015/11/twitter-logo.png',
        createdAt: 'Tue Mar 06 06:57:48 +0000 2018',
        admin: false,
      },
      {
        userImage: 'https://pbs.twimg.com/profile_images/872159308884168709/AZ5YUbNx_normal.jpg',
        userName: '@McRaivii',
        user: 'Raivis Šulcs',
        text: 'Beidzot saņēmām atbildi - cik maksā piens litrā? 👍😂 Atbilde nav iepriecinoša 🙄😎😂 / dienaszaglis… https://www.instagram.com/p/BAZ9NgnrHR3/',
        image: 'https://picsum.photos/600/600/?random&ts',
        socialIcon: 'https://www.seeklogo.net/wp-content/uploads/2016/06/Instagram-logo.png',
        createdAt: 'Tue Mar 06 06:57:48 +0000 2018',
        admin: false,
      },
      */
    ],
    hashtagCatcher: '#grobina OR #disconakts OR #disconakts2018',
  }),
  // Fetches posts when the component is created.
  created() {
    this.loadData();

    setInterval(function () {
      this.loadData();
    }.bind(this), 30000);
  },
  methods: {
    loadData: function () {
      let vm = this;
      let url = encodeURI(vm.hashtagCatcher);
      url = url.replace(/#/g, '');
      //url = url.replace(/#/g, '%23');
      axios.get(`/twitter?q=${url}`)
      .then(response => {
        // JSON responses are automatically parsed.
        this.posts = response.data
      })
      .catch(e => {
        this.errors.push(e)
      })

      // async / await version (created() becomes async created())
      //
      // try {
      //   const response = await axios.get(`http://jsonplaceholder.typicode.com/posts`)
      //   this.posts = response.data
      // } catch (e) {
      //   this.errors.push(e)
      // }
    }
  }
}
</script>

<style scoped>
.top-right {
  position: absolute;
  right: 10px;
  top: 18px;
}

.title {
  font-size: 85px;
}

.username {
  font-size: 15px;
  color: #af1b96;
}

.user-image-container {
  position: relative;
}

.user-image-container-inner {
  position: absolute;
  background: rgba(255, 255, 255, 0.5);
  width: 100%;
  height: 60px;
  top: -65px;
}

.username-container {
  position: absolute;
  bottom: 10px;
  left: 10px;
}

.debug {
  border: 1px solid red;
}

.main-layout {
  /*background-image: url("/img/disconakts2018-full-edited-colors.jpg") !important;*/
}
</style>
