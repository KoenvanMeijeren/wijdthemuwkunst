<?php
declare(strict_types=1);

namespace System\Entity\Type;

use Components\Attribute\AttributeInterface;
use System\Entity\EntityRepository;

/**
 * Provides a class for ContentEntityType.
 *
 * @package System\Entity\Type;
 */
#[\Attribute]
class ContentEntityType implements AttributeInterface {

  /**
   * Constructs a new content entity type.
   *
   * @param string $table
   *   The table.
   * @param string $repository
   *   The repository.
   */
  public function __construct(
    public readonly string $table,
    public readonly string $repository = EntityRepository::class
  ) {

  }

}
