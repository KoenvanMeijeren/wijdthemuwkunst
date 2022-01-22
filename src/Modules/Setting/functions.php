<?php

use Modules\Setting\Entity\Setting;
use System\Entity\EntityManager;

/**
 * Gets a setting.
 *
 * @param string $setting
 *   The setting.
 *
 * @return string
 *   The found setting.
 */
function setting(string $setting): string {
  $entityManager = new EntityManager();

  /** @var \Modules\Setting\Entity\SettingRepositoryInterface $repository */
  $repository = $entityManager->getStorage(Setting::class)->getRepository();
  if ($entity = $repository->loadBySetting($setting)) {
    return $entity->getValue();
  }

  return '';
}
