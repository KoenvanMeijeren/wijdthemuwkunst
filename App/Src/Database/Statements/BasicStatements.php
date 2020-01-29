<?php
declare(strict_types=1);


namespace Src\Database\Statements;

use PDOException;
use Src\Database\DatabaseProcessor;
use Src\Database\DB;

trait BasicStatements
{
    /**
     * Add a statement to the query.
     *
     * @param string $statement the statement to be added to the query
     *
     * @return DB
     */
    abstract public function addStatement(string $statement): DB;

    /**
     * Add values. These values will be used when
     *             the query is going to be executed
     *
     * @param string[] $values The values to be added
     */
    abstract public function addValues(array $values): void;

    /**
     * Execute the prepared query.
     *
     * @return DatabaseProcessor
     * @throws PDOException
     */
    abstract public function execute(): DatabaseProcessor;

    /**
     * The HAVING clause was added to SQL because
     * the WHERE keyword could not be used with aggregate functions.
     *
     * @param string[] ...$conditions The condition(s) of the having clause.
     *
     * @return $this
     */
    public function having(...$conditions): self
    {
        $this->addStatement(
            'HAVING ' . implode(', ', $conditions) . ' '
        );

        return $this;
    }

    /**
     * The INSERT INTO statement is used to insert new records in a table.
     *
     * @param string[] $values The values to be inserted.
     *
     * @return void
     */
    public function insert(array $values): void
    {
        $columns = implode(', ', array_keys($values));
        $bindColumns = ':' . implode(', :', array_keys($values));

        $this->addStatement(
            'INSERT INTO ' . self::$table .
            " ({$columns}) VALUES ({$bindColumns}) "
        );

        $this->addValues($values);

        $this->execute();
    }

    /**
     * The UPDATE statement is used to modify the existing records in a table.
     *
     * @param string[] $values The values to be updated
     *
     * @return $this
     */
    public function update(array $values): self
    {
        $this->addStatement(
            'UPDATE ' . self::$table . ' SET '
        );

        foreach (array_keys($values) as $column) {
            $comma = array_key_last($values) !== $column ? ',' : '';

            $this->addStatement(
                "{$column} = :{$column}{$comma} "
            );
        }

        $this->addValues($values);

        return $this;
    }

    /**
     * Soft delete records from the database.
     *
     * @param string $column The column to be updated.
     *                       This value will be used to determine
     *                       if the record has been deleted
     * @param string $value  The value -> 1 is deleted 0 -> is available
     *
     * @return $this
     */
    public function delete(string $column, string $value = '1'): self
    {
        $this->update([$column => $value]);

        return $this;
    }

    /**
     * The DELETE statement is used to delete existing records in a table.
     *
     * @return $this
     */
    public function permanentDelete(): self
    {
        $this->addStatement(
            'DELETE FROM ' . self::$table . ' '
        );

        return $this;
    }

    /**
     * Order all selected records by specified columns with a specified filter.
     *
     * @param string    $filter     The filter
     *                                  -> ascending (asc) or descending (desc).
     * @param string[]  ...$columns The columns to be ordered.
     *
     * @return $this
     */
    public function orderBy(string $filter, ...$columns): self
    {
        $this->addStatement(
            'ORDER BY ' . implode(', ', $columns) . " {$filter} "
        );

        return $this;
    }

    /**
     * The GROUP BY statement is used to group the
     * result-set by one or more columns.
     *
     * @param string[] ...$columns The columns to be grouped into one record
     *
     * @return $this
     */
    public function groupBy(...$columns): self
    {
        $this->addStatement(
            'GROUP BY ' . implode(', ', $columns) . ' '
        );

        return $this;
    }

    /**
     * Limit the number of records that are selected from the database.
     *
     * @param int $number The maximum number of selected records.
     *
     * @return $this
     */
    public function limit(int $number = 1): self
    {
        $this->addStatement(
            "LIMIT {$number} "
        );

        return $this;
    }
}
