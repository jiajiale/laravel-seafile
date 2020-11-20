<?php

namespace Jiajiale\LaravelSeafile\Resource;

/**
 * Interface ResourceInterface
 * @package Jiajiale\LaravelSeafile\Resource
 */
interface ResourceInterface
{
    /**
     * Clip tailing slash
     *
     * @param string $uri URI string
     *
     * @return mixed|string
     */
    public function clipUri(string $uri): string;
}
