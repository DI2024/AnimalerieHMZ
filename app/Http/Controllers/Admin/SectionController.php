<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index()
    {
        $sections = collect([]);
        return view('admin.sections.index', compact('sections'));
    }
}
