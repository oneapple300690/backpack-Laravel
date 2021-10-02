<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ModuleRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ModuleCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ModuleCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\InlineCreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\FetchOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Module::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/module');
        CRUD::setEntityNameStrings('module', 'modules');

        /**
         * Define allowAccess to particular permissions
         */
        CRUD::denyAccess(['list', 'create', 'delete', 'update']); // deny all accesses by default
        if (backpack_user()->can('view program')) {
            CRUD::allowAccess('list');
        }
        if (backpack_user()->can('update program')) {
            CRUD::allowAccess(['list', 'update']);
        }
        if (backpack_user()->can('create program')) {
            CRUD::allowAccess(['list', 'create']);
        }
    }

    public function fetchSteppingStone()
    {
        return $this->fetch(\App\Models\SteppingStone::class);
    }

    public function fetchSteppingStones()
    {
        return $this->fetch(\App\Models\SteppingStone::class);
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
                'name' => 'description',
                'label' => 'Description',
            ],
            [
                'name' => 'video_link',
                'label' => 'Video Link',
                'type' => 'video'
            ]
        ]);

        // CRUD::enableExportButtons();
        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * Define what happens when the Preview operation is loaded.
     * 
     * @return void
     */
    protected function setupShowOperation()
    {
        $this->setupListOperation();
        CRUD::modifyColumn('description', ['type' => 'markdown']);
        CRUD::addColumn(['name' => 'steppingStones', 'label' => 'Stepping Stones', 'type' => 'relationship']);
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ModuleRequest::class);

        CRUD::addFields([
            [
                'name' => 'name',
                'label' => 'Module name',
                'type' => 'text'
            ],
            [
                'name' => 'description',
                'label' => 'Module description',
                'type' => 'ckeditor'
            ],
            [
                'name' => 'video_link',
                'label' => 'Video link',
                'type' => 'video',
                'youtube_api_key' => env('GOOGLE_API_KEY', '')
            ],
            [
                'name'      => 'steppingStones', // the method that defines the relationship in your Model
                'label'     => 'Stepping stones',
                'type'      => 'relationship',
                'entity'    => 'steppingStones', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                // 'model' => "App\Models\SteppingStone",
                // 'ajax' => true,
                'inline_create' => [
                    'entity'      => 'stepping-stone',
                    'modal_class' => 'modal-dialog modal-xl',
                ],
                // 'data_source' => backpack_url('module/fetch/steppingStone'),
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
