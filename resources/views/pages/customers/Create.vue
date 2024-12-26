<template layout="default">
    <div class="container bg-gray-700 w-[800px] shadow p-10 mx-auto mt-5">
        <h1 class="text-2xl font-bold mb-5 text-white text-center">
            Create Customer
        </h1>
        <form @submit.prevent="addCust">
            <div class="grid grid-cols-2 sm:grid-cols-1 gap-4">
                <div class="flex flex-col mb-4">
                    <label
                        class="font-bold text-white mb-2"
                        for="item_category_id"
                        >Select Item:</label
                    >
                    <select
                        v-model="form.item_category_id"
                        name="item_category_id"
                        id="item_category_id"
                        class="border py-2 px-3 text-grey-darkest"
                    >
                        <option value="" hidden="true">Select Item</option>
                        <option disabled>Select Item</option>
                        <option
                            v-for="itemC in itemCategories"
                            :key="itemC.id"
                            :value="itemC.id"
                        >
                            {{ itemC.item_name }}/Price: {{ itemC.item_price }}
                        </option>
                    </select>
                    <span
                        v-if="form.errors.item_category_id"
                        class="text-red-300"
                        >{{ form.errors.item_category_id }}</span
                    >
                </div>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-2 gap-4">
                <div class="flex flex-col mb-4">
                    <label class="font-bold text-white mb-2" for="cust_name"
                        >Customer Name:</label
                    >
                    <input
                        type="text"
                        id="cust_name"
                        v-model="form.cust_name"
                        class="border py-2 px-3 text-grey-darkest"
                    />
                    <span v-if="form.errors.cust_name" class="text-red-300">{{
                        form.errors.cust_name
                    }}</span>
                </div>
                <div class="flex flex-col mb-4">
                    <label class="font-bold text-white mb-2" for="cust_address"
                        >Customer Address:</label
                    >
                    <input
                        type="text"
                        id="cust_address"
                        v-model="form.cust_address"
                        class="border py-2 px-3 text-grey-darkest"
                    />
                    <span
                        v-if="form.errors.cust_address"
                        class="text-red-300"
                        >{{ form.errors.cust_address }}</span
                    >
                </div>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-2 gap-4">
                <div class="flex flex-col mb-4">
                    <label class="font-bold text-white mb-2" for="cust_number"
                        >Customer Number:</label
                    >
                    <input
                        v-model="form.cust_number"
                        type="number"
                        name="cust_number"
                        id="cust_number"
                        class="border py-2 px-3 text-grey-darkest"
                    />
                    <span v-if="form.errors.cust_number" class="text-red-300">{{
                        form.errors.cust_number
                    }}</span>
                </div>

                <div class="flex flex-col mb-4">
                    <label class="font-bold text-white mb-2" for="cust_money"
                        >Customer Money:</label
                    >
                    <input
                        v-model="form.cust_money"
                        type="number"
                        name="cust_money"
                        id="cust_money"
                        class="border py-2 px-3 text-grey-darkest"
                    />
                    <span v-if="form.errors.cust_money" class="text-red-300">{{
                        form.errors.cust_money
                    }}</span>
                </div>
            </div>

            <div class="">
                <button
                    type="submit"
                    class="bg-green-600 hover:bg-green-800 text-white font-bold block w-full py-2 px-4 rounded"
                >
                    Add Customer
                </button>

                <Link
                    href="/customers"
                    class="block w-full bg-gray-500 hover:bg-gray-600 mt-1 text-center text-white font-bold py-2 px-4 rounded"
                >
                    Back
                </Link>
            </div>
        </form>
    </div>
</template>

<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import { Link } from "@inertiajs/inertia-vue3";

const props = defineProps({
    itemCategories: Object,
});

let form = useForm({
    cust_name: "",
    cust_address: "",
    cust_number: "",
    cust_money: "",
    cust_change: "",
    item_category_id: "",
});

const addCust = () => {
    form.post("/customers");
};
</script>
