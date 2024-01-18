<style scoped>
.card-register {
    min-width: 450px;
    min-height: 650px;
    width: 450px;
    height: 50%;
    border-radius: 10px;
    box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.3);
}

.card-register .card-header {
    background-color: rgb(141, 153, 174);
    color: white;
    font-size: 24px;
    font-weight: bold;
    text-align: center;
}

.card-tem-login {
    box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.3);
}

.card-body form {
    height: 100%;
}
</style>

<template>
    <div>
        <div class="card card-register">
            <div class="card-header w-100">Registrar-se</div>
            <div class="card-body w-100">
                <form
                    method="post"
                    action="/register"
                    class="p-3 pt-0 d-flex flex-column"
                >
                    <input name="_token" :value="csrf_token" type="hidden" />

                    <div class="row mb-3">
                        <div class="">
                            <div class="">
                                <div class="btn-group border w-100">
                                    <a
                                        id="insChecked"
                                        href="#"
                                        class="btn btn-danger fs-5 fw-bold"
                                        >Quero me inscrever</a
                                    >
                                    <a
                                        id="orgChecked"
                                        href="#"
                                        class="btn btn-outline-danger fs-5 fw-bold"
                                        >Sou organizador</a
                                    >
                                </div>
                            </div>

                            <input
                                type="hidden"
                                id="tipo_id"
                                name="tipo_id"
                                value="3"
                            />

                            <span
                                v-if="errors?.tipo_id"
                                class="invalid-feedback"
                                role="alert"
                            >
                                <strong>{{ errors.tipo_id }}</strong>
                            </span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label
                            for="nome"
                            class="col-form-label text-md-start text-danger fw-bold fs-5"
                            >Nome</label
                        >

                        <div class="">
                            <input
                                value="Vitória"
                                type="text"
                                class="form-control"
                                :class="{ 'is-invalid': errors?.nome }"
                                name="nome"
                                required
                                autocomplete="nome"
                                autofocus
                            />

                            <span
                                v-if="errors?.nome"
                                class="invalid-feedback"
                                role="alert"
                            >
                                <strong>{{ errors.nome[0] }}</strong>
                            </span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label
                            for="email"
                            class="col-form-label text-md-start text-danger fw-bold fs-5"
                            >Email</label
                        >

                        <div class="">
                            <input
                                value="vitoria@email.com"
                                type="email"
                                class="form-control"
                                :class="{ 'is-invalid': errors?.email }"
                                name="email"
                                required
                                autocomplete="email"
                                autofocus
                            />

                            <span
                                v-if="errors?.email"
                                class="invalid-feedback"
                                role="alert"
                            >
                                <strong>{{ errors.email[0] }}</strong>
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

                    <div class="row mb-3">
                        <label
                            for="password_confirmation"
                            class="col-form-label text-md-start text-danger fw-bold fs-5"
                            >Comfirme sua senha</label
                        >

                        <div class="">
                            <input
                                value="Strong.2106"
                                type="password"
                                class="form-control"
                                :class="{
                                    'is-invalid': errors?.password,
                                }"
                                name="password_confirmation"
                                required
                            />
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
                                Registrar-se
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card card-tem-login mt-4">
            <div class="row p-4">
                <div
                    class="col-md-12 d-flex justify-content-center fw-bold fs-5 text-danger"
                >
                    <span>Já tem conta?&nbsp;&nbsp;</span>
                    <a class="" href="/login">Faça o login</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["csrf_token", "errors"],
    data() {
        return {
            tipo_id: 3,
        };
    },
    beforeCreate() {
        console.log(this.csrf_token, this.errors);
    },
    methods: {},
    mounted() {
        let insChecked = document.getElementById("insChecked");
        let orgChecked = document.getElementById("orgChecked");
        let tipo_id = document.getElementById("tipo_id");
        insChecked.onclick = function () {
            tipo_id.value = 3;
            insChecked.classList.add("btn-danger");
            insChecked.classList.remove("btn-outline-danger");
            orgChecked.classList.remove("btn-danger");
            orgChecked.classList.add("btn-outline-danger");
        };
        orgChecked.onclick = function () {
            tipo_id.value = 2;
            orgChecked.classList.add("btn-danger");
            orgChecked.classList.remove("btn-outline-danger");
            insChecked.classList.remove("btn-danger");
            insChecked.classList.add("btn-outline-danger");
        };

        let form_controls = document.getElementsByClassName("form-control");

        Array.from(form_controls).forEach((item) => {
            item.oninput = () => {
                item.classList.remove("is-invalid");
            };
        });
    },
};
</script>
