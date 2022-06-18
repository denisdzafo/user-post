<template>
  <div id="app">
    <div>
    <navigation></navigation>

    <div class="main">
      <router-view />
   
    </div>

       <custom-footer></custom-footer>
    </div>
  </div>
</template>

<script>
import Navigation from './main/Navigation';
import CustomFooter from './main/Footer';
export default {
  name: 'Index',
    components: {
      Navigation,
      CustomFooter
    }
  }
</script>

<style lang="scss" scoped>
  .main{
    margin-top:200px;
  }
</style>