<?php

namespace App\DataTables;

use App\Models\TradeIn;
use App\Models\TradeImage;
use App\User;
use App\Models\Action;
use App\Models\Role;
use App\Models\AdminPermission;
use Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TradeInDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $status_action = Action::where('action_slug','status')->first();
        $checkStatusAction = Role::where('name_slug','trade_in')->whereRaw("find_in_set('".$status_action->id."',action_id)")->first();
        $roles = Role::where('name_slug','trade_in')->first();
        $checkStatusPermission = AdminPermission::where('user_id',Auth::user()->id)->whereRaw("find_in_set('status',action_id)")->first();

        return datatables()
            ->eloquent($query)
            ->editColumn('image', function($row) {
                $image = TradeImage::where('trade_id',$row->image)->first();
                if (!empty($image)) {
                    $url = url('/public/admin/clip-one/assets/trade_images').'/'.$image->image;
                    return '<img alt="Avatar" src="'.$url.'" width="100px">';
                }else{
                    return '<ul class="list-inline"><li class="list-inline-item"><img alt="Avatar" class="table-avatar" src=""></li></ul>';
                }
            })
            ->editColumn('quote', function($row) use ($roles) {
                $action_ids = explode(',', $roles->action_id);
                $btn = '';
                foreach ($action_ids as $key => $action_id) {
                    $action = Action::find($action_id);
                    $checkPermission = AdminPermission::where('user_id',Auth::user()->id)->whereRaw("find_in_set('".$action->action_slug."',action_id)")->first();

                    if (!empty($checkPermission) || Auth::user()->user_type == 'admin') {
                        if ($action->action_slug == 'view' || $action->action_slug == 'password') {
                            $btn .= '<a href="'.route("quotes.$action->action_slug",$row->quote).'" class="btn btn-'.$action->class.' btn-sm" data-placement="top" data-original-title="'.$action->action_title.'" onclick="return confirm("Are you sure?")"><i class="'.$action->icon.'"></i>'.$action->action_title.'</a>&nbsp;';
                        }
                    }
                }
                return $btn;
            })
            ->editColumn('action', function($row) use ($roles) {
                $action_ids = explode(',', $roles->action_id);
                $btn = '';
                foreach ($action_ids as $key => $action_id) {
                    $action = Action::find($action_id);
                    $checkPermission = AdminPermission::where('user_id',Auth::user()->id)->whereRaw("find_in_set('".$action->action_slug."',action_id)")->first();

                    if (!empty($checkPermission) || Auth::user()->user_type == 'admin') {
                        if ($action->action_slug == 'edit' || $action->action_slug == 'delete' || $action->action_slug == 'password') {
                            $btn .= '<a href="'.route("trade_in.$action->action_slug",$row->id).'" class="btn btn-'.$action->class.' btn-sm" data-placement="top" data-original-title="'.$action->action_title.'" onclick="return confirm("Are you sure?")"><i class="'.$action->icon.'"></i>'.$action->action_title.'</a>&nbsp;';
                        }
                    }
                }
                return $btn;
            })
            ->escapeColumns([]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ActionDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(TradeIn $model)
    {
        //return $model->newQuery();
        $data = TradeIn::join('quotes','trade_ins.quote_id','=','quotes.id')
                        ->join('leads','quotes.lead_id','=','leads.id')
                        ->select('trade_ins.*','leads.title as lead_name','trade_ins.id as image','trade_ins.quote_id as quote');

        return $this->applyScopes($data);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(0,'ASC');
                    // ->buttons(
                    //     Button::make('export'),
                    //     Button::make('print')
                    // );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id'=> [
                'title' => 'Sr. No.', 
                'orderable' => true, 
                'searchable' => false, 
                'render' => function() {
                        return 'function(data,type,fullData,meta){return meta.settings._iDisplayStart+meta.row+1;}';
                    }
            ],
            'lead_name',
            'image',
            'make',
            'model',
            'year',
            'hours',
            'quote',
            'action' => [
                'searchable' => false,
                'visible' => true, 
                'printable' => false, 
                'exportable' => false
            ],
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Export_' . date('YmdHis');
    }
}
