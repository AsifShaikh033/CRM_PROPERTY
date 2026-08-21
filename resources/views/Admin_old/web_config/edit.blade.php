@extends('Admin.layout.main')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Web Setting</h3>
            <ul class="breadcrumbs mb-3">
                <!-- <li class="nav-home">
                  <a href="#">
                    <i class="icon-home"></i>
                  </a>
                </li> -->
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Form Elements</div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.web_config.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <!-- Web Title and Tagline -->
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="web_title">Web Title</label>
                                        <input type="text" name="web_title" class="form-control" id="web_title" value="{{ $settings['web_title'] ?? '' }}" placeholder="Enter Web Title">
                                        <small class="form-text text-muted">Web Title Name</small>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="tagline">Description</label>
                                        <input type="text" name="tagline" class="form-control" id="tagline" value="{{ $settings['tagline'] ?? '' }}" placeholder="Enter Tagline">
                                        <small class="form-text text-muted">Website Description</small>
                                    </div>
                                </div>

                                <!-- Email Addresses -->
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="primary_email">Primary Email</label>
                                        <input type="email" name="primary_email" class="form-control" id="primary_email" value="{{ $settings['primary_email'] ?? '' }}" placeholder="Enter Primary Email">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="support_email">Support Email</label>
                                        <input type="email" name="support_email" class="form-control" id="support_email" value="{{ $settings['support_email'] ?? '' }}" placeholder="Enter Support Email">
                                    </div>
                                </div>

                                <!-- Phone Numbers -->
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="primary_phone">Primary Phone</label>
                                        <input type="text" name="primary_phone" class="form-control" id="primary_phone" value="{{ $settings['primary_phone'] ?? '' }}" placeholder="Enter Primary Phone">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="secondary_phone">Secondary Phone</label>
                                        <input type="text" name="secondary_phone" class="form-control" id="secondary_phone" value="{{ $settings['secondary_phone'] ?? '' }}" placeholder="Enter Secondary Phone">
                                    </div>
                                </div>

                                <!-- Address -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <textarea name="address" class="form-control" id="address" rows="3" placeholder="Enter Address">{{ $settings['address'] ?? '' }}</textarea>
                                    </div>
                                </div>
                                <!-- Logo and Favicon -->
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="logo">Logo</label>
                                        <input type="file" name="logo" class="form-control" id="logo">
                                        @if(!empty($settings['logo']))
                                        <img src="{{ asset('storage/' . $settings['logo']) }}" alt="Logo" class="img-fluid" height="120px" width="120px"/>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="fav_icon">Favicon</label>
                                        <input type="file" name="fav_icon" class="form-control" id="fav_icon">
                                        @if(!empty($settings['fav_icon']))
                                            <img src="{{ asset('storage/' . $settings['fav_icon']) }}" alt="Favicon" class="img-fluid" height="120px" width="120px"/>
                                        @endif
                                    </div>
                                </div>

                                <!-- Social Media Links -->
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="instagram_link">Instagram Link</label>
                                        <input type="url" name="instagram_link" class="form-control" id="instagram_link" value="{{ $settings['instagram_link'] ?? '' }}" placeholder="Enter Instagram URL">
                                    </div>
                                </div>
                                <!-- Facebook Link -->
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="facebook_link">Facebook Link</label>
                                        <input type="url" name="facebook_link" class="form-control" id="facebook_link" value="{{ $settings['facebook_link'] ?? '' }}" placeholder="Enter Facebook URL">
                                    </div>
                                </div>
                                <!-- Twitter Link -->
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="twitter_link">Twitter Link</label>
                                        <input type="url" name="twitter_link" class="form-control" id="twitter_link" value="{{ $settings['twitter_link'] ?? '' }}" placeholder="Enter Twitter URL">
                                    </div>
                                </div>
                                <!-- YouTube Link -->
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="youtube_link">YouTube Link</label>
                                        <input type="url" name="youtube_link" class="form-control" id="youtube_link" value="{{ $settings['youtube_link'] ?? '' }}" placeholder="Enter YouTube URL">
                                    </div>
                                </div>

                                <!-- Terms and Privacy -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="privacy_policy">Privacy Policy</label>
                                        <textarea name="privacy_policy" class="form-control" id="privacy_policy" rows="3" placeholder="Enter Privacy Policy">{{ $settings['privacy_policy'] ?? '' }}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="terms_conditions">Terms & Conditions</label>
                                        <textarea name="terms_conditions" class="form-control" id="terms_conditions" rows="3" placeholder="Enter Terms and Conditions">{{ $settings['terms_conditions'] ?? '' }}</textarea>
                                    </div>
                                </div>

                                <!-- SMTP Settings -->
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="smtp_host">SMTP Host</label>
                                        <input type="text" name="smtp_host" class="form-control" id="smtp_host" value="{{ $settings['smtp_host'] ?? '' }}" placeholder="Enter SMTP Host">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="smtp_port">SMTP Port</label>
                                        <input type="text" name="smtp_port" class="form-control" id="smtp_port" value="{{ $settings['smtp_port'] ?? '' }}" placeholder="Enter SMTP Port">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="smtp_username">SMTP Username</label>
                                        <input type="text" name="smtp_username" class="form-control" id="smtp_username" value="{{ $settings['smtp_username'] ?? '' }}" placeholder="Enter SMTP Username">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="smtp_password">SMTP Password</label>
                                        <input type="password" name="smtp_password" class="form-control" id="smtp_password" value="{{ $settings['smtp_password'] ?? '' }}" placeholder="Enter SMTP Password">
                                    </div>
                                </div>

                               
                                <!-- SEO Settings -->
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="meta_keywords">Meta Keywords</label>
                                        <input type="text" name="meta_keywords" class="form-control" id="meta_keywords" value="{{ $settings['meta_keywords'] ?? '' }}" placeholder="Enter Meta Keywords">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="meta_description">Meta Description</label>
                                        <textarea name="meta_description" class="form-control" id="meta_description" rows="3" placeholder="Enter Meta Description">{{ $settings['meta_description'] ?? '' }}</textarea>
                                    </div>
                                </div>

                            </div>

                            <div class="card-action">
                                <button type="submit" class="btn btn-success">Save Settings</button>
                                <button type="reset" class="btn btn-danger">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
