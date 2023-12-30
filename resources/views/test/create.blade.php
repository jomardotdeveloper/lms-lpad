@extends('layouts.master')
@section('title', 'Create Exam')

@section('content')
@include('includes.breadcrumb', ['breadcrumbs' => [
    ['name' => 'Classroom', 'link' => route('classrooms.index')],
    ['name' => $classroom->name, 'link' => route('classrooms.show', $classroom)],
    ['name' => 'Create Exam']
]])
@include('includes.alert-error')
@include('includes.alert-success')

<div class="nk-block nk-block-lg">
    @include('includes.title', ['title' => 'Exam Form', 'subtitle' => 'New', 'subtitleCode' => 'Record'])
    <button class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#questionModal">Add Question</button>
    <div class="card card-bordered card-preview">
        <div class="card-inner">

            <div class="preview-block">
                <span class="preview-title-lg overline-title">Form</span>
                <form action="{{ route('tests.store') }}" class="row gy-4" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="classroom_id" value="{{ $classroom->id }}">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="name">Name</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" required/>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="description">Description</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="description" placeholder="Enter description" name="description" required/>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-12">
                        <table class="table table-bordered" id="questionsTable">
                            <thead>
                                <tr>
                                    <th scope="col">Question Type</th>
                                    <th scope="col">Question</th>
                                    <th scope="col">Choices</th>
                                    <th scope="col">Answer</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-sm-12">
                        <input type="submit" value="Save" class="btn btn-primary" />
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

@include('test.question-modal')

@endsection

