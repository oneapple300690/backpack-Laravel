<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProgramRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ProgramCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ProgramCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CloneOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\BulkCloneOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\BulkDeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\FetchOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Program::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/program');
        CRUD::setEntityNameStrings('program', 'programs');

        /**
         * Define allowAccess to particular permissions
         */
        CRUD::denyAccess(['list', 'create', 'delete', 'update', 'clone']); // deny all accesses by default
        if (backpack_user()->can('view program')) {
            CRUD::allowAccess('list');
        }
        if (backpack_user()->can('update program')) {
            CRUD::allowAccess(['list', 'update']);
        }
        if (backpack_user()->can('create program')) {
            CRUD::allowAccess(['list', 'create', 'clone']);
        }
        if (backpack_user()->can('export program')) {
            CRUD::enableExportButtons();
        }
    }

    public function fetchModule()
    {
        return $this->fetch(\App\Models\Module::class);
    }

    public function fetchModules()
    {
        return $this->fetch(\App\Models\Module::class);
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
                'name' => 'id',
                'label' => 'ID',
            ],
            [
                'name' => 'name',
                'label' => 'Program Name',
            ],
            [
                'name' => 'created_at',
                'label' => 'Date Created',
            ],
            [
                'name' => 'status',
                'label' => 'Status',
            ],
            [
                'name' => 'subscription_price',
                'label' => 'Subscription Price',
            ],
            [
                'name' => 'oneOff_price',
                'label' => 'One off Price',
            ],
            [
                'name' => 'numOfSubscriber',
                'label' => 'Number of Subscribers/Purchases',
            ],
        ]);

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

        CRUD::addColumn(['name' => 'video_link', 'label' => 'Video link', 'type' => 'video']);
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ProgramRequest::class);

        CRUD::addFields([
            [
                'name' => 'name',
                'label' => 'Program name',
                'type' => 'text',
                'tab' => 'Programs Details'
            ],
            [
                'name' => 'description',
                'label' => 'Program description',
                'type' => 'ckeditor',
                'tab' => 'Programs Details'
            ],
            [
                'name' => 'video_link',
                'label' => 'Video link',
                'type' => 'video',
                'tab' => 'Programs Details',
                'youtube_api_key' => env('GOOGLE_API_KEY', '')
            ],
            [
                'name' => 'oneOff_price',
                'label' => 'One off price',
                'type' => 'number',
                'prefix' => '$',
                'suffix' => ' NZD',
                'decimals' => 2,
                'dec_point' => ',',
                'thousands_sep' => '.',
                'attributes' => ['step' => 'any'],
                'wrapper' => ['class' => 'form-group col-md-6'],
                'tab' => 'Programs Details',
            ],
            [
                'name' => 'subscription_price',
                'label' => 'Subscriber price',
                'type' => 'number',
                'prefix' => '$',
                'suffix' => ' NZD',
                'decimals' => 2,
                'dec_point' => ',',
                'thousands_sep' => '.',
                'attributes' => ['step' => 'any'],
                'wrapper' => ['class' => 'form-group col-md-6'],
                'tab' => 'Programs Details',
            ],

            [
                'name' => 'status',
                'label' => 'Status',
                'type' => 'select2_from_array',
                'options' => [
                    'including' => 'Including',
                    'unpublished' => 'Unpublished',
                    'published' => 'Published',
                    'draft' => 'Draft',
                ],
                'tab' => 'Programs Details'
            ],
            [
                'name' => 'date',
                'label' => 'Publish date',
                'type' => 'date',
                'tab' => 'Modules & Stepping Stones'
            ],
            [
                'name'      => 'modules', // the method that defines the relationship in your Model
                'label'     => 'Module name',
                'type'      => 'relationship',
                'entity'    => 'modules', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                // 'model' => "App\Models\Module",
                // 'ajax' => true,
                'inline_create' => [
                    'entity'      => 'module',
                    'modal_class' => 'modal-dialog modal-xl',
                ],
                // 'data_source' => backpack_url('program/fetch/module'),
                'tab' => 'Modules & Stepping Stones',
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
