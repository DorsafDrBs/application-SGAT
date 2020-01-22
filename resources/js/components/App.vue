
 <template>
    <div>
   
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" :href="'home'">
                <img :src="'welcom/images/Image1.png'" style="width:170px; height:50px;"  href="http://sogeclairaerospace.com/">
                </a>
           
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" :aria-label="'Toggle navigation'">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                     
                        <a class="nav-link" :href="'cartographie' "> Cartography</a>
                    
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{Auth::user()->name}}
                                 Auth::user()->name  <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                     <router-link to="/home" @click="home">About</router-link>
                              
                                  
                                  <router-link to="/accueil" >About</router-link>   
                          <span style="display:block;" @click="logout">{{ $t('navbar.logOut') }}</span>
                                   
                                </div>
                            </li>
                            
                  <router-view @authenticated="setAuthenticated" />
                    </ul>
                </div>
            </div>
        </nav>
       
        <main>
            <router-view></router-view>
        </main>
    </div>
</template>
<script>
import axios from 'axios';
    export default {
      
          data: 3
     methods: {

    async logout() {
      await this.$store.dispatch('/logout');
      this.$router.push(`/login?redirect=${this.$route.fullPath}`);
    },
  },
                     home()   {
                             can => {
                                       can(['home-index',  'Post');
                                    }
                              }

                     }
                   }
</script>