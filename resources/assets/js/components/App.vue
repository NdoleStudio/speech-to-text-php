<template>
    <div>
        <upload-form-component
                @changeIsLoading="changeIsLoading"
                @changeTranscribedText="changeTranscribedText"
                :pusherKey="pusherKey"
                :pusherCluster="pusherCluster"
                :isLoading="isLoading"></upload-form-component>
        <spinner-component v-if="isLoading"></spinner-component>
        <text-component :transcribedText="transcribedText" v-if="transcribedText !== null"></text-component>
    </div>
</template>

<script>
import UploadFormComponent from "./UploadFormComponent";
import SpinnerComponent from "./SpinnerComponent";
import TextComponent from "./TextComponent";

export default {
    name: "App",
    components: {
        UploadFormComponent,
        SpinnerComponent,
        TextComponent
    },
    props: ["pusherKey", "pusherCluster"],
    data() {
        return {
            isLoading: false,
            transcribedText: null
        };
    },
    methods: {
        changeIsLoading(isLoadingValue) {
            this.isLoading = isLoadingValue;
        },
        changeTranscribedText(transcribedText) {
            this.transcribedText = transcribedText;
        }
    }
};
</script>
