<template layout>
    <div class="bg-gray-500 w-[1250px] p-5 rounded">
        <p class="text-right text-white">
            total items: <strong>{{ itemCategories.total }}</strong>
        </p>
        <div>
            <h1 class="mb-3 text-white">Item Lists</h1>
        </div>
        <hr />
        <Link
            href="/items/create"
            class="btn bg-gray-800 text-center hover:bg-gray-900 float-right mt-5 mb-4"
            >Add Item</Link
        >
        <div class="container mx-auto mb-3">
            <table class="w-[1250px] bg-white border border-gray-300 table">
                <thead>
                    <tr>
                        <th class="px-4 py-2 font-semibold border-b">ID.</th>
                        <th class="px-4 py-2 font-semibold border-b">
                            Item Code
                        </th>
                        <th class="px-4 py-2 font-semibold border-b">
                            Item Name
                        </th>
                        <th class="px-4 py-2 font-semibold border-b">
                            Item Description
                        </th>
                        <th class="px-4 py-2 font-semibold border-b">
                            Item Price
                        </th>
                        <th class="px-4 py-2 font-semibold border-b">
                            Item Quantity
                        </th>
                        <th class="px-4 py-2 font-semibold border-b">
                            Item Type
                        </th>
                        <th class="px-4 py-2 font-semibold border-b">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="item in itemCategories.data"
                        :key="item.id"
                        class="text-center"
                    >
                        <td>{{ item.id }}</td>
                        <td>{{ item.item_code }}</td>
                        <td>{{ item.item_name }}</td>
                        <td>{{ item.item_description }}</td>
                        <td>{{ item.item_price }}</td>
                        <td>{{ item.item_quantity }}</td>
                        <td>{{ item.item_type }}</td>
                        <td>
                            <span class="flex"
                                ><Link
                                    :href="'/items/edit/' + item.id"
                                    class="btn bg-sky-600 hover:bg-sky-700"
                                >
                                    Edit
                                </Link>
                                <Link
                                    :href="'/items/delete/' + item.id"
                                    class="ml-1 btn bg-red-700 hover:bg-red-800"
                                >
                                    Delete
                                </Link></span
                            >
                        </td>
                    </tr>
                </tbody>
            </table>

            <p v-if="itemCategories.data.length === 0" class="p-5 text-center">
                No data
            </p>
        </div>

        <div class="flex justify-between">
            <div>
                Showing
                <strong>{{ itemCategories.data.length }}</strong> entries.
            </div>
            <nav
                class="isolate inline-flex -space-x-px rounded-md shadow-sm"
                aria-label="Pagination"
            >
                <ul class="pagination">
                    <li
                        v-for="page in itemCategories.links"
                        :key="page.url"
                        :class="{
                            ' relative z-10 inline-flex items-center text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:outline-offset-0':
                                !page.active && page.label !== 'Previous',
                            ' relative z-10 inline-flex items-center text-sm font-semibold text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600':
                                page.active,
                            'opacity-50 cursor-not-allowed relative z-10 inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-300 ring-1 ring-inset ring-gray-300':
                                !page.url && page.label === 'Previous',
                        }"
                    >
                        <Link
                            v-if="page.url"
                            :href="page.url"
                            :class="{
                                'cursor-pointer relative z-10 inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:outline-offset-0':
                                    !page.active && page.label !== 'Previous',
                                'cursor-pointer relative z-10 inline-flex items-center bg-gray-600 px-4 py-2 text-sm font-semibold text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-600':
                                    page.active,
                                'opacity-50 cursor-not-allowed relative z-10 inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-300 ring-1 ring-inset ring-gray-300':
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
    itemCategories: Array,
});
</script>
