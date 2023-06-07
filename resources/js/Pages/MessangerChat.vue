<script setup>
import LayoutMessage from '../Components/LayoutMessage.vue';
import Welcome from '@/Components/Welcome.vue';

const props = defineProps({
    Thread: Object,
});
</script>

<template>
    <LayoutMessage>
        <div class="mr-6 ml-6 mb-6">
            <div id="header">

            </div>
            <div id="buttons">

            </div>
            <div id="chat">

            </div>
            <div id="keyboard">

            </div>
        </div>
    </LayoutMessage>
    
    
</template>
