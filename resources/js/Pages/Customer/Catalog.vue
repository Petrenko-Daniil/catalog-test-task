<template>
    <CustomerLayout>
        <ProductComponent v-for="product in products" :product="product"></ProductComponent>
    </CustomerLayout>
</template>

<script setup>
import CustomerLayout from "../Template/CustomerLayout.vue"
import ProductComponent from "../Template/Components/ProductComponent.vue";

import { usePage } from '@inertiajs/vue3'
import { computed } from 'vue'

const page = usePage()
const products = computed(() => page.props.products);


</script>

<style scoped>

</style>
