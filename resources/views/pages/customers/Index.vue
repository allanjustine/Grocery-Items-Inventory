<template layout>
    <div class="bg-gray-500 w-[1250px] p-5 rounded">
        <p class="text-right text-white">
            total customers: <strong>{{ customers.total }}</strong>
        </p>
        <div>
            <h1 class="mb-3 text-white">Customer Lists</h1>
        </div>
        <hr />
        <Link
            href="/customers/create"
            class="btn bg-gray-800 text-center hover:bg-gray-900 float-right mt-5 mb-4"
            >Add Customer</Link
        >
        <div class="container mx-auto mb-3">
            <table class="min-w-full bg-white border border-gray-300 table">
                <thead>
                    <tr>
                        <th class="px-4 py-2 font-semibold border-b">ID.</th>
                        <th class="px-4 py-2 font-semibold border-b">
                            Customer Name
                        </th>
                        <th class="px-4 py-2 font-semibold border-b">
                            Customer Address
                        </th>
                        <th class="px-4 py-2 font-semibold border-b">
                            Customer Number
                        </th>
                        <th class="px-4 py-2 font-semibold border-b">
                            Customer Money
                        </th>
                        <th class="px-4 py-2 font-semibold border-b">
                            Customer Change
                        </th>
                        <th class="px-4 py-2 font-semibold border-b">
                            Added Date
                        </th>
                        <th class="px-4 py-2 font-semibold border-b">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="cust in customers.data"
                        :key="cust.id"
                        class="text-center"
                    >
                        <td>
                            <Link :href="'/customers/view/' + cust.id"
                                >{{ cust.id }}
                            </Link>
                        </td>
                        <td>
                            <Link :href="'/customers/view/' + cust.id">{{
                                cust.cust_name
                            }}</Link>
                        </td>
                        <td>
                            <Link :href="'/customers/view/' + cust.id">{{
                                cust.cust_address
                            }}</Link>
                        </td>
                        <td>
                            <Link :href="'/customers/view/' + cust.id">{{
                                cust.cust_number
                            }}</Link>
                        </td>
                        <td>
                            <Link :href="'/customers/view/' + cust.id"
                                >P{{ cust.cust_money }}</Link
                            >
                        </td>
                        <td>
                            <Link :href="'/customers/view/' + cust.id"
                                >P{{ cust.cust_change }}</Link
                            >
                        </td>
                        <td><Link :href="'/customers/view/' + cust.id"
                                >
                            {{
                                new Date(
                                    cust.created_at
                                ).toLocaleDateString("en-US")
                            }}
                            </Link>
                        </td>
                        <td>
                            <Link
                                :href="'/customers/edit/' + cust.id"
                                class="btn bg-sky-600 hover:bg-sky-700"
                            >
                                Edit
                            </Link>
                            <Link
                                :href="'/customers/delete/' + cust.id"
                                class="ml-1 btn bg-red-700 hover:bg-red-800"
                            >
                                Delete
                            </Link>
                        </td>
                    </tr>
                </tbody>
            </table>

            <p v-if="customers.data.length === 0" class="p-5 text-center">
                No data
            </p>
        </div>

        <div class="flex justify-between">
            <div>
                Showing
                <strong>{{ customers.data.length }}</strong> entries.
            </div>
            <nav
                class="isolate inline-flex -space-x-px rounded-md shadow-sm"
                aria-label="Pagination"
            >
                <ul class="pagination">
                    <li
                        v-for="page in customers.links"
                        :key="page.url"
                        :class="{
                            ' relative z-10 inline-flex custs-center text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:outline-offset-0':
                                !page.active && page.label !== 'Previous',
                            ' relative z-10 inline-flex custs-center text-sm font-semibold text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600':
                                page.active,
                            'opacity-50 cursor-not-allowed relative z-10 inline-flex custs-center px-4 py-2 text-sm font-semibold text-gray-300 ring-1 ring-inset ring-gray-300':
                                !page.url && page.label === 'Previous',
                        }"
                    >
                        <Link
                            v-if="page.url"
                            :href="page.url"
                            :class="{
                                'cursor-pointer relative z-10 inline-flex custs-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:outline-offset-0':
                                    !page.active && page.label !== 'Previous',
                                'cursor-pointer relative z-10 inline-flex custs-center bg-gray-600 px-4 py-2 text-sm font-semibold text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600':
                                    page.active,
                                'opacity-50 cursor-not-allowed relative z-10 inline-flex custs-center px-4 py-2 text-sm font-semibold text-gray-300 ring-1 ring-inset ring-gray-300':
                                    !page.url && page.label === 'Previous',
                            }"
                        >
                            <span v-if="page.label.includes('Next')"
                                >Next <i class="fas fa-chevron-right"></i
                            ></span>

                            <span v-else-if="page.label.includes('Previous')">
                                <i class="fas fa-chevron-left"></i> Previous
                            </span>
                            <span v-else class="page-link">{{
                                page.label
                            }}</span>
                        </Link>
                        <span
                            v-else-if="page.label.includes('Previous')"
                            class="cursor-not-allowed px-4 py-2"
                            ><i class="fas fa-chevron-left"></i> Previous</span
                        >
                        <span v-else class="cursor-not-allowed px-4 py-2"
                            >Next <i class="fas fa-chevron-right"></i
                        ></span>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/inertia-vue3";

defineProps({
    customers: Array,
});
</script>
