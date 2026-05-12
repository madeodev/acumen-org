<template>
  <div>
    <p
      class="sr-only"
      v-html="labels.filtered_by"
    />
    <ul
      class="inline-flex gap-3.5"
      aria-live="polite"
    >
      <li
        v-for="filter in selected"
        :key="filter.id"
      >
        <button
          :class="classes.active"
          :aria-label="buttonLabel(filter)"
          @click.prevent="() => removeSelected(filter)"
        >
          <span v-html="filter.label" />
          <inline-svg
            aria-hidden="true"
            :src="'/wp-content/themes/sage/public/images/close.fda38d.svg'"
          />
        </button>
      </li>

      <li>
        <button
          class="static-underline h5 mb-0 hover:text-black/80 transition duration-300"
          @click="clear"
          v-html="labels.clear"
        />
      </li>
    </ul>
  </div>
</template>

<script setup>
import InlineSvg from 'vue-inline-svg';

const emit = defineEmits(['clear', 'removeSelected']);

const props = defineProps({
  selected: {
    type: Object,
    default: () => ({}),
    required: true,
  },
  classes: {
    type: Object,
    default: () => ({}),
    required: true,
  },
  labels: {
    type: Object,
    default: () => ({}),
    required: true,
  },
});

function clear() {
  emit('clear');
}

function removeSelected(filter) {
  emit('removeSelected', filter)
}

const buttonLabel = (filter) => {
  if (!props.labels.remove_filter) {
    // fallback only if the label does not exist
    return `Remove ${filter.label}`;
  }

  const label = props.labels.remove_filter;
  const term = filter.label;

  return label.replace('%term%', term);
};
</script>
