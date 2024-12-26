<template layout="default">
    <div class="container bg-gray-700 w-[1000px] shadow p-10 mx-auto m-10">
        <h1 class="text-2xl font-bold text-white mb-5 text-center">
            View Customer: {{ customer.cust_name }} <br>
            Ordered: ({{ customer.item_category.item_name}})
        </h1>
        <hr />
        <div v-if="customer" class="text-white mt-2">
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th>ID.</th>
                        <th>Customer Name</th>
                        <th>Customer Address</th>
                        <th>Customer Number</th>
                        <th>Customer Money</th>
                        <th>Customer Change</th>
                        <th>Added Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-if="customer">
                        <td>{{ customer.id }}</td>
                        <td>{{ customer.cust_name }}</td>
                        <td>{{ customer.cust_address }}</td>
                        <td>{{ customer.cust_number }}</td>
                        <td>{{ customer.cust_money }}</td>
                        <td>{{ customer.cust_change }}</td>
                        <td>
                            {{
                                new Date(
                                    customer.created_at
                                ).toLocaleDateString("en-US")
                            }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <br />
        <Link
            class="block w-full bg-gray-500 hover:bg-gray-600 mt-1 text-center text-white font-bold py-2 px-4 rounded"
            href="/customers"
        >
            Back
        </Link>
    </div>
</template>

<script setup>
import { Inertia } from "@inertiajs/inertia";
import { Link } from "@inertiajs/inertia-vue3";

const props = defineProps({
    customer: Array,
    itemCategories: Array,
});
</script>
