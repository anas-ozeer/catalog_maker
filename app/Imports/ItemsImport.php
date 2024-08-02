<?php
namespace App\Imports;

use App\Models\Item;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;


class ItemsImport implements ToModel, WithHeadingRow, WithValidation
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
        $item = new Item([
            'name'        => $row['name'],
            'description' => $row['description'],
            'price'       => $row['price'],
            'catalog_id'  => $this->catalog_id,
        ]);
        return $item;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'min:3'],
            'description' => ['nullable', 'string', 'max:255'],
            'price' => ['required', 'decimal:0,2']
        ];
    }


    public function customValidationMessages() : array
    {
        return [
            'name.min' => 'All names should have a minimum of 3 characters',
            'price.decimal' => 'All prices should be in the format 0.00'
        ];
    }
}
