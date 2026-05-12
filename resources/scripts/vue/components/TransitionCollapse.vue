<template>
  <transition
    name="collapse"
    @before-enter="beforeEnter"
    @enter="enter"
    @before-leave="beforeLeave"
    @leave="leave"
    @after-enter="afterEnter"
  >
    <slot />
  </transition>
</template>

<script setup>
function beforeEnter(el) {
  el.style.height = '0';
}

function enter(el) {
  el.style.height = el.scrollHeight + 'px';
}

function beforeLeave(el) {
  el.style.height = el.scrollHeight + 'px';
}

function leave(el) {
  el.style.height = '0';
}

function afterEnter(el) {
  el.style.height = '';
}
</script>

<style>
.collapse-enter-active,
.collapse-leave-active {
  @apply transition-all duration-500 overflow-hidden;
}
</style>
