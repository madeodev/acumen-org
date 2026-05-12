<?php

namespace App\Concerns;

class CreatesLabels
{
    public function __invoke($singular, $plural = null)
    {
        $plural = $plural ?: $singular;

        return [
        "name"                     => _x("{$plural}", "post type general name"),
        "singular_name"            => _x("{$singular}", "post type singular name"),
        "menu_name"                => _x("{$plural}", "post type general name"),
        "add_new"                  => _x("Add New", "{$singular}"),
        "add_new_item"             => __("Add New {$singular}"),
        "edit_item"                => __("Edit {$singular}"),
        "new_item"                 => __("New {$singular}"),
        "view_item"                => __("View {$singular}"),
        "view_items"               => __("View {$plural}"),
        "search_items"             => __("Search {$plural}"),
        "not_found"                => __("No {$plural} found."),
        "no_terms"                => __("No {$plural}"),
        "not_found_in_trash"       => __("No {$plural} found in Trash."),
        "parent_item"              => __("Parent {$singular}"),
        "parent_item_colon"        => __("Parent {$singular}:"),
        "all_items"                => __("All {$plural}"),
        "archives"                 => __("{$singular} Archives"),
        "attributes"               => __("{$singular} Attributes"),
        "insert_into_item"         => __("Insert into {$singular}"),
        "uploaded_to_this_item"    => __("Uploaded to this {$singular}"),
        "featured_image"           => _x("Featured image", "{$singular}"),
        "set_featured_image"       => _x("Set featured image", "{$singular}"),
        "remove_featured_image"    => _x("Remove featured image", "{$singular}"),
        "use_featured_image"       => _x("Use as featured image", "{$singular}"),
        "filter_items_list"        => __("Filter {$plural} list"),
        "items_list_navigation"    => __("{$plural} list navigation"),
        "items_list"               => __("{$plural} list"),
        "item_published"           => __("{$singular} published."),
        "item_published_privately" => __("{$singular} published privately."),
        "item_reverted_to_draft"   => __("{$singular} reverted to draft."),
        "item_scheduled"           => __("{$singular} scheduled."),
        "item_updated"             => __("{$singular} updated."),
        "update_item"              => __("Update {$singular}"),
        "new_item_name"            => __("New {$singular} Name"),
        "item_link"                => __("{$singular} Link"),
        "item_link_description"    => __("A link to a {$singular}."),
        "label"                    => __("{$singular}"),
        "name_admin_bar"           => __("{$singular}"),
        ];
    }
}
