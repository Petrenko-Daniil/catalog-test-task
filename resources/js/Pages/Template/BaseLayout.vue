<template>
    <header>
        <div id="header-logo">

        </div>
        <div id="header-btns">
            <Link href="/" :data="{session_id: sessionId}">Catalog</Link>
            <Link href="/basket" :data="{session_id: sessionId}">Basket</Link>
            <Link href="/orders"  :data="{session_id: sessionId}">Orders</Link>
        </div>
    </header>
    <main>
        <div id="main-container">
            <slot />
        </div>
    </main>
    <footer>

    </footer>
    <notifications />
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
import { usePage } from '@inertiajs/vue3'
import { computed } from 'vue'

const page = usePage()
const sessionId = computed(() => page.props.session_id);
</script>
<style scoped>
    *{
        color: white;
    }
    header{
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #232248;
        min-height: 10vh;
        padding: 0 50px;
    }
    #header-btns > *{
        padding: 5px 10px;
        margin: 0 5px;
        text-decoration: none;
        color: white;
        font-size: 18px;
    }
    #header-btns > *:hover{
        color: #dedede;
    }
    #main-container{
        padding: 20px 40px;
        background-color: #232248;
        min-height: calc(85vh - 40px);
    }
    footer{
        min-height: 5vh;
        background-color: #1f1f1f;
        display: flex;
        align-items: center;
        padding: 0 20px;
    }
    #header-logo{
        height: 35px;
        width: 35px;
        background-color: #ff5a59;
        animation-duration: 3s;
        animation-name: headerlogo;
        animation-iteration-count: infinite;
    }
    @keyframes headerlogo {
        from {
            transform: rotateX(0deg);
            background-color: #ff5a59;
        }
        50%{
            transform: rotateX(90deg);
            background-color: #6d2261;
        }
        70%{
            background-color: #59ccb6;
        }
        to {
            transform: rotateX(360deg);
            background-color: #ff5a59;
        }
    }
</style>
