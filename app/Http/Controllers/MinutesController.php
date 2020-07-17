<?php
/**
 * Created by PhpStorm.
 * User: Faith Kilonzi
 * Date: 7/15/2020
 * Time: 1:09 PM
 */

namespace App\Http\Controllers;

use App\Classes\ToastNotification;
use App\Minute;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class MinutesController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth')->except('verify_user');
    }


    public function index(){
        $minutes = Minute::all();
        $current_user =  Auth::id();
        return view('minutes.index',compact('minutes','current_user'));
    }

    public function createMeeting(){
        $organizer_id = Auth::id();
        $users = User::all();
        return view('minutes.create_meeting',compact('organizer_id','users'));
    }
    public function saveMinute(Request $request){

//        $this->validate($request, [
//            'meeting_title' => 'required|string|max:255',
//            'purpose' => 'string',
//            'organization' => 'string',
//            'start_date' =>'required|date',
//            'end_date' => 'required|date|after:start_date',
//            'meeting_notes' => 'required|string',
//        ]);

        $minute = new Minute();
        $minute->organizer_id = Auth::id();
        $minute->meeting_title = $request->meeting_title;
        $minute->purpose = $request->purpose;
        $minute->organization = $request->organization;
        $minute->start_date = $request->start_date;
        $minute->end_date = $request->end_date;
        $minute->meeting_notes = $request->meeting_notes;

        //time to add participants

        $participants = $request->participants;

        $saved= $minute->save();
        if($saved){
            foreach($participants as $p){
                $data = array('meeting_id'=>$minute->id,'participant_id'=>$p);
                DB::table('meeting_participants')->insert($data);
            }
        }
        if(!$saved) {
            notify(new ToastNotification('Error!', 'Failed to add a new Meeting!', 'error'));
            return back()->withInput();
        }
        notify(new ToastNotification('Successful!', 'Meeting Minutes added!', 'success'));
        return back();




    }

    public function editMinute($meeting_id){
        $organizer_id = Auth::id();
        $this_minute = Minute::find($meeting_id)->first();
        return view('minutes.edit_minutes',compact('meeting_id','this_minute','organizer_id'));
    }


    public function updateMinute(Request $request){

        //        $this->validate($request, [
//            'meeting_title' => 'required|string|max:255',
//            'purpose' => 'string',
//            'organization' => 'string',
//            'start_date' =>'required|date',
//            'end_date' => 'required|date|after:start_date',
//            'meeting_notes' => 'required|string',
//        ]);
        $minute = Minute::find($request->minute_id);
        $minute->update([
            'organizer_id'=> Auth::id(),
            'meeting_title' => $request->meeting_title,
            'purpose' => $request->purpose,
            'organization' => $request->organization,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'meeting_notes' => $request->meeting_notes,
        ]);

        notify(new ToastNotification('Successful!', 'The Minutes Have been Updated!', 'success'));
        return back();

    }


    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteMinute($id)
    {
        $id = Crypt::decrypt($id);
        Minute::destroy($id);

        notify(new ToastNotification('Successful!', 'Minute Deleted!', 'success'));
        return back();

    }

    public function searchMinutes(Request $request){
        $search_string = $request->search_value;

        // searching multiple columns in one go
        $minutes = Minute::whereLike(['meeting_title', 'purpose','organization','meeting_notes'], $search_string)->get();
        $current_user =  Auth::id();
        $the_view = view('minutes.search_results', compact('minutes','current_user'))->render();

        return response()->json(['the_view'=>$the_view]);
    }


    public function filterMinutes(Request $request){
        $minutes = Minute::all();
        $users = User::all();

        return view('minutes.filter_form',compact('minutes','users'));
    }
    public function filterResultsMinutes(Request $request){

        $minutes = DB::table('minutes')
                    ->join ('meeting_participants','meeting_participants.meeting_id','=','minutes.id');


        foreach ($request->filter_by as $filter) {
            if ($filter == "date") {
                if (isset($request->date)) {
                    $minutes = $minutes->where('start_date', $request->date)
                        ->orWhere('end_date', $request->date);
                }
            }
            if ($filter == "organization") {
                if (isset($request->organization)) {
                    $minutes = $minutes->where('organization', $request->organization);
                }
            }
            if ($filter == "purpose") {
                if (isset($request->purpose)) {
                    $minutes = $minutes->where('purpose', $request->purpose);
                }
            }
            if ($filter == "participants") {
                if (isset($request->participants)) {
                    $minutes=$minutes->whereIn('participant_id',$request->participants);
                }
            }
        }

        $minutes = $minutes->get();
        $users = User::all();


        return view('minutes.filter_form',compact('minutes','users'));
    }

    public function add_filter(){
        $filtercount = rand ( 10000 , 99999 );
        $minutes = Minute::all();
        $users = User::all();

        return view('minutes.add_filter',compact('filtercount','minutes','users'));
    }

    public function viewMeeting(Request $request,$id){
        $m_id = Crypt::decrypt($id);
        $this_minute = Minute::find($m_id);

        $organizer = User::where('id',$this_minute->organizer_id)->first();
        $users = User::all();
        $attendants = DB::table('meeting_participants')
                        ->join('users','meeting_participants.participant_id','=','users.id')
                        ->where('meeting_participants.meeting_id','=',$this_minute->id)
                        ->get();

        return view('minutes.minute_profile',compact('this_minute','organizer','users','attendants'));
    }








}