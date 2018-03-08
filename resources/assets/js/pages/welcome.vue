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

<div class="row">
  <div v-show="loading" class="col-xs-12"><span class="alert alert-info">Loading...</span></div>
  <div class="card-group">
    <div v-for="post in posts" :class="post.admin == true ? 'col-sm-12' : 'col-lg-6 col-xl-4'">
      <div :class="post.admin == true ? 'card w-100' : 'card w-35'">
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
                  >
                  <span class="user-name">{{ post.user }}</span>
                  <span class="username">{{ post.userName }}</span>
                  <span class="pull-right"><img :src="post.socialIcon" style="height: 50px;"></span>
              </div>
            </div>
          </h5>
          <p class="card-text">
            <h1 v-if="post.admin" v-html="post.text"></h1>
            <span v-else v-html="post.text"></span>
          </p>
          <p class="card-text">
            <small class="text-muted">{{ post.createdAt }}</small>
          </p>
        </div>
      </div>
    </div>
  </div>
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
    loading: true,
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
    errors: [],
    hashtagCatcher: '',
  }),
  // Fetches posts when the component is created.
  mounted() {
    this.loadData();

    setInterval(function () {
      this.loadData();
    }.bind(this), 30000);
  },
  methods: {
    loadData: function () {
      try {
        let vm = this;
        //let hashtagCatcher = encodeURI(vm.hashtagCatcher);

        let hashtagCatcher = '';
        let hashtagCatcherArray = [];

        //url = url.replace(/#/g, '%23');
        const config = axios.get(`/client`)
          .then((response) => {
            hashtagCatcher = response.data.hashtags.replace(/#/g, '');

            hashtagCatcherArray = hashtagCatcher.split(/(\s+)/);
            hashtagCatcherArray = hashtagCatcherArray.filter(function(str) {
              return /\S/.test(str);
            });
            console.debug(hashtagCatcherArray);
            let twitterQuery = hashtagCatcherArray.join(' OR ');

            //url = url.replace(/#/g, '%23');

            return vm.loadTweets(twitterQuery)
          })
          .then((response) => {
            return vm.loadInsta(hashtagCatcherArray[0])
            console.log('Response', response);
          });

          /*
        if(hashtagCatcherArray[1]) {
          axios.get(`/instagram?q=${hashtagCatcherArray[1]}`)
          .then(response => {
            vm.loading = false;
            // JSON responses are automatically parsed.
            //this.posts = response.data
            response.data.forEach(function(post) {
              vm.posts.unshift(post);
            });
          })
          .catch(e => {
            vm.loading = false;
            this.errors.push(e)
          })
        }

        if(hashtagCatcherArray[2]) {
          axios.get(`/instagram?q=${hashtagCatcherArray[1]}`)
          .then(response => {
            vm.loading = false;
            // JSON responses are automatically parsed.
            //this.posts = response.data
            response.data.forEach(function(post) {
              vm.posts.unshift(post);
            });
          })
          .catch(e => {
            vm.loading = false;
            this.errors.push(e)
          })
        }
        */

      } catch (e) {
        console.error(e); // 💩
      }
    },
    loadTweets: function(twitterQuery) {
      let vm = this;
      return axios.get(`/twitter?q=${twitterQuery}`)
      .then(response => {
        vm.loading = false;
        // JSON responses are automatically parsed.
        response.data.forEach(function(post) {
          vm.posts.unshift(post);
        });
      })
      .catch(e => {
        vm.loading = false;
        this.errors.push(e)
      })
    },
    loadInsta: function(hashtag) {
      let vm = this;
      return axios.get(`/instagram?q=${hashtag}`)
      .then(response => {
        vm.loading = false;
        // JSON responses are automatically parsed.
        //this.posts = response.data
        response.data.forEach(function(post) {
          vm.posts.unshift(post);
        });
      })
      .catch(e => {
        vm.loading = false;
        this.errors.push(e)
      })
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
.user-image {
  margin-top: 10px;
  width: 48px;
}

.debug {
  border: 1px solid red;
}

.main-layout {
  /*background-image: url("/img/disconakts2018-full-edited-colors.jpg") !important;*/
}
</style>
