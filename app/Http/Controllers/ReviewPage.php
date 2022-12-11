<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\review_page;

class ReviewPage extends Controller
{
    //
    public function addReview(Request $request)
    {
        $Review = new review_page;
        $Review->review_rating = $request->input('review_rating');
        $Review->review_comment = $request->input('review_comment');
        $Review->user = $request->input('user');
        $Review->house_id = $request->input('house_id');
        $Review->save();

        return response()->json([
            'status'=> 200,
            'message'=> 'Review added successfully'
        ]);
    }

    public function getAllSpecificReviews($id)
    {
        $review_page = review_page::where('house_id',"=",$id)->get();

        return response()->json([
            'status'=> 200,
            'review_page'=> $review_page,
        ]);
    }

    public function updateReview(Request $request, $id)
    {
        $review_page = review_page::where('id', $id)->first();
        if($review_page)
        {
            $review_page->review_rating = $request->input('review_rating');
            $review_page->review_comment = $request->input('review_comment');
            $review_page->user = $request->input('user');
            $review_page->house_id = $request->input('house_id');
            $review_page->update();

            return response()->json([
                'status'=> 200,
                'message'=> 'Profile updated successfully',
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message'=> 'No record with such id found!',
            ]);
        }
    }
}
