<?php

namespace App\Helpers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class SimpleTable
{
    protected $data;
    protected $columns;
    protected $actions;
    protected $entityRoutePrefix;
    protected $actionColumnLabel;
    protected $config;

    /**
     * Defaultne hodnoty pre SimpleTableComponent, ak treba je mozne ich pretazit
     * zadefinovanim rovnakych konstant v konkretnom modeli
     */
    const NUMBER_OF_ROWS    = 50;
    const SORT_KEY          = 'created_at';
    const SORT_DIRECTION    = 'desc';
    const SEARCH            = [];
    const ITEMS_PER_PAGE    = ['50', '100', '150'];
    const SEARCHABLE        = true;

    /**
     * SimpleTable constructor.
     *
     * @param $columns array of columns desc
     * @param $data array of data, that shows in table
     * @param $entityRoutePrefix String define base url link for action button
     * @param array $config array of config table view (pagination, items par page, inline new ...atd)
     * @param null $actions array of action buttons
     */
    public function __construct($columns = [], $data = [], $entityRoutePrefix = '', $config = [], $actions = null)
    {
        $this->data = $data;
        $this->columns = $columns;
        $this->config = $config;
        $this->actionColumnLabel = __('general.Actions');

        if (is_null($actions)) {
            $this->entityRoutePrefix = $entityRoutePrefix;
            $this->actions = $this->getDefaultActions();
        } else {
            $this->actions = $actions;
        }
    }

    /**
     * Sets default actions 'Detail', 'Edit' and 'Delete' for every row in table
     *
     * @return array[]
     */
    private function getDefaultActions() {
        return [
            [
                'label' => 'visibility',
                'title' => __('general.Detail'),
                'key' => 'detail',
                'class' => 'btn btn-primary btn-sm mr-1',
                'url' => url(config('simple-table.route-prefix').'/'.$this->entityRoutePrefix.'/{id}')
            ],
            [
                'label' => 'edit',
                'title' => __('general.Edit'),
                'key' => 'edit',
                'class' => 'btn btn-primary btn-sm mr-1',
                'url' => url(config('simple-table.route-prefix').'/'.$this->entityRoutePrefix.'/{id}/edit')
            ],
            [
                'label' => 'delete',
                'title' => __('general.Delete'),
                'key' => 'delete',
                'class' => 'btn btn-sm btn-danger',
                'url' => url(config('simple-table.route-prefix').'/'.$this->entityRoutePrefix.'/{id}'),
                'dataToggle' => 'modal',
                'dataTarget' => '#modalConfirm',
                'modalText' => __('general.Confirmation delete')
            ]
        ];
    }

    public function orderBy($sort_key, $order_by)
    {
        $this->data->orderBy();
    }

    /**
     * Sends data to blade template, which contains Vue component => SimpleTableComponent
     *
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('admin.simple-table', ['config' => [
            'data' => $this->data,
            'columns' => $this->columns,
            'actions' => $this->actions,
            'config' => $this->config,
            'actionColumnLabel' => $this->actionColumnLabel,
        ]]);
    }
}
