<template layout>
    <div class="container mx-auto py-8 bg-gray-700 text-white rounded p-5">
        <div class="flex justify-center">
            <div class="mb-4">
                <span>Total Customers: </span>
                <span class="p-2 px-3.5 bg-white text-black rounded-full"
                    ><strong>{{ custCount }}</strong></span
                >
            </div>
        </div>
        <div class="flex justify-center">
            <div class="mb-4">
                <span>Total Items: </span>
                <span class="p-2 px-3.5 bg-white text-black rounded-full"
                    ><strong>{{ itemsCount }}</strong></span
                >
            </div>
        </div>
        <section class="hero mb-5">
            <div class="container text-center">
                <h1 class="text-2xl text-center font-bold mb-4">
                    Grocery Item Inventory
                </h1>
                <p>
                    Get fresh and high-quality groceries delivered to your
                    doorstep.
                </p>
            </div>
        </section>
        <hr />
        <section class="featured-products mt-5 mb-5">
            <div class="container text-center">
                <h1>Featured Items</h1>
                <div class="grid grid-cols-5 gap-2 mt-5">
                    <div
                        class="product"
                        v-for="item in itemCategories"
                        :key="item.id"
                    >
                        <div
                            class="max-w-xs bg-gray-500 hover:bg-gray-600 rounded-lg shadow-md overflow-hidden"
                        >
                            <div class="px-4 py-3">
                                <h3 class="text-xl font-medium text-gray-300">
                                    {{ item.item_name }}
                                </h3>
                                <p class="text-gray-200 mt-2">
                                    {{ item.item_type }}
                                </p>
                                <p
                                    class="text-gray-300 mt-2"
                                    v-if="showFullDescription"
                                >
                                    {{ item.item_description }}
                                </p>
                                <p class="text-gray-300 mt-2" v-else>
                                    {{ truncatedDescription }}
                                </p>
                                <button
                                    class="text-blue-300 hover:text-blue-300"
                                    v-if="
                                        item.item_description.length >
                                        descriptionLimit
                                    "
                                    @click="toggleDescription"
                                >
                                    {{
                                        showFullDescription
                                            ? "Read Less"
                                            : "Read More"
                                    }}
                                </button>
                                <div
                                    class="flex items-center justify-between mt-4"
                                >
                                    <span class="text-gray-300 font-bold"
                                        >P{{ item.item_price }}</span
                                    >
                                    <span class="text-gray-300 font-bold"
                                        >Qty:{{ item.item_quantity }}</span
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <hr />
        <h1 class="text-4xl font-bold text-white text-center mt-10">
            <marquee behavior="" direction="left">
                Welcome,
                {{ auth.user ? auth.user.fullname : "Guest" }}!</marquee
            >
        </h1>
    </div>
</template>

<script setup>
import { Link, usePage } from "@inertiajs/inertia-vue3";
import { ref, computed } from "vue";


const descriptionLimit = 100;
const item = {
    item_description: "Item Description",
};
const showFullDescription = ref(false);
const truncatedDescription = computed(() => {
    return item.item_description.length > descriptionLimit
        ? `${item.item_description.slice(0, descriptionLimit)}...`
        : item.item_description;
});
const props = defineProps({
    auth: Array,
    itemCategories: Array,
    custCount: Number,
    itemsCount: Number,
});

const user = usePage().props.auth;
const toggleDescription = () => {
    showFullDescription.value = !showFullDescription.value;
};
console.log(user);
</script>
