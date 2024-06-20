<template>
    <AdminLayout>
        <div class="orders-container">
            <div class="orders-total-price">
                <span>Total price of all orders: ${{ordersTotalPrice}}</span>
                <span>Total price of open orders: ${{ordersOpenTotalPrice}}</span>
                <span>Total price of confirmed orders: ${{ordersConfirmedTotalPrice}}</span>
            </div>
            <table class="order-products">
                <thead>
                <tr>
                    <th>#</th><th>Status</th><th>session_id</th><th>Total</th><th>Products</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(order, k) in orders">
                    <td>{{order.id}}</td>
                    <td>{{order.status}}</td>
                    <td>{{order.session_id}}</td>
                    <td>${{order.total_price}}</td>
                    <td><span class="order-products" v-for="product in order.products">{{product.name}}</span></td>

                </tr>
                </tbody>
            </table>
        </div>
    </AdminLayout>
</template>

<script setup>
import AdminLayout from "../Template/AdminLayout.vue"

import { usePage } from '@inertiajs/vue3'
import { computed } from 'vue'
import axios from "axios";

const page = usePage()
const orders = computed(() => page.props.orders);
const ordersTotalPrice = computed(() => page.props.ordersTotalPrice);
const ordersOpenTotalPrice = computed(() => page.props.ordersOpenTotalPrice);
const ordersConfirmedTotalPrice = computed(() => page.props.ordersConfirmedTotalPrice);
</script>

<style scoped>
    .order-products span:not(:last-child):after{
        content: ', ';
        margin-right: 2px;
    }
    .orders-container{
        display: flex;
        flex-direction: column;
        max-width: 50%;
    }
    .orders-total-price{
        display: flex;
        flex-direction: column;
    }
    th, td{
        text-align: center;
    }
</style>
