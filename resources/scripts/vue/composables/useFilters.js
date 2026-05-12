import { ref, onMounted, watch } from 'vue';

/**
 * @param {string} endpoint - pass empty string to skip fetching filters
 * @param {ref} preFilter - pass Filters->getPreFilters() to preselect filters based on the url parameters.
 * @param {ref} staticFilters - an array of Term objects to use as filters
 */
export default (endpoint, preFilter = ref([]), staticFilters = ref([])) => {
  const filterGroups = staticFilters;
  const selected = ref([]);
  const isActive = ref([]);

  onMounted(() => {
    fetchFilters();
    applyPreFilter();
  });

  watch(preFilter, (terms) => {
    applyPreFilter(terms);
  });

  function fetchFilters() {
    if (!endpoint) return;

    fetch(endpoint)
      .then((data) => data.json())
      .then((result) => {
        result.data.map((data) => {
          filterGroups.value.push(data);
        });
      });
  }

  function clearFilters(group, apply) {
    if (!group) {
      selected.value = [];
      isActive.value = [];
      return;
    }

    if (selected.value.length) {
      selected.value = selected.value.filter(
        (item) => item.taxonomy !== group.slug,
      );
    }

    if (apply) {
      apply();
    }
  }

  function isActiveFilter(filter) {
    return selected.value.some((item) => item.ID === filter.ID);
  }

  function removeActiveFilter(filter) {
    selected.value = selected.value.filter(
      (item) => item.taxonomy !== filter.taxonomy,
    );
  }

  function addFilter(filter) {
    selected.value = [...selected.value, filter];
  }

  function toggleFilter(filter, apply) {
    const hasGroup = selected.value.find((item) => filter.ID === item.ID);

    if (hasGroup) {
      removeActiveFilter(hasGroup);
    } else {
      addFilter(filter);
    }

    if (apply) {
      apply();
    }
  }

  function setActiveFilter(filter, apply) {
    const activeGroup = selected.value.find(
      (item) => filter.taxonomy === item.taxonomy,
    );

    if (activeGroup) {
      removeActiveFilter(activeGroup);
    }

    addFilter(filter);

    if (apply) {
      apply();
    }
  }

  function getActiveFilter(group) {
    let active = [];

    selected.value.map((item) => {
      if (group.slug === item.taxonomy) {
        active = [...active, item];
      }
    });

    return active;
  }

  function getSelectedFilter(group) {
    return selected.value.find((item) => group.slug === item.taxonomy) || {};
  }

  function applyPreFilter(filters = preFilter) {
    clearFilters();

    filters.value.forEach((filter) => {
      if (filter && filter.ID) {
        addFilter(filter);
      }
    });
  }

  function getFilterGroup(name, filterSrc = {}, filterField) {
    const filter = filterGroups.value.find((group) => group.slug == name) || {};

    if (filter.terms && filterSrc.ID && filterField) {
      return {
        ...filter,
        terms: filter.terms.filter(
          (term) => term[filterField] === filterSrc.ID,
        ),
      };
    }

    return filter;
  }

  function hasFilterGroup(group) {
    if (!group) {
      return;
    }

    const filter =
      selected.value.find((item) => item.taxonomy === group.slug) || {};

    return Object.keys(filter).length;
  }

  return {
    filterGroups,
    clearFilters,
    isActiveFilter,
    removeActiveFilter,
    toggleFilter,
    getActiveFilter,
    getSelectedFilter,
    setActiveFilter,
    getFilterGroup,
    hasFilterGroup,
    selected,
  };
};
