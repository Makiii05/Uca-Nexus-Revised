<?php

namespace App\Http\Requests\Prospectus;

use App\Enums\Status;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProspectusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'curriculum_id' => ['required', 'exists:curricula,id'],
            'level_id' => ['required', 'exists:levels,id'],
            'term_id' => ['required', 'exists:academic_terms,id'],
            'subject_id' => [
                'required',
                'exists:subjects,id',
                Rule::unique('prospectuses')
                    ->ignore($this->route('prospectus'))
                    ->where(function ($query) {
                        return $query->where('curriculum_id', $this->curriculum_id)
                            ->where('level_id', $this->level_id)
                            ->where('term_id', $this->term_id)
                            ->where('subject_id', $this->subject_id);
                    }),
            ],
            'status' => ['required', Rule::enum(Status::class)],
        ];
    }

    public function messages(): array
    {
        return [
            'subject_id.unique' => 'This subject is already assigned to this curriculum, level, and term.',
        ];
    }
}
