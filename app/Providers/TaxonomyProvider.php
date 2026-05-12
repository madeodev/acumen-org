<?php

namespace App\Providers;

use App\Taxonomies\BlogTypeTaxonomy;
use App\Taxonomies\CaseStudyTypeTaxonomy;
use App\Taxonomies\CompanyStatusTaxonomy;
use App\Taxonomies\FellowshipTaxonomy;
use App\Taxonomies\MediaFormatTaxonomy;
use App\Taxonomies\NewsTypeTaxonomy;
use App\Taxonomies\OfficeTaxonomy;
use App\Taxonomies\ProblemTaxonomy;
use App\Taxonomies\ProgramTypeTaxonomy;
use App\Taxonomies\RegionTaxonomy;
use App\Taxonomies\ReportTypeTaxonomy;
use App\Taxonomies\TeamFunctionTaxonomy;
use App\Taxonomies\TeamTypeTaxonomy;
use App\Taxonomies\YearTaxonomy;
use App\Taxonomies\AuthorTaxonomy;
use Illuminate\Support\ServiceProvider;

class TaxonomyProvider extends ServiceProvider
{
    protected $taxonomies = [
        BlogTypeTaxonomy::class,
        CaseStudyTypeTaxonomy::class,
        CompanyStatusTaxonomy::class,
        FellowshipTaxonomy::class,
        NewsTypeTaxonomy::class,
        OfficeTaxonomy::class,
        ProblemTaxonomy::class,
        ProgramTypeTaxonomy::class,
        RegionTaxonomy::class,
        ReportTypeTaxonomy::class,
        TeamFunctionTaxonomy::class,
        TeamTypeTaxonomy::class,
        YearTaxonomy::class,
        AuthorTaxonomy::class,
        MediaFormatTaxonomy::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        add_action('init', [&$this, 'registerTaxonomies']);
    }

    /**
     * Register taxonomies
     *
     * @return void
     */
    public function registerTaxonomies()
    {
        collect($this->taxonomies)->each(function ($className) {
            $instance = $this->app->make($className);
            $this->app->singleton($className, function () use ($instance) {
                return $instance;
            });
        });
    }
}
