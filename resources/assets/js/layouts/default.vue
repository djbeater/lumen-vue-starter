<template>
  <div class="main-layout" style="background: url('/img/disconakts2018-full-edited-colors.jpg') no-repeat center center / cover; height: 100%;">
    <header>
      <div class="row">
        <div class="col-xs-6">
          <img src="/img/disconakts2018-header-transparent.png" class="ml-3 header-logo">
        </div>
        <div class="col-xs-6">
          <div class="pull-right mt-4 ml-4">
            <div class="taken-hashtags">Tiek rādītas mirkļbirkas:</div>
            <div class="data-catcher"></div>
          </div>
        </div>
        <!--
        <div class="col-xs-12">
          <div class="form-group">
            <input type="text" class="form-control">
          </div>
        </div>
        -->
      </div>
    </header>
    <div class="container-fluid">
      <child/>
    </div>
  </div>
</template>

<script>
import Navbar from '~/components/Navbar'

export default {
  name: 'MainLayout',

  /*
  data() {
    return {
      hashtagCatcher: '#disconakts #disconakts2018',
    }
  },
  */

  components: {
    Navbar
  }
}
</script>

<style>

html {
  height: 100%;
}

body {
  height: 100%;
}

#app {
  height: 100%;
}

.data-catcher {
  font-size: 30px;
  color: #fff;
  font-weight: bold;
}

.highlight {
  color: blue;
  font-weight: bold;
}

.taken-hashtags {
  font-size: 30px;
  font-weight: bold;
  color: #fff;
}

.data-catcher {
  font-size: 40px;
  font-weight: bold;
  color: #fff;
}

.header-logo {
  height: 150px;
  margin-top: -10px;
}

</style>
