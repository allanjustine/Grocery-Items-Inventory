<template layout="default">
    <div
        class="container bg-gray-600 w-[700px] text-white text-center shadow p-10 mx-auto mt-5"
    >
        <h1 class="text-2xl font-bold mb-5 text-center">Delete Customer</h1>
        <hr />
        <br />
        <i
            ><span class="text-white"
                >Are you sure you want to delete
                <span class="text-red-800"
                    ><strong>{{ customer.cust_name }}</strong></span
                >
                into Customer's list? This customer has ordered <span class="text-red-800"><strong>{{ customer.item_category.item_name }}</strong></span></span
            ></i
        >
        <button
            @click="deleteCustomer"
            style="width: 100%"
            class="mt-10 bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded form-control"
        >
            Yes, delete
        </button>
        <Link
            href="/customers"
            class="block w-full bg-gray-500 hover:bg-gray-700 mt-1 text-center text-white font-bold py-2 px-4 rounded"
        >
            Cancel
        </Link>
    </div>
</template>

<script setup>
import { Inertia } from "@inertiajs/inertia";
import { Link } from "@inertiajs/inertia-vue3";

const props = defineProps({
    customer: Object,
    itemCategory: Object,
});

const deleteCustomer = () => {
    Inertia.post(`/customers/${props.customer.id}`, {
        _method: "delete",
    });
};
</script>
