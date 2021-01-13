<?php

declare(strict_types=1);

namespace App\Service;

use App\Data\SomeItem;
use Generator;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class SomeService
 * @package App\Service
 */
class SomeService
{
    private SerializerInterface $serializer;

    public function __construct(
        private DataService $dataService,
    )
    {
        $this->serializer = new Serializer(
            [new GetSetMethodNormalizer(), new ArrayDenormalizer()],
            [new JsonEncoder()]
        );
    }

    /**
     * @return string[]
     */
    public function getData(): array
    {
//        /** @var SomeItem $item */
//        foreach ($this->iterateSomeItems($this->dataService->getItems()) as $item) {
//            $item->getId();
//        }
        return [
            '12',
            '121323',
            '35',
            '764',
            '2',
            '999',
        ];
    }

    private function iterateSomeItems(string $data): Generator
    {
        $items = $this->serializer->deserialize($data, 'App\Data\SomeItem[]', 'json');
        if (is_iterable($items) && !empty($items)) {
            foreach ($items as $item) {
                yield $item;
            }
        }
    }
}