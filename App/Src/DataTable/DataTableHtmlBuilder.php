<?php


namespace App\Src\DataTable;


abstract class DataTableHtmlBuilder
{
    protected string $table = '';
    protected string $head = '';
    protected string $rows = '';
    protected string $footer = '';
    protected string $ids = '';
    protected string $classes = '';
    protected string $var = 'table';

    /**
     * Add a head to the table.
     *
     * @param string[] $ths each item represents a title for a column.
     */
    abstract public function addHead(array $ths): void;

    /**
     * Add a row to the table.
     *
     * @param string[] $tds     each item represent a piece of data in a row.
     * @param string   $actions the actions for this row.
     */
    abstract public function addRow(array $tds, string $actions = null): void;

    /**
     * Add a footer to the table.
     *
     * @param string[] $ths each item represent a head for a column.
     */
    abstract public function addFooter(array $ths): void;

    /**
     * Get the build table.
     *
     * @param string $id the id of the table.
     *
     * @return string
     */
    abstract public function get(string $id = 'table'): string;

    /**
     * Add (multiple) ids to a piece of html.
     *
     * @param string ...$ids
     */
    final public function addId(...$ids): void
    {
        $this->ids = implode(', ', $ids);
    }

    /**
     * Add (multiple) classes to a piece of html.
     *
     * @param string ...$classes
     */
    final public function addClasses(...$classes): void
    {
        $this->classes = implode(', ', $classes);
    }

    final protected function addTableStart(): void
    {
        $this->add('<table width="100%" cellspacing="0">', $this->var);
    }

    final protected function addTableEnd(): void
    {
        $this->add('</table>', $this->var);
    }

    final protected function addHeadStart(): void
    {
        $this->add('<thead>', $this->var);
    }

    final protected function addHeadEnd(): void
    {
        $this->add('</thead>', $this->var);
    }

    final protected function addBodyStart(): void
    {
        $this->add('<tbody>', $this->var);
    }

    final protected function addBodyEnd(): void
    {
        $this->add('</tbody>', $this->var);
    }

    final protected function addFooterStart(): void
    {
        $this->add('<tfoot>', $this->var);
    }

    final protected function addFooterEnd(): void
    {
        $this->add('</tfoot>', $this->var);
    }

    final protected function addTrStart(): void
    {
        $this->add('<tr>', $this->var);
    }

    final protected function addTrEnd(): void
    {
        $this->add('</tr>', $this->var);
    }

    final protected function addThStart(): void
    {
        $this->add('<th>', $this->var);
    }

    final protected function addThEnd(): void
    {
        $this->add('</th>', $this->var);
    }

    final protected function addTdStart(): void
    {
        $this->add('<td>', $this->var);
    }

    final protected function addTdEnd(): void
    {
        $this->add('</td>', $this->var);
    }

    /**
     * Add a piece html to the table.
     *
     * @param string $piece
     * @param string $var
     */
    final protected function add(string $piece, string $var = 'table'): void
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
    final protected function reset(): void
    {
        $this->ids = '';
        $this->classes = '';
    }
}
