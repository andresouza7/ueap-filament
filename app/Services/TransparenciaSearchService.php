<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;

function getModels() {
    return [
        \App\Models\User::class => [
            'label' => 'Servidores',
            // 'url' => 'filament.portalTransparencia.pages.record',
            'columns' => ['login', 'email'],
            'relationships' => [
                'person' => ['name']
            ]
        ],
        \App\Models\Document::class => [
            'label' => 'Documentos',
            // 'url' => 'filament.portalTransparencia.pages.document',
            'columns' => ['title', 'description'],
            'custom_query' => function ($query) {
                return $query->whereHas('category', function($query) {
                    $query->where('type', 'transparency');
                });
            },
            'relationships' => [
                'category' => ['name'], 
            ],
        ],
    ];
}

class TransparenciaSearchService
{
    public function search(string $query)
    {
        $results = [];

        foreach (getModels() as $model => $config) {
            $modelInstance = new $model;
            $queryBuilder = $modelInstance->newQuery();

            // **Search in specified columns**
            $queryBuilder->where(function ($q) use ($config, $query) {
                foreach ($config['columns'] as $column) {
                    $q->orWhere($column, 'ILIKE', "%{$query}%");
                }
            });

            // **Apply custom query logic**
            if (!empty($config['custom_query']) && is_callable($config['custom_query'])) {
                $queryBuilder = $config['custom_query']($queryBuilder);
            }

            // **Search in related models**
            if (!empty($config['relationships'])) {
                foreach ($config['relationships'] as $relation => $columns) {
                    $queryBuilder->orWhereHas($relation, function (Builder $q) use ($columns, $query) {
                        $q->where(function ($q2) use ($columns, $query) {
                            foreach ($columns as $column) {
                                $q2->orWhere($column, 'ILIKE', "%{$query}%");
                            }
                        });
                    });
                }
            }

            // **Fetch results and format the response**
            $records = $queryBuilder->get()->map(function ($record) use ($config) {
                // Collect main model's columns
                $columns = collect($config['columns'])->mapWithKeys(fn($column) => [$column => $record->{$column}])->toArray();
            
                // Collect related model's columns
                if (!empty($config['relationships'])) {
                    foreach ($config['relationships'] as $relation => $relColumns) {
                        if ($record->{$relation}) { // Check if relationship exists
                            foreach ($relColumns as $relColumn) {
                                $columns["{$relation}.{$relColumn}"] = $record->{$relation}->{$relColumn} ?? null;
                            }
                        }
                    }
                }
            
                return [
                    'label' => $config['label'],
                    'columns' => $columns,
                    // 'url' => !empty($config['url']) ? route($config['url'], ['id' => $record->id]) : null,
                ];
            });
            
            // **Only return non-empty results**
            if ($records->isNotEmpty()) {
                $results[$modelInstance->getTable()] = $records;
            }
        }

        return $results;
    }
}
