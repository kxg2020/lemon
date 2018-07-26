<template>
  <div id="app">
    <div class="navbar">
      <div class="container navbar-container">
        <div class="navbar-first">
          <h1>
            <router-link :to="{path: '/'}" class="title">Lemon</router-link>
          </h1>
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
          <div class="right-item user">
            <img class="user-avatar" src="https://avatars2.githubusercontent.com/u/24952193?s=460&v=4" alt="">
            <div class="user-name">lostinfo</div>
            <div class="user-intro">你就是打死我，我也不改这个bug</div>
            <div class="user-links">
              <div class="user-link"><a target="_blank" href="https://github.com/lostinfo"><i
                class="ion-social-github"></i></a></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="footer">
      <div class="footer-info">© 2017-2017 Lemon|<a href="http://www.miitbeian.gov.cn/"
                                                    target="_blank">蜀ICP备17009035号</a>|<a href="http://www.qiniu.com"
                                                                                          target="_blank">七牛云</a></div>
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
<style scoped>
  #app {
    height: 100%;
  }

  .navbar {
    background-color: #656D6D;
    color: #FFFFFF;
    line-height: 80px;
    box-shadow: 0 2px 12px 0 #656d6da1;
  }

  .navbar-first {
    display: flex;
    flex-direction: row;
  }

  .title {
    color: #FFFFFF;
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

    .left-main {
      width: 75%;
      margin-right: 15px;
      padding: 1em 30px;
      background-color: #FFFFFF;
      box-shadow: 0 2px 12px 0 rgba(0, 0, 0, 0.1);
    }

    .right-main {
      width: 25%;
      margin-left: 15px;
    }

    .right-item {
      background-color: #FFFFFF;
      box-shadow: 0 2px 12px 0 rgba(0, 0, 0, 0.1);
      padding: 1em;
      margin-bottom: 30px;
    }
  }

  @media screen and (max-width: 992px) {
    .main-container {
      display: flex;
      flex-direction: column;
      background-color: #FFFFFF;
    }

    .left-main {
      width: 100%;
      padding: 30px 0;
    }

    .right-main {
      width: 100%;
    }
  }

  .main {
    box-sizing: border-box;
    padding: 80px 0 200px;
    margin-top: -80px;
    min-height: 100%;
  }

  .main-container {
    height: 100%;
    margin-top: 50px;
    margin-bottom: 50px;
  }

  .user {
    display: flex;
    flex-direction: column;
    justify-content: center;
  }

  .user-avatar {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    margin: 1em auto;
  }

  .user-name {
    height: 2em;
    line-height: 2em;
    text-align: center;
    color: #999;
    font-size: 16px;
    font-weight: 400;
  }

  .user-intro {
    font-size: 14px;
    line-height: 1.5em;
    margin: 1em 0;
    text-align: center;
  }

  .user-links {
    display: flex;
    flex-direction: row;
    justify-content: center;
  }

  .user-link i {
    font-size: 2em;
  }

  .footer {
    background-color: #F7FDFD;
    width: 100%;
    height: 200px;
    margin-top: -200px;
    padding: 40px auto;
  }

  .footer-info {
    display: flex;
    flex-direction: row;
    justify-content: center;
    padding-top: 90px;
    color: rgb(149, 149, 149);
  }

  .footer-info a {
    color: rgb(149, 149, 149);
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