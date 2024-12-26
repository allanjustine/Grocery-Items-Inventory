<template>
    <section class="bg-gray-700">
        <div class="wrapper flex">
            <div id="brand" class="text-lg text-white font-bold mt-5" style="font-family: 'UnifrakturCook', cursive;">
                <span class="bg-gray-900 p-4 rounded-full">Grocery Items Inventory</span>
            </div>
            <nav class="main-nav mx-auto py-2">
                <Link class="main-link" href="/">Home</Link>
                <!-- <Link v-if="user" class="main-link" href="/users"
                    >Users</Link
                > -->
                <Link v-if="user" class="main-link" href="/customers"
                    >Customers</Link
                >
                <Link v-if="user" class="main-link" href="/items"
                    >Items</Link
                >
            </nav>
            <div class="flex p-2">
                <Link
                    v-if="!user"
                    class="ml-2 py-4 text-white font-semibold bg-gray-500 hover:bg-gray-600 text-white font-bold px-4 rounded"
                    href="/login"
                    >Log In</Link
                >
                <Link
                    v-if="user"
                    class="text-white font-semibold bg-gray-500 rounded-full hover:bg-gray-900 px-10"
                    href="/logout"
                    method="post"
                    as="button"
                    >Log Out</Link
                >
            </div>
        </div>
    </section>
</template>

<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import { defineProps } from "vue";

defineProps({
    user: "",
});
</script>
