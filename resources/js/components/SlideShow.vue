<style>
.slider {
    position: relative;
    width: 100%;
    height: 800px;
    overflow: hidden;
}

.item {
    position: absolute;
    width: 508px;
    height: 800px;
    transition: 0.4s;
    left: calc(50% - 254px);
    top: 0;
    border-radius: 10px;
    overflow: hidden;
}

.item img {
    width: 100%;
    height: 100%;
}

#next,
#prev {
    position: absolute;
    top: 0;
    color: #fff;
    background-color: rgba(0, 0, 0, 0.25);
    border: none;
    font-size: xxx-large;
    font-family: monospace;
    font-weight: bold;
    left: 0;
    width: 100px;
    height: 100%;
    justify-content: center;
    align-items: center;
    display: flex;
    cursor: pointer;
    user-select: none;
}

#next:hover,
#prev:hover {
    background-color: rgba(0, 0, 0, 0.5);
}

#next {
    left: unset;
    right: 0;
}
</style>

<template>
    <div class="slider">
        <div class="item" v-for="(evento, i) in eventos" :key="i">
            <a href="">
                <img
                    :src="'/imagens/banner/' + evento.imagem + '.jpeg'"
                    alt=""
                />
            </a>
        </div>
        <div id="prev"><div>&#60;</div></div>
        <div id="next"><div>&#62;</div></div>
    </div>
</template>

<script>
export default {
    props: ["csrf_token", "eventos"],
    data() {
        return {};
    },
    beforeCreate() {
        this.eventos.forEach((evento) => {
            evento.data_inicio = new Date(evento.data_inicio);
            evento.data_fim = new Date(evento.data_fim);
        });

        console.log(this.eventos);
    },
    methods: {},
    mounted() {
        console.log("Oi");
        let items = document.querySelectorAll(".slider .item");
        let next = document.getElementById("next");
        let prev = document.getElementById("prev");
        console.log(items);

        let active = 2;

        function loadShow() {
            items[active].style.transform = `none`;
            items[active].style.zIndex = 1;
            items[active].style.filter = "none";
            let stt = 0;
            let index = 0;
            for (let i = 1; i <= Math.floor(items.length / 2); i++) {
                stt++;
                index = (active + i) % items.length;
                items[index].style.transform = `translateX(${508 * stt}px)`;
                items[index].style.zIndex = -stt;
                items[index].style.filter = `blur(5px)`;
                console.log("Dele pra frente", i);
            }
            stt = 0;
            for (let i = 1; i <= Math.floor((items.length - 1) / 2); i++) {
                stt++;
                index = (active - i + items.length) % items.length;
                items[index].style.transform = `translateX(${-508 * stt}px)`;
                items[index].style.zIndex = -stt;
                items[index].style.filter = `blur(5px)`;
                console.log("Pra trás", i);
            }
        }
        loadShow();

        next.onclick = function () {
            active = active + 1 < items.length ? active + 1 : 0;
            loadShow();
        };

        prev.onclick = function () {
            active = active - 1 > -1 ? active - 1 : items.length - 1;
            loadShow();
        };
    },
};
</script>
