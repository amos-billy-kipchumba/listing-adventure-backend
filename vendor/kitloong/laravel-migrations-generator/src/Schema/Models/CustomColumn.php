<?php

namespace KitLoong\MigrationsGenerator\Schema\Models;

/**
 * Table column. Column type which is not supported by the framework.
 */
interface CustomColumn extends Model
{
    /**
     * Get the column name.
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Get the table name.
     *
     * @return string
     */
    public function getTableName(): string;

    /**
     * Get the ALTER table ADD column SQL.
     *
     * @return string[]
     */
    public function getSqls(): array;
}
