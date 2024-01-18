<style scoped>
.center {
    justify-content: center;
    align-content: center;
    align-items: center;
    display: flex;
}

.card-inscricao-grid {
    min-width: 600px;
}

.card-inscricao-grid .card-header {
    background-color: rgb(141, 153, 174);
    color: white;
    font-size: 24px;
    font-weight: bold;
}

.grid {
    width: 100%;
}

.linha-inscricao-grid {
    height: 180px;
    width: auto;
    min-width: 542px;
    display: flex;
    margin: 10px 0;
    border: 1px solid #8888;
    border-radius: 10px;
    /* padding: 10px; */
    background-color: #eee;
    overflow: hidden;
}

.linha-inscricao-grid .foto-grid {
    min-width: 300px;
    height: 180px;
    padding: 10px;
}

.linha-inscricao-grid .foto-grid img {
    height: 100%;
    aspect-ratio: 7 / 4;
    border-radius: 10px;
}

.linha-inscricao-grid .detail-grid {
    padding: 10px;
    min-width: 300px;
    width: 100%;
    display: flex;
    background-color: #eee;
    padding: 10px;
}

.linha-inscricao-grid .titulo-grid {
    min-width: 190px;
    height: 100%;
    padding: 10px;
    width: 50%;
    justify-content: center;
}

.linha-inscricao-grid .status-grid {
    min-width: 120px;
    width: 300px;
    height: 100px;
    padding: 10px;
    display: flex;
    justify-content: center;
}

.linha-inscricao-grid .botoes-grid {
    height: 100px;
}

@media (max-width: 1200px) {
    .linha-inscricao-grid {
        height: 300px;
        display: grid;
        grid-template-columns: 300px auto;
        grid-template-rows: repeat(90px, 3);
    }

    .linha-inscricao-grid .foto-grid {
        grid-column-start: 1;
        grid-column-end: 2;
        grid-row-start: 1;
        grid-row-end: 3;
    }

    .linha-inscricao-grid .titulo-grid {
        grid-column-start: 1;
        grid-column-end: 2;
        grid-row-start: 3;
        grid-row-end: 4;
        display: flex;
        flex-direction: column;
        text-align: center;
        width: 100%;
    }

    .linha-inscricao-grid .status-grid {
        grid-column-start: 2;
        grid-column-end: 3;
        grid-row-start: 2;
        grid-row-end: 3;
        width: 240px;
        display: flex;
        justify-content: end;
    }

    .linha-inscricao-grid .botoes-grid {
        grid-column-start: 2;
        grid-column-end: 3;
        grid-row-start: 1;
        grid-row-end: 2;
        width: 100%;
        display: flex;
        justify-content: end;
        padding: 20px;
    }
}
</style>

