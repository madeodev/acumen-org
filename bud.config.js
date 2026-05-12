/**
 * Compiler configuration
 *
 * @see {@link https://roots.io/docs/sage sage documentation}
 * @see {@link https://bud.js.org/guides/configure bud.js configuration guide}
 *
 * @type {import('@roots/bud').Config}
 */
export default async (app) => {
  app.extensions.get('@roots/bud-eslint')?.enable(false);
  app.extensions.get('@roots/bud-stylelint')?.enable(false);

  /**
   * Application assets & entrypoints
   *
   * @see {@link https://bud.js.org/docs/bud.entry}
   * @see {@link https://bud.js.org/docs/bud.assets}
   */
  app
    .entry('app', ['@scripts/app', '@styles/app'])
    .entry('editor', ['@scripts/editor', '@styles/editor'])
    .entry('peopleGrid', ['@scripts/vue/people-grid'])
    .entry('companyGrid', ['@scripts/vue/company-grid'])
    .entry('postGridFilter', ['@scripts/vue/post-grid-filter'])
    .entry('interactiveMap', ['@scripts/vue/interactive-map'])
    .entry('foundryGrid', ['@scripts/vue/foundry-grid'])
    .entry('knowledgeHubHeroPostsSlider', ['@scripts/vue/knowledge-hub-hero-posts-slider'])
    .assets(['images', 'fonts', 'json']);

  // Allows us to import colors from '@tailwind/colors' in InteractiveMap.vue
  app.tailwind.generateImports([`colors`]);

  app.alias({
    vue: app.path('node_modules', 'vue/dist/vue.esm-browser.prod.js'),
  });

  /**
   * Set public path
   *
   * @see {@link https://bud.js.org/docs/bud.setPublicPath}
   */
  app.setPublicPath(process.env['BUD_PUBLIC_PATH'] || '/wp-content/themes/sage/public/');

  /**
   * Ensure relative URLs for assets to avoid mixed content
   */
  app.hooks.on('build.before', () => {
    // Use relative paths to avoid protocol-specific URLs
    app.setPublicPath('/wp-content/themes/sage/public/');
  });

  /**
   * Handle SVG assets for Vue Inline SVG component
   */
  app.hooks.on('build.resolve', () => {
    // Ensure SVG requires are resolved as absolute paths from theme root
    app.module.setRule('asset', {
      test: /\.svg$/,
      type: 'asset/resource',
      generator: {
        filename: 'images/[name].[hash][ext]',
        publicPath: '/wp-content/themes/sage/public/',
      },
      issuer: {
        test: /\.vue$/,
      },
    });
  });

  /**
   * Development server settings
   *
   * @see {@link https://bud.js.org/docs/bud.setUrl}
   * @see {@link https://bud.js.org/docs/bud.setProxyUrl}
   * @see {@link https://bud.js.org/docs/bud.watch}
   */
  app
    .setUrl(`${process.env['WP_HOME']}:3000`)
    .setProxyUrl(process.env['WP_HOME'])
    .watch(['resources/views', 'app']);

  /**
   * Generate WordPress `theme.json`
   *
   * @note This overwrites `theme.json` on every build.
   *
   * @see {@link https://bud.js.org/extensions/sage/theme.json}
   * @see {@link https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-json}
   */
  app.wpjson
    .setSettings({
      color: {
        custom: false,
        customDuotone: false,
        customGradient: false,
        defaultDuotone: false,
        defaultGradients: false,
        defaultPalette: false,
        duotone: [],
      },
      custom: {
        spacing: {},
        typography: {
          'font-size': {},
          'line-height': {},
        },
      },
      spacing: {
        padding: true,
        units: ['px', '%', 'em', 'rem', 'vw', 'vh'],
      },
      typography: {
        customFontSize: false,
      },
    })
    .useTailwindColors();
};
