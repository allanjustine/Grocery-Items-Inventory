<template layout="default">
    <div class="flex justify-center items-center h-screen">
        <div
            class="bg-gray-200 shadow-lg rounded p-8 max-w-lg w-full"
            style="margin-top: -150px"
        >
            <h2 class="text-2xl font-bold mb-6 text-center">Log in</h2>
            <form @submit.prevent="submit">
                <div class="mb-4">
                    <label
                        class="block text-gray-700 text-sm font-bold mb-2"
                        for="username"
                        >User Name</label
                    >
                    <input
                        class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:border-blue-500"
                        id="username"
                        type="username"
                        placeholder="Username"
                        v-model="form.username"
                    />
                    <div
                        class="text-sm text-red-500 italic"
                        v-if="form.errors.username"
                    >
                        {{ form.errors.username }}
                    </div>
                </div>
                <div class="mb-6">
                    <label
                        class="block text-gray-700 text-sm font-bold mb-2"
                        for="password"
                        >Password</label
                    >
                    <input
                        class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:border-blue-500"
                        id="password"
                        type="password"
                        placeholder="Password"
                        v-model="form.password"
                    />
                    <div
                        class="text-sm text-red-500 italic"
                        v-if="form.errors.password"
                    >
                        {{ form.errors.password }}
                    </div>
                </div>
                <div>
                    <button
                        class="bg-blue-500 w-full hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="submit"
                    >
                        Log in
                    </button>
                    <Link
                        class="block align-baseline font-bold text-sm bg-gray-500 mt-1 rounded text-white text-center py-2 px-4 hover:bg-gray-800"
                        href="register"
                    >
                        Register an Account
                    </Link>
                </div>
                <div
                    class="text-sm text-red-500 italic"
                    v-if="form.errors.authentication"
                >
                    {{ form.errors.authentication }}
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import { Link } from "@inertiajs/inertia-vue3";

let form = useForm({
    username: "",
    password: "",
});

let submit = () => {
    form.post("/login");
};
</script>
