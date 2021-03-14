<?php


namespace App\Services\ElasticSearchMigrations;


use Elasticsearch\Client;

abstract class ESMigration
{
    public $index = '';
    /**
     * @var Client
     */
    protected $client;

    /**
     * 默认情况下使用注册服务中的 es 客户端
     * ESMigration constructor.
     * @param Client|null $client
     */
    public function __construct(Client $client = null)
    {
        $this->client = $client ?? app('es');
    }

    /**
     * 获取 es 客户端
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * 创建索引
     * @return bool
     */
    public function create()
    {
        $params = [
            'index' => $this->index,
            'body'  => [
                'mappings' => $this->mappings()
            ]
        ];

        $response = $this->getClient()->indices()->create($params);
        return $response['acknowledged'];
    }

    public function delete()
    {
        $response = $this->getClient()->indices()->delete(['index' => $this->index]);
        return $response['acknowledged'];
    }

    /**
     * @return array
     */
    abstract public function mappings(): array;
}
