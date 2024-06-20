<template>
    <div class="product">
        <div class="product-img">
            <img height="100" width="100" src="/img/placeholder.svg" alt="">
            <div class="product-name">
                {{ product.name }}
            </div>
        </div>
        <div class="product-info">
            <div class="product-buy">
                <div class="product-price">
                    ${{ product.price }}.00
                </div>
                <div class="product-buy-actions">
                    <input type="text" class="product-buy-amount" placeholder="amount" v-model="amount">
                    <div @click="buy" class="product-buy-button">BUY NOW</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import {ref} from "vue"
import axios from "axios";
import { usePage } from '@inertiajs/vue3'
import { computed } from 'vue'
import { useNotification } from "@kyvg/vue3-notification";

const notification = useNotification()

const page = usePage()
const sessionId = computed(() => page.props.session_id);
const props = defineProps(['product'])
let product = props.product;
let amount = ref(1)
function buy(){
    axios.post(route('api.order.buy', [product.id]), {
        amount: amount.value,
        session_id: sessionId.value
    }).then((response) => {
        notification.notify({
            title: 'Your product in the basket',
            text: response.data.msg,
            duration: 300,
            type: 'success'
        });
        amount.value = 1;
    }).catch((e) => {
        notification.notify({
            title: 'Something went wrong',
            classes: 'app-notification app-notification-red',
            duration: 300,
            type: 'error'
        });
    })
}
</script>

<style scoped>
    .product{
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 2px 8px;
        max-width: 40%;
        margin-bottom: 5px;
    }
    .product-price{
        font-size: 24px;
        margin-bottom: 4px;
    }
    .product-img{
        display: flex;
        align-items: center;
        margin-right: 60px;
    }
    .product-name{
        margin-left: 60px;
        font-size: 24px;
    }
    .product-info{
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .product-buy{
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    .product-buy-amount{
        width: 60px;
    }
    .product-buy-actions{
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .product-buy-actions > * {
        margin: 0 5px;
    }
    .product-buy-button{
        background-color: #ff5a59;
        padding: 5px 10px;
        border-radius: 20px;
        cursor: pointer;
    }
    .product-buy-button:hover{
        background-color: #ff6c52;
    }
    .product-buy-button:active{
        background-color: #fd7e48;
    }
    .product-buy-amount{
        border-radius: 5px;
        padding: 5px 10px;
    }
</style>