@push('scripts')
<script>
    var typeElement = document.getElementById('type');
    var questionElement = document.getElementById('question');
    var choiceAElement = document.getElementById('choiceAInput');
    var choiceBElement = document.getElementById('choiceBInput');
    var choiceCElement = document.getElementById('choiceCInput');
    var choiceDElement = document.getElementById('choiceDInput');
    var trueOrFalseAnswerElement = document.getElementById('trueOrFalseAnswer');
    var multipleChoiceAnswerElement = document.getElementById('multipleChoiceAnswer');
    var identificationAnswerElement = document.getElementById('identificationAnswer');


    // COLUMNS ELEMENTS
    var choiceAColElement = document.getElementById('choiceACol');
    var choiceBColElement = document.getElementById('choiceBCol');
    var choiceCColElement = document.getElementById('choiceCCol');
    var choiceDColElement = document.getElementById('choiceDCol');
    var trueOrFalseColAnswerElement = document.getElementById('trueOrFalseColAnswer');
    var multipleChoiceColAnswerElement = document.getElementById('multipleChoiceColAnswer');
    var identificationColAnswerElement = document.getElementById('identificationColAnswer');

    // ELEMENTS FOR ADDING SOMETHING IN THE TABLE

    var btnAddQuestionElement = document.getElementById('btnAddQuestion');
    var tableQuestionsElement = document.getElementById('questionsTable');


    typeElement.addEventListener('change', function() {
        var type = this.value;

        if (type == 'multiple_choice') {
            choiceAColElement.classList.remove('d-none');
            choiceBColElement.classList.remove('d-none');
            choiceCColElement.classList.remove('d-none');
            choiceDColElement.classList.remove('d-none');
            trueOrFalseColAnswerElement.classList.add('d-none');
            multipleChoiceColAnswerElement.classList.remove('d-none');
            identificationColAnswerElement.classList.add('d-none');
        } else if (type == 'true_false') {
            choiceAColElement.classList.add('d-none');
            choiceBColElement.classList.add('d-none');
            choiceCColElement.classList.add('d-none');
            choiceDColElement.classList.add('d-none');
            trueOrFalseColAnswerElement.classList.remove('d-none');
            multipleChoiceColAnswerElement.classList.add('d-none');
            identificationColAnswerElement.classList.add('d-none');
        } else if (type == 'identification') {
            choiceAColElement.classList.add('d-none');
            choiceBColElement.classList.add('d-none');
            choiceCColElement.classList.add('d-none');
            choiceDColElement.classList.add('d-none');
            trueOrFalseColAnswerElement.classList.add('d-none');
            multipleChoiceColAnswerElement.classList.add('d-none');
            identificationColAnswerElement.classList.remove('d-none');
        }
    });

    function addQuestion() {



        var type = typeElement.value;
        var question = questionElement.value;
        var choiceA = choiceAElement.value;
        var choiceB = choiceBElement.value;
        var choiceC = choiceCElement.value;
        var choiceD = choiceDElement.value;
        var trueOrFalseAnswer = trueOrFalseAnswerElement.value;
        var multipleChoiceAnswer = multipleChoiceAnswerElement.value;
        var identificationAnswer = identificationAnswerElement.value;


        var questionHidden = getHiddenElements('questions[]', question);
        var typeHidden = getHiddenElements('types[]', type);
        var choiceAHidden = getHiddenElements('choiceAs[]', choiceA);
        var choiceBHidden = getHiddenElements('choiceBs[]', choiceB);
        var choiceCHidden = getHiddenElements('choiceCs[]', choiceC);
        var choiceDHidden = getHiddenElements('choiceDs[]', choiceD);
        var answerHidden = null;
        // var choicesHidden

        if (type == 'multiple_choice') {
            var realAnswer = "";

            if (multipleChoiceAnswer == 'A') {
                realAnswer = choiceA;
            } else if (multipleChoiceAnswer == 'B') {
                realAnswer = choiceB;
            } else if (multipleChoiceAnswer == 'C') {
                realAnswer = choiceC;
            } else if (multipleChoiceAnswer == 'D') {
                realAnswer = choiceD;
            }

            answerHidden = getHiddenElements('answers[]', realAnswer);
        } else if (type == 'true_false') {
            answerHidden = getHiddenElements('answers[]', trueOrFalseAnswer);
        } else if (type == 'identification') {
            answerHidden = getHiddenElements('answers[]', identificationAnswer);
        }

        if (type == 'multiple_choice') {
            if (choiceA == '' || choiceB == '' || choiceC == '' || choiceD == '') {
                alert('Please fill up all the choices');
                return;
            }
        } else if (type == 'true_false') {
            if (trueOrFalseAnswer == '') {
                alert('Please fill up the answer');
                return;
            }
        } else if (type == 'identification') {
            if (identificationAnswer == '') {
                alert('Please fill up the answer');
                return;
            }
        }
        var details2 = "N/A";

        if (type == 'multiple_choice') {
            details = choiceA + ',' + choiceB + ',' + choiceC + ',' + choiceD;
        }

        var html = '<tr><td>' + type + '</td><td>' + question + '</td><td>';
        html+= details2 + '</td><td>';

        if (type == 'multiple_choice') {
            html += '<ul><li>' + choiceA + '</li><li>' + choiceB + '</li><li>' + choiceC + '</li><li>' + choiceD + '</li></ul>';
        } else if (type == 'true_false') {
            html += trueOrFalseAnswer;
        } else if (type == 'identification') {
            html += identificationAnswer;
        }

        html += '</td><td><a href="javascript:void(0);" onclick="deleteQuestion(this)">Delete</a></td>';

        html += questionHidden + typeHidden + choiceAHidden + choiceBHidden + choiceCHidden + choiceDHidden + answerHidden + '</tr>';

        tableQuestionsElement.innerHTML += html;
        emptyValues();
    }



    function deleteQuestion(row) {
        var i = row.parentNode.parentNode.rowIndex;
        document.getElementById("questionsTable").deleteRow(i);
    }

    function emptyValues() {
        questionElement.value = '';
        choiceAElement.value = '';
        choiceBElement.value = '';
        choiceCElement.value = '';
        choiceDElement.value = '';
        trueOrFalseAnswerElement.value = '';
        multipleChoiceAnswerElement.value = '';
        identificationAnswerElement.value = '';
    }

    function getHiddenElements(name, value) {
        return '<input type="hidden" name="' + name + '" value="' + value + '">';
    }

    btnAddQuestionElement.addEventListener('click', function() {
        addQuestion();
    });




</script>
@endpush
