<?php


namespace App\Src\DataTable;


final class DataTable extends DataTableHtmlBuilder
{
    /**
     * @inheritDoc
     */
    public function addHead(array $ths): void
    {
        $this->var = 'head';

        $this->addTrStart();

        foreach ($ths as $item) {
            $this->addThStart();
            $this->add($item, $this->var);
            $this->addThEnd();
        }

        $this->addTrEnd();
    }

    /**
     * @inheritDoc
     */
    public function addRow(array $tds, string $actions = null): void
    {
        $this->var = 'rows';

        $this->addTrStart();

        foreach ($tds as $item) {
            $this->addTdStart();
            $this->add((string) $item, $this->var);
            $this->addTdEnd();
        }

        if ($actions !== null) {
            $this->addTdStart();
            $this->add($actions, $this->var);
            $this->addTdEnd();
        }

        $this->addTrEnd();
    }

    /**
     * @inheritDoc
     */
    public function addFooter(array $ths): void
    {
        $this->var = 'footer';

        $this->addTrStart();

        foreach ($ths as $item) {
            $this->addThStart();
            $this->add($item, $this->var);
            $this->addThEnd();
        }

        $this->addTrEnd();
    }

    /**
     * @inheritDoc
     */
    public function get(string $id = 'table'): string
    {
        $this->var = 'table';

        $this->addClasses('table table-hover customTableStyle');
        $this->addId($id);
        $this->addTableStart();

        $this->addHeadStart();
        $this->add($this->head);
        $this->addHeadEnd();

        $this->addBodyStart();
        $this->add($this->rows);
        $this->addBodyEnd();

        $this->addFooterStart();
        $this->add($this->footer);
        $this->addFooterEnd();

        $this->addTableEnd();

        return $this->table;
    }
}
