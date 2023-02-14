<?php

namespace App\Http\Livewire;

use App\Models\Client;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class ClientTable extends PowerGridComponent
{
    use ActionButton;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()
                // ->showSearchInput()
                ->showToggleColumns(),
            Footer::make()
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
    * @return Builder<\App\Models\Client>
    */
    public function datasource(): Builder
    {
        return Client::query();
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
        return [];
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
            ->addColumn('dni')

           /** Example of custom column using a closure **/
            ->addColumn('dni_lower', function (Client $model) {
                return strtolower(e($model->dni));
            })

            ->addColumn('name')
            ->addColumn('surname')
            ->addColumn('phone')
            ->addColumn('first_address')
            ->addColumn('second_address')
            ->addColumn('city')
            ->addColumn('postal_code')
            ->addColumn('country')
            ->addColumn('created_at_formatted', fn (Client $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'))
            ->addColumn('updated_at_formatted', fn (Client $model) => Carbon::parse($model->updated_at)->format('d/m/Y H:i:s'));
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
                ->makeInputRange(),

            Column::make('DNI', 'dni')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('NAME', 'name')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('SURNAME', 'surname')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('PHONE', 'phone')
                ->makeInputRange(),

            Column::make('FIRST ADDRESS', 'first_address')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('SECOND ADDRESS', 'second_address')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('CITY', 'city')
                ->sortable()
                // ->searchable()
                ->makeInputSelect(Client::all(), 'city', 'id', ['live-search' => true]),
                // ->makeInputText(),

            Column::make('POSTAL CODE', 'postal_code')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('COUNTRY', 'country')
                ->sortable()
                ->searchable()
                ->makeInputText(),

            Column::make('CREATED AT', 'created_at_formatted', 'created_at')
                ->searchable()
                ->sortable()
                ->makeInputDatePicker(),

            Column::make('UPDATED AT', 'updated_at_formatted', 'updated_at')
                ->searchable()
                ->sortable()
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
     * PowerGrid Client Action Buttons.
     *
     * @return array<int, Button>
     */

    /*
    public function actions(): array
    {
       return [
           Button::make('edit', 'Edit')
               ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
               ->route('client.edit', ['client' => 'id']),

           Button::make('destroy', 'Delete')
               ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
               ->route('client.destroy', ['client' => 'id'])
               ->method('delete')
        ];
    }
    */

    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

     /**
     * PowerGrid Client Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($client) => $client->id === 1)
                ->hide(),
        ];
    }
    */
}
