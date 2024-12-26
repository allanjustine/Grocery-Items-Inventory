<template layout="default">
    <div
        class="container bg-gray-700 w-[550px] rounded shadow-lg shadow px-10 pt-5 pb-10 mx-auto mt-5"
    >
        <h1 class="text-2xl font-bold mb-5 text-white text-center">Update Item</h1>
        <hr />
        <form @submit.prevent="updateNow" class="mt-3">
            <div class="flex flex-col mb-4">
                <label class="font-bold text-white mb-2" for="item_code"
                    >Item Code:</label
                >
                <input
                    type="number"
                    id="item_code"
                    v-model="form.item_code"
                    class="border py-2 px-3 text-grey-darkest"
                    disabled
                    readonly
                />
                <span v-if="form.errors.item_code" class="text-red-600">{{
                    form.errors.item_code
                }}</span>
            </div>

            <div class="flex flex-col mb-4">
                <label class="font-bold text-white mb-2" for="item_name"
                    >Item Name:</label
                >
                <input
                    v-model="form.item_name"
                    type="text"
                    name="item_name"
                    id="item_name"
                    class="border py-2 px-3 text-grey-darkest"
                />
                <span v-if="form.errors.item_name" class="text-red-600">{{
                    form.errors.item_name
                }}</span>
            </div>

            <div class="flex flex-col mb-4">
                <label class="font-bold text-white mb-2" for="item_price"
                    >Item Price:</label
                >
                <input
                    v-model="form.item_price"
                    type="number"
                    name="item_price"
                    id="item_price"
                    class="border py-2 px-3 text-grey-darkest"
                />
                <span v-if="form.errors.item_price" class="text-red-600">{{
                    form.errors.item_price
                }}</span>
            </div>

            <div class="flex flex-col mb-4">
                <label class="font-bold text-white mb-2" for="item_quantity"
                    >Item Qunatity:</label
                >
                <input
                    v-model="form.item_quantity"
                    type="number"
                    name="item_quantity"
                    id="item_quantity"
                    class="border py-2 px-3 text-grey-darkest"
                />
                <span v-if="form.errors.item_quantity" class="text-red-600">{{
                    form.errors.item_quantity
                }}</span>
            </div>

            <div class="flex flex-col mb-4">
                <label class="font-bold text-white mb-2" for="item_type"
                    >Item Type:</label
                >
                <input
                    v-model="form.item_type"
                    type="text"
                    name="item_type"
                    id="item_type"
                    class="border py-2 px-3 text-grey-darkest"
                />
                <span v-if="form.errors.item_type" class="text-red-600">{{
                    form.errors.item_type
                }}</span>
            </div>

            <div class="flex flex-col mb-4">
                <label class="font-bold text-white mb-2" for="item_description"
                    >Item Description:</label
                >
                <textarea
                    v-model="form.item_description"
                    type="text"
                    name="item_description"
                    id="item_description"
                    class="border py-2 px-3 text-grey-darkest"
                ></textarea>
                <span
                    v-if="form.errors.item_description"
                    class="text-red-600"
                    >{{ form.errors.item_description }}</span
                >
            </div>

            <div class="items-center">
                <button
                    type="submit"
                    class="bg-green-600 w-full hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                >
                    Update Item
                </button>
                <Link
                    href="/items"
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
import { Inertia } from "@inertiajs/inertia";
import { Link } from "@inertiajs/inertia-vue3";

const props = defineProps({
    itemCategory: Object,
});

let form = useForm({
    item_code: props.itemCategory.item_code,
    item_name: props.itemCategory.item_name,
    item_description: props.itemCategory.item_description,
    item_price: props.itemCategory.item_price,
    item_quantity: props.itemCategory.item_quantity,
    item_type: props.itemCategory.item_type,
});

const updateNow = () => {
    Inertia.post(`/items/${props.itemCategory.id}`, {
        _method: "put",
        item_code: form.item_code,
        item_name: form.item_name,
        item_description: form.item_description,
        item_price: form.item_price,
        item_quantity: form.item_quantity,
        item_type: form.item_type,
    });
};
</script>
