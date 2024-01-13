<style>
.card-forget {
    min-width: 400px;
    min-height: 250px;
    width: 400px;
    height: 300px;
    border-radius: 10px;
    box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.3);
}

.card-forget .card-header {
    background-color: rgb(141, 153, 174);
    color: white;
    font-size: 24px;
    font-weight: bold;
}

.card-forget .card-body form {
    height: 100%;
}
</style>

<template>
    <div>
        <div
            class="alert alert-success fw-bold fs-5"
            v-if="status"
            role="alert"
        >
            Link enviado com sucesso!
        </div>
        <div class="card card-forget">
            <div class="card-header">Resetar a senha</div>

            <div class="card-body">
                <form method="POST" action="/password/email">
                    <input name="_token" :value="csrf_token" type="hidden" />

                    <div class="row mb-5">
                        <label
                            for="email"
                            class="col-form-label text-md-start text-danger fw-bold fs-5"
                            >Email</label
                        >

                        <div class="">
                            <input
                                id="email"
                                type="email"
                                class="form-control"
                                :class="{
                                    'is-invalid': errors?.email,
                                }"
                                name="email"
                                value=""
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

                    <div class="row mb-3 d-flex justify-content-center mt-auto">
                        <div class="col-md-8 d-flex justify-content-center">
                            <button
                                type="submit"
                                class="btn btn-danger btn-lg w-75 fw-bold"
                            >
                                Enviar Link
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
    props: ["csrf_token", "errors", "status"],
    data() {
        return {};
    },
    beforeCreate() {
        console.log(this.errors, this.status);
    },
    methods: {},
    mounted() {
        let form_controls = document.getElementsByClassName("form-control");

        Array.from(form_controls).forEach((item) => {
            item.oninput = () => {
                item.classList.remove("is-invalid");
            };
        });
    },
};
</script>
