<?php

namespace App\Http\Requests;

use App\Services\Wikipedia;
use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Http\FormRequest;

class WikipediaContentRequest extends FormRequest
{
  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'page' => 'required'
    ];
  }

  /**
   * Get wikipedia content.
   *
   * @return JsonResponse
   */
  public function content()
  {
    return Wikipedia::content($this->page);
  }
}
