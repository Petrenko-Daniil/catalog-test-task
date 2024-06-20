<template>
    <CustomerLayout>
        <div class="order-container">
            <div class="order-id">
                Order #{{order.id}}
            </div>
            <table class="order-products">
                <thead>
                    <tr>
                        <th>#</th><th>Name</th><th>Price</th><th>Amount</th><th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(product, k) in order.products">
                        <td>{{k+1}}</td>
                        <td>{{product.name}}</td>
                        <td>${{product.price}}</td>
                        <td>{{product.pivot.amount}}</td>
                        <td>${{product.pivot.amount * product.price}}</td>
                    </tr>
                </tbody>
            </table>
            <div class="order-actions">
                <div class="order-total-price">
                    Total price: ${{order.total_price}}
                </div>
                <div @click="confirmOrder" class="order-confirm">
                    Confirm order
                </div>
            </div>
        </div>
    </CustomerLayout>
</template>

<script setup>
import CustomerLayout from "../Template/CustomerLayout.vue"
import ProductComponent from "../Template/Components/ProductComponent.vue";

import { usePage } from '@inertiajs/vue3'
import { computed } from 'vue'
import axios from "axios";
import { useNotification } from "@kyvg/vue3-notification";
import { router } from '@inertiajs/vue3'

const notification = useNotification()

const page = usePage()
const order = computed(() => page.props.order);
const sessionId = computed(() => page.props.session_id);

function confirmOrder(){
    axios.post(route('api.order.confirm', {order: order.value.id}))
        .then((response) => {
            notification.notify({
                title: 'Your order is confirmed!',
                text: response.data.msg,
                duration: 300,
                type: 'success'
            });
            setTimeout(() => {
                router.visit(route('catalog'))
            }, 400);
        })
        .catch((e) => {
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
    .order-container{
        max-width: 50%;
        display: flex;
        flex-direction: column;
    }
    th, td{
        text-align: center;
    }
    .order-actions{
        margin-top: 10px;
        display: flex;
        flex-direction: column;
    }
    .order-confirm{
        background-color: #59ccb6;
        width: fit-content;
        padding: 5px 10px;
        border-radius: 5px;
        margin-top: 10px;
        cursor: pointer;
    }
</style>
