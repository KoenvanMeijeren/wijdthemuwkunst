<?php

use Modules\Text\Entity\Text;
use System\Entity\EntityManager;

/**
 * Translates texts.
 *
 * @param string $text
 *   The text to be translated.
 */
function t(string $text): string {
  $entityManager = new EntityManager();

  /** @var \Modules\Text\Entity\TextRepositoryInterface $repository */
  $repository = $entityManager->getStorage(Text::class)->getRepository();
  if ($entity = $repository->loadByText($text)) {
    return $entity->getValue();
  }

  throw new RuntimeException('Not implemented yet.');
}
