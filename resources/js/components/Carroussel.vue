<style scoped>
.center {
    justify-content: center;
    align-content: center;
    align-items: center;
    display: flex;
}

.carroussel {
    display: grid;
    justify-content: start;
    grid-auto-flow: column;
    gap: 1.2rem;
    overflow-y: auto;
    overscroll-behavior-x: contain;
    scroll-snap-type: x mandatory;
    scrollbar-width: 12px;
}

.carroussel::-webkit-scrollbar {
    border-radius: 6px;
}

.carroussel::-webkit-scrollbar-thumb {
    background-color: #dc3545;
    border-radius: 10px;
}

.carroussel-item {
    scroll-snap-align: start;
    min-width: 350px;
    min-height: 320px;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 350px;
    height: 320px;
    background-color: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.3);
}

.foto-card {
    width: 350px;
    height: 200px;
}

.foto-card img {
    width: 350px;
}

.info-card {
    width: 350px;
    height: 120px;
    display: flex;
    background-color: #ddd;
    padding: 10px;
}

.periodo-card {
    width: 120px;
    height: 120px;
    padding: 10px;
}
</style>

<template>
    <div class="carroussel mx-5 py-2">
        <div
            v-for="(evento, i) in eventos"
            :key="i"
            class="card carroussel-item"
            style=""
        >
            <div class="foto-card">
                <a :href="'/evento/' + evento.id"
                    ><img :src="'/storage/' + evento.thumbnail"
                /></a>
            </div>
            <div class="info-card">
                <div class="periodo-card">
                    <div
                        class="rounded overflow-hidden row"
                        style="
                            background-color: white;
                            width: 100px;
                            height: 80px;
                        "
                    >
                        <div
                            class="center fw-bolder col-6"
                            :class="{ 'col-12': evento.dia_unico }"
                            style="background-color: #bbb"
                        >
                            {{ dias_semana[evento.data_inicio.getDay()] }}
                        </div>
                        <div
                            v-if="!evento.dia_unico"
                            class="center fw-bolder col-6 border-start"
                            style="background-color: #bbb"
                        >
                            {{ dias_semana[evento.data_fim.getDay()] }}
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
                            :class="{ 'col-12': evento.dia_unico }"
                        >
                            {{ meses_ano[evento.data_inicio.getMonth()] }}
                        </div>
                        <div
                            v-if="!evento.dia_unico"
                            class="center text-white bg-danger fw-bolder col-6 border-start"
                        >
                            {{ meses_ano[evento.data_fim.getMonth()] }}
                        </div>
                    </div>
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
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["csrf_token", "eventos"],
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
    beforeCreate() {
        this.eventos.forEach((evento) => {
            evento.data_inicio = new Date(evento.data_inicio);
            evento.data_fim = new Date(evento.data_fim);
        });
    },
    methods: {},
};
</script>
