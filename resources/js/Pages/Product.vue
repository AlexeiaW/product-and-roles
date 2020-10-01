<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Product
            </h2>

            <div class="py-12">
                <div class=" mx-auto  px-6">
                    <div
                        class="bg-white overflow-hidden shadow-xl rounded-lg p-6"
                    >
                        <div class="py-2"><b>id:</b> {{ product.id }}</div>
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

                        <input
                            class="py-2"
                            type="checkbox"
                            :id="product.id"
                            :name="product.name"
                            :value="product.published"
                            @click="checked"
                            :checked="product.published == 1"
                        />
                        <label :for="product.name" class="py-2"
                            >Published</label
                        >
                    </div>
                    <button
                        class="mt-6 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        @click="updateProduct"
                    >
                        Update
                    </button>
                    <button
                        class="mt-6 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        @click="deleteProduct"
                    >
                        Delete
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
            product_id: window.location.pathname.split("/").pop(),
            product: {}
        };
    },
    methods: {
        getProduct() {
            let token = localStorage.getItem("token");

            fetch(
                `http://onbrandhq-tech-test.test/api/products/${this.product_id}`,
                {
                    method: "GET",
                    headers: {
                        Authorization: `Bearer ${token}`,
                        "Content-Type": "application/json"
                    }
                }
            )
                .then(response => response.json())
                .then(data => {
                    this.product = data;
                })
                .catch(error => {
                    this.$toasted.show("Unauthorized", {
                        theme: "toasted-primary",
                        position: "bottom-right",
                        duration: 5000
                    });
                });
        },
        checked: function(event) {
            let checked = event.target.checked;
            let value = event.target.value;
            if (checked) {
                this.product.published = 1;
            } else {
                this.product.published = 0;
            }
        },
        updateProduct: function() {
            let token = localStorage.getItem("token");

            fetch(
                `http://onbrandhq-tech-test.test/api/products/${this.product_id}`,
                {
                    method: "PUT",
                    headers: {
                        Authorization: `Bearer ${token}`,
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        name: this.product.name,
                        published: this.product.published
                    })
                }
            ).then(response => {
                if (response.ok) {
                    this.$toasted.show("Success", {
                        theme: "toasted-primary",
                        position: "bottom-right",
                        duration: 5000
                    });
                } else {
                    this.$toasted.show("Unauthorized", {
                        theme: "toasted-primary",
                        position: "bottom-right",
                        duration: 5000
                    });
                }
            });
        },
        deleteProduct: function() {
            let token = localStorage.getItem("token");

            fetch(
                `http://onbrandhq-tech-test.test/api/products/${this.product_id}`,
                {
                    method: "DELETE",
                    headers: {
                        Authorization: `Bearer ${token}`,
                        "Content-Type": "application/json"
                    }
                }
            ).then(response => {
                if (response.ok) {
                    this.$toasted.show("Success", {
                        theme: "toasted-primary",
                        position: "bottom-right",
                        duration: 5000
                    });
                } else {
                    this.$toasted.show("Unauthorized", {
                        theme: "toasted-primary",
                        position: "bottom-right",
                        duration: 5000
                    });
                }
            });
        }
    },
    mounted: function() {
        this.getProduct();
    }
};
</script>
