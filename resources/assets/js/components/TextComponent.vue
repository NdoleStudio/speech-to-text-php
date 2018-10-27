<template>
    <div class="w-full flex-center mt-4">
        <div class="md:w-4/5 rounded border border-blue-dark  content-center overflow-hidden shadow-lg">
            <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2 text-center">Transcription of Audio</div>
                <p v-for="line in transcribedText" class="text-grey-darker text-base">
                    {{ line }}
                    <br>
                    <br>
                </p>
            </div>
            <div class="px-6 py-4">
                <span class="inline-block bg-grey-lighter rounded-full px-3 py-1 text-sm font-semibold text-grey-darker mr-2">
                   Line Count: {{ transcribedText.length }}
                </span>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "TextComponent",
        props: ['transcribedText']
    }
</script>

<style scoped>
</style>