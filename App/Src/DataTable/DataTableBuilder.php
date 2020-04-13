<?php


namespace App\Src\DataTable;


abstract class DataTableBuilder
{
    protected DataTable $dataTable;

    protected array $data = [];

    public function __construct(array $data)
    {
        $this->dataTable = new DataTable();

        $this->data = $data;
    }

    /**
     * Build the head of the table.
     *
     * @return string[]
     */
    abstract protected function buildHead(): array;

    /**
     * Build one row with data.
     *
     * @param object $data
     *
     * @return string[]
     */
    abstract protected function buildRow(object $data): array;

    /**
     * Build the actions for one row.
     *
     * @param object $data
     *
     * @return string
     */
    abstract protected function buildRowActions(object $data): string;

    /**
     * Get the build table.
     *
     * @return string
     */
    final public function get(): string
    {
        $this->dataTable->addHead(
            $this->buildHead()
        );

        foreach ($this->data as $item) {
            $this->dataTable->addRow(
                $this->buildRow($item),
                $this->buildRowActions($item)
            );
        }

        return $this->dataTable->get();
    }
}
