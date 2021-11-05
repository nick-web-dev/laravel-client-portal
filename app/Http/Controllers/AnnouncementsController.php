<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Models\SubscriptionLevel;

class AnnouncementsController extends Controller {
    public function index(Request $request) {
        // This is the laravel version of
        //   $limit = $_GET['limit'] ?? 1;
        $request->merge([
            'page' => max($request->page ?? 1, 1),
            'limit' => $request->limit ?? 20,
        ]);

        if( $request->has('v') && $request->ajax() ) {
            $set = Announcement::with('subscriptionLevels');

            // $filter = json_decode( $request->filter );
            // $group = json_decode( $request->group );
            // $sort = json_decode( $request->sort );

            // if( is_array( $group ) ){
            //     foreach ($group as $groupBy) {
            //         $set = $set->select( $groupBy->selector )->groupBy( $groupBy->selector );
            //     }
            // }

            // if( $filter && !is_array( $filter[0] ) ){
            //     if( $filter[0] == 'subscription_levels' ){
            //         $set = $set->where('subscription_levels.name', $filter[1], $filter[2]);
            //     } else if( isset( $filter[2] ) ){
            //         $set = $set->where($filter[0], $filter[1], $filter[2]);
            //     } else {
            //         $set = $set->where($filter[0], $filter[1], '');
            //     }
            // } else if( $filter && is_array( $filter[0] ) ) {
            //     foreach ($filter as $cond) {
            //         if( is_array( $cond ) ){
            //             if( isset( $cond[2] ) ){
            //                 $set = $set->orWhere($cond[0], $cond[1], $cond[2]);
            //             } else {
            //                 $set = $set->orWhere($cond[0], $cond[1], '');
            //             }
            //         }
            //     }
            // }

            // if( is_array( $sort ) ){
            //     foreach ($sort as $sorter) {
            //         if( $sorter->desc ){
            //             $set = $set->orderByDesc( $sorter->selector );
            //         } else {
            //             $set = $set->orderBy( $sorter->selector );
            //         }
            //     }
            // }

            // // dd( $set->toSql() );
            // $set = $set->skip( $request->skip )->take( $request->take );

            // $data = [];
            // if( $group ){
            //     foreach ($set->pluck( $group[0]->selector ) as $key) {
            //         array_push($data, [
            //             'key' => $key,
            //             'items' => null,
            //             'count' => 1
            //         ]);
            //     }
            // } else {
                $set = $set->get();
            // }

            return [
                // 'data' => $group ? $data : $set,
                'data' => $set,
                'totalCount' => $set->count()
            ];

        }

        // // Start our query blank so we can modify it for a data table
        $query = Announcement::with('subscriptionLevels');

        // if( $request->has('filter') && !empty($request->filter) ) {
        //     switch ($request->filter) {
        //         case 'draft': $query = $query->where('status', 'draft'); break;
        //         case 'published': $query = $query->where('status', 'scheduled'); break;
        //     }
        // }

        // Here we'll populate an object to make generating pagination and filters easier
        $table_meta = (object) [
            'record_total' => $query->count(),
            'page' => $request->page,
            'range' => [($request->page * $request->limit) - $request->limit + 1, $request->page * $request->limit],
            'filtered' => $request->has('filter')
        ];

        // // forPage automatically offsets and limits the query
        // $query = $query->forPage($request->page, $request->limit);

        $announcements = $query->get();

        $subscriptions = SubscriptionLevel::all();
        return view('announcements.index', compact('announcements', 'table_meta', 'subscriptions'));
    }

    public function create() {
        $subscriptions = SubscriptionLevel::all();
        return view('announcements.form', compact('subscriptions'));
    }

    public function show(Announcement $announcement) {
        $subscriptions = SubscriptionLevel::all();
        return view('announcements.form', compact('announcement', 'subscriptions'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'title' => 'required|max:255',
            'author' => 'nullable|max:255',
            'content' => 'required',
            'action_link' => 'nullable',
            'action_text' => 'nullable',
            'publish_start_date' => 'nullable',
            'publish_end_date' => 'nullable',
        ]);

        // We only change the status if the user has checked the publish box,
        // regardless of whether there is a date or not
        $data['status'] = ( isset($request->publish) ? 'scheduled' : 'draft' );

        $announcement = Announcement::create($data);

        // Handle the featured image
        if( $request->file('media') ) {
            $announcement->media = $request->file('media')->store('media', 'public');
            $announcement->save();
        }

        if( $request->has('v') && $request->ajax() ) {
            $announcement->subscriptionLevels()->sync( explode(',', $request->sub_levels[0]) );
            return json_encode(['status' => 'success', 'route' => route('announcements-list')]);
        } else {
            $announcement->subscriptionLevels()->sync( $request->sub_levels );
        }

        return redirect()->route('announcements-list');
    }

    public function update_status(Request $request, $id) {
        $announcement = Announcement::find($id);
        $announcement->status = $request->input('status');
        $announcement->save();
    }

    public function update(Request $request, Announcement $announcement) {
        $data = $request->validate([
            'title' => 'required|max:255',
            'author' => 'nullable|max:255',
            'content' => 'required',
            'action_link' => 'nullable',
            'action_text' => 'nullable',
            'publish_start_date' => 'nullable',
            'publish_end_date' => 'nullable',
        ]);

        $data['status'] = ( isset($request->publish) ? 'scheduled' : 'draft' );

        // Same as above, but for our ajax request
        if( $request->has('status') ) {
            $data['status'] = ( $request->status == 'scheduled' ? 'scheduled' : 'draft' );
        }

        $data['publish_start_date'] = $data['publish_start_date'].' '.$request->publish_start_time.':00';
        $data['publish_end_date'] = $data['publish_end_date'].' '.$request->publish_end_time.':00';

        if( $request->file('media') ) {
            $announcement->media = $request->file('media')->store('media', 'public');
        }
        if( $request->has('remove-media') ){
            $announcement->media = null;
        }

        $announcement->fill( $data );
        $announcement->save();

        // No redirect necessary, since they are using quick edit
        if( $request->has('v') && $request->ajax() ) {
            $announcement->subscriptionLevels()->sync( explode(',', $request->sub_levels[0]) );
            return json_encode(['status' => 'success', 'route' => route('announcements-list')]);
        } else {
            $announcement->subscriptionLevels()->sync( $request->sub_levels );
        }

        return redirect()->route('announcements-list');
    }

    public function destroy(Announcement $announcement) {
        $announcement->delete();
    }
}