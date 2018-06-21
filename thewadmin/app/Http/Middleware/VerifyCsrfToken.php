<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        "instant-cash/success",
        "instant-cash/failure",
        "product/failure",
        "product/aftertrans",
        "orders/table_list",
        "orders/get_order_data",
    ];
}
