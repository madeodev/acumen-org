<?php

namespace App\Concerns;

class Translation
{
  /**
   * @var string
   */
  public $current_lang;

  /**
   * @var boolean
   */
  public $wpml_active;

  /**
   * @var string
   */
  protected $default_lang = 'en';

  public function __construct()
  {
    $this->wpml_active = $this->checkWpmlActive();
    $this->current_lang = $this->getCurrentLanguage();
    $this->default_lang = $this->getDefaultLanguage();
  }

  /**
   * Check if WPML is active
   *
   * @return boolean
   */
  private function checkWpmlActive()
  {
    return once(function () {
      return is_plugin_active('sitepress-multilingual-cms/sitepress.php');
    });
  }

  /**
   * Get the current language
   *
   * @return string
   */
  private function getCurrentLanguage()
  {
    if (!$this->wpml_active) {
      return '';
    }

    return once(function () {
      return apply_filters('wpml_current_language', null);
    });
  }

  /**
   * Get the default language
   *
   * @return string
   */
  private function getDefaultLanguage()
  {
    if (!$this->wpml_active) {
      return '';
    }

    return once(function () {
      return apply_filters('wpml_default_language', null);
    });
  }

  /**
   * Fetch the options field value from the default language
   *
   * @return string
   */
  public function setDefaultLanguage()
  {
    return acf_get_setting('default_language');
  }

  /**
   * Use the `get_field` function to get the value of a field.
   * If the translated value is empty, pull the value from the default language.
   *
   * Note: Only use for ACF Settings page, or the nav.
   *
   * @return string
   */
  public function getOptionsFieldValue($field, $post_id, $all = false)
  {
    $value = get_field($field, $post_id);

    if (!$this->wpml_active) {
      return $value;
    }

    if (empty($value)) {
      add_filter('acf/settings/current_language', [&$this, 'setDefaultLanguage'], 100);

      $value = get_field($field, $post_id);

      remove_filter('acf/settings/current_language', [&$this, 'setDefaultLanguage'], 100);
    }

    return $value;
  }

  /**
   * Use the `get_fields` function to get the field values.
   * If the translated value is empty, pull the value from the default language.
   *
   * Note: Only use for ACF Settings page, or the nav.
   *
   * @return string
   */
  public function getAllOptionsFieldValue($post_id)
  {
    $value = get_fields($post_id);

    if (!$this->wpml_active) {
      return $value;
    }

    if (empty($value)) {
      add_filter('acf/settings/current_language', [&$this, 'setDefaultLanguage'], 100);

      $value = get_fields($post_id);

      remove_filter('acf/settings/current_language', [&$this, 'setDefaultLanguage'], 100);
    }

    return $value;
  }

  /**
   * Check if the menu has a translation. If there is, return the translated menu.
   * Otherwise, pull the menu from the defualt language.
   *
   * @return array
   */
  public function getTranslatedMenu($menu_id)
  {
    $value = wp_get_nav_menu_items($menu_id);

    if (!$this->wpml_active) {
      return $value;
    }

    $has_translation = apply_filters('wpml_element_has_translations', null, $menu_id, 'nav_menu');

    if (!$has_translation) {
      global $sitepress;

      // switch to the default language to pull the nav
      $sitepress->switch_lang($this->default_lang);

      $value = wp_get_nav_menu_items($menu_id);

      // switch back to the current language
      $sitepress->switch_lang($this->current_lang);
    }

    return $value;
  }
}
