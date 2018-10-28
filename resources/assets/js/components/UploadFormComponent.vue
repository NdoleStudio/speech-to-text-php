<template>
    <form class="w-full max-w-lg flex flex-wrap content-center">
        <div class="w-full md:w-3/4 px-2">
            <label class="block uppercase tracking-wide text-grey-darker text-sm font-bold mb-2">
                Audio File
            </label>
            <input @change="handleFileUpload" class="appearance-none block w-full bg-grey-lighter text-grey-darker border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white border-grey" ref="fileInput" type="file">
            <p class="text-red text-xs italic" :class="{hidden: !uploadedFileIsInvalid}">Please upload a valid sound file</p>
        </div>
        <div class="md:w-1/4 px-3">
            <button @click="submitFile" :class="{'text-black cursor-not-allowed': isLoading, 'text-white bg-red' : !isLoading}" class="get-weather-btn hover:text-black border-red border focus:outline-none border hover:bg-transparent font-bold py-4 px-4 rounded" type="button">
                Transcribe Audio
            </button>
        </div>
        <div v-if="errors.length > 0" class="w-full flex-center content-center">
            <div class="w-4/5 text-red-dark font-bold border bg-red-lightest p-4">
                <ul v-for="error in errors">
                    <li>{{ error }}</li>
                </ul>
            </div>
        </div>
    </form>
</template>

<script>
    import axios from "axios";
    import Echo from 'laravel-echo';
    import Pusher from 'pusher-js';

    export default {
        name: "UploadFormComponent",
        props: [
            'isLoading',
            'pusherKey',
            'pusherCluster'
        ],
        data () {
          return {
              file: null,
              uploadedFileIsInvalid: false,
              errors: []
          }
        },
        mounted () {
            axios.interceptors.response.use(response => response, (error) => {
                return Promise.reject(error.response);
            });
        },
        methods: {
            handleFileUpload () {
                this.file = this.$refs.fileInput.files[0];
                this.uploadedFileIsInvalid = false;
                this.clearErrors();
            },
            submitFile() {
                let _self = this;

                if(_self.isLoading === true) {
                    return ;
                }

                _self.changeIsLoading(true);
                this.uploadedFileIsInvalid = false;
                _self.changeTranscribedText(null);
                if(_self.file === null) {
                    _self.changeIsLoading(false);
                    this.uploadedFileIsInvalid = true;
                    return;
                }

                let formData = new FormData();
                formData.append('file', _self.file);

                axios.post( '/store-sound-file',
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }
                ).then(function(response){
                    window.Pusher = Pusher;

                    let echoInstance = new Echo({
                        broadcaster: 'pusher',
                        key: _self.pusherKey,
                        cluster: _self.pusherCluster,
                        encrypted: true
                    });

                    echoInstance
                        .channel(response.data.payload.filename)
                        .listen('AudioTranscribed', (data) => {
                            _self.changeTranscribedText(data);
                            _self.changeIsLoading(false);
                            _self.file = null;
                            _self.$refs.fileInput.value = '';
                        });
                })
                .catch(function(response){
                    console.log(response);
                    let errorsArray = [];
                    for (let property in response.data.errors) {
                        if (response.data.errors.hasOwnProperty(property)) {
                            errorsArray.push(...response.data.errors[property]);
                        }
                    }
                    _self.errors = errorsArray;
                    _self.changeIsLoading(false);
                });
            },
            changeIsLoading(newValue) {
                this.$emit('changeIsLoading', newValue);
            },

            changeTranscribedText(text) {
                this.$emit('changeTranscribedText', text);
            },

            clearErrors() {
                this.errors = [];
            }
        },
    }
</script>

<style scoped>

</style>