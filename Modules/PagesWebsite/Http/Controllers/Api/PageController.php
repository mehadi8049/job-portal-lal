<?php

namespace Modules\PagesWebsite\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseApiController;
use Illuminate\Http\JsonResponse;
use Modules\PagesWebsite\Entities\PageWebsite;

class PageController extends BaseApiController
{
    public function privacyPolicy(): JsonResponse
    {
        $page = PageWebsite::active()->where('slug', 'privacy-policy')->first();

        if (!$page) {
            return $this->error('Privacy policy page not found.', 404);
        }

        return $this->success([
            'id'          => $page->id,
            'title'       => $page->title,
            'description' => $page->description,
            'slug'        => $page->slug,
        ]);
    }

    public function termsAndConditions(): JsonResponse
    {
        $page = PageWebsite::active()->where('slug', 'terms-and-conditions')->first();

        if (!$page) {
            return $this->error('Terms and conditions page not found.', 404);
        }

        return $this->success([
            'id'          => $page->id,
            'title'       => $page->title,
            'description' => $page->description,
            'slug'        => $page->slug,
        ]);
    }
}
