<style scoped>
.card-inscricao {
    min-width: 450px;
    width: 450px;
    display: flex;
    border-radius: 10px;
    box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.3);
}

.card-inscricao .card-header {
    background-color: rgb(141, 153, 174);
    color: white;
    font-size: 24px;
    font-weight: bold;
    text-align: center;
}

.card-body form {
    height: 100%;
}
</style>

<template>
    <div>
        <div class="card card-inscricao">
            <div class="card-header w-100">Inscrição</div>
            <div class="card-body w-100">
                <form
                    method="post"
                    action="/inscricao/nova"
                    class="p-3 pt-0 d-flex flex-column"
                >
                    <input name="_token" :value="csrf_token" type="hidden" />
                    <input name="evento_id" :value="evento_id" type="hidden" />
                    <input name="user_id" :value="user_id" type="hidden" />

                    <div class="row mb-3">
                        <div class="">
                            <div class="">
                                <div class="btn-group border w-100">
                                    <a
                                        id="pixChecked"
                                        href="#"
                                        class="btn btn-danger fs-5 fw-bold"
                                        >Pix</a
                                    >
                                    <a
                                        id="cartaoChecked"
                                        href="#"
                                        class="btn btn-outline-danger fs-5 fw-bold"
                                        >Cartão</a
                                    >
                                </div>
                            </div>

                            <input
                                type="hidden"
                                id="forma_pagamento_id"
                                name="forma_pagamento_id"
                                value="1"
                            />

                            <span
                                v-if="errors?.forma_pagamento_id"
                                class="invalid-feedback"
                                role="alert"
                            >
                                <strong>{{ errors.forma_pagamento_id }}</strong>
                            </span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label
                            for="password"
                            class="col-form-label text-md-start text-danger fw-bold fs-5"
                            >Senha</label
                        >

                        <div class="">
                            <input
                                value="Strong.2106"
                                type="password"
                                class="form-control"
                                :class="{
                                    'is-invalid': errors?.password,
                                }"
                                name="password"
                                required
                            />

                            <span
                                v-if="errors?.password"
                                class="invalid-feedback"
                                role="alert"
                            >
                                <strong>{{ errors.password[0] }}</strong>
                            </span>
                        </div>
                    </div>

                    <div class="row mb-3 d-flex justify-content-center mt-auto">
                        <div
                            class="col-md-8 d-flex justify-content-center mb-1"
                        >
                            <button
                                type="submit"
                                class="btn btn-outline-danger btn-lg w-75 fw-bold"
                            >
                                Inscrever-se
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["csrf_token", "errors", "user_id", "evento_id"],
    data() {
        return {};
    },
    beforeCreate() {
        console.log(
            "User ",
            this.user_id,
            "Evento ",
            this.evento_id,
            "Errors ",
            this.errors
        );
    },
    methods: {},
    mounted() {
        let form_controls = document.getElementsByClassName("form-control");

        Array.from(form_controls).forEach((item) => {
            item.oninput = () => {
                item.classList.remove("is-invalid");
            };
        });

        let pixChecked = document.getElementById("pixChecked");
        let cartaoChecked = document.getElementById("cartaoChecked");
        let forma_pagamento_id = document.getElementById("forma_pagamento_id");
        pixChecked.onclick = function () {
            forma_pagamento_id.value = 1;
            pixChecked.classList.add("btn-danger");
            pixChecked.classList.remove("btn-outline-danger");
            cartaoChecked.classList.remove("btn-danger");
            cartaoChecked.classList.add("btn-outline-danger");
        };
        cartaoChecked.onclick = function () {
            forma_pagamento_id.value = 2;
            cartaoChecked.classList.add("btn-danger");
            cartaoChecked.classList.remove("btn-outline-danger");
            pixChecked.classList.remove("btn-danger");
            pixChecked.classList.add("btn-outline-danger");
        };
    },
};
</script>
