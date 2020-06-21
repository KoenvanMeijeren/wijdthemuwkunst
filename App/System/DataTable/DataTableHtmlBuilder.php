<?php

declare(strict_types=1);

namespace System\DataTable;

/**
 * Provides a class for generating HTML for data tables.
 *
 * @package Src\DataTable
 */
abstract class DataTableHtmlBuilder implements DataTableInterface {

  /**
   * The HTML table.
   *
   * @var string
   */
  protected string $table = '';

  /**
   * The head of the table.
   *
   * @var string
   */
  protected string $head = '';

  /**
   * The rows of the table.
   *
   * @var string
   */
  protected string $rows = '';

  /**
   * The footer of the table.
   *
   * @var string
   */
  protected string $footer = '';

  /**
   * The identifiers of the HTML piece.
   *
   * @var string
   */
  protected string $identifiers = '';

  /**
   * The classes of the HTML piece.
   *
   * @var string
   */
  protected string $classes = '';

  /**
   * The attribute to append the HTML to.
   *
   * @var string
   */
  protected string $var = 'table';

  /**
   * {@inheritDoc}
   */
  abstract public function addHead(array $ths): void;

  /**
   * {@inheritDoc}
   */
  abstract public function addRow(array $tds, string $actions = ''): void;

  /**
   * {@inheritDoc}
   */
  abstract public function addFooter(array $ths): void;

  /**
   * {@inheritDoc}
   */
  abstract public function get(string $id = 'table'): string;

  /**
   * {@inheritDoc}
   */
  final public function addId(...$ids): void {
    $this->identifiers = implode(', ', $ids);
  }

  /**
   * {@inheritDoc}
   */
  final public function addClasses(...$classes): void {
    $this->classes = implode(', ', $classes);
  }

  /**
   * Adds a open table HTML tag.
   */
  final protected function addTableStart(): void {
    $this->add('<table width="100%" cellspacing="0">', $this->var);
  }

  /**
   * Adds a close table HTML tag.
   */
  final protected function addTableEnd(): void {
    $this->add('</table>', $this->var);
  }

  /**
   * Adds a open table head HTML tag.
   */
  final protected function addHeadStart(): void {
    $this->add('<thead>', $this->var);
  }

  /**
   * Adds a close table head HTML tag.
   */
  final protected function addHeadEnd(): void {
    $this->add('</thead>', $this->var);
  }

  /**
   * Adds a open table body HTML tag.
   */
  final protected function addBodyStart(): void {
    $this->add('<tbody>', $this->var);
  }

  /**
   * Adds a close table body HTML tag.
   */
  final protected function addBodyEnd(): void {
    $this->add('</tbody>', $this->var);
  }

  /**
   * Adds a open table footer HTML tag.
   */
  final protected function addFooterStart(): void {
    $this->add('<tfoot>', $this->var);
  }

  /**
   * Adds a close table footer HTML tag.
   */
  final protected function addFooterEnd(): void {
    $this->add('</tfoot>', $this->var);
  }

  /**
   * Adds a open table row HTML tag.
   */
  final protected function addTrStart(): void {
    $this->add('<tr>', $this->var);
  }

  /**
   * Adds a close table row HTML tag.
   */
  final protected function addTrEnd(): void {
    $this->add('</tr>', $this->var);
  }

  /**
   * Adds a open table head HTML tag.
   */
  final protected function addThStart(): void {
    $this->add('<th>', $this->var);
  }

  /**
   * Adds a close table head HTML tag.
   */
  final protected function addThEnd(): void {
    $this->add('</th>', $this->var);
  }

  /**
   * Adds a open table column HTML tag.
   */
  final protected function addTdStart(): void {
    $this->add('<td>', $this->var);
  }

  /**
   * Adds a close table column HTML tag.
   */
  final protected function addTdEnd(): void {
    $this->add('</td>', $this->var);
  }

  /**
   * Add a piece HTML to the table.
   *
   * @param string $piece
   *   The HTML piece.
   * @param string $var
   *   The variable to append the html to.
   */
  final protected function add(string $piece, string $var = 'table'): void {
    $string = $piece;

    if ($this->identifiers !== '') {
      $string = (string) preg_replace(
            '/>/',
            " id='{$this->identifiers}' >",
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
  final protected function reset(): void {
    $this->identifiers = '';
    $this->classes = '';
  }

}
