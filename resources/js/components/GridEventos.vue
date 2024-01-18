<style scoped>
.center {
    justify-content: center;
    align-content: center;
    align-items: center;
    display: flex;
}

.card-grid {
    min-width: 670px;
}

.card-grid .card-header {
    background-color: rgb(141, 153, 174);
    color: white;
    font-size: 24px;
    font-weight: bold;
}

.grid {
    width: 100%;
}

.linha-evento-grid {
    height: 180px;
    width: auto;
    min-width: 542px;
    display: flex;
    margin: 10px 0;
    border: 1px solid #8888;
    border-radius: 10px;
    background-color: #eee;
    /* overflow: hidden; */
}

.linha-evento-grid .foto-grid {
    min-width: 300px;
    height: 180px;
    padding: 10px;
}

.linha-evento-grid .foto-grid img {
    height: 100%;
    aspect-ratio: 7 / 4;
    border-radius: 10px;
}

.linha-evento-grid .detail-grid {
    padding: 10px;
    min-width: 300px;
    width: 100%;
    display: flex;
    background-color: #eee;
    padding: 10px;
}

.linha-evento-grid .titulo-grid {
    min-width: 190px;
    height: 100%;
    padding: 10px;
    width: 50%;
    justify-content: center;
}

.linha-evento-grid .periodo-grid {
    min-width: 120px;
    width: 120px;
    height: 100px;
    padding: 10px;
    justify-content: center;
    display: flex;
}

.linha-evento-grid .periodo-grid > div {
    height: 80px;
}

.linha-evento-grid .capacidade-grid {
    min-width: 120px;
    width: 120px;
    height: 100px;
    padding: 8px;
    display: flex;
    justify-content: center;
}

.linha-evento-grid .faturamento-grid {
    min-width: 120px;
    width: 120px;
    height: 100px;
    justify-content: center;
    display: flex;
    padding: 10px 0;
}

.linha-evento-grid .status-grid {
    min-width: 120px;
    width: 120px;
    height: 100px;
    padding: 8px;
    justify-content: center;
    display: flex;
}

.linha-evento-grid .botoes-grid {
    height: 100px;
}

