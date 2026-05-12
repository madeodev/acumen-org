<template>
  <transition
    name="slide-fade"
    mode="out-in"
  >
    <slot />
  </transition>
</template>

<style>
.slide-fade-enter-active,
.slide-fade-leave-active {
  @apply transition duration-500;
}

.slide-fade-enter-from,
.slide-fade-leave-to {
  @apply translate-x-5 opacity-0;
}
</style>
