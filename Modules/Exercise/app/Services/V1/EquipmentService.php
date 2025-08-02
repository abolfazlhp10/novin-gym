<?php
namespace Modules\Exercise\Services\V1;

use Modules\Exercise\Models\V1\Equipment;

class EquipmentService
{
    public function getAll()
    {
        return Equipment::all();
    }

    public function create(array $data)
    {
        return Equipment::create($data);
    }

    public function update(Equipment $equipment, array $data)
    {
        $equipment->update($data);
        return $equipment;
    }

    public function delete(Equipment $equipment):void
    {
        $equipment->delete();
    }
}
