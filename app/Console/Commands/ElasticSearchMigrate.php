<?php

namespace App\Console\Commands;

use App\Services\ElasticSearchMigrations\ESMigration;
use App\Services\ElasticSearchMigrations\PostsMigration;
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

    protected $actions = [
        'create', 'delete',
    ];

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $indices = $this->getIndices();
        $classes = $this->getMigrationClass($indices);
        $action = $this->getAction();

        foreach ($classes as $class) {
            if ($class instanceof ESMigration) {
                $result = $class->$action();

                var_dump($result);
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

        return explode(',', $option);
    }

    /**
     * @param string[] $indices
     * @return array
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

    protected function getAction()
    {
        $action = $this->option('action');
        if (!in_array($action, $this->actions)) {
            $this->error('Unknown Action: ' . $action);
            exit();
        }
        return $action;
    }
}
