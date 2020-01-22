<?php
declare(strict_types=1);


namespace App\Src\Header;

final class Header
{
    /**
     * Header options.
     *
     * @var string
     */
    public const STRICT_TRANSPORT_SECURITY = 'Strict-Transport-Security: max-age=31536000; includeSubDomains; preload';
    public const X_XSS_PROTECTION = 'X-XSS-Protection: 1; mode=block;';
    public const APACHE_X_FRAME_OPTIONS = 'Header always set X-Frame-Options "sameorigin"';
    public const NGINX_X_FRAME_OPTIONS = 'add_header X-Frame-Options sameorigin always;';
    public const X_CONTENT_TYPE_OPTIONS = 'X-Content-Type-Options: nosniff';
    public const CONTENT_SECURITY_POLICY = 'content-security-policy-report-only';

    public function set(
        string $header,
        bool $replace = true,
        int $httpResponseCode = 0
    ): void {
        header($header, $replace, $httpResponseCode);
    }

    public function remove(string $name): void
    {
        header_remove($name);
    }
}
