<?php
namespace App\Responses;

use Phalcon\Http\Response;

class JsonResponse extends Response
{
    /**
     * @param array $data
     *
     */
    public function json($data = [])
    {
        $this->setContentType('application/json', 'UTF-8');
        if (!is_array($data)) {
            return 0;
        }

        return $this->setContent(json_encode($data, JSON_NUMERIC_CHECK));

    }

    /**
     * @param array $data
     * @param array $header
     * @return Response
     */
    public function make($data = [], $header = [])
    {
        $mimeTypeRaw = $this->getHeaders($header)->get('Content-Type');
        // If its empty or has */* then default to JSON
        if ($mimeTypeRaw === '*/*' || !$mimeTypeRaw) {
            $mimeType = 'application/json';
        } else {
            // You'll probably want to do something intelligent with charset if provided
            $mimeParts = (array) explode(';', $mimeTypeRaw);
            $mimeType = strtolower($mimeParts[0]);
        }
        switch ($mimeType) {
            case 'application/json':
                $contentType = 'application/json';
                $content = json_encode($data);
                break;
            case 'application/x-yaml':
                $contentType = 'application/x-yaml';
                break;
            default:
                $contentType = 'application/json';

        }
        $this->setContentType($contentType, 'UTF-8');
        return $this->setContent($content);
    }
}
