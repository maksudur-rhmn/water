<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Faq;
use Carbon\Carbon;
use App\Http\Requests\FaqFormPost;

class FaqController extends Controller
{
    function index()
    {
      $faqs = Faq::all();
      $deleted_faqs = Faq::onlyTrashed()->get();
      return view('faq.index', compact('faqs', 'deleted_faqs'));
    }
    function faq_insert(FaqFormPost $request)
    {
      Faq::insert($request->except('_token') + ['created_at' => Carbon::now()]);
      return back();
    }

    function faq_delete($faq_id)
    {
      Faq::findOrFail($faq_id)->delete();
      return back();
    }

    function faq_edit($faq_id)
    {
     $faq = Faq::find($faq_id);
     return view('faq.edit', compact('faq'));
    }

    function faq_update(Request $request)
    {
      Faq::find($request->id)->update([
        'faq_question'  => $request->faq_question,
        'faq_answer'  => $request->faq_answer,
      ]);
      return redirect('/faq');
    }

    function faq_restore($faq_id)
    {
     Faq::withTrashed()->find($faq_id)->restore();
     return back();
    }

    function faq_permanentDelete($faq_id)
    {
      Faq::withTrashed()->findOrFail($faq_id)->forceDelete();
      return back();
    }




























// END
}
