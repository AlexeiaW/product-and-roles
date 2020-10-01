<template>
    <app-layout>
        <div class="py-4">
            <div class=" mx-auto px-4">
                <div class="bg-white overflow-hidden shadow-xl rounded-lg">
                    <h3
                        class="font-semibold text-xl text-gray-800 leading-tight px-4 py-2"
                    >
                        Approved products
                    </h3>

                    <div
                        class="px-4 py-2"
                        v-for="product in products"
                        :key="product.id"
                    >
                        <a
                            :href="'/product/' + product.id"
                            class="text-blue-500 hover:text-blue-700"
                        >
                            {{ product.id }} | {{ product.name }} |
                            <em v-if="product.published == 1">published</em>
                            <em v-if="product.published == 0"
                                >needs approval</em
                            >
                        </a>
                    </div>
                </div>
                <a
                    href="/product"
                    class="mt-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded block w-40"
                >
                    Submit product
                </a>
            </div>
        </div>
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
            products: []
        };
    },
    methods: {
        getProducts() {
            let token = localStorage.getItem("token");

            fetch("http://onbrandhq-tech-test.test/api/products", {
                method: "GET",
                headers: {
                    Authorization: `Bearer ${token}`,
                    "Content-Type": "application/json"
                }
            })
                .then(response => response.json())
                .then(data => {
                    this.products = data;
                });
        },
        async getToken() {
            return await fetch("http://onbrandhq-tech-test.test/auth-token", {
                method: "GET"
            })
                .then(response => response.json())
                .then(data => {
                    return data;
                });
        }
    },
    mounted: function() {
        this.getToken().then(data => {
            if (data.token) {
                localStorage.setItem("token", data.token);
                this.getProducts();
            } else {
                this.$toasted.show("Unauthorized", {
                    theme: "toasted-primary",
                    position: "bottom-right",
                    duration: 5000
                });
            }
        });
    }
};
</script>
