<?php
declare(strict_types=1);

namespace Components\Route;

use Components\Http\HttpTypes;
use JetBrains\PhpStorm\Pure;

/**
 * Provides a class for RouteGet.
 *
 * @package Components\Route;
 */
#[\Attribute]
final class RouteGet implements RouteInterface {

  /**
   * The http type.
   *
   * @var \Components\Http\HttpTypes
   */
  public readonly HttpTypes $httpType;

  /**
   * The class of the method.
   *
   * @var string
   */
  public string $class;

  /**
   * The method to be called.
   *
   * @var string
   */
  public string $method;

  /**
   * Constructs a new route.
   *
   * @param string $url
   *   The url.
   * @param \Components\Route\RouteRights $rights
   *   The rights.
   * @param string|null $route
   *   The route.
   */
  #[Pure] public function __construct(
    public readonly string $url,
    public readonly RouteRights $rights = RouteRights::GUEST,
    public readonly ?string $route = NULL
  ) {
    $this->httpType = HttpTypes::GET;
  }

  /**
   * Sets the parent class of the method.
   *
   * @param string $class
   *   The parent class of the method.
   */
  public function setClass(string $class): void {
    $this->class = $class;
  }

  /**
   * Sets the callable method.
   *
   * @param string $method
   *   The callable method.
   */
  public function setMethod(string $method): void {
    $this->method = $method;
  }

  /**
   * {@inheritDoc}
   */
  public function instantiateClass(): object {
    return new $this->class();
  }

}
