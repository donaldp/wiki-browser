<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;

class Wikipedia
{
  /**
   * Search query or url page.
   *
   * @var string
   */
  protected $value;

  /**
   * Search type.
   *
   * @var string
   */
  protected $type;

  /**
   * Find wikipedia results.
   *
   * @param string $value
   */
  public function __construct(string $value, string $type)
  {
    $this->value = urlencode($value);
    $this->type  = $type;
  }

  /**
   * Persist request.
   *
   * @return JsonResponse
   */
  private function persist()
  {
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => config("services.wikipedia.{$this->type}") . $this->value,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
      ),
    ));

    $response = curl_exec($curl);
    $error = curl_error($curl);

    curl_close($curl);

    if ($error) {
      return ['data' => null, 'code' => 422];
    }

    return [
      'data' => json_decode($response),
      'code' => 200
    ];
  }

  /**
   * Return wikipedia response.
   *
   * @return JsonResponse
   */
  private function response()
  {
    return $this->persist();
  }

  /**
   * Find results.
   *
   * @param string $query
   * @return 
   */
  public static function search(string $query, array $build = [])
  {
    $response = (new self($query, 'search'))->response();

    if ($response['data'] && count($response['data']) == 4) {
      $titles = $response['data'][1];
      $urls   = $response['data'][3];

      return array_map(function($key) use ($titles, $urls) {
        $page = substr($urls[$key], strrpos($urls[$key], '/') + 1);

        return $build = [
          'title' => $titles[$key],
          'url' => $urls[$key],
          'summary' => Wikipedia::getSummary($page),
          'page' => $page
        ];
      }, array_keys($titles), $build);
    }

    return ['empty'];
  }

  /**
   * Get article summary.
   *
   * @param string $page
   * @return string
   */
  public static function getSummary(string $page)
  {
    $response = (new self($page, 'summary'))->response();

    if ($response['data'] && isset($response['data']->extract_html)) {
      return $response['data']->extract_html;
    }

    return '';
  }

  /**
   * Get content.
   *
   * @param string $page
   * @return string
   */
  public static function content(string $page)
  {
    $response = (new self($page, 'content'))->response();

    if ($response['data']) {
      return array_values((Array)$response['data']->query->pages)[0]->extract;
    }

    return '';
  }
}
