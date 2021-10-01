<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SteppingStoneRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class SteppingStoneCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class SteppingStoneCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\InlineCreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\SteppingStone::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/stepping-stone');
        CRUD::setEntityNameStrings('stepping stone', 'stepping stones');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::addColumns([
            [
                'name' => 'name',
                'label' => 'Name'
            ],
            [
                'name' => 'short_description',
                'label' => 'Short Description'
            ],
            [
                'name' => 'description',
                'label' => 'Description'
            ],
            [
                'name' => 'video_link',
                'label' => 'Video Link'
            ],
            [
                'name' => 'main_content',
                'label' => 'Main Content'
            ],
        ]);

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(SteppingStoneRequest::class);

        CRUD::addFields([
            [
                'name' => 'name',
                'label' => 'Stepping stone name',
                'type' => 'text'
            ],
            [
                'name' => 'short_description',
                'label' => 'Stepping stone short description',
                'type' => 'textarea'
            ],
            [
                'name' => 'description',
                'label' => 'Stepping stone description',
                'type' => 'ckeditor'
            ],
            [
                'name' => 'video_link',
                'label' => 'Video Link',
                'type' => 'text'
            ],
            [
                'name' => 'pdf_file',
                'label' => 'PDF file upload',
                'type' => 'upload'
            ],
            [
                'name' => 'audio_file',
                'label' => 'Audio file upload',
                'type' => 'upload'
            ],
            [
                'name' => 'main_content',
                'label' => 'Main Stepping stone content',
                'type' => 'ckeditor'
            ],
        ]);

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
