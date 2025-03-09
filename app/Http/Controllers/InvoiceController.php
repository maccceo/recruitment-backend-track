<?php

namespace App\Http\Controllers;

use App\Http\Requests\Invoice\StoreInvoiceRequest;
use App\Http\Requests\Invoice\UpdateInvoiceRequest;
use App\Http\Resources\InvoiceResource;
use App\Models\Invoice;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InvoiceController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $query = Invoice::query();
        $query = $this->applyFilters($query, $request->query());

        $invoices = $query->orderBy('created_at', 'desc')->paginate();
        return InvoiceResource::collection($invoices)->response();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInvoiceRequest $request): JsonResponse
    {
        $invoice = Invoice::create($request->validated());
        return response()->json(new InvoiceResource($invoice), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        try {
            $invoice = Invoice::findOrFail($id);
            return response()->json(new InvoiceResource($invoice));
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Invoice not found',
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInvoiceRequest $request, $id): JsonResponse
    {
        try {
            $invoice = Invoice::findOrFail($id);
            $invoice->update($request->validated());
            $invoice->refresh();
            return response()->json([
                'data' => new InvoiceResource($invoice),
                'message' => 'Invoice edited successfully'
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Invoice not found',
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        try {
            $invoice = Invoice::findOrFail($id);
            $invoice->delete();
            return response()->json(['message' => 'Invoice deleted successfully']);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Invoice not found',
            ], 404);
        }
    }
}
