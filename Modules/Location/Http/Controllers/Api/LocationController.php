<?php

namespace Modules\Location\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseApiController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Location\Entities\City;
use Modules\Location\Entities\Country;
use Modules\Location\Entities\State;
use Modules\Location\Http\Resources\CityResource;
use Modules\Location\Http\Resources\CountryResource;
use Modules\Location\Http\Resources\StateResource;

class LocationController extends BaseApiController
{
    public function countries(): JsonResponse
    {
        $countries = Country::active()->orderBy('is_default', 'desc')->orderBy('name')->get();
        return $this->success(CountryResource::collection($countries));
    }

    public function states($countryId): JsonResponse
    {
        $states = State::where('country_id', $countryId)->active()->orderBy('is_default', 'desc')->orderBy('name')->get();
        return $this->success(StateResource::collection($states));
    }

    public function cities($stateId): JsonResponse
    {
        $cities = City::where('state_id', $stateId)->active()->orderBy('is_default', 'desc')->orderBy('name')->get();
        return $this->success(CityResource::collection($cities));
    }

    public function allCities(): JsonResponse
    {
        $cities = City::active()->orderBy('is_default', 'desc')->orderBy('name')->get();
        return $this->success(CityResource::collection($cities));
    }
}
