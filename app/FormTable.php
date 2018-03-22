<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;

class FormTable
{
    /** @var array */
    private $headers = [];

    /** @var array */
    private $data;

    public function __construct(Collection $forms)
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

    private function parseTable(Collection $forms): void
    {
        $this->headers = $this->parseHeaders($forms);

        $this->data = $this->parseData($forms);
    }

    private function parseHeaders(Collection $forms): array
    {
        $headers = ['date'];

        /** @var \App\Form $form */
        foreach ($forms as $form) {
            $headers = array_merge(
                $headers,
                array_keys($form->data ?? [])
            );
        }

        $headers = array_unique($headers);

        return $headers;
    }

    private function parseData(Collection $forms): array
    {
        $data = [];

        /** @var \App\Form $form */
        foreach ($forms as $form) {
            $row = [];

            foreach ($this->headers as $header) {
                $row[$header] = $form->data[$header] ?? null;
            }

            $row['date'] = optional($form->created_at)->format('Y-m-d H:i');

            $data[] = $row;
        }

        return $data;
    }
}
