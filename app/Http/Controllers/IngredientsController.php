<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class IngredientsController
{
    public function index(): Response
    {
        return Inertia::render('Ingredients');
    }
}
