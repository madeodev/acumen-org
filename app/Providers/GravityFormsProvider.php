<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Concerns\Colors\ButtonColors;

class GravityFormsProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        add_filter('gform_submit_button_1', [&$this, 'updateNewsletterSubmitButton'], 10, 2);
        add_filter('gform_submit_button', [&$this, 'updateSubmitButton'], 10, 2);
        add_filter('gform_disable_css', '__return_true');
        add_filter('gform_field_validation', [&$this, 'updateValidationMessage'], 10, 3);
        add_filter('gform_form_settings', [&$this, 'setDefaultFormSettings'], 10, 2);
    }

    /**
     * Update the submit button for form ID 1 (the footer newsletter form)
     */
    public function updateNewsletterSubmitButton($button)
    {
        if (is_admin()) {
            return $button;
        }

        $classes = (new ButtonColors('outline-white'))->classes();

        return $this->renderButton($button, $classes);
    }

    /**
     * Add default button styles for the submit button
     */
    public function updateSubmitButton($button)
    {
        if (is_admin()) {
            return $button;
        }

        $classes = (new ButtonColors('fill-black'))->classes();

        return $this->renderButton($button, $classes);
    }

    /**
     * Renders a button element with updated attributes and optional classes.
     *
     * @param string $button The original button HTML string.
     * @param string $classes Optional. Additional CSS classes to add to the button.
     * @return string The modified button HTML with updated attributes and classes.
     */
    private function renderButton($button, $classes = '')
    {
        $label = $this->extractButtonLabel($button);
        $button = $this->appendClasses($button, $classes);

        if (preg_match('/<button\b/i', $button)) {
            return $button;
        }

        $button = preg_replace('/^<input\b/i', '<button', $button, 1);
        $button = preg_replace('/\s*\/?>\s*$/', sprintf('>%s</button>', esc_html($label)), $button, 1);

        return $button;
    }

    /**
     * Extract the button text from an input/button markup string.
     */
    private function extractButtonLabel($button)
    {
        if (preg_match('/\bvalue=(["\'])(.*?)\1/i', $button, $matches)) {
            return html_entity_decode($matches[2], ENT_QUOTES, 'UTF-8');
        }

        if (preg_match('/<button\b[^>]*>(.*?)<\/button>/is', $button, $matches)) {
            return wp_strip_all_tags($matches[1]);
        }

        return __('Submit', 'form');
    }

    /**
     * Append theme classes without dropping any Gravity Forms attributes.
     */
    private function appendClasses($button, $classes)
    {
        if (empty(trim($classes))) {
            return $button;
        }

        if (preg_match('/\bclass=(["\'])(.*?)\1/i', $button, $matches)) {
            $mergedClasses = trim($matches[2] . ' ' . $classes);

            return preg_replace(
                '/\bclass=(["\'])(.*?)\1/i',
                sprintf('class="%s"', esc_attr($mergedClasses)),
                $button,
                1
            );
        }

        return preg_replace(
            '/^<(input|button)\b/i',
            sprintf('<$1 class="%s"', esc_attr($classes)),
            $button,
            1
        );
    }

    /**
     * Add default form settings
     */
    public function setDefaultFormSettings($settings, $form)
    {
        $settings[__('Form Layout', 'gravityforms')]['form_description_placement'] = 'above';
        $settings[__('Form Layout', 'gravityforms')]['form_required_indicator'] = 'asterisk';
        $settings[__('Form Options', 'gravityforms')]['honey_pot'] = true;

        return $settings;
    }

    /**
     * Update the form validation message
     */
    public function updateValidationMessage($result, $value, $form)
    {
        if (!empty($result['message'])) {
            $result['message'] = get_svg('images.error', 'mr-2') . '*' . $result['message'];
        }

        return $result;
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
