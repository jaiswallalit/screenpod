<?php

namespace App\DataTables;

use App\Models\Lead;
use App\Models\SiteVisits;
use App\Models\LeadComment;
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

class SiteVisitDataTable extends DataTable
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
        $checkStatusAction = Role::where('name_slug','site_visits')->whereRaw("find_in_set('".$status_action->id."',action_id)")->first();
        $roles = Role::where('name_slug','site_visits')->first();
        $checkStatusPermission = AdminPermission::where('user_id',Auth::user()->id)->whereRaw("find_in_set('status',action_id)")->first();

        return datatables()
            ->eloquent($query)
            ->editColumn('status', function($row) {
                if($row->status == 'New'){
                    return '<a href="javascript:void(0)" class="btn btn-secondary btn-sm" onclick="return confirm("Are you sure want to change status?")">'.$row->status.'</a>';
                }elseif($row->status == 'In Progress'){
                    return '<a href="javascript:void(0)" class="btn btn-primary btn-sm" onclick="return confirm("Are you sure want to change status?")">'.$row->status.'</a>';
                }elseif ($row->status == 'On Hold') {
                    return '<a href="javascript:void(0)" class="btn btn-warning btn-sm" onclick="return confirm("Are you sure want to change status?")">'.$row->status.'</a>';
                }elseif ($row->status == 'Lost') {
                    return '<a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="return confirm("Are you sure want to change status?")">'.$row->status.'</a>';
                }else{
                    return '<a href="javascript:void(0)" class="btn btn-success btn-sm" onclick="return confirm("Are you sure want to change status?")">'.$row->status.'</a>';
                }
            })
            ->editColumn('action', function($row) use ($roles) {
                $action_ids = explode(',', $roles->action_id);
                $btn = '';
                foreach ($action_ids as $key => $action_id) {
                    $action = Action::find($action_id);
                    $checkPermission = AdminPermission::where('user_id',Auth::user()->id)->whereRaw("find_in_set('".$action->action_slug."',action_id)")->first();

                    if (!empty($checkPermission) || Auth::user()->user_type == 'admin') {
                        if ($action->action_slug == 'edit' || $action->action_slug == 'delete' || $action->action_slug == 'view' || $action->action_slug == 'password') {
                            $btn .= '<a style="margin-top: 5px;" href="'.route("site_visits.$action->action_slug",$row->id).'" class="btn btn-'.$action->class.' btn-sm" data-placement="top" data-original-title="'.$action->action_title.'" onclick="return confirm("Are you sure?")"><i class="'.$action->icon.'"></i>'.$action->action_title.'</a>&nbsp;';
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
    public function query(SiteVisits $model)
    {

        $d = $this->data;
        if (!empty($d['from']) || !empty($d['to']) || !empty($d['customer']) || !empty($d['status']) || !empty($d['user_id'])|| !empty($d['customer_id'])) {
            $queryData = SiteVisits::join('users','site_visits.user_id','=','users.id')
            ->join('customers','site_visits.customer_id','=','customers.id');
            if (!empty($d['from'])) {
                $queryData = $queryData->where('site_visits.date','>=',$d['from']);
            }
            if (!empty($d['to'])) {
                $queryData = $queryData->where('site_visits.date','<=',$d['to']);
            }
            // if (!empty($d['customer'])) {
            //     $queryData = $queryData->where('site_visits.customer_id',$d['customer']);
            // }
            if (!empty($d['status'])) {
                $queryData = $queryData->where('site_visits.status',$d['status']);
            }
            if (!empty($d['user_id'])) {
                $queryData = $queryData->where('site_visits.user_id',$d['user_id']);
            }
            if (!empty($d['customer'])) {
                $queryData = $queryData->where('site_visits.customer_id',$d['customer_id']);
            }
            $queryData = $queryData->select('site_visits.*','customers.name as customer_name');
            $queryData = $queryData->select('site_visits.*','users.name as sales_rep');
          
        }else{
            // $queryData = SiteVisits::join('users','site_visits.user_id','=','users.id')
            //                 ->select('site_visits.*','users.name as sales_rep');


                            $queryData = SiteVisits::join('users','site_visits.user_id','=','users.id')
                            ->join('customers','customers.id','=','site_visits.customer_id')
                            ->orderBy('id','desc')
                            ->select('site_visits.*','users.name as sales_rep','customers.name as customer_name');
        }
        
        
        return $this->applyScopes($queryData);

       // return $this->applyScopes($data);
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
                    ->dom('Bfrtip')
                    ->orderBy(0,'ASC')
                    ->buttons(
                        //Button::make(['csv','excel']),
                        Button::make('print')
                    );
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
                'location' => '#', 
                'orderable' => true, 
                'searchable' => false, 
                'render' => function() {
                        return 'function(data,type,fullData,meta){return meta.settings._iDisplayStart+meta.row+1;}';
                    }
            ],
            'sales_rep' => ['name' => 'users.name'],
            'customer_name' => ['name' => 'customers.name'],
            'location' => ['location' => 'Location'],
            'date',
            'email',
            'contact',
            'telephone',
            'lead_source',
            'email',
            'category',
            'model',
            
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