<template>
  <transition
    name="slide-in"
    mode="out-in"
  >
    <slot />
  </transition>
</template>

<style>
.slide-in-enter-active,
.slide-in-leave-active {
  @apply transition duration-500;
}

.slide-in-enter-from,
.slide-in-leave-to {
  @apply translate-x-full;
}
</style>
