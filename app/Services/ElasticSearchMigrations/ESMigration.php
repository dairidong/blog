<?php


namespace App\Services\ElasticSearchMigrations;

abstract class ESMigration
{
    public $index = '';

    /**
     * @return array
     */
    abstract public function mappings(): array;
}
