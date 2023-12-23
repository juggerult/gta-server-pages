<template>
    <header>
    <div class="header-container">
        <div class="logo"><router-link to="/" style="text-decoration: none; color: grey;">NAMERP</router-link></div>
        <nav>
            <ul>
                <li><router-link to="/news" style="color: grey;">Новости</router-link></li>
                <li><router-link to="/forum-nameRP" style="color: grey;" >Форум</router-link></li>
                <li><router-link to="/donate" style="color: grey;" >Донат</router-link></li>
            </ul>
        </nav>
        <div class="user-profile" style="color: grey">ЛИЧНЫЙ КАБИНЕТ</div>
    </div>
</header>
<router-view />
</template>

<script lang="ts">
import { defineComponent } from 'vue';

export default defineComponent({
    components: {},
    setup(){
        return {};
    },
});

</script>

<style>
body {
    margin: 0;
    font-family: 'Courier New', Courier, monospace;
}
header {
    margin-top: 10px;
    margin-left: auto;
    margin-right: auto;
    background-color: rgb(220, 220, 220);
    color: #fff;
    padding: 10px 0;
    max-width: 90%;
    box-shadow: 0 6px 9px rgba(0, 0, 0, 0.5);
    border-radius: 35px;
}

.header-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    color:grey;
    max-width: 60%;
    margin: 0 auto;
}

.logo {
    font-size: 1.9em;
    font-weight: bold;
}

nav ul {
    list-style: none;
    display: flex;
}


nav li {
    color:grey;
    text-align: center;
    margin-right: 20px;
    font-size: 20px;
}
li:hover{
    box-shadow: 0 0px 15px rgba(0, 0, 0, 0.4);
}
nav a {
    text-decoration: none;
    color: #fff;
    font-weight: bold;
}
.user-profile {
    font-weight: bold;
    font-size: 23px;
}



</style>
