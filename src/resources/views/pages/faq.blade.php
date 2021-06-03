@extends('layouts.app')

@section('title', "Frequently Asked Questions")

@include('partials.breadcrumb', ['pages' => ["Frequently Asked Questions" => ""], 'withoutMargin' => false])

<h1 class="content-general-margin mb-4">Frequently Asked Questions</h1>
<div class="accordion content-general-margin margin-to-footer" id="accordionExample">
    @php $i = 0; @endphp
    @foreach($frequentlyAskedQuestions as $idx => $frequentlyAskedQuestion)
        @include('partials.faq', ['id' => $i++, 'question' => $frequentlyAskedQuestion->question, 'answer' => $frequentlyAskedQuestion->answer])
    @endforeach
</div>

