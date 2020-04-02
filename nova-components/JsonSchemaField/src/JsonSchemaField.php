<?php

declare(strict_types=1);

namespace MartinJuul\JsonSchemaField;

use Laravel\Nova\Fields\Code;

class JsonSchemaField extends Code
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'json-schema-field';

    public function __construct(string $name, array $schema, $attribute = null, $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);
        $this->json(JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        $this->loadSchema($schema);
        $this->displayUsing(function ($value) {
            return optional($value)->toArray();
        });
    }

    public function listClass(string $listClass = ''): JsonSchemaField
    {
        return $this->options(compact('listClass'));
    }

    public function loadSchema(array $schema = []): JsonSchemaField
    {
        return $this->options(compact('schema'));
    }
}
