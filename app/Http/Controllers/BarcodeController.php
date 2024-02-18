<?php

// app/Http/Controllers/BarcodeController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BarcodeController extends Controller
{
    public function scan()
    {
        return view('scan');
    }

    public function handleScan(Request $request)
    {
        $barcodeData = $request->input('barcode');
        // Process the barcode data as needed

        return response()->json(['success' => true, 'message' => 'Barcode scanned successfully']);
    }
}
