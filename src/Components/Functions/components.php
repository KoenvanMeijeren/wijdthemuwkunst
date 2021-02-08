<?php

use Components\Env\Env;
use Components\Env\EnvInterface;
use Components\Header\Header;
use Components\Header\HeaderInterface;
use Components\SuperGlobals\Request;
use Components\SuperGlobals\RequestInterface;
use Components\SuperGlobals\Session\Session;
use Components\SuperGlobals\Session\SessionInterface;
use Components\Translation\Translation;
use Modules\Text\Entity\Text;
use JetBrains\PhpStorm\Pure;
use System\Entity\EntityManager;


/**
 * Gets the request definition.
 *
 * @return RequestInterface
 *   The request object.
 */
#[Pure] function request(): RequestInterface {
  return new Request();
}

/**
 * Gets the session definition.
 *
 * @return SessionInterface
 *   The session object.
 */
function session(): SessionInterface {
  return new Session();
}

/**
 * Gets the env object.
 *
 * @return EnvInterface
 *   The env object.
 */
function env(): EnvInterface {
  return new Env();
}

/**
 * Gets the header object.
 *
 * @return HeaderInterface
 *   The env object.
 */
#[Pure] function headerSend(): HeaderInterface {
  return new Header();
}

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

  return new Translation();
}
