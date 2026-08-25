<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProductPhoto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProductPhotoController extends Controller
{
    public function destroy(ProductPhoto $productPhoto)
    {
        if ($productPhoto->photo && Storage::disk('public')->exists($productPhoto->photo)) {
            Storage::disk('public')->delete($productPhoto->photo);
        }

        $productPhoto->delete();

        return redirect()->back()->with('success', 'تم حذف الصورة بنجاح');
    }
}
