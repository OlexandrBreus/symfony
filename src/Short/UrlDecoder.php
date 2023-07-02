<?php

namespace App\Short;

use InvalidArgumentException;
use App\Short\Exceptions\DataNotFoundException;
use App\Short\Interfaces\ICodeRepository;

class UrlDecoder implements Interfaces\IUrlDecoder
{
    public function __construct(protected ICodeRepository $repository)
    {

    }

    /**
     * @inheritDoc
     */
    public function decode(string $code): string
    {
        try {
            $code = $this->repository->getUrlByCode($code);
        } catch (DataNotFoundException $e) {
            throw new InvalidArgumentException(
                $e->getMessage(),
                $e->getCode(),
                $e->getPrevious()
            );
        }
        return $code;
    }
}