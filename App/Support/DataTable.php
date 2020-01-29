<?php
declare(strict_types=1);


namespace Support;

final class DataTable
{
    private string $table = '';
    private string $head = '';
    private string $rows = '';
    private string $footer = '';
    private string $ids = '';
    private string $classes = '';
    private string $var = 'table';

    /**
     * Add (multiple) ids to a piece of html.
     *
     * @param string ...$ids
     */
    public function addId(...$ids): void
    {
        $this->ids = implode(', ', $ids);
    }

    /**
     * Add (multiple) classes to a piece of html.
     *
     * @param string ...$classes
     */
    public function addClasses(...$classes): void
    {
        $this->classes = implode(', ', $classes);
    }

    public function addTableStart(): void
    {
        $this->add('<table>', $this->var);
    }

    public function addTableEnd(): void
    {
        $this->add('</table>', $this->var);
    }

    public function addHeadStart(): void
    {
        $this->add('<thead>', $this->var);
    }

    public function addHeadEnd(): void
    {
        $this->add('</thead>', $this->var);
    }

    public function addBodyStart(): void
    {
        $this->add('<tbody>', $this->var);
    }

    public function addBodyEnd(): void
    {
        $this->add('</tbody>', $this->var);
    }

    public function addFooterStart(): void
    {
        $this->add('<tfoot>', $this->var);
    }

    public function addFooterEnd(): void
    {
        $this->add('</tfoot>', $this->var);
    }

    public function addTrStart(): void
    {
        $this->add('<tr>', $this->var);
    }

    public function addTrEnd(): void
    {
        $this->add('</tr>', $this->var);
    }

    public function addThStart(): void
    {
        $this->add('<th>', $this->var);
    }

    public function addThEnd(): void
    {
        $this->add('</th>', $this->var);
    }

    public function addTdStart(): void
    {
        $this->add('<td>', $this->var);
    }

    public function addTdEnd(): void
    {
        $this->add('</td>', $this->var);
    }

    /**
     * Add a head to the table.
     *
     * @param string ...$ths each item represents a title for a column.
     */
    public function addHead(...$ths): void
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
     * Add an edit head to the table.
     *
     * @param string ...$ths each item represents a title for a column.
     */
    public function addEditHead(...$ths): void
    {
        $this->var = 'head';

        $this->addTrStart();

        foreach ($ths as $item) {
            $this->addThStart();
            $this->add($item, $this->var);
            $this->addThEnd();
        }

        $this->addClasses('table-edit-row');
        $this->addThStart();
        $this->add('Bewerken', $this->var);
        $this->addThEnd();

        $this->addTrEnd();
    }

    /**
     * Add a row to the table.
     *
     * @param string|int|bool ...$tds each item represent a piece
     *                                of data in a row.
     */
    public function addRow(...$tds): void
    {
        $this->var = 'rows';

        $this->addTrStart();

        foreach ($tds as $item) {
            $this->addTdStart();
            $this->add((string) $item, $this->var);
            $this->addTdEnd();
        }

        $this->addTrEnd();
    }

    /**
     * Add a footer to the table.
     *
     * @param string ...$ths each item represent a head for a column.
     */
    public function addFooter(...$ths): void
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
     * Get the build table.
     *
     * @return string
     */
    public function get(): string
    {
        $this->var = 'table';

        $this->addClasses('table table-hover customTableStyle');
        $this->addId('table');
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

    /**
     * Add a piece html to the table.
     *
     * @param string $piece
     * @param string $var
     */
    private function add(string $piece, string $var = 'table'): void
    {
        $string = $piece;

        if ($this->ids !== '') {
            $string = (string) preg_replace(
                '/>/',
                " id='{$this->ids}' >",
                $string
            );
        }

        if ($this->classes !== '') {
            $string = (string) preg_replace(
                '/>/',
                " class='{$this->classes}' >",
                $string
            );
        }

        $this->$var .= $string;
        $this->reset();
    }

    /**
     * Reset all settings for the added piece html to the table.
     */
    public function reset(): void
    {
        $this->ids = '';
        $this->classes = '';
    }
}
