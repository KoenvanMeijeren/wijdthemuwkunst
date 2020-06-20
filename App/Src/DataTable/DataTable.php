<?php

declare(strict_types=1);

namespace App\Src\DataTable;

/**
 * Provides a wrapper class for generating HTML output for data tables.
 *
 * @package App\Src\DataTable
 */
final class DataTable extends DataTableHtmlBuilder {

  /**
   * @inheritDoc
   */
  public function addHead(array $ths): void {
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
  public function addRow(array $tds, string $actions = ''): void {
    $this->var = 'rows';

    $this->addTrStart();

    foreach ($tds as $item) {
      $this->addTdStart();
      $this->add($item, $this->var);
      $this->addTdEnd();
    }

    if ($actions !== '') {
      $this->addTdStart();
      $this->add($actions, $this->var);
      $this->addTdEnd();
    }

    $this->addTrEnd();
  }

  /**
   * @inheritDoc
   */
  public function addFooter(array $ths): void {
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
  public function get(string $id = 'table'): string {
    $this->var = 'table';

    $this->addClasses('table table-hover');
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

    $table = '<div class="table-responsive">';
    $table .= $this->table;
    $table .= '</div>';

    return $table;
  }

}
