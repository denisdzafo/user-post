<template>
<div class="footer">
        <div class="row">
          <div class="col-md-6 text-center text-lg-right mt-4 mt-lg-0">
            <p class="copyright">© 2022 Denis Džafo. All rights reserved.</p>
          </div>

        </div>
      </div>
</template>

<script>
    export default {
    data() {
      return {

      }
    },
    components: {
        //
    },
    mounted(){

    }
  }
</script>

<style lang="scss" scoped>
.copyright{
    margin: 0;
    color: #eee;
    font-size: 0.9rem;
}
.footer{
    padding: 60px 0;
    background: #222;
    position:absolute;
    bottom:0;
    width: 100%;
}
</style>