@media (max-width: 1200px) {
    .linha-evento-grid {
        height: 300px;
        display: grid;
        grid-template-columns: 2fr 1fr 1fr 1fr;
        grid-template-rows: 110px 70px 40px 110px;
    }

    .linha-evento-grid .foto-grid {
        grid-column-start: 1;
        grid-column-end: 2;
        grid-row-start: 1;
        grid-row-end: 3;
        display: flex;
        justify-content: center;
    }

    .linha-evento-grid .titulo-grid {
        grid-column-start: 1;
        grid-column-end: 2;
        grid-row-start: 3;
        grid-row-end: 5;
        display: flex;
        flex-direction: column;
        text-align: center;
        width: 100%;
    }

    .linha-evento-grid .periodo-grid {
        grid-column-start: 2;
        grid-column-end: 3;
        grid-row-start: 1;
        grid-row-end: 2;
        display: flex;
        width: 100%;
        height: 100%;
        justify-content: center;
        padding: 20px;
    }

    .linha-evento-grid .capacidade-grid {
        grid-column-start: 2;
        grid-column-end: 3;
        grid-row-start: 2;
        grid-row-end: 4;
        display: flex;
        width: 100%;
        height: 100%;
        justify-content: center;
    }

    .linha-evento-grid .faturamento-grid {
        grid-column-start: 3;
        grid-column-end: 4;
        grid-row-start: 2;
        grid-row-end: 4;
        display: flex;
        width: 100%;
        height: 100%;
        justify-content: center;
    }

    .linha-evento-grid .status-grid {
        grid-column-start: 3;
        grid-column-end: 4;
        grid-row-start: 1;
        grid-row-end: 2;
        display: flex;
        width: 100%;
        height: 100%;
        justify-content: center;
    }

    .linha-evento-grid .botoes-grid {
        grid-column-start: 4;
        grid-column-end: 5;
        grid-row-start: 1;
        grid-row-end: 2;
        display: flex;
        width: 100%;
        height: 100%;
        justify-content: center;
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
                Meu Eventos
            </h3>
            <div class="card card-grid">
                <div class="card-header w-100">&nbsp;</div>
                <div class="card-body w-100">
                    <div class="d-flex justify-content-between">
                        <div
                            v-if="errors"
                            class="alert alert-danger"
                            role="alert"
                        >
                            {{ Object.values(errors)[0][0] }}
                        </div>
                        <div>
                            <a class="btn btn-success" href="/evento/novo">
                                Novo Evento
                            </a>
                        </div>
                    </div>
                    <div class="grid py-2">
                        <div
                            v-for="(evento, i) in eventos"
                            :key="i"
                            class="linha-evento-grid"
                        >
                            <div class="foto-grid">
                                <a :href="'/evento/' + evento.id"
                                    ><img :src="'/storage/' + evento.thumbnail"
                                /></a>
                            </div>
                            <div class="titulo-grid">
                                <div>
                                    <p class="text-danger m-0">
                                        {{ evento.local.cidade.nome }}
                                    </p>
                                </div>
                                <div>
                                    <a
                                        :href="'/evento/' + evento.id"
                                        class="text-decoration-none"
                                        ><h5 class="fs-5 fw-bolder text-dark">
                                            {{ evento.titulo }}
                                        </h5></a
                                    >
                                </div>
                                <div>
                                    <p class="text-secondary">
                                        {{ evento.local.nome }}
                                    </p>
                                </div>
                            </div>
                            <div class="periodo-grid">
                                <div
                                    class="rounded overflow-hidden row"
                                    style="background-color: white; margin: 0"
                                >
                                    <div
                                        class="center fw-bolder col-6"
                                        :class="{ 'col-12': evento.dia_unico }"
                                        style="background-color: #bbb"
                                    >
                                        {{
                                            dias_semana[
                                                evento.data_inicio.getDay()
                                            ]
                                        }}
                                    </div>
                                    <div
                                        v-if="!evento.dia_unico"
                                        class="center fw-bolder col-6 border-start"
                                        style="background-color: #bbb"
                                    >
                                        {{
                                            dias_semana[
                                                evento.data_fim.getDay()
                                            ]
                                        }}
                                    </div>
                                    <div
                                        class="center text-danger fw-bolder col-6"
                                        :class="{ 'col-12': evento.dia_unico }"
                                    >
                                        {{ evento.data_inicio.getDate() }}
                                    </div>
                                    <div
                                        v-if="!evento.dia_unico"
                                        class="center text-danger fw-bolder col-6 border-start"
                                    >
                                        {{ evento.data_fim.getDate() }}
                                    </div>
                                    <div
                                        class="center text-white bg-danger fw-bolder col-6"
                                        :class="{
                                            'col-12':
                                                evento.data_inicio.getMonth() ==
                                                evento.data_fim.getMonth(),
                                        }"
                                    >
                                        {{
                                            meses_ano[
                                                evento.data_inicio.getMonth()
                                            ]
                                        }}
                                    </div>
                                    <div
                                        v-if="
                                            !evento.dia_unico &&
                                            evento.data_inicio.getMonth() !=
                                                evento.data_fim.getMonth()
                                        "
                                        class="center text-white bg-danger fw-bolder col-6 border-start"
                                    >
                                        {{
                                            meses_ano[
                                                evento.data_fim.getMonth()
                                            ]
                                        }}
                                    </div>
                                </div>
                            </div>
                            <div class="capacidade-grid">
                                <div
                                    class="rounded overflow-hidden row center fw-bold w-100 h-100 bg-light text-danger"
                                >
                                    <div
                                        style="
                                            text-align: center;
                                            font-size: 16px;
                                        "
                                    >
                                        {{ evento.n_inscricoes }} /
                                        {{ evento.capacidade }}
                                    </div>
                                    <div style="text-align: center">
                                        Capacidade
                                    </div>
                                </div>
                            </div>
                            <div class="faturamento-grid">
                                <div
                                    class="rounded overflow-hidden row center fw-bold w-100 h-100 bg-light text-danger"
                                >
                                    <div
                                        style="
                                            text-align: center;
                                            font-size: 16px;
                                        "
                                    >
                                        {{ get_faturamento(evento) }}
                                    </div>
                                    <div style="text-align: center">
                                        Faturamento
                                    </div>
                                </div>
                            </div>
                            <div class="status-grid">
                                <div
                                    class="rounded overflow-hidden row center fw-bold w-100 h-100 bg-light text-danger"
                                >
                                    <div
                                        style="
                                            text-align: center;
                                            font-size: 16px;
                                        "
                                    >
                                        {{ evento.status.nome }}
                                    </div>
                                </div>
                            </div>
                            <div class="botoes-grid dropdown p-1">
                                <button
                                    class="btn btn-secondary dropdown-toggle h-50"
                                    type="button"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                >
                                    Ações
                                </button>
                                <ul
                                    class="dropdown-menu"
                                    style="position: relative"
                                >
                                    <li>
                                        <a
                                            class="dropdown-item"
                                            :href="
                                                '/evento/' +
                                                evento.id +
                                                '/edit/'
                                            "
                                            >Editar</a
                                        >
                                    </li>
                                    <li>
                                        <a
                                            class="dropdown-item"
                                            :href="
                                                '/evento/' +
                                                evento.id +
                                                '/manage/'
                                            "
                                            >Gerenciar</a
                                        >
                                    </li>
                                    <li
                                        v-if="
                                            [2, 3, 4].includes(evento.status_id)
                                        "
                                    >
                                        <a
                                            class="dropdown-item"
                                            href="#"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalEventosGrid"
                                            @click="
                                                status(evento.id, 1) // Ativar
                                            "
                                            >Ativar</a
                                        >
                                    </li>
                                    <li
                                        v-if="
                                            [1, 3, 4].includes(evento.status_id)
                                        "
                                    >
                                        <a
                                            class="dropdown-item"
                                            href="#"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalEventosGrid"
                                            @click="
                                                status(evento.id, 2) // Pausar
                                            "
                                            >Pausar</a
                                        >
                                    </li>
                                    <li
                                        v-if="
                                            [1, 2, 3].includes(evento.status_id)
                                        "
                                    >
                                        <a
                                            class="dropdown-item"
                                            href="#"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalEventosGrid"
                                            @click="
                                                status(evento.id, 4) // Finalizar
                                            "
                                            >Finalizar</a
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
            <modal-component
                id="modalEventosGrid"
                title="Mudar Status de Evento"
            >
                <template v-slot:content>
                    <form
                        id="modalEventoStatus"
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
                                id="modal-evento-status"
                                name="status_id"
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
                                        type="submit"
                                        class="btn btn-outline-danger btn-lg w-75 fw-bold"
                                    >
                                        Cancelar
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
    props: ["csrf_token", "eventos", "errors"],
    data() {
        return {
            dias_semana: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sáb"],
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
        this.eventos.forEach((evento) => {
            evento.data_inicio = new Date(evento.data_inicio);
            evento.data_fim = new Date(evento.data_fim);
            evento.data_inicio_grid =
                evento.data_inicio.getDate() +
                " de " +
                this.meses_ano[1] +
                " de " +
                evento.data_inicio.getFullYear();
            evento.data_fim_grid =
                evento.data_fim.getDate() +
                " de " +
                this.meses_ano[2] +
                " de " +
                evento.data_fim.getFullYear();
            evento.n_inscricoes = evento.inscricoes.filter((item) => {
                return item.status_id != 8;
            }).length;
        });
        console.log(this.eventos, this.errors);
    },
    methods: {
        get_capacidade(evento) {},

        get_faturamento(evento) {
            let n_inscricoes = evento.inscricoes.filter((item) => {
                return item.pagamento?.status_id == 10;
            }).length;

            return (
                "R$" +
                (n_inscricoes * evento.preco).toFixed(2).replace(".", ",")
            );
        },
        status(eventoId, statusId) {
            $("#modalEventoStatus").prop(
                "action",
                "/evento/" + eventoId + "/status/"
            );
            $("#modal-evento-status").val(statusId);
        },
    },
};
</script>
