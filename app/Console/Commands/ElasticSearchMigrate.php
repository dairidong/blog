<?php

namespace App\Console\Commands;

use App\Services\ElasticSearch\Migrations\ESMigration;
use App\Services\ElasticSearch\Migrations\PostsMigration;
use Elasticsearch\Client;
use Illuminate\Console\Command;

class ElasticSearchMigrate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'es:migrate {--indices=} {--action=create}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ElasticSearch Migration';

    protected $indices = [
        'posts' => PostsMigration::class
    ];

    /**
     * 开放给 command 的 action
     * @var string[]
     */
    protected $actions = [
        'create', 'delete', 'refresh'
    ];

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $indices = $this->getIndices();
        $migrations = $this->getMigrationClass($indices);
        $action = $this->checkAction();

        foreach ($migrations as $migration) {
            if ($migration instanceof ESMigration) {
                $result = $this->$action($migration);
                if ($result) {
                    $this->info("Index {$migration->index} {$action}. done!");
                } else {
                    $this->error("Index {$migration->index} {$action}. failed!");
                }
            }
        }
    }

    /**
     * 解析索引参数
     * @return false|string[]
     */
    protected function getIndices()
    {
        $option = $this->option('indices');
        if (empty($option)) {
            $this->error('Indices can not be null');
            exit();
        }

        return array_unique(explode(',', $option));
    }

    /**
     * @param string[] $indices
     * @return ESMigration[]
     */
    protected function getMigrationClass(array $indices)
    {
        $migrations = [];
        foreach ($indices as $index) {
            $migration = $this->indices[$index];
            if ($migration) {
                $migrations[] = new $migration;
            } else {
                $this->warn("No migration class name {$index} exist!");
            }
        }

        return $migrations;
    }

    /**
     * 获取 action
     * @return array|bool|string|null
     */
    protected function checkAction()
    {
        $action = $this->option('action');
        if (!in_array($action, $this->actions)) {
            $this->error('Unknown Action: ' . $action);
            exit();
        }
        return $action;
    }

    /**
     * 获取 ES 客户端
     * @return Client
     */
    protected function getClient()
    {
        return app('es');
    }

    /**
     * 创建索引
     * @param ESMigration $migration
     * @return bool
     */
    protected function create(ESMigration $migration)
    {
        $params = [
            'index' => $migration->index,
            'body'  => [
                'mappings' => $migration->mappings(),
            ]
        ];

        $response = $this->getClient()->indices()->create($params);
        return $response['acknowledged'];
    }

    /**
     * 删除索引
     * @param ESMigration $migration
     * @return bool
     */
    public function delete(ESMigration $migration)
    {
        $response = $this->getClient()->indices()->delete(['index' => $migration->index]);
        return $response['acknowledged'];
    }

    /**
     * 重建索引
     * @param ESMigration $migration
     * @return bool
     */
    public function refresh(ESMigration $migration)
    {
        $this->delete($migration);

        return $this->create($migration);
    }
}
