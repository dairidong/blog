<?php


namespace App\Services\ElasticSearch\Migrations;

abstract class ESMigration
{
    public $index = '';

    /**
     * @return array
     */
    abstract public function mappings(): array;
}
