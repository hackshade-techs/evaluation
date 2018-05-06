<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\EvaluationRequest as StoreRequest;
use App\Http\Requests\EvaluationRequest as UpdateRequest;

class EvaluationCrudController extends CrudController
{
    public function setup()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Evaluation');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/evaluation');
        $this->crud->setEntityNameStrings('evaluation', 'evaluations');

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

        $this->crud->setFromDb();

        // ------ CRUD FIELDS
        $this->crud->addField([
            // 1-n relationship
            'label' => "Choose a Course Unit to Evaluate", // Table column heading
            'type' => "select2_from_ajax",
            'name' => 'course_unit_id', // the column that contains the ID of that connected entity
            'entity' => 'courseUnit', // the method that defines the relationship in your Model
            'attribute' => "name", // foreign key attribute that is shown to user
            'model' => "App\Models\CourseUnit", // foreign key model
            'data_source' => url("api/courseunit"), // url to controller search function (with /{id} should return model)
            'placeholder' => "Select a Course Unit", // placeholder for the select
            'minimum_input_length' => 1, // minimum characters to type before querying results
        ]);

        $this->crud->addField([
            'name'    => 'structure', // the name of the db column
            'label'   => 'How is the current structure of the course unit?', // the input label
            'type'    => 'radio',
            'options' => [ // the key will be stored in the db, the value will be shown as label;
                0 => 'poor',
                1 => 'fair',
                2 => 'good',
                3 => 'very good',
                4 => 'Excellent'
            ],
            // optional
            'inline' => true, // show the radios all on the same line?
            'tab'    => 'Course Unit',
        ]);

        $this->crud->addField([
            'name'    => 'how_it_is_taught', // the name of the db column
            'label'   => 'How is the course unit being taught currently?', // the input label
            'type'    => 'radio',
            'options' => [ // the key will be stored in the db, the value will be shown as label;
                0 => 'poor',
                1 => 'fair',
                2 => 'good',
                3 => 'very good',
                4 => 'Excellent'
            ],
            // optional
            'inline' => true, // show the radios all on the same line?
            'tab'    => 'Course Unit',
        ]);

        $this->crud->addField([
            'name'    => 'relevance', // the name of the db column
            'label'   => 'Is the course unit relevant in the course that you are offering?', // the input label
            'type'    => 'radio',
            'options' => [ // the key will be stored in the db, the value will be shown as label;
                0 => 'poor',
                1 => 'fair',
                2 => 'good',
                3 => 'very good',
                4 => 'Excellent'
            ],
            // optional
            'inline' => true, // show the radios all on the same line?
            'tab'    => 'Course Unit',
        ]);

        $this->crud->addField([
            'name'    => 'tutor', // the name of the db column
            'label'   => 'How would you rate the tutor delivering the course unit?', // the input label
            'type'    => 'radio',
            'options' => [ // the key will be stored in the db, the value will be shown as label;
                0 => 'poor',
                1 => 'fair',
                2 => 'good',
                3 => 'very good',
                4 => 'Excellent'
            ],
            // optional
            'inline' => true, // show the radios all on the same line?
            'tab'    => 'Course Unit',
        ]);

        $this->crud->addField([   // Summernote
            'name' => 'changes_suggested',
            'label' => 'What would you like to be changed in the course unit?',
            'type' => 'summernote',
            'tab' => 'Course Unit Changes'
            // 'options' => [], // easily pass parameters to the summernote JS initialization
        ]);

        $this->crud->addField([   // Summernote
            'name' => 'non_changes_suggested',
            'label' => 'What would you like to stay the same in the course unit?',
            'type' => 'summernote',
            'tab' => 'Course Unit Changes'
            // 'options' => [], // easily pass parameters to the summernote JS initialization
        ]);

        $this->crud->addField([
            'name'    => 'lecture_room', // the name of the db column
            'label'   => 'How would you rate the lecture rooms in which the course unit is taught?', // the input label
            'type'    => 'radio',
            'options' => [ // the key will be stored in the db, the value will be shown as label;
                0 => 'poor',
                1 => 'fair',
                2 => 'good',
                3 => 'very good',
                4 => 'Excellent'
            ],
            // optional
            'inline' => true, // show the radios all on the same line?
            'tab'    => 'Lecture Rooms',
        ]);

        $this->crud->addField([   // Summernote
            'name' => 'description_about_lecture_room',
            'label' => 'Write a brief description about the Lecture room?',
            'type' => 'summernote',
            'tab' => 'Lecture Rooms'
            // 'options' => [], // easily pass parameters to the summernote JS initialization
        ]);

        $this->crud->addField([   // Summernote
            'name' => 'recommendations',
            'label' => 'What are your recommendations for the course unit?',
            'type' => 'summernote',
            'tab' => 'Recommendations'
            // 'options' => [], // easily pass parameters to the summernote JS initialization
        ]);

        // $this->crud->addField($options, 'update/create/both');
        // $this->crud->addFields($array_of_arrays, 'update/create/both');
        // $this->crud->removeField('name', 'update/create/both');
        // $this->crud->removeFields($array_of_names, 'update/create/both');

        // ------ CRUD COLUMNS
        // $this->crud->addColumn(); // add a single column, at the end of the stack
        // $this->crud->addColumns(); // add multiple columns, at the end of the stack
        // $this->crud->removeColumn('column_name'); // remove a column from the stack
        // $this->crud->removeColumns(['column_name_1', 'column_name_2']); // remove an array of columns from the stack
        // $this->crud->setColumnDetails('column_name', ['attribute' => 'value']); // adjusts the properties of the passed in column (by name)
        // $this->crud->setColumnsDetails(['column_1', 'column_2'], ['attribute' => 'value']);

        // ------ CRUD BUTTONS
        // possible positions: 'beginning' and 'end'; defaults to 'beginning' for the 'line' stack, 'end' for the others;
        // $this->crud->addButton($stack, $name, $type, $content, $position); // add a button; possible types are: view, model_function
        // $this->crud->addButtonFromModelFunction($stack, $name, $model_function_name, $position); // add a button whose HTML is returned by a method in the CRUD model
        // $this->crud->addButtonFromView($stack, $name, $view, $position); // add a button whose HTML is in a view placed at resources\views\vendor\backpack\crud\buttons
        // $this->crud->removeButton($name);
        // $this->crud->removeButtonFromStack($name, $stack);
        // $this->crud->removeAllButtons();
        // $this->crud->removeAllButtonsFromStack('line');

        // ------ CRUD ACCESS
        if (!auth()->user()->hasRole('student')) $this->crud->denyAccess(['create']);
        if (auth()->user()->hasRole('student')) $this->crud->denyAccess(['list', 'update', 'reorder', 'delete']);
        // $this->crud->allowAccess(['list', 'create', 'update', 'reorder', 'delete']);
        // $this->crud->denyAccess(['list', 'create', 'update', 'reorder', 'delete']);

        // ------ CRUD REORDER
        // $this->crud->enableReorder('label_name', MAX_TREE_LEVEL);
        // NOTE: you also need to do allow access to the right users: $this->crud->allowAccess('reorder');

        // ------ CRUD DETAILS ROW
         $this->crud->enableDetailsRow();
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
}
