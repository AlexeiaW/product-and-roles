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
                        <p>{{ product.id }} | {{ product.name }} | approved</p>
                    </div>
                </div>
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

            fetch("http://onbrandhq-tech-test.test/api/approved-products", {
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
        }
    },
    mounted: function() {
        this.getProducts();
    }
};
</script>
