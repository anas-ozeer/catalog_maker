<?php
namespace App\Imports;

use App\Models\Item;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;


class ItemsImport implements ToModel, WithHeadingRow
{
    protected $catalog_id;
    // Constructor method to initialize the catalogId property
    public function __construct($catalog_id)
    {
        $this->catalog_id = $catalog_id;
    }
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Item([
            'name'        => $row['name'],
            'description' => $row['description'],
            'price'       => $row['price'],
            'catalog_id'  => $this->catalog_id,
        ]);
    }
}
