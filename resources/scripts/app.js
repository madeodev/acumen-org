import domReady from '@roots/sage/client/dom-ready';
import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
import collapse from '@alpinejs/collapse';
import intersect from '@alpinejs/intersect';
import accordion from './blocks/accordion';
import tabs from './blocks/tabs';
import nav from './blocks/nav';
import logoAnimation from './blocks/logoAnimation';
import videoModal from './blocks/videoModal';
import localVideo from './blocks/localVideo';
import carousel from './blocks/carousel';
import carouselCaseStudyCard from './blocks/carouselCaseStudyCard';
import carouselLarge from './blocks/carouselLarge';
import carouselKnowledgeHub from './blocks/carouselKnowledgeHub';
import animations from './util/animations';
import stats from './blocks/stats';
import shareButtons from './blocks/shareButtons';
import parallaxBlockquote from './blocks/parallaxBlockquote';

/**
 * Application entrypoint
 */
domReady(async () => {
  animations();
  Alpine.plugin(focus);
  Alpine.plugin(collapse);
  Alpine.plugin(intersect);
  Alpine.data('accordion', accordion);
  Alpine.data('tabs', tabs);
  Alpine.data('nav', nav);
  Alpine.data('logoAnimation', logoAnimation);
  Alpine.data('localVideo', localVideo);
  Alpine.data('videoModal', videoModal);
  Alpine.data('carousel', carousel);
  Alpine.data('carouselCaseStudyCard', carouselCaseStudyCard);
  Alpine.data('carouselLarge', carouselLarge);
  Alpine.data('carouselKnowledgeHub', carouselKnowledgeHub);
  Alpine.data('stats', stats);
  Alpine.data('shareButtons', shareButtons);
  Alpine.data('parallaxBlockquote', parallaxBlockquote);
  Alpine.start();
});

/**
 * @see {@link https://webpack.js.org/api/hot-module-replacement/}
 */
if (import.meta.webpackHot) import.meta.webpackHot.accept(console.error);
