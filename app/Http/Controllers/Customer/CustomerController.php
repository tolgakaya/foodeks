<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function index()
    {
        return 'This is customer controller';
    }

    public function create()
    {
        return 'This is customer controller create method';
    }
}