<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255|string|unique:categories,name',
        ], [
            'name.required' => 'الاسم مطلوب',
            'name.unique'   => 'الاسم موجود مسبقاً',
            'name.string'   => 'يجب أن يكون الاسم من حروف',
            'name.max'      => 'يجب ألا يتجاوز الاسم 255 حرفاً',
        ]);
        Category::create($data);
        return redirect()->back()->with('success', 'تم إضافة القسم بنجاح');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $new_data = $request->validate([
            'name' => 'required|max:255|string|unique:categories,name,' . $category->id,
        ], [
            'name.required' => 'الاسم مطلوب',
            'name.unique'   => 'الاسم موجود مسبقاً',
            'name.string'   => 'يجب أن يكون الاسم من حروف',
            'name.max'      => 'يجب ألا يتجاوز الاسم 255 حرفاً',
        ]);

        if (!$category->fill($new_data)->isDirty()) {
            return redirect()->back()->with('warning', 'لم تقم بأي تعديل');
        }
        $category->save();
        return redirect()->back()->with('success', 'تم التعديل بنجاح');
    }
}
