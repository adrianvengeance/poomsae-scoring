<?php

namespace App\Http\Livewire;

use App\Actions\DeactivateIndividuAction;
use App\Models\Participants;
use Illuminate\Contracts\Database\Eloquent\Builder;
use LaravelViews\Facades\UI;
use LaravelViews\Views\TableView;

class IndividuActiveTableView extends TableView
{
    /**
     * Sets a model class to get the initial data
     */
    public function repository(): Builder
    {
        return Participants::activeIndividu();
    }

    /**
     * Sets the headers of the table as you want to be displayed
     *
     * @return array<string> Array of headers
     */
    public function headers(): array
    {
        return [
            "Name - Dojang",
            "A1",
            "P1",
            "A2",
            "P2",
            "A3",
            "P3",
            "A4",
            "P4",
            "A5",
            "P5",
            "A6",
            "P6",
            "Accuracy",
            "Presentation",
            "Total",
            "Ranking"
        ];
    }

    /**
     * Sets the data to every cell of a single row
     *
     * @param $model Current model for each row
     */
    public function row($model): array
    {
        $acc = explode(',', $model->acc_scores);
        $pre = explode(',', $model->pre_scores);
        return [
            $model->name . ' ' . $model->dojang,
            $acc[0] ?? '',
            $pre[0] ?? '',
            $acc[1] ?? '',
            $pre[1] ?? '',
            $acc[2] ?? '',
            $pre[2] ?? '',
            $acc[3] ?? '',
            $pre[3] ?? '',
            $acc[4] ?? '',
            $pre[4] ?? '',
            $acc[5] ?? '',
            $pre[5] ?? '',
            $model->sum_acc,
            $model->sum_pre,
            $model->total,
            UI::editable($model, 'ranking')
        ];
    }

    protected function bulkActions()
    {
        return [
            new DeactivateIndividuAction,
        ];
    }

    public function update(Participants $participants, $data)
    {
        $participants->update($data);
    }
}
