<?php

namespace App\DataTables;

use App\Http\Controllers\Controller;
use App\Models\User;

class UsersDataTable extends Controller
{
    public function get($request)
    {
        $query = new User();
        if (isset($request->dob)) {
            $query = $query->where('dob', $request->dob);
        }
        if (isset($request->gender)) {
            $query = $query->where('gender', $request->gender);
        }
        if (isset($request->family_type)) {
            $query = $query->where('family_type', $request->family_type);
        }
        if (isset($request->manglik)) {
            $query = $query->where('manglik', $request->manglik);
        }
        if (isset($request->income_from) && isset($request->income_to) && $request->income_from > 0 && $request->income_to > 0)  {
            $query = $query->whereBetween('income', [$request->income_from, $request->income_to]);
        }
        $query = $query->where('type', 0);
        return $query;
    }
}
