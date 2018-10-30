<template>
    <div class="loading-spinner text-center mb-4 font-bold">
        <div class="lds-hourglass"></div>
        <br>
        <h3>Transcribing...</h3>
        <h4>It takes a while to transcribe the file so please be patient.</h4>
    </div>
</template>

<script>
export default {
    name: "SpinnerComponent"
};
</script>

<style lang="scss" scoped>
.lds-hourglass {
    display: inline-block;
    position: relative;
    width: 64px;
    height: 64px;

    &:after {
        content: " ";
        display: inline-block;
        border-radius: 50%;
        width: 0;
        height: 0;
        margin: 6px;
        box-sizing: border-box;
        border: 26px solid;
        border-color: #636b6f transparent #636b6f transparent;
        animation: lds-hourglass 1.2s infinite;
    }
}

@keyframes lds-hourglass {
    0% {
        transform: rotate(0);
        animation-timing-function: cubic-bezier(0.55, 0.055, 0.675, 0.19);
    }
    50% {
        transform: rotate(900deg);
        animation-timing-function: cubic-bezier(0.215, 0.61, 0.355, 1);
    }
    100% {
        transform: rotate(1800deg);
    }
}
</style>
