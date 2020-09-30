<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Product Submit
            </h2>

            <div class="py-12">
                <div class=" mx-auto  px-6">
                    <div
                        class="bg-white overflow-hidden shadow-xl rounded-lg p-6"
                    >
                        <div class="mb-4 py-2">
                            <label
                                class="block text-gray-700 text-sm font-bold mb-2 inline"
                                for="email"
                            >
                                name
                            </label>
                            <input
                                class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                id="email"
                                type="text"
                                :placeholder="product.name"
                                v-model="product.name"
                            />
                        </div>
                    </div>
                    <button
                        class="mt-6 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        @click="createProduct"
                    >
                        Submit
                    </button>
                </div>
            </div>
        </template>
    </app-layout>
</template>

<script>
import AppLayout from "./../Layouts/AppLayout";
import Welcome from "./../Jetstream/Welcome";

export default {
    components: {
        AppLayout,
        Welcome
    },
    data() {
        return {
            product: {}
        };
    },
    methods: {
        checked: function(event) {
            let checked = event.target.checked;
            let value = event.target.value;
            this.product.published = value;
        },
        createProduct: function() {
            fetch(`http://onbrandhq-tech-test.test/api/products`, {
                method: "POST",
                headers: {
                    Authorization:
                        "Bearer 1|bXPBMekcAbRy4M9znid0UyyU8TydWPlIge34fr41",
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    name: this.product.name,
                    published: 0
                })
            }).then(response => {
                console.log(response);
                if (response.ok) {
                    console.log(response.status);
                }
            });
        }
    }
};
</script>