<template>
    <div>
        <div class="container-md">
            <h3
                style="font-family: Montserrat, sans-serif; min-width: 576px"
                class="fw-bold text-danger"
            >
                Histórico de inscrições
            </h3>
            <div class="card card-inscricao-grid">
                <div class="card-header w-100">&nbsp;</div>
                <div class="card-body w-100">
                    <div class="d-flex justify-content-start">
                        <div
                            v-if="errors"
                            class="alert alert-danger"
                            role="alert"
                        >
                            {{ Object.values(errors)[0][0] }}
                        </div>
                    </div>
                    <div class="grid py-2">
                        <div
                            v-for="(inscricao, i) in inscricoes"
                            :key="i"
                            class="linha-inscricao-grid"
                        >
                            <div class="foto-grid">
                                <a :href="'/evento/' + inscricao.evento_id"
                                    ><img
                                        :src="
                                            '/storage/' +
                                            inscricao.evento.thumbnail
                                        "
                                /></a>
                            </div>
                            <div class="titulo-grid">
                                <div>
                                    <p class="text-danger m-0">
                                        {{ inscricao.evento.local.cidade.nome }}
                                    </p>
                                </div>
                                <div>
                                    <a
                                        :href="'/evento/' + inscricao.evento.id"
                                        class="text-decoration-none"
                                        ><h5 class="fs-5 fw-bolder text-dark">
                                            {{ inscricao.evento.titulo }}
                                        </h5></a
                                    >
                                </div>
                                <div>
                                    <p class="text-secondary">
                                        {{ inscricao.evento.local.nome }}
                                    </p>
                                </div>
                            </div>
                            <div class="status-grid">
                                <div
                                    class="rounded overflow-hidden row center fw-bold w-100 h-100 bg-light fs-5 fw-bold text-danger"
                                >
                                    {{ inscricao.status.nome }}
                                </div>
                            </div>

                            <div class="botoes-grid dropdown p-1">
                                <button
                                    v-if="
                                        inscricao.status_id != 8 // Cancelada
                                    "
                                    class="btn btn-secondary dropdown-toggle h-50"
                                    type="button"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                >
                                    Ações
                                </button>
                                <ul class="dropdown-menu">
                                    <li
                                        v-if="
                                            [5, 9].includes(inscricao.status_id) //6 processando
                                        "
                                    >
                                        <a
                                            class="dropdown-item"
                                            href="#"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalInscricoesGrid"
                                            @click="
                                                acoes(inscricao.id, 1) // Pagar
                                            "
                                            >Realizar Pagamento</a
                                        >
                                    </li>
                                    <li
                                        v-if="
                                            [5, 6, 7, 9].includes(
                                                inscricao.status_id
                                            ) // 8 cancelada
                                        "
                                    >
                                        <a
                                            class="dropdown-item"
                                            href="#"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalInscricoesGrid"
                                            @click="
                                                acoes(inscricao.id, 2) // Cancelar
                                            "
                                            >Cancelar</a
                                        >
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <modal-component id="modalInscricoesGrid" title="">
                <template v-slot:content>
                    <form
                        id="modalInscricaoStatus"
                        method="post"
                        action=""
                        class="p-3 pt-0 d-flex flex-column"
                    >
                        <div class="modal-body">
                            <input
                                name="_token"
                                :value="csrf_token"
                                type="hidden"
                            />
                            <input
                                id="modal-inscricao-status"
                                name="inscricao_id"
                                value=""
                                type="hidden"
                            />

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
                                </div>
                            </div>

                            <div
                                class="row mb-3 d-flex justify-content-center mt-auto"
                            >
                                <div
                                    class="col-md-8 d-flex justify-content-center mb-1"
                                >
                                    <button
                                        id="modalAcaoButton"
                                        type="submit"
                                        class="btn btn-outline-danger btn-lg w-75 fw-bold"
                                    >
                                        Executar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </template>
            </modal-component>
        </div>
    </div>
</template>

<script>
export default {
    props: ["csrf_token", "inscricoes", "errors"],
    data() {
        return {
            meses_ano: [
                "Jan",
                "Fev",
                "Mar",
                "Abr",
                "Maio",
                "Jun",
                "Jul",
                "Ago",
                "Set",
                "Out",
                "Nov",
                "Dez",
            ],
        };
    },
    created() {
        this.inscricoes.forEach((inscricao) => {
            inscricao.evento.data_inicio = new Date(
                inscricao.evento.data_inicio
            );
            inscricao.evento.data_fim = new Date(inscricao.evento.data_fim);
            inscricao.evento.data_inicio_grid =
                inscricao.evento.data_inicio.getDate() +
                " de " +
                this.meses_ano[1] +
                " de " +
                inscricao.evento.data_inicio.getFullYear();
            inscricao.evento.data_fim_grid =
                inscricao.evento.data_fim.getDate() +
                " de " +
                this.meses_ano[2] +
                " de " +
                inscricao.evento.data_fim.getFullYear();
        });
        console.log(this.errors, this.inscricoes);
    },
    methods: {
        acoes(inscricaoId, acao) {
            switch (acao) {
                case 1: // Pagar
                    $("#modalInscricaoStatus").prop(
                        "action",
                        "/pagamento/" + inscricaoId + "/novo"
                    );
                    $("#modalInscricaoStatus").prop("method", "post");
                    $("#ModalLabel").html("Realizar Pagamento");
                    $("#modalAcaoButton").html("Pagar");
                    break;
                case 2:
                    $("#modalInscricaoStatus").prop(
                        "action",
                        "/inscricao/cancel"
                    );
                    $("#modalInscricaoStatus").prop("method", "post");
                    $("#ModalLabel").html("Cancelar Inscrição");
                    $("#modalAcaoButton").html("Cancelar");
                    break;
            }
            $("#modal-inscricao-status").val(inscricaoId);
        },
    },
};
</script>
