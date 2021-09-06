<?php

  declare(strict_types=1);

  return [
    /*
    |--------------------------------------------------------------------------
    | Global Route Prefix
    |--------------------------------------------------------------------------
    |
    | This option allows to modify the prefix used by all the chart routes.
    | It will be applied to each and every chart created by the library. This
    | option comes with the default value of: 'api/chart'. You can still define
    | a specific route prefix to each individual chart that will be applied after this.
    |
    */
      'global_route_prefix'      => 'api/chart',

    /*
    |--------------------------------------------------------------------------
    | Global Middlewares.
    |--------------------------------------------------------------------------
    |
    | This option allows to apply a list of middlewares to each and every
    | chart created. This is commonly used if all your charts share some
    | logic. For example, you might have all your charts under authentication
    | middleware. If that's the case, applying a global middleware is a good
    | choice rather than applying it individually to each chart.
    |
    */
      'global_middlewares'       => ['web'],

    /*
    |--------------------------------------------------------------------------
    | Global Route Name Prefix
    |--------------------------------------------------------------------------
    |
    | This option allows to modify the prefix used by all the chart route names.
    | This is mostly used if there's the need to modify the route names that are
    | binded to the charts.
    |
    */
      'global_route_name_prefix' => 'charts',
  ];
