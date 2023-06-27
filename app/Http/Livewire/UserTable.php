<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};
// use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\SoftDeletes;

final class UserTable extends PowerGridComponent
{
    use ActionButton;

    //  public int $perPage = 5;
    
    //  public array $perPageValues = [0, 5, 10, 20, 50];

    public ?array $name = [];
    public ?array $email = [];

    public function setUp(): array
    {
        $this->showCheckBox();
        $this->persist(['columns', 'filters','deletes']);

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()
                ->showSearchInput()
                ->showToggleColumns()->showSoftDeletes(),
            Footer::make()
                // ->showPerPage($this->perPage, $this->perPageValues)
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */

    /**
    * PowerGrid datasource.
    *
    * @return Builder<\App\Models\User>
    */
    public function datasource(): Builder
    {
        // return User::withTrashed();
        return User::query();
        
        // return User::query()->with('roles');
        // return User::query()->with('client');
        
        // return User::query()->leftJoin('clients',function($clients){
        //     $clients->on('clients.user_id', '=', 'users.id');
        // })
        // ->select([
        //     'users.*',
        //     'clients.name as nom_cliente',
        //     'clients.surname as ape_cliente',

        // ]);

    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */

    /**
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
    public function relationSearch(): array
    {
        return [
            'roles' => [ // relationship on dishes model
                'name', // column enabled to search
            ],
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    | ❗ IMPORTANT: When using closures, you must escape any value coming from
    |    the database using the `e()` Laravel Helper function.
    |
    */
    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('id')
            ->addColumn('name')

           /** Example of custom column using a closure **/
            // ->addColumn('name_lower', function (User $model) {
            //     return strtolower(e($model->name));
            // })

            ->addColumn('email')
            // ->addColumn('client')
            // ->addColumn('roles', fn(User $user )=> $user->role->name)
            ->addColumn('roles', function (User $model) {
                if(e($model->getRoleNames()->implode(', ')) === ""){
                    return '<span class=" bg-red-500 text-white badge p-2 text-bold">NO</span>';

                }else{                   
                    return '<span class="bg-sky-500 text-white badge p-2 text-bold">'. e(strtoupper($model->getRoleNames()->implode(', ') )) .'</span>';
                }
            })
            ->addColumn('created_at_formatted', fn (User $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'))
            ->addColumn('updated_at_formatted', fn (User $model) => Carbon::parse($model->updated_at)->format('d/m/Y H:i:s'));
    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */

     /**
     * PowerGrid Columns.
     *
     * @return array<int, Column>
     */
    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
            ->sortable()
            ->makeInputRange(),

            Column::make('NAME', 'name')
                ->sortable()
                ->searchable()
                ->makeInputText()
                ->editOnClick(auth()->user()->hasRole('super')),

            Column::make('EMAIL', 'email')
                ->sortable()
                ->searchable()
                ->makeInputText()
                ->editOnClick(auth()->user()->hasRole('super')),

            Column::add()
                ->title('ROLES')
                ->field('roles'),
                // ->sortable(),
                // ->searchable(),
                // ->makeInputSelect(Role::all(),'name','id', ['live-search' => true]),
                // ->makeInputSelect(User::all(),'roles' ,'roles', ['live-search' => true]),
                // ->makeInputText(),
            
            // Column::add()
            //     ->title('APELLIDOS')
            //     ->field('ape_cliente')
            //     ->sortable()
            //     ->searchable()
            //     ->makeInputText(),

            Column::make('CREATED AT', 'created_at_formatted', 'created_at')
                ->searchable()
                ->sortable()
                // ->bodyAttribute('text-center', 'color:red')
                ->makeInputDatePicker(),

            Column::make('UPDATED AT', 'updated_at_formatted', 'updated_at')
                ->searchable()
                ->sortable()
                // ->headerAttribute('text-center', 'color:red')
                ->makeInputDatePicker(),

        ]
;
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

     /**
     * PowerGrid User Action Buttons.
     *
     * @return array<int, Button>
     */
    
    public function actions(): array
    {
       return [
           Button::make('edit', '<i class="fas fa-edit"></i>')
               ->class('bg-blue-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
               ->target('')
               ->route('user.edit', ['user' => 'id'])
               ->tooltip('Editar Usuario'),
        
            Button::make('show', '<i class="fas fa-edit"></i>')
               ->class('bg-blue-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
               ->target('')
               ->route('user.edit', ['user' => 'id'])
               ->tooltip('Mostrar Usuario'),

           Button::make('delete', '<i class="fas fa-trash"></i>')
               ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
               ->id('delete')
               ->target('')
               ->route('user.delete', ['user' => 'id'])
            //    ->can(auth()->user()->hasRole('empleado'))
               ->method('delete')
               ->tooltip('Eliminar Usuario'),
            
           Button::make('restore', '<i class="fas fa-trash-restore"></i> Restaurar')
               ->class('bg-emerald-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
               ->target('')
               ->route('user.restore', ['user' => 'id'])
            //    ->can(auth()->user()->hasRole('empleado'))
               ->method('post')
               ->tooltip('Restaurar Usuario'),
               
            // Button::add('buttons.delete')
            //     // ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
            //     ->bladeComponent('buttons.delete', ['user' => 'id']),
        ];
    }
    

    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

     /**
     * PowerGrid User Action Rules.
     *
     * @return array<int, RuleActions>
     */

    
    public function actionRules(): array
    {
       return [


            // Rule::rows()
            //     ->when(fn($user) => $user->getRoleNames()->implode(', ') === "cliente")
            //     ->setAttribute('class','bg-green-100'),

            // Rule::rows()
            //     ->when(fn($user) => $user->getRoleNames()->implode(', ') === "empleado")
            //     ->setAttribute('class','bg-sky-100'),
            
            // Rule::rows()
            //     ->when(fn($user) => $user->getRoleNames()->implode(', ') === "admin")
            //     ->setAttribute('class','bg-yellow-100'),

            Rule::button('delete')
              ->when(fn ($user) => $user->trashed() == true)
              ->hide()
              ->disable(),

            Rule::button('restore')
              ->when(fn ($user) => $user->trashed() == false)
              ->hide(),

            Rule::rows()
              ->when(fn ($user) => $user->trashed() == true)
              ->setAttribute('class', 'bg-red-100 hover:bg-red-200'),
        ];
    }
    

    public function onUpdatedEditable(string $id, string $field, string $value): void
    {

        try {
            // Update query
            $updated = User::query()
                ->find($id)
                ->update([
                    $field => $value
                ]);

        } catch (QueryException $exception) {
            $updated = false;
        }

        // Reload data after a successful update
        if ($updated) {

            $this->fillData();
        }

    }

    // public function updateMessages(string $status, string $field = 'default_message')
    // {
    //     $updateMessages = [
    //         'success' => [
    //             'default_message' => __('Actualizado con éxito'),
    //         ],
    //         'error' => [
    //             'default_message' => __('Error al actualizar'),
    //         ]
    //     ];

    //     return ($updateMessages[$status][$field] ?? $updateMessages[$status]['default_message']);
    // }

    protected function getListeners()
    {
        return array_merge(
            parent::getListeners(),
            [
                'rowActionEvent',
            ]);
    }

    public function rowActionEvent(array $data): void
    {
        $message = $data['user'];

        $this->dispatchBrowserEvent('showAlert', ['message' => $message]);
    }

}
