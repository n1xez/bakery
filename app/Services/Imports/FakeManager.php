<?php

namespace App\Services\Imports;

use Faker\Factory;

class FakeManager implements ImportManager
{
    /**
     * @var Factory
     */
    private $factory;

    /**
     * FakeManager constructor.
     * @param Factory $factory
     */
    public function __construct(Factory $factory)
    {
        $this->factory =  $factory::create();
    }

    /**
     * @return array
     */
    public function getDishes()
    {
        return collect($this->prepareDishes());
    }

    private function prepareDishes()
    {
        $prepareDishes = [];
        foreach ($this->shops() as $articleShops => $shop) {
            foreach ($this->products() as $articleProducts => $product) {
                $prepareDishes[] = [
                    'storage' => $articleShops,
                    'storageName' => $shop,
                    'product' => $articleProducts,
                    'productName' => $product,
                    'quantity' => $this->factory->numberBetween(0, 20),
                ];
            }
        }

        return $prepareDishes;
    }

    private function products()
    {
        return [
            '45eda4d2-051f-44a9-8b14-3f905a1d2352' => 'Хлеб белый',
            'ffefedcd-d54c-4e8c-b39c-88a3f890f6ca' => 'Багет',
            '0eb9f9f7-1865-49de-9c61-caf2d93ad9eb' => 'Фокачча',
            '52a11f7a-bb5d-46f2-a3be-bb3552837817' => 'Батон',
            '96403b83-1e93-4f24-b195-5f32635cf5bd' => 'Хлеб спортивный',
            'a0f642a0-fec9-4a03-9dcc-e19d7f068fef' => 'Хлеб картофельный',
            'dd0c338a-0732-4934-ad26-c735faa41cf3' => 'Хлеб ржаной',
            '14090c9f-14c6-4480-ba5d-2eda15da6f5f' => 'Хлеб «Бородино»',
            '8cf560c7-e94a-40f4-8774-840e4ad6252a' => 'Хачапури',
            'b7d23a8d-1f5b-4d33-abeb-ffeff9ca9218' => 'Сосиска в тесте',
            '3f872908-b5a9-4da2-bcd1-bb6c52995ae1' => 'Пирожок с зелёным луком и яйцом',
            'fb4ebf53-953b-4560-98ad-f5b2b0a2f8c6' => 'Эчпочмак',
            '5dfcdb23-a4bd-427f-a1fe-1922f7860275' => 'Элеш с курицей',
            '6b8da0bc-e673-48ad-af1a-54a8938c7032' => 'Беккен',
            '940fd47f-da71-4630-8ef7-cbe2f7c03752' => 'Вак бэлеш',
        ];
    }

    private function shops()
    {
        return [
            '19021341-d18b-44af-bf22-610bb6c4ec25' => 'Аделя Кутуя',
            '2e8ea139-d7f8-4da1-8c58-8159076a63c7' => 'Проспект победы',
            '9d477049-81de-4537-b53f-e66ebd62f998' => 'Декабристов',
            '1812fed0-b3ee-4fa6-82f9-8952e2cf57b5' => 'Вишневского',
        ];
    }
}