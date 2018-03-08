<template>
  <div class="main-layout" style="background: url('/img/disconakts2018-full-edited-colors.jpg') no-repeat center center / cover; height: 100%;">
    <header>
      <div class="row">
        <div class="col-xs-6">
          <img src="/img/disconakts2018-header-transparent.png" style="height: 150px;">
        </div>
        <div class="col-xs-6">
          <div class="pull-right mt-4 ml-4">
            <div><h2>Sekojošas mirkļbirkas tiks atspoguļotas</h2></div>
            <div class="data-catcher">#disconakts #disconakts2018</div>
          </div>
        </div>
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

</style>
