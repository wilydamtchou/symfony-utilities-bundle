<?php

namespace Willydamtchou\SymfonyUtilities\Exception;

use Afrikpay\SymfonyUtilities\Model\AppMessage;

class GeneralException extends \RuntimeException
{
    public const string MESSAGE = 'message';
    public const string CODE = 'code';
    public const string HEADER_CONTENT_TYPE = 'Content-Type';
    public const string CONTENT_TYPE_JSON = 'application/json';
    public const string CONTENT_TYPE_HTML = 'text/html;charset=UTF-8';
    public const int SUCCESS_STATUS = 200;
    public const int FAILED_STATUS = 500;

    /**
     * @var string
     */
    protected string $exceptionCode = '01';

    /**
     * @var string|null
     */
    protected ?string $exceptionType = 'GeneralException';

    /**
     * @var string|null
     */
    protected ?string $userMessage = 'System general error';

    /**
     * @var array<string>
     */
    protected array $headers;
    protected int $statusCode;

    /**
     * @param string $message
     * @param int $code
     * @param \Throwable|null $previous
     */
    public function __construct(
        string $message = AppMessage::GENERAL_FAILURE[self::MESSAGE],
        int $code = AppMessage::GENERAL_FAILURE[self::CODE],
        \Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);

        $this->statusCode = self::SUCCESS_STATUS;
        $this->headers = [self::HEADER_CONTENT_TYPE => self::CONTENT_TYPE_JSON];
    }

    /**
     * @return void
     */
    public function updateCode(): void {
        $this->code = intval(sprintf('%d%d', $this->code, $this->exceptionCode));
    }

    /**
     * @return string
     */
    public function getExceptionCode(): string
    {
        return $this->exceptionCode;
    }

    /**
     * @param string $exceptionCode
     *
     * @return void
     */
    public function setExceptionCode(string $exceptionCode): void
    {
        $this->exceptionCode = $exceptionCode;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @param int $statusCode
     *
     * @return void
     */
    public function setStatusCode(int $statusCode): void
    {
        $this->statusCode = $statusCode;
    }

    /**
     * @return array<string>
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @param array<string> $headers
     *
     * @return void
     */
    public function setHeaders(array $headers): void
    {
        $this->headers = $headers;
    }

    /**
     * @return int|null
     */
    public function getStatus(): ?int
    {
        return $this->statusCode;
    }

    /**
     * @return void
     */
    public function formatJson(): void
    {
        $this->headers = [self::HEADER_CONTENT_TYPE => self::CONTENT_TYPE_JSON];
    }

    /**
     * @return void
     */
    public function formatHtml(): void
    {
        $this->statusCode = self::FAILED_STATUS;
        $this->headers = [self::HEADER_CONTENT_TYPE => self::CONTENT_TYPE_HTML];
    }

    /**
     * @return string
     */
    public function getUserMessage(): string {
        return $this->userMessage ?? $this->message;
    }

    /**
     * @return string
     */
    public function getExceptionType(): string {
        return $this->exceptionType;
    }
}
