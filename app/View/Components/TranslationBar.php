<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Concerns\Translation;

class TranslationBar extends Component
{
    /**
     * @var array
     */
    public $translations;

    /**
     * @var string
     */
    public $label;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->translations = $this->getTranslations();
        $this->label = __('Read this page in another language', 'translation_bar');
    }

    /**
     * Get the translations for the current page, and the corresponding links and labels
     *
     * @return array
     */
    private function getTranslations()
    {
        if (!(new Translation)->wpml_active) {
            return [];
        }

        $post_id = get_the_ID();

        $is_translated = apply_filters('wpml_element_has_translations', null, $post_id, get_post_type($post_id));

        if (!$is_translated) {
            return [];
        }

        $type = apply_filters('wpml_element_type', get_post_type($post_id));
        $trid = apply_filters('wpml_element_trid', false, $post_id, $type);

        $translations = apply_filters('wpml_get_element_translations', [], $trid, $type);

        if (empty($translations)) {
            return [];
        }

        $current_lang = apply_filters('wpml_post_language_details', null, $post_id);

        return collect($translations)->map(function ($lang) use ($current_lang) {
            $is_current = $current_lang['language_code'] === $lang->language_code && $lang->post_status === 'publish';

            /**
             * switch to the target language otherwise the permalink returned is the
             * same as the current language
             */
            do_action('wpml_switch_language', $lang->language_code);

            $data = [
                'translation_id' => $lang->translation_id,
                'title' => strtoupper($lang->language_code),
                'element' => $is_current ? 'span' : 'a',
                'color' => $is_current ? 'current-page-translation' : 'link-translation',
                'url' => get_permalink($lang->element_id),
            ];

            // reset back to the current language
            do_action('wpml_switch_language', $current_lang['language_code']);

            return $data;
        })->toArray();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.translation-bar');
    }
}
