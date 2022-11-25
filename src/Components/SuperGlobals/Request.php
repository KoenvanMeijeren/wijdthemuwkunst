<?php
declare(strict_types=1);

namespace Components\SuperGlobals;

use Components\Route\RouteProcessor;
use Components\SuperGlobals\Cookie\Cookie;
use Components\SuperGlobals\Env\Env;
use Components\SuperGlobals\File\File;
use Components\SuperGlobals\Post\Post;
use Components\SuperGlobals\Query\Query;
use Components\SuperGlobals\Server\Server;
use Components\SuperGlobals\Session\Session;
use JetBrains\PhpStorm\Pure;

/**
 * Provides a class for interacting with super globals.
 *
 * @package Components\SuperGlobals
 */
final class Request implements RequestInterface {

  /**
   * Constructs the request.
   *
   * @param \Components\SuperGlobals\Query\Query $query
   *   The query.
   * @param \Components\SuperGlobals\Post\Post $post
   *   The posted form values.
   * @param \Components\SuperGlobals\Server\Server $server
   *   The server values.
   * @param \Components\SuperGlobals\File\File $file
   *   The uploaded files.
   * @param \Components\SuperGlobals\Env\Env $env
   *   The environment values.
   * @param \Components\SuperGlobals\Cookie\Cookie $cookie
   *   The cookies.
   * @param \Components\SuperGlobals\Session\Session $session
   *   The session values.
   */
  public function __construct(
    public readonly Query $query = new Query(),
    public readonly Post $post = new Post(),
    public readonly Server $server = new Server(),
    public readonly File $file = new File(),
    public readonly Env $env = new Env(),
    public readonly Cookie $cookie = new Cookie(encrypt: FALSE),
    public readonly Session $session = new Session()
  ) {}

  /**
   * {@inheritDoc}
   */
  public function getHost(): string {
    $urlComponents = (array) parse_url($this->env('app_uri'));

    return $urlComponents['host'] ?? '';
  }

  /**
   * {@inheritDoc}
   */
  #[Pure]
  public function getRouteParameter(): string {
    return RouteProcessor::getWildcard();
  }

  /**
   * {@inheritDoc}
   */
  public function post(string $key, $default = ''): string {
    return $this->post->get($key, $default);
  }

  /**
   * {@inheritDoc}
   */
  public function file(): File {
    return $this->file;
  }

  /**
   * {@inheritDoc}
   */
  public function env(string $key, string $default = ''): string {
    return $this->env->get($key, $default);
  }

  /**
   * {@inheritDoc}
   */
  public function cookie(string $key, string $default = ''): string {
    return $this->cookie->get($key, $default);
  }

  /**
   * {@inheritDoc}
   */
  public function session(string $key, string $default = ''): string {
    return $this->session->get($key, $default);
  }

}
