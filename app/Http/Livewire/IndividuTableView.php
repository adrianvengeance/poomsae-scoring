<?php

namespace App\Http\Livewire;

use App\Actions\ActivateIndividuAction;
use App\Filters\IndividuCategoryFilter;
use App\Filters\IndividuClassFilter;
use App\Filters\IndividuGenderFilter;
use App\Models\Participants;
use Illuminate\Contracts\Database\Eloquent\Builder;
use LaravelViews\Facades\Header;
use LaravelViews\Facades\UI;
use LaravelViews\Views\TableView;

class IndividuTableView extends TableView
{
    /**
     * Sets a model class to get the initial data
     */
    // protected $model = User::class;
    public function repository(): Builder
    {
        return Participants::individu();
    }

    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return [
            Header::title('Session')->sortBy('session'),
            "Status",
            'Ranking',
            'Name',
            'Birthdate',
            Header::title('Age')->sortBy('birthdate'),
            'Gender',
            Header::title('Dojang')->sortBy('dojang'),
            'Tipe',
            Header::title('Category')->sortBy('caategory'),
            Header::title('Class')->sortBy('class'),
        ];
    }

    /**
     * Sets the data to every cell of a single row
     *
     * @param $model Current model for each row
     */
    public function row($model): array
    {
        return [
            $model->session,
            $this->showStatus($model->status),
            UI::editable($model, 'ranking'),
            // $model->ranking,
            $model->name,
            $model->birthdate,
            date_diff(date_create($model->birthdate), date_create('today'))->y,
            // floor((time() - strtotime($model->birthdate)) / 31556926),
            strtolower($model->gender) == "m" ? "Male" : "Female",
            $model->dojang,
            $model->type,
            $model->category,
            $model->class,
        ];
    }

    public $paginate = 20;
    public $searchBy = ['name', 'dojang'];

    private function showStatus($status)
    {
        $url = route('active');
        $print = "";
        switch ($status) {
            case 'active':
                $print = '<span class="badge text-bg-info"><a class="link-offset-2 link-underline link-underline-opacity-0" href="' . $url . '">Judging</a></span>';
                // $print = '<a class="link-offset-2 link-underline link-underline-opacity-0" href="{{ route(' . 'active' . ') }}">Judging</a>';
                break;
            case 'inactive':
                $print = '<span class="badge text-bg-secondary">Finished</span>';
                break;
            default:
                $print = '';
                break;
        }
        return $print;
    }

    protected function filters()
    {
        return [
            new IndividuGenderFilter,
            new IndividuClassFilter,
            new IndividuCategoryFilter
        ];
    }

    protected function bulkActions()
    {
        return [
            new ActivateIndividuAction,
        ];
    }

    public function update(Participants $participants, $data)
    {
        $participants->update($data);
    }
}
