<?php

namespace Core45\LaravelBaselinker\Baselinker;

class Catalog extends LaravelBaselinker
{
    public function getInventoryCategories()
    {
        $params = [
            'method' => __FUNCTION__,
            'parameters' => '{}'
        ];

        return $this->makeRequest($params);
    }

    public function test()
    {
        return 'Catalog test says: Hello World!';
    }
}
