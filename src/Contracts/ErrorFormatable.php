<?php

namespace WoodyNaDobhar\Dingo2Generators\Contracts;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\Response;

/**
 * Contract for realization return formatted errors
 *
 * Interface ErrorFormatable
 *
 * @package App\Contracts
 */
interface ErrorFormatable
{
    public function responseNotFoundModel(Model $model, int $status_code = 422);

    public function responseCouldNotCreate($nameOfEntity);

    public function responseErrorMessage(string $message, int $status_code, array $errors = []);

    public function response($content, $status_code = 200, array $headers): Response;
}