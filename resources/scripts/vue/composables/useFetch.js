import { ref, computed, onMounted } from 'vue';
import { debounce } from 'lodash';

/**
 * @param {string} endpoint
 * @param {ref} filters - pass 'selected' from useFilters: an array of term objects. To use non-term filters, add 'param' key to object.
 * @param {ref} params - parameters to pass to query string
 * @param {boolean} paginate - use false if using 'load more' button
 * @param {boolean} loadOnMounted
 */
export default (
  endpoint,
  filters = ref([]),
  params = ref(),
  paginate = false,
  loadOnMounted = true,
) => {
  const DEFAULT_PAGE = paginate ? 1 : 0;
  const search = ref('');
  const maxPages = ref(1);
  const page = ref(DEFAULT_PAGE);
  const isLoading = ref(false);
  const totalPosts = ref(null);
  const resources = ref([]);
  const emptyMessage = ref('');
  const post = ref(null);
  const perpage = ref(params.value?.per_page ?? 15);

  const debouncedLoad = debounce(load);
  const debouncedReset = debounce(reset);

  onMounted(() => {
    if (loadOnMounted) debouncedLoad();
  });

  const hasMore = computed(
    () => resources.value.length && page.value < maxPages.value,
  );

  const query = computed(() => {
    // the selected terms, with any 'param' filters filtered out
    const terms = filters.value
      .filter((item) => !item.param)
      .map((item) => {
        return {
          ID: item.ID,
          taxonomy: item.taxonomy,
          slug: item.slug,
        };
      });

    // create copy of params for potential modification
    const queryParams = { ...params.value };

    // find any filters with a 'param' key and add the parameter to queryParams
    filters.value
      .filter((item) => item.param)
      .forEach((item) => {
        if (!item.slug) return;
        queryParams[item.param] = item.slug;
      });

    return Object.assign(
      {},
      {
        page: paginate ? page.value : page.value + 1,
        search: search.value ?? '',
        post: post.value,
        terms: JSON.stringify(terms),
        ...queryParams,
        per_page: perpage.value,
      },
    );
  });

  const queryString = computed(() => new URLSearchParams(query.value));

  function load(toPage = 0, setUrl) {
    isLoading.value = true;

    if (toPage) {
      page.value = toPage;
    }

    fetch(`${endpoint}?${queryString.value}`)
      .then((res) => res.json())
      .then((res) => {
        resources.value = paginate
          ? res.data
          : [...resources.value, ...res.data];
        maxPages.value = res.max_pages;
        page.value = res.current_page;
        totalPosts.value = res.total_posts;
        isLoading.value = false;
        emptyMessage.value = res.emptyMessage;

        if (setUrl) {
          setPageUrl();
        }
      });
  }

  function setPageUrl() {
    // start from scratch
    let urlSearch = new URLSearchParams();

    if (post.value) {
      urlSearch.set(post.value.post_type, post.value.slug);
      window.history.pushState(
        null,
        null,
        `${window.location.origin}${
          window.location.pathname
        }?${urlSearch.toString()}`,
      );
      return;
    }

    if (search.value !== '') {
      urlSearch.set('search', search.value);
    }

    if (filters.value.length > 0) {
      filters.value.forEach((param) => {
        urlSearch.set(param.taxonomy, param.slug);
      });
    }

    if (urlSearch.toString() !== '') {
      window.history.pushState(
        null,
        null,
        `${window.location.origin}${
          window.location.pathname
        }?${urlSearch.toString()}`,
      );
    } else {
      window.history.pushState(
        null,
        null,
        `${window.location.origin}${window.location.pathname}`,
      );
    }
  }

  function reset(setUrl = false) {
    page.value = DEFAULT_PAGE;
    search.value = '';
    maxPages.value = 1;
    resources.value = [];
    load(page.value, setUrl);
  }

  function resetPage() {
    page.value = DEFAULT_PAGE;
  }

  function setSearch(value) {
    search.value = value;
  }

  function setPost(obj) {
    post.value = obj;
    setPageUrl();
  }

  function setPerPage(value) {
    perpage.value = value;
  }

  function getPost(postType) {
    const url = new URL(window.location.href);
    let urlSearch = new URLSearchParams(url.search);
    const slug = urlSearch.get(postType);
    let post = null;

    if (urlSearch.has(postType)) {
      post = resources.value.find((item) => item.slug === slug);

      if (!post) {
        post = fetch(`${endpoint}?name=${slug}`)
          .then((res) => res.json())
          .then((res) => {
            return res.data[0];
          });
      }
    }

    return post;
  }

  return {
    search,
    load,
    reset: debouncedReset,
    hasMore,
    totalPosts,
    resources,
    setSearch,
    page,
    maxPages,
    isLoading,
    emptyMessage,
    resetPage,
    setPost,
    getPost,
    setPerPage,
  };
};
