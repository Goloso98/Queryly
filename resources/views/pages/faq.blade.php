@extends('layouts.app')

@section('content')
  <head>
    <title>FAQ</title>
  </head>
  <body>
    <h1>FAQ</h1>
    <p>Welcome to our FAQ page! Here you can find answers to common questions about our company and our products or services.</p>
    <h2> </h2>
    <p> </p>

    <!--<div class="accordion" id="accordionFAQ1">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    How can I ask a question?
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    Click in the 'Post Question' button. Write a title and below the question you
                    want you want to ask. Optionally you can add a tag that best suits your question.
                </div>
            </div>
        </div>
    </div>-->
 
    <button class="accordion accordion-collapse" id="accordion-1">How can I ask a question?</button>
    <div class="panel">
        Click in the 'Post Question' button. Write a title and below the question you
        want you want to ask. Optionally you can add a tag that best suits your question.
    </div>

    <button class="accordion accordion-collapse" id="accordion-2">How do I add an answer or a question?</button>
    <div class="panel">
      By clicking on the button add comment/post answer write what you desire in the box.
    </div>

    <button class="accordion accordion-collapse" id="accordion-3">How do I use tags to classify my question?</button>
    <div class="panel">
      While posting a question you can add the adquated tags.
      After posting the question you can edit your question and add the tags you desire.
    </div>

    <button class="accordion accordion-collapse" id="accordion-4">How do I search for an existing question or answer?</button>
    <div class="panel">
      In the homepage you can use the searchbar to search existing questions.
    </div>

    <button class="accordion accordion-collapse" id="accordion-5">How do I star a post or a question?</button>
    <div class="panel">
      Press the star next to a post or a question.
    </div>

    <button class="accordion accordion-collapse" id="accordion-6">How do I earn reputation points and badges?</button>
    <div class="panel">
      By completing certain milestones while using Queryly.
    </div>

    <!--<button class="accordion accordion-collapse" id="accordion-7">How do I become a moderator?</button>
    <div class="panel">
      <!\-- Accordion 1 content goes here -\->
      Coisas
    </div>
    -->

  </body>
@endsection