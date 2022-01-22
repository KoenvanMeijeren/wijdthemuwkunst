<?php

namespace System\Entity\Status;

/**
 * Provides an enumeration for entity saved statuses.
 *
 * @package \System\Entity\Status
 */
enum EntitySaveStatus: int {
  // Return status for saving which involved creating a new item.
  case SAVED_NEW = 1;
  // Return status for saving which involved an update to an existing item.
  case SAVED_UPDATED = 2;
  // Return status for saving which deleted an existing item.
  case SAVED_DELETED = 3;
}
