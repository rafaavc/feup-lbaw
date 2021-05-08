<?php

namespace App\Http\Controllers;

use App\Models\Faq;

class FaqController extends Controller
{
    public function view() {
        $frequentlyAskedQuestions = Faq::all();

        return view('pages.faq', [
            'frequentlyAskedQuestions' => $frequentlyAskedQuestions,
        ]);
    }
}
