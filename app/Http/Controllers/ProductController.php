<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('user');

        // Search by product name or user name
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;

            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                    ->orWhereHas('user', function ($query) use ($searchTerm) {
                        $query->where('name', 'like', '%' . $searchTerm . '%');
                    });
            });
        }

        // Filter harga (price)
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                default:
                    $query->orderBy('date_info', 'desc');
                    break;
            }
        } else {
            $query->orderBy('date_info', 'desc');
        }

        // Filter lokasi terdekat (nearby) jika terpilih
        if ($request->has('location') && in_array('nearby', $request->location)) {
            // Pastikan ada latitude dan longitude dalam request
            if ($request->has('user_latitude') && $request->has('user_longitude')) {
                $latitude = $request->user_latitude;
                $longitude = $request->user_longitude;
                $radius = 50; // radius dalam kilometer

                // Query untuk menghitung jarak berdasarkan latitude dan longitude
                $query->selectRaw("*, (6371 * acos(cos(radians($latitude)) * cos(radians(latitude)) * cos(radians(longitude) - radians($longitude)) + sin(radians($latitude)) * sin(radians(latitude)))) AS distance")
                    ->havingRaw("distance < ?", [$radius]);
            }
        }

        // Filter grade (A, B)
        if ($request->has('grade') && count($request->grade) > 0) {
            $query->whereIn('grade', $request->grade);
        }

        // Filter berdasarkan rating
        if ($request->has('rating')) {
            $ratingThreshold = $request->rating;
            $query->whereHas('ratings', function ($q) use ($ratingThreshold) {
                $q->where('rating', '>=', $ratingThreshold);
            });
        }

        // Paginate produk
        $products = $query->paginate(40);

        // Kirim data produk ke dashboard
        return view('dashboard', compact('products'));
    }


    public function shop()
    {
        $user = Auth::user();

        // Ambil semua produk pengguna
        $products = $user->products->sortByDesc('date_info');

        // Paginate produk secara manual
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 40; // Jumlah produk per halaman
        $currentPageItems = $products->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $products = new LengthAwarePaginator($currentPageItems, $products->count(), $perPage, $currentPage, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
        ]);

        return view('product.shop', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3',
            'price' => 'required|numeric|min:99|max:99999999',
            'stock' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'address' => 'nullable|string|max:255',
            'addres_detail' => 'nullable|string|max:100',
            'date_info' => 'nullable|date',
            'grade' => 'nullable|string|in:Grade A,Grade B',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:10240',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ], [
            'name.required' => 'The name field is required.',
            'name.min' => 'The name field must be at least 3 characters.',
            'name.max' => 'The name field may not be greater than 255 characters.',
            'price.required' => 'The price field is required.',
            'price.numeric' => 'The price must be a number.',
            'price.min' => 'The price field may not be less than 2 digits.',
            'price.max' => 'The price field may not be greater than 8 digits.',
            'stock.required' => 'The stock field is required.',
            'stock.integer' => 'The stock must be an integer.',
            'stock.min' => 'The stock must be at least 1.',
            'stock.max' => 'The stock may not be greater than 999999.',
            'description.string' => 'The description must be a string.',
            'description.max' => 'The description may not be greater than 1000 characters.',
            'address.string' => 'The address must be a string.',
            'address.max' => 'The address may not be greater than 255 characters.',
            'date_info.date' => 'The date info must be a valid date.',
            'grade.in' => 'The grade must be either "Grade A" or "Grade B".',
            'image.image' => 'The uploaded file must be an image.',
            'image.mimes' => 'The image must be in jpg, png, jpeg, or gif format.',
            'image.max' => 'The image may not be larger than 10MB.',
        ]);

        $data = $request->only([
            'name',
            'price',
            'stock',
            'description',
            'address',
            'addres_detail',
            'region',
            'date_info',
            'grade',
            'latitude',
            'longitude'
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('images', $filename, 'public');
            $data['image'] = $filename;
        }

        $data['user_id'] = Auth::id();
        Product::create($data);

        return redirect()->route('product.shop')->with('success', 'Product added successfully.');
    }

    public function update(Request $request, Product $id)
    {
        Log::info("Latitude yang dikirim: " . $request->latitude);
        Log::info("Longitude yang dikirim: " . $request->longitude);
        $request->validate([
            'name' => 'required|string|min:3',
            'price' => 'required|numeric|min:99|max:99999999',
            'stock' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'address' => 'nullable|string|max:255',
            'addres_detail' => 'nullable|string|max:100',
            'region' => 'nullable|string|max:100',
            'date_info' => 'nullable|date',
            'grade' => 'nullable|string|in:Grade A,Grade B',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:10240',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ], [
            'name.required' => 'The name field is required.',
            'name.min' => 'The name field must be at least 3 characters.',
            'name.max' => 'The name field may not be greater than 255 characters.',
            'price.required' => 'The price field is required.',
            'price.numeric' => 'The price must be a number.',
            'price.min' => 'The price field may not be less than 2 digits.',
            'price.max' => 'The price field may not be greater than 8 digits.',
            'stock.required' => 'The stock field is required.',
            'stock.integer' => 'The stock must be an integer.',
            'stock.min' => 'The stock must be at least 1.',
            'stock.max' => 'The stock may not be greater than 999999.',
            'description.string' => 'The description must be a string.',
            'description.max' => 'The description may not be greater than 1000 characters.',
            'address.string' => 'The address must be a string.',
            'address.max' => 'The address may not be greater than 255 characters.',
            'date_info.date' => 'The date info must be a valid date.',
            'grade.in' => 'The grade must be either "Grade A" or "Grade B".',
            'image.image' => 'The uploaded file must be an image.',
            'image.mimes' => 'The image must be in jpg, png, jpeg, or gif format.',
            'image.max' => 'The image may not be larger than 10MB.',
        ]);

        $data = $request->only([
            'name',
            'price',
            'stock',
            'description',
            'address',
            'addres_detail',
            'region',
            'date_info',
            'grade',
            'latitude',
            'longitude'
        ]);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($id->image) {
                Storage::disk('public')->delete('images/' . $id->image);
            }

            // Simpan gambar baru
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('images', $filename, 'public');
            $data['image'] = $filename;
        }



        $id->update($data);

        return redirect()->route('product.shop')->with('success', 'Product updated successfully.');
    }

    public function edit($id)
    {
        Log::info("Edit request for product ID: " . $id);

        $product = Product::findOrFail($id);
        return view('product.edit', compact('product'));
    }
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('product.shop')->with('success', 'Product deleted successfully.');
    }
}
