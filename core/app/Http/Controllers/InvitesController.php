<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Competitor;
use App\Models\CompetitorSetting;
use App\Models\Property;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;
use App\Events\ImageDownloadCompetitor;
use App\Events\ReviewsCountScrapeCompetitor;
use App\Models\Invite;
use App\Constants\Status;
use Yajra\DataTables\DataTables;

class InvitesController extends Controller
{
    //
    public function index(Request $request): View|JsonResponse
    {
        
        if ($request->ajax()) {
            return $this->getData();
        } else {
            $pageTitle   = 'Invites';
            return view('invites.list', compact('pageTitle'));           
        }        

    }
    public function getData()
    {
       
        $data = DataTables::of(Invite::select('id', 'name', 'email', 'phone'))
             ->addColumn('action', function ($invite) {
                $return = '<div class="d-flex justify-content-end">';
                $return .= '<button class="btn btn-sm me-1 general-modal-button" data-action="'.route('invites.edit', $invite->id).'" >
                                    <i class="fas fa-file-edit fa-lg"></i>
                                </button>';
                $return .= '<button class="btn btn-sm confirmationBtn" data-action="'.route('invites.delete', $invite->id).'" data-question="'.__('Are you sure to delete this record?').'">
                                    <i class="fa-solid fa-trash-alt fa-lg"></i>
                                </button>';
                $return .= '</div>';
                return $return;
             })
            ->toArray();
            // general-modal-button" data-action="{{ route('invites.edit', 1) }}
        return generate_datatables($data);        

    }
    public function store(Request $request)
    {

        if ($request->isMethod('get')) {
            $data = [];
            $view = view('invites.form', $data)->render();
            $title = __('Add invite');

            return response()->json(['html' => $view, 'title' => $title, 'classXl' => true]);
        }else{
            $request->validate([
                'name'              => 'required|string|max:250',
                'email'             => 'required|email|max:255',
                'phone'             => 'required|string|max:20',
            ]);

            $invite               = new Invite();
            $invite->name         = $request->name;
            $invite->email        = $request->email;
            $invite->phone        = $request->phone;
            $invite->client_id    = 5;
            $saved = $invite->save(); 
            
            if($saved) {
                $message = __('Invites created successfully');
                $notify = ['success' => $message, 'reloadTable' => 'invites-table', 'closeModal' => 'general-modal'];
            } else {
                $notify = ['error' => "Some error occured"];
            }    
            return response()->json($notify);        
        }

    }

    public function edit(Request $request,$id)
    {
        $invite = Invite::find($id);
        if ($request->isMethod('get')) {
           

            $data['invite'] = Invite::find($id);

            $view = view('invites.form', $data)->render();
            $title = __('Add invite');

            return response()->json(['html' => $view, 'title' => $title, 'classXl' => true]);
        }else{

            $request->validate([
                'name'              => 'required|string|max:250',
                'email'             => 'required|email|max:255',
                'phone'             => 'required|string|max:20',
            ]);            


            $updateInvite = Invite::find($id);
            $updateInvite->name = $request->name;
            $updateInvite->email = $request->email;
            $updateInvite->phone = $request->phone;
            $updateInvite->save();

            if($updateInvite->save()) {
                $message = __('Invites edited successfully');
                $notify = ['success' => $message, 'reloadTable' => 'invites-table', 'closeModal' => 'general-modal'];
            } else {
                $notify = ['error' => "Some error occured"];
            }

            return response()->json($notify);            
        }


    }
    public function delete(Request $request, $id)
    {
        $invite = Invite::find($id);
        if ($invite) {
            $invite->delete();
            $message = __('Invite deleted successfully');
            $notify = ['success' => $message, 'reloadTable' => 'invites-table', 'closeModal' => 'confirmationModal'];
        } else {
            $notify = ['error' => __('Invite not found')];
        }
        return response()->json($notify);
    }

    private function validateRequest(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:250',
            ],
            'email' => [
                'required',
                'email',
                'max:255',
            ],
            'phone' => [
                'required',
                'string',
                'max:20',
            ],
        ]);
    }    
}
