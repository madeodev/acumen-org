<template>
  <transition
    name="fade"
    mode="out-in"
  >
    <slot />
  </transition>
</template>

<style>
.fade-enter-active,
.fade-leave-active {
  @apply transition-opacity duration-500;
}

.fade-enter-from,
.fade-leave-to {
  @apply opacity-0;
}
</style>
