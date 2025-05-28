<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class GroupPermissions
{
    public function permission()
    {
        $results = DB::table('permissions')
            ->select('id', 'name')
            ->orderBy('id')
            ->get()
            ->pluck('name')
            ->toArray();

        $permissions = collect($results)
            ->groupBy(function ($item) {
                $words = explode(' ', $item);
                return end($words);
            })
            ->map(function ($group) {
                return $group->toArray();
            })
            ->toArray();
        
        return $permissions;
    }

}