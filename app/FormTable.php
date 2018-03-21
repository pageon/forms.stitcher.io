<?php

namespace App;

class FormTable
{
    /** @var array */
    private $headers = [];

    /** @var array */
    private $data;

    public function __construct(array $forms)
    {
        $this->parseTable($forms);
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function getData(): array
    {
        return $this->data;
    }

    private function parseTable(array $forms): void
    {
        $this->headers = $this->parseHeaders($forms);

        $this->data = $this->parseData($forms);
    }

    private function parseHeaders(array $forms): array
    {
        $headers = [];

        foreach ($forms as $form) {
            $headers = array_merge(
                $headers,
                array_keys($form['data'] ?? [])
            );
        }

        $headers = array_unique($headers);

        return $headers;
    }

    private function parseData(array $forms): array
    {
        $data = [];

        foreach ($forms as $form) {
            $row = [];

            foreach ($this->headers as $header) {
                $row[$header] = $form['data'][$header] ?? null;
            }

            $data[] = $row;
        }

        return $data;
    }
}
