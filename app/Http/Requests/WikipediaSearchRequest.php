<?php

namespace App\Http\Requests;

use App\Services\Wikipedia;
use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Http\FormRequest;

class WikipediaSearchRequest extends FormRequest
{
  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'search' => 'required'
    ];
  }

  /**
   * Persist search.
   *
   * @return JsonResponse
   */
  public function search()
  {
    return Wikipedia::search($this->search);
  }
}
