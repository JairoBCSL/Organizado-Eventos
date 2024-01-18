<style scoped>
.modal-content {
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.3);
}

.card-header {
    background-color: rgb(141, 153, 174);
}

.card-header .modal-title {
    color: white;
    font-size: 24px;
    font-weight: bold;
    text-align: center;
}
</style>

<template>
    <div
        class="modal fade"
        :id="id"
        tabindex="-1"
        aria-labelledby=""
        aria-hidden="true"
    >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header card-header">
                    <h1 class="modal-title fs-5" id="ModalLabel">
                        {{ title }}
                    </h1>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <slot name="content"> </slot>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["id", "title"],
};
</script>
