<?php


namespace App\Services\ElasticSearchMigrations;


class PostsMigration extends ESMigration
{
    /**
     * 索引名
     * @var string
     */
    public $index = 'posts';

    /**
     * mapping 设置
     * @return array
     */
    public function mappings(): array
    {
        return [
            'properties' => [
                'title'        => [
                    'type'     => 'text',
                    'analyzer' => 'ik_smart',
                    'fields'   => [
                        "keyword" => ["type" => "keyword"]
                    ]
                ],
                'slug'         => [
                    'type' => 'keyword',
                ],
                'cover'        => [
                    'type'  => 'keyword',
                    'index' => false,
                ],
                'content'      => [
                    'type'     => 'text',
                    'analyzer' => 'ik_smart',
                    'fields'   => [
                        'outline' => [
                            'type'     => 'text',
                            'analyzer' => 'ik_smart'
                        ]
                    ]
                ],
                'category'     => [
                    'type'       => 'object',
                    'properties' => [
                        'id'   => ['type' => 'integer'],
                        'name' => ['type' => 'keyword']
                    ]
                ],
                'is_published' => [
                    'type' => 'boolean'
                ],
                'published_at' => [
                    'type' => 'date'
                ],
                'created_at'   => [
                    'type' => 'date'
                ],
                'updated_at'   => [
                    'type' => 'date'
                ]
            ]
        ];
    }
}
