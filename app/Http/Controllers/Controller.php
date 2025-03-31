<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    //Getting principal and financial manager accesses
    public function getFilteredAccessesPF($userAccessInfo): array
    {
        $principalAccess = [];
        $financialManagerAccess = [];

        if (!empty($userAccessInfo->principal)) {
            $principalAccess = explode('|', $userAccessInfo->principal);
        }

        if (!empty($userAccessInfo->financial_manager)) {
            $financialManagerAccess = explode('|', $userAccessInfo->financial_manager);
        }

        return array_filter(array_unique(array_merge($principalAccess, $financialManagerAccess)));
    }
}
