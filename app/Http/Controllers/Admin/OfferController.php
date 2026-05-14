<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function index()
    {
        $offers = collect([]);
        return view('admin.offers.index', compact('offers'));
    }
}
