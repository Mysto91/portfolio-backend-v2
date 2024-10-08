<?php

declare(strict_types=1);

namespace App\Exception;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class ProjectNotFoundException extends NotFoundHttpException
{
}
