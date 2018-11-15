<template>
    <div id="profile" style="min-height: 310px;">
        <div class="container">
            <div class="columns">
                <div class="column is-one-third">
                    <aside class="menu">
                         <div class="side-body">
            
                    <ul class="menu-list" style="list-style: none;">
                        <li><router-link v-bind:to="{name: 'Profile'}"><i class="fa fa-home m-r-10" aria-hidden="true"></i>  <span>Profile</span> </router-link></li>
                        <li><router-link v-bind:to="{ name: 'Bag' }"  ><i class="fa fa-file m-r-10" aria-hidden="true"></i>  <span>Bag </span> </router-link></li>
                         <li><router-link v-bind:to="{name: 'Logout'}" class="navbar-item"><span class="icon"><i class="fa fa-fw fa-sign-out m-r-5"></i></span>Logout</router-link ></li>

                    </ul>
                </div>
                        </aside>
                </div>
                <div class="column">

                <div id="app">
                    <main class="userDashboardContent">
                    <transition name="fade">
                    <router-view></router-view>
                    </transition>
                    </main>
                </div>


                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
   
}
</script>
