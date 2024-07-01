<?php

namespace App\Http\Controllers\Client;

use App\Models\FaqContent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FaqClientController extends Controller
{
    public function getFaq()
    {
        $data = FaqContent::join('faq_categories', 'faq_categories.id', '=', 'faq_contents.category_id')
        ->select([
            'faq_contents.id',
            'faq_contents.title',
            'faq_contents.description',
            'faq_categories.name'
        ])
        ->get();

        return response()->json([
            "success" => true,
            "message" => "faq",
            "data" => $data,
        ], 200);
    }
}
