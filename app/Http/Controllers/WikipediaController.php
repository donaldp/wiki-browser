<?php

namespace App\Http\Controllers;

use App\Http\Requests\WikipediaContentRequest;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\WikipediaSearchRequest;

class WikipediaController extends Controller
{
  /**
   * Search wikipedia.
   *
   * @param WikipediaSearchRequest $request
   * @return JsonResponse
   */
  public function search(WikipediaSearchRequest $request)
  {
    return response()->json(['results' => $request->search()]);
  }

  /**
   * Get wikipedia page content.
   *
   * @param WikipediaContentRequest
   * @return JsonResponse
   */
  public function content(WikipediaContentRequest $request)
  {
    return response()->json(['results' => $request->content()]);
  }
}
