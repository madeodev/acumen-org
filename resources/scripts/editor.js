/**
 * @see {@link https://bud.js.org/extensions/bud-preset-wordpress/editor-integration/filters}
 */
roots.register.filters('@scripts/filters');

/**
 * Remove taxonomy editor panels
 */
const taxonomies = [
  'acumen-year',
  'blog-type',
  'case-study-type',
  'category',
  'company-status',
  'news-type',
  'office',
  'post_tag',
  'problem-tax',
  'program-type',
  'region-tax',
  'report-type',
  'team-function',
  'team-type',
  'media-format',
];

taxonomies.forEach(taxonomy => {
  wp.data
    .dispatch("core/edit-post")
    .removeEditorPanel("taxonomy-panel-"+taxonomy);
});

/**
 * @see {@link https://webpack.js.org/api/hot-module-replacement/}
 */
if (import.meta.webpackHot) import.meta.webpackHot.accept(console.error);
