<?php
declare(strict_types=1);

namespace System\Entity\Status;

use System\Entity\EntityBase;

/**
 * Provides a class for EntityStatusBase.
 *
 * @package System\Entity\Status;
 */
abstract class EntityStatusBase extends EntityBase implements EntityStatusInterface {

  use EntityStatusTrait;

}
