<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AcfProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        add_filter( 'relevanssi_content_to_index', [&$this, 'indexPdfsWithPostContent'], 10, 2 );
        add_filter( 'relevanssi_excerpt_content', [&$this, 'indexPdfsWithPostContent'], 10, 2 );
    }

    /**
     * Add files associated with a post to the search index
     */
    public function indexPdfsWithPostContent( $content, $post ) {

        foreach (['button_file', 'report_file'] as $field) {
            $file = get_field( $field, $post->ID );
            if( empty($file['ID']) ) continue;
            $content .= ' ' . get_post_meta( $file['ID'], '_relevanssi_pdf_content', true );
        }
       
        return $content;
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
