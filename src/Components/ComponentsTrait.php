<?php
declare(strict_types=1);

namespace Components;

use Components\Env\Env;
use Components\Env\EnvInterface;
use Components\Header\Header;
use Components\Header\HeaderInterface;
use Components\Log\Logger;
use Components\Log\LoggerInterface;
use Components\SuperGlobals\Request;
use Components\SuperGlobals\RequestInterface;
use Components\SuperGlobals\Session\Session;
use Components\SuperGlobals\Session\SessionInterface;
use Components\Translation\Translation;
use Components\Translation\TranslationInterface;
use Modules\Setting\Entity\Setting;
use Modules\User\CurrentUser;
use Modules\User\CurrentUserInterface;
use Modules\User\Entity\AccountInterface;
use Psr\Log\LoggerInterface as PsrLoggerInterface;
use System\Entity\EntityManager;
use System\Entity\EntityManagerInterface;

/**
 * Provides a trait for interacting with the components.
 *
 * @package Components
 */
trait ComponentsTrait {

  /**
   * The request definition.
   *
   * @var \Components\SuperGlobals\RequestInterface
   */
  private RequestInterface $requestDl;

  /**
   * Gets the request definition.
   *
   * @return RequestInterface
   *   The request definition.
   */
  protected function request(): RequestInterface {
    return $this->requestDl ??= new Request();
  }

  /**
   * The request definition.
   *
   * @var \Components\SuperGlobals\RequestInterface
   */
  private static RequestInterface $requestStaticDl;

  /**
   * Gets the request definition.
   *
   * @return RequestInterface
   *   The request definition.
   */
  protected static function requestStatic(): RequestInterface {
    return static::$requestStaticDl ??= new Request();
  }

  /**
   * The session definition.
   *
   * @var \Components\SuperGlobals\Session\SessionInterface
   */
  private SessionInterface $sessionDl;

  /**
   * Gets the session definition.
   *
   * @return SessionInterface
   *   The session definition.
   */
  protected function session(): SessionInterface {
    return $this->sessionDl ??= new Session();
  }

  /**
   * The env definition.
   *
   * @var \Components\Env\EnvInterface
   */
  private EnvInterface $envDl;

  /**
   * Gets the env definition.
   *
   * @return EnvInterface
   *   The env definition.
   */
  protected function env(): EnvInterface {
    return $this->envDl ??= new Env();
  }

  /**
   * The header definition.
   *
   * @var \Components\Header\HeaderInterface
   */
  private HeaderInterface $headerDl;

  /**
   * Gets the header definition.
   *
   * @return HeaderInterface
   *   The header definition.
   */
  protected function header(): HeaderInterface {
    return $this->headerDl ??= new Header();
  }

  /**
   * The translation definition.
   *
   * @var \Components\Translation\TranslationInterface
   */
  private TranslationInterface $translationDl;

  /**
   * Gets the translation definition.
   *
   * @return TranslationInterface
   *   The translator definition.
   */
  protected function t(): TranslationInterface {
    return $this->translationDl ??= new Translation();
  }

  /**
   * The logger definition.
   *
   * @var \Components\Log\LoggerInterface
   */
  private LoggerInterface $loggerDl;

  /**
   * Gets the logger definition.
   *
   * @return \Psr\Log\LoggerInterface
   *   The logger definition.
   */
  protected function log(): PsrLoggerInterface {
    $this->loggerDl ??= new Logger();

    return $this->loggerDl->getLogger();
  }

  /**
   * Gets the logger definition.
   *
   * @return LoggerInterface
   *   The logger definition.
   */
  protected function logger(): LoggerInterface {
    return $this->logger ??= new Logger();
  }

  /**
   * The current user service.
   *
   * @var CurrentUserInterface
   */
  private CurrentUserInterface $currentUserDl;

  /**
   * Gets the current user service.
   *
   * @return CurrentUserInterface
   *   The current user service.
   */
  protected function currentUserService(): CurrentUserInterface {
    return $this->currentUserDl ??= new CurrentUser();
  }

  /**
   * Gets the current user entity.
   *
   * @return AccountInterface
   *   The current user entity.
   */
  protected function user(): AccountInterface {
    return $this->currentUserService()->get();
  }

  /**
   * Gets a setting.
   *
   * @param string $setting
   *   The setting.
   *
   * @return string
   *   The setting.
   */
  protected function setting(string $setting): string {
    $entityManager = $this->getEntityManager();

    /** @var \Modules\Setting\Entity\SettingRepositoryInterface $repository */
    $repository = $entityManager->getStorage(Setting::class)->getRepository();
    if ($entity = $repository->loadBySetting($setting)) {
      return $entity->getValue();
    }

    return '';
  }

  /**
   * The entity manager definition.
   *
   * @var \System\Entity\EntityManagerInterface
   */
  private EntityManagerInterface $EntityManagerDl;

  /**
   * Gets the entity manager.
   *
   * @return EntityManagerInterface
   *   The entity manager definition.
   */
  protected function getEntityManager(): EntityManagerInterface {
    return $this->EntityManagerDl ??= new EntityManager();
  }

}
