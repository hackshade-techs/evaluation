<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\LecturerRequest as StoreRequest;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\LecturerRequest as UpdateRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;

class LecturerCrudController extends CrudController
{
    public function setup()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
         */
        $this->crud->setModel('App\Models\Lecturer');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/lecturer');
        $this->crud->setEntityNameStrings('lecturer', 'lecturers');

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
         */

        $this->crud->setFromDb();

        // ------ CRUD FIELDS
        $this->crud->addField([ // Select2
            'label' => "Department",
            'type' => 'select2',
            'name' => 'department_id', // the db column for the foreign key
            'entity' => 'department', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model' => "App\Models\Department", // foreign key model
        ]);

        $this->crud->addField([ // Browse
            'name' => 'image',
            'label' => 'Image',
            'type' => 'browse',
        ]);

        $this->crud->addField([ // date_picker
            'name' => 'date_of_birth',
            'type' => 'date_picker',
            'label' => 'Date of Birth',
            // optional:
            'date_picker_options' => [
                'todayBtn' => true,
                'format' => 'dd-mm-yyyy',
                'language' => 'fr',
            ],
        ]);

        $this->crud->addField([ // select_from_array
            'name' => 'gender',
            'label' => "Gender",
            'type' => 'select2_from_array',
            'options' => ['male' => 'Male', 'female' => 'Female'],
            'allows_null' => false,
            'default' => 'one',
            // 'allows_multiple' => true, // OPTIONAL; needs you to cast this to array in your model;
        ]);
        // $this->crud->addField($options, 'update/create/both');
        // $this->crud->addFields($array_of_arrays, 'update/create/both');
        // $this->crud->removeField('name', 'update/create/both');
        // $this->crud->removeFields($array_of_names, 'update/create/both');

        // ------ CRUD COLUMNS
        $this->crud->addColumn([
            // 1-n relationship
            'label' => "Department", // Table column heading
            'type' => "select",
            'name' => 'department_id', // the column that contains the ID of that connected entity;
            'entity' => 'department', // the method that defines the relationship in your Model
            'attribute' => "name", // foreign key attribute that is shown to user
            'model' => "App\Models\Department", // foreign key model
        ]);

        $this->crud->addColumn([
            'name' => 'image', // The db column name
            'label' => "Profile image", // Table column heading
            'type' => 'image',
            // 'prefix' => 'folder/subfolder/',
            // optional width/height if 25px is not ok with you
            // 'height' => '30px',
            // 'width' => '30px',
        ]);

        $this->crud->removeColumn('email');
        $this->crud->removeColumn('date_of_birth');
        $this->crud->removeColumn('employee_code');
        // $this->crud->addColumn(); // add a single column, at the end of the stack
        // $this->crud->addColumns(); // add multiple columns, at the end of the stack
        // $this->crud->removeColumn('column_name'); // remove a column from the stack
        // $this->crud->removeColumns(['column_name_1', 'column_name_2']); // remove an array of columns from the stack
        // $this->crud->setColumnDetails('column_name', ['attribute' => 'value']); // adjusts the properties of the passed in column (by name)
        // $this->crud->setColumnsDetails(['column_1', 'column_2'], ['attribute' => 'value']);

        // ------ CRUD BUTTONS
        // possible positions: 'beginning' and 'end'; defaults to 'beginning' for the 'line' stack, 'end' for the others;
        if (auth()->user()->hasRole('student')){

            $this->crud->addButtonFromModelFunction('line', 'report_lecturer', 'reportLecturer', 'beginning');
        }

        // $this->crud->addButton($stack, $name, $type, $content, $position); // add a button; possible types are: view, model_function
        // $this->crud->addButtonFromModelFunction($stack, $name, $model_function_name, $position); // add a button whose HTML is returned by a method in the CRUD model
        // $this->crud->addButtonFromView($stack, $name, $view, $position); // add a button whose HTML is in a view placed at resources\views\vendor\backpack\crud\buttons
        // $this->crud->removeButton($name);
        // $this->crud->removeButtonFromStack($name, $stack);
        // $this->crud->removeAllButtons();
        // $this->crud->removeAllButtonsFromStack('line');

        // ------ CRUD ACCESS
        if (auth()->user()->hasRole('student')) $this->crud->denyAccess(['create', 'update', 'reorder']);
        // $this->crud->allowAccess(['list', 'create', 'update', 'reorder', 'delete']);
        // $this->crud->denyAccess(['list', 'create', 'update', 'reorder', 'delete']);

        // ------ CRUD REORDER
        // $this->crud->enableReorder('label_name', MAX_TREE_LEVEL);
        // NOTE: you also need to do allow access to the right users: $this->crud->allowAccess('reorder');

        // ------ CRUD DETAILS ROW
        // $this->crud->enableDetailsRow();
        // NOTE: you also need to do allow access to the right users: $this->crud->allowAccess('details_row');
        // NOTE: you also need to do overwrite the showDetailsRow($id) method in your EntityCrudController to show whatever you'd like in the details row OR overwrite the views/backpack/crud/details_row.blade.php

        // ------ REVISIONS
        // You also need to use \Venturecraft\Revisionable\RevisionableTrait;
        // Please check out: https://laravel-backpack.readme.io/docs/crud#revisions
        // $this->crud->allowAccess('revisions');

        // ------ AJAX TABLE VIEW
        // Please note the drawbacks of this though:
        // - 1-n and n-n columns are not searchable
        // - date and datetime columns won't be sortable anymore
        // $this->crud->enableAjaxTable();

        // ------ DATATABLE EXPORT BUTTONS
        // Show export to PDF, CSV, XLS and Print buttons on the table view.
        // Does not work well with AJAX datatables.
        $this->crud->enableExportButtons();

        // ------ ADVANCED QUERIES
        // $this->crud->addClause('active');
        // $this->crud->addClause('type', 'car');
        // $this->crud->addClause('where', 'name', '==', 'car');
        // $this->crud->addClause('whereName', 'car');
        // $this->crud->addClause('whereHas', 'posts', function($query) {
        //     $query->activePosts();
        // });
        // $this->crud->addClause('withoutGlobalScopes');
        // $this->crud->addClause('withoutGlobalScope', VisibleScope::class);
        // $this->crud->with(); // eager load relationships
        // $this->crud->orderBy();
        // $this->crud->groupBy();
        // $this->crud->limit();

        $this->addCustomCrudFilters();
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function addCustomCrudFilters()
    {


        $this->crud->addFilter([ // text filter
            'type'  => 'text',
            'name'  => 'first',
            'label' => 'First Name',
        ],
            false,
            function ($value) { // if the filter is active
                $this->crud->addClause('where', 'first_name', 'LIKE', "%$value%");
            });

//        $this->crud->addFilter([  // Select2
//            'label' => "Department",
//            'type' => 'select2',
//            'name' => 'department_id', // the db column for the foreign key
//            'entity' => 'department', // the method that defines the relationship in your Model
//            'attribute' => 'name', // foreign key attribute that is shown to user
//            'model' => "App\Models\Department" // foreign key model
//        ],
//            false,
//            function () {
//                $this->crud->addClause()
//            });
    }
}
