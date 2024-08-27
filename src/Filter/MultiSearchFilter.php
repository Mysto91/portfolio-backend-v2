<?php

declare(strict_types=1);

namespace App\Filter;

use ApiPlatform\Doctrine\Orm\Filter\AbstractFilter;
use ApiPlatform\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use ApiPlatform\Metadata\Operation;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\CssSelector\Exception\InternalErrorException;
use Symfony\Component\PropertyInfo\Type;

final class MultiSearchFilter extends AbstractFilter
{
    private string $propertyName = 'search';

    protected function filterProperty(
        string $property,
        $value,
        QueryBuilder $queryBuilder,
        QueryNameGeneratorInterface $queryNameGenerator,
        string $resourceClass,
        Operation $operation = null,
        array $context = []
    ): void {
        if (!$this->properties || $property !== $this->propertyName) {
            return;
        }

        $parameterName = $queryNameGenerator->generateParameterName($property);

        foreach ($this->properties as $fieldProperty => $pattern) {
            if (!$this->isPropertyNested($fieldProperty, $resourceClass)) {
                $queryBuilder->orWhere(sprintf('LOWER(o.%s) LIKE :%s', $fieldProperty, $parameterName));
            } else {
                [$associatedEntity, $associatedEntityField] = explode(".", $fieldProperty);

                $queryBuilder
                    ->join("o.{$associatedEntity}", $associatedEntity)
                    ->orWhere(sprintf('LOWER(%s.%s) LIKE :%s', $associatedEntity, $associatedEntityField, $parameterName));
            }

            $queryBuilder->setParameter($parameterName, '%' . strtolower($value) . '%');
        }
    }

    public function getDescription(string $resourceClass): array
    {
        if (!$this->properties) {
            return [];
        }

        $description[$this->propertyName] = [
            'property' => $this->propertyName,
            'type' => Type::BUILTIN_TYPE_STRING,
            'required' => false,
            'description' => 'Filter results by a partial match',
            'openapi' => [
                'example' => 'exampleSearchTerm',
                'allowReserved' => false,
                'allowEmptyValue' => true,
                'explode' => false,
            ],
        ];

        return $description;
    }
}
