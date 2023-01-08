<?php

namespace App\Http\Requests\Api\v1\Questions;

use App\Core\Resources\Questions\v1\Services\SaveQuestionsService;
use App\Rules\Api\v1\Questions\IsRequiredTypeTestOfQuestion;
use App\Rules\Api\v1\Questions\IsThereShouldBeNoMoreThan1GroupingAnswer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UpdateQuestionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'is-test' => $this->get('is-test') === 'true',
            'is-card-memory' => $this->get('is-card-memory') === 'true',
            'is-visible' => $this->get('is-visible') === 'true',
            'is-grouper-answer-correct' => $this->get('is-grouper-answer-correct') === 'true',
            'is-grouper-answer-one' => $this->get('is-grouper-answer-one') === 'true',
            'is-grouper-answer-two' => $this->get('is-grouper-answer-two') === 'true',
            'is-grouper-answer-three' => $this->get('is-grouper-answer-three') === 'true',
        ]);
    }

    public function rules(): array
    {

        $isThereShouldBeNoMoreThan1GroupAnswer = collect([
                [
                    'is-grouper' => (bool) $this->get('is-grouper-answer-correct')
                ],
                [
                    'is-grouper' => (bool) $this->get('is-grouper-answer-one')
                ],
                [
                    'is-grouper' => (bool) $this->get('is-grouper-answer-two')
                ],
                [
                    'is-grouper' => (bool) $this->get('is-grouper-answer-three')
                ],
            ])->where('is-grouper', true)
                ->count() <= 1;

        return [
            'question-text' => ['required', 'max:255', new IsThereShouldBeNoMoreThan1GroupingAnswer($isThereShouldBeNoMoreThan1GroupAnswer)],
            'is-test' => ['required', 'boolean', new IsRequiredTypeTestOfQuestion(
                "Test", "Tarjeta de memoria", $this->get('is-card-memory')
            )],
            'is-card-memory' => ['required', 'boolean', new IsRequiredTypeTestOfQuestion(
                "Tarjeta de memoria", "Test", $this->get('is-test')
            )],
            'is-visible' => ['required', 'boolean'],

            'answer-correct-id' => ['required', 'uuid', 'exists:answers,id'],
            'answer-correct' => ['required', 'max:255'],
            'is-grouper-answer-correct' => ['required', 'boolean'],

            'answer-one-id' => ['required', 'uuid', 'exists:answers,id'],
            'answer-one' => ['required', 'max:255'],
            'is-grouper-answer-one' => ['required', 'boolean'],

            'answer-two-id' => ['required', 'uuid', 'exists:answers,id'],
            'answer-two' => ['required', 'max:255'],
            'is-grouper-answer-two' => ['required', 'boolean'],

            'answer-three-id' => ['required', 'uuid', 'exists:answers,id'],
            'answer-three' => ['required', 'max:255'],
            'is-grouper-answer-three' => ['required', 'boolean'],

            'reason-question' => [
                'nullable',
                Rule::when(
                    (bool) $this->get('is-card-memory') &&
                    (bool) SaveQuestionsService::validateImageWithFails($this->file('file-reason'))->fails()
                    && (bool) !$this->route('question')->image
                    , [
                    'required', 'max:400'
                ])
            ],
            'file-reason' => [
                'nullable',
                Rule::when((bool) $this->get('is-card-memory') && (bool) !$this->get('reason-question') && (bool) !$this->route('question')->image, [
                    'required', 'file', 'image', 'mimes:jpeg,jpg,png,gif', 'max:10000'
                ])
            ]
        ];
    }

    public function messages(): array {
        return [
            //
        ];
    }

    public function attributes():array
    {
        // Este metodo remplaza cada índice que es mostrado en el error
        return [
            //'email' => 'Correo Electrónico',
        ];
    }
}
