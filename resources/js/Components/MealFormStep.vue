<script setup>
const props = defineProps({
    active:{
        type: Boolean,
        default: false
    }
});
</script>
<template>
        <Transition name="slide-fade" mode="in-out">
        <div v-if="active">
            <slot></slot>
        </div>
    </Transition>
</template>
<style scoped>
.slide-fade-enter-active {
  transition: all 0.5s ease-out;
}

.slide-fade-leave-active {
  transition: all 0.5s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-fade-enter-from,
.slide-fade-leave-to {
  transform: translateX(20px);
  opacity: 0;
}

</style>
