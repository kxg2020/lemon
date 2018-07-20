<template>
  <div id="app">
    <div class="navbar">
      <div class="container navbar-container">
        <div class="navbar-first">
          <h1>Title</h1>
          <div class="nav-menu-btn">
            <button @click="changeNavbarList" class="icon-button" style="height: 64px"><i class="ion-navicon-round"></i>
            </button>
          </div>
        </div>
        <div class="navbar-list-box" :style="minWidth768 ? (navbarListShow ? 'height: 405px;' : 'height: 0;') : ''">
          <ul id="navbar-list" class="navbar-list">
            <li class="navbar-item"><a class="nav-item-a" href="#">item</a></li>
            <li class="navbar-item"><a class="nav-item-a" href="#">item</a></li>
            <li class="navbar-item"><a class="nav-item-a" href="#">item</a></li>
            <li class="navbar-item"><a class="nav-item-a" href="#">item</a></li>
            <li class="navbar-item"><a class="nav-item-a" href="#">item</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="main">
      <div class="container main-container">
        <div class="left-main">
          <router-view></router-view>
        </div>
        <div class="right-main">
          <h1>Right Main</h1>
        </div>
      </div>
    </div>
    <div class="footer">
      <div class="container">
        <h1>Footer</h1>
      </div>
    </div>
  </div>
</template>
<script>
  export default {
    data() {
      return {
        minWidth768: false,
        navbarListStatus: false
      }
    },
    computed: {
      navbarListShow() {
        return this.minWidth768 ? this.navbarListStatus : false
      }
    },
    created() {
      this.widthChange()
      let that = this
      window.onresize = function () {
        that.widthChange()
      }
    },
    methods: {
      widthChange: function () {
        if (document.documentElement.clientWidth <= 768) {
          this.minWidth768 = true
        } else {
          this.minWidth768 = false
        }
      },
      changeNavbarList: function () {
        this.navbarListStatus = !this.navbarListStatus
        console.log(this.navbarListStatus)
      }
    }
  }
</script>
<style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  html, body {
    margin: 0;
    padding: 0;
    overflow-x: hidden;
    height: 100%;
    color: #1d1d1d;
  }

  li {
    list-style: none;
  }

  a {
    color: #000000;
    list-style: none;
    text-decoration: none;
  }

  a:hover {

  }

  #app {
    min-height: 100%;
    position: relative;
  }

  .navbar {
    /*height: 80px;*/
    background-color: #656D6D;
    color: #FFFFFF;
    line-height: 80px;
  }

  .navbar-first {
    display: flex;
    flex-direction: row;
  }

  .navbar-list-box {
    transition: height 0.45s;
    overflow: hidden;
    transition-timing-function: ease-out;
    box-sizing: border-box;
    text-decoration: none;
    list-style: none;
    padding: 0;
    margin: 0;
  }

  @media screen and (min-width: 768px) {
    .nav-menu-btn {
      display: none;
    }

    .navbar-container {
      display: flex;
      flex-direction: row;
      justify-content: space-between;
    }

    .navbar-list {
      display: flex;
      flex-direction: row;
    }

    .navbar-item {
      border-left: 1px solid rgba(255, 255, 255, .08);
      width: 100px;
      text-align: center;
    }

    .nav-item-a {
      color: #FFFFFF;
      display: inline-block;
      width: 100%
    }

    .nav-item-a:hover {
      background: rgba(255, 255, 255, .08);
    }

    .navbar-item:nth-last-child(1) {
      border-right: 1px solid rgba(255, 255, 255, .08);
    }
  }

  @media screen and (max-width: 768px) {
    .nav-menu-btn {
      display: block;
    }

    .navbar-container {
      display: flex;
      flex-direction: column;
    }

    .navbar-first {
      border-bottom: 1px solid rgba(255, 255, 255, .08);
    }

    .navbar h1 {
      width: 100%;
    }

    .navbar-list {
      display: flex;
      flex-direction: column;
    }

    .navbar-item {
      border-bottom: 1px solid rgba(255, 255, 255, .08);
      width: 100%;
      text-align: left;
    }

    .nav-item-a {
      color: #FFFFFF;
      display: inline-block;
      width: 100%
    }

    .nav-item-a:hover {
      background: rgba(255, 255, 255, .08);
    }
  }

  @media screen and (min-width: 992px) {
    .main-container {
      display: flex;
      flex-direction: row;
      position: relative;
    }

    .main-container:before {
      content: '';
      position: absolute;
      right: 20%;
      top: 0;
      height: 100%;
      width: 1px;
      background-color: #e2e2e2;
    }

    .left-main {
      width: 80%;
      padding-top: 30px;
      padding-right: 30px;
    }

    .right-main {
      width: 20%;
      padding-left: 30px;
      padding-top: 30px;
    }
  }

  @media screen and (max-width: 992px) {
    .main-container {
      display: flex;
      flex-direction: column;
    }

    .left-main {
      width: 100%;
    }

    .right-main {
      width: 100%;
    }
  }

  .main {
    min-height: 100%;
    box-sizing: border-box;
    padding-bottom: 200px;
  }

  .main-container {

  }

  .footer {
    position: absolute;
    bottom: 0;
    background-color: #F7FDFD;
    width: 100%;
    height: 200px;
    padding: 40px auto;
  }

  .container {
    margin-right: auto;
    margin-left: auto;
    padding-left: 15px;
    padding-right: 15px;
  }

  @media (min-width: 768px) {
    .container {
      width: 750px;
    }
  }

  @media (min-width: 992px) {
    .container {
      width: 970px;
    }
  }

  @media (min-width: 1200px) {
    .container {
      width: 1200px;
    }
  }
</style>