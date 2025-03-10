<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaxProfile\StoreTaxProfileRequest;
use App\Http\Requests\TaxProfile\UpdateTaxProfileRequest;
use App\Http\Resources\TaxProfileResource;
use App\Models\TaxProfile;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaxProfileController extends BaseController
{
    /**
     * Display a listing of the tax profile.
     */
    public function index(Request $request): JsonResponse
    {
        $query = TaxProfile::query();
        $query = $this->applyFilters($query, $request->query());

        $taxProfiles = $query->orderBy('created_at', 'desc')->paginate();
        return TaxProfileResource::collection($taxProfiles)->response();
    }

    /**
     * Store a newly created tax profile in storage.
     */
    public function store(StoreTaxProfileRequest $request): JsonResponse
    {
        $taxProfile = TaxProfile::create($request->validated());
        return response()->json(new TaxProfileResource($taxProfile), 201);
    }

    /**
     * Display the specified tax profile.
     */
    public function show($id): JsonResponse
    {
        try {
            $taxProfile = TaxProfile::findOrFail($id);
            return response()->json(new TaxProfileResource($taxProfile));
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Tax profile not found',
            ], 404);
        }
    }

    /**
     * Update the specified tax profile in storage.
     */
    public function update(UpdateTaxProfileRequest $request, $id): JsonResponse
    {
        try {
            $taxProfile = TaxProfile::findOrFail($id);
            $taxProfile->update($request->validated());
            $taxProfile->refresh();
            return response()->json([
                'data' => new TaxProfileResource($taxProfile),
                'message' => 'Tax profile edited successfully'
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Tax profile not found',
            ], 404);
        }
    }

    /**
     * Remove the specified tax profile from storage.
     */
    public function destroy($id): JsonResponse
    {
        try {
            $taxProfile = TaxProfile::findOrFail($id);
            $taxProfile->delete();
            return response()->json(['message' => 'Tax profile deleted successfully']);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Tax profile not found',
            ], 404);
        }
    }
}
