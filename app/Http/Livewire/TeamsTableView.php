<?php

namespace App\Http\Livewire;

use App\Models\Teams;
use Illuminate\Contracts\Database\Eloquent\Builder;
use LaravelViews\Facades\Header;
use LaravelViews\Facades\UI;
use LaravelViews\Views\TableView;

class TeamsTableView extends TableView
{
    public function repository(): Builder
    {
        return Teams::findAll();
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
            Header::title('Tipe')->sortBy('type'),
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
}
