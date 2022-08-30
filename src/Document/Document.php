<?php
declare(strict_types=1);

namespace PrinsFrank\PdfParser\Document;

use PrinsFrank\PdfParser\Document\CrossReference\CrossReferenceSource;

use PrinsFrank\PdfParser\Document\Object\ObjectStream\ObjectStream;
use PrinsFrank\PdfParser\Document\Trailer\Trailer;
use PrinsFrank\PdfParser\Document\Version\Version;

final class Document
{
    public readonly string $content;
    public readonly int    $contentLength;

    /** @var ObjectStream[] */
    public readonly array                $objectStreams;
    public readonly Version              $version;
    public readonly CrossReferenceSource $crossReferenceSource;
    public readonly Trailer              $trailer;

    /** @var array<string> */
    public array $errors = [];

    public function __construct(string $content)
    {
        $this->content       = $content;
        $this->contentLength = strlen($content);
    }

    public function setTrailer(Trailer $trailer): self
    {
        $this->trailer = $trailer;

        return $this;
    }

    public function setVersion(Version $version): self
    {
        $this->version = $version;

        return $this;
    }

    public function setCrossReferenceSource(CrossReferenceSource $crossReferenceSource): self
    {
        $this->crossReferenceSource = $crossReferenceSource;

        return $this;
    }

    public function setObjectStreams(ObjectStream ...$objectStreams): self
    {
        $this->objectStreams = $objectStreams;

        return $this;
    }

    public function addError(string $error): self
    {
        $this->errors[] = $error;

        return $this;
    }

    /** @return array<string> */
    public function getErrors(): array
    {
        return $this->errors;
    }

    public function hasErrors(): bool
    {
        return $this->errors !== [];
    }
}
