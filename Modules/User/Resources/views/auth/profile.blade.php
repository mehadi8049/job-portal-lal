@extends('core::layouts.app')
@section('title', __('Account Settings'))

@push('head')
    <style>
        .card-header {
            border-bottom: 0;
        }

        .tag {
            background: #007bff;
            color: #fff;
            padding: 3px 8px;
            border-radius: 4px;
            margin: 3px;
            display: inline-flex;
            align-items: center;
        }

        .tag .remove {
            margin-left: 6px;
            cursor: pointer;
            font-weight: bold;
        }
    </style>
@endpush
@push('scripts')
    <script>
        $('.collapse').collapse()

        document.addEventListener("DOMContentLoaded", function() {

            let input = document.getElementById("tag-input");
            let tagContainer = document.getElementById("tag-container");
            let hiddenContainer = document.getElementById("keywords-hidden");

            /** Load existing keywords (from controller) **/
            @if (!empty($user->keywords))
                let existingKeywords = {!! json_encode($user->keywords) !!};
                existingKeywords.forEach(keyword => addTag(keyword));
            @endif

            /** Add Tag on Enter **/
            input.addEventListener("keydown", function(e) {
                if (e.key === "Enter") {
                    e.preventDefault();
                    let value = input.value.trim();
                    if (value !== "") {
                        addTag(value);
                        input.value = "";
                    }
                }
            });

            /** Add tag function **/
            function addTag(text) {

                // Visible tag
                let tag = document.createElement("span");
                tag.classList.add("tag");
                tag.innerHTML = text + '<span class="remove">&times;</span>';

                // Remove handler
                tag.querySelector(".remove").addEventListener("click", function() {
                    tag.remove();
                    hiddenInput.remove();
                });

                tagContainer.insertBefore(tag, input);

                // Hidden input for form submitting
                let hiddenInput = document.createElement("input");
                hiddenInput.type = "hidden";
                hiddenInput.name = "keywords[]";
                hiddenInput.value = text;

                hiddenContainer.appendChild(hiddenInput);
            }
        });
        $("#add-experience").on("click",function(){
            $("#add-experience-form").removeClass('d-none')
        })
        $("#cancel-experience").on("click",function(){
            $("#add-experience-form").addClass('d-none')
        })
        $("#add-qualification").on("click",function(){
            $("#add-qualification-form").removeClass('d-none')
        })
        $("#cancel-qualification").on("click",function(){
            $("#add-qualification-form").addClass('d-none')
        })
        $("#add-skill").on("click",function(){
            $("#add-skill-form").removeClass('d-none')
        })
        $("#cancel-skill").on("click",function(){
            $("#add-skill-form").addClass('d-none')
        })
        $("#add-category").on("click",function(){
            $("#add-category-form").removeClass('d-none')
        })
        $("#cancel-category").on("click",function(){
            $("#add-category-form").addClass('d-none')
        })
        $("#add-language").on("click",function(){
            $("#add-language-form").removeClass('d-none')
        })
        $("#cancel-language").on("click",function(){
            $("#add-language-form").addClass('d-none')
        })
    </script>
@endpush
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">@lang('Setting Account')</h1>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" href="#tab_profile" data-toggle="tab">
                                @lang('Profile')
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tab_experience" data-toggle="tab">
                                @lang('Experience')
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tab_qualification" data-toggle="tab">
                                @lang('Qualification/Traning')
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tab_skill" data-toggle="tab">
                                @lang('Skill')
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tab_preferred_job_category" data-toggle="tab">
                                @lang('Preferred Job Category')
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tab_Language_proficiency" data-toggle="tab">
                                @lang('Language Proficiency')
                            </a>
                        </li>
                        @php
                            $views_render = accountSettingPayments(['user' => $user]);
                        @endphp

                        @if (!empty($views_render))
                            <li class="nav-item">
                                <a class="nav-link" href="#tab_payment_setting" data-toggle="tab">
                                    @lang('Payment Settings')
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>

                <div class="card-body">
                    <div class="tab-content">
                        @include('user::auth.tabs.tab_personal')
                        @include('user::auth.tabs.tab_experience')
                        @include('user::auth.tabs.tab_qualification')
                        @include('user::auth.tabs.tab_skill')
                        @include('user::auth.tabs.tab_preferred_job_category')
                        @include('user::auth.tabs.tab_Language_proficiency')


                        <div class="tab-pane" id="tab_payment_setting">
                            @if (!empty($views_render))
                                {!! $views_render !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
