@extends('Admin.layouts.app')
@section('content')
    <div class="content-page">
        <div class="content">
            <!-- Start Content-->
            <div class="container-fluid">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="#">Setting</a></li>
                                    <li class="breadcrumb-item active" id="breadcrumb-active"></li>
                                </ol>
                            </div>
                            <h4 class="page-title">Setting</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="header-title">Setting</h4>
                            </div>
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-md-12 rightsetup-details">
                                        <div class="d-flex justify-content-between p-2 bd-highlight">
                                            <div>
                                            </div>
                                            <div>
                                            </div>
                                        </div>
                                        <!-- Main Content -->
                                        <div class="card-body my-4">
                                            <div class="row">
                                                <div class="col-2">
                                                    <div class="list-group" id="list-tab" role="tablist">
                                                        <a class="list-group-item list-group-item-action active"
                                                            id="list-general-list" data-toggle="list" href="#list-general"
                                                            role="tab">General Setting</a>
                                                        <a class="list-group-item list-group-item-action"
                                                            id="list-contact-lis" data-toggle="list" href="#list-contact"
                                                            role="tab">Contact
                                                            setting
                                                        </a>
                                                        <a class="list-group-item list-group-item-action"
                                                            id="list-theme-lis" data-toggle="list" href="#list-theme"
                                                            role="tab">Theme
                                                            setting
                                                        </a>
                                                        <a class="list-group-item list-group-item-action"
                                                            id="list-other-list" data-toggle="list" href="#list-other"
                                                            role="tab">Other Setting</a>
                                                        <a class="list-group-item list-group-item-action"
                                                            id="list-email-list" data-toggle="list" href="#list-email"
                                                            role="tab">Email Setting</a>
                                                    </div>
                                                </div>
                                                <div class="col-10">
                                                    <div class="tab-content" id="nav-tabContent">
                                                        @include('Admin.setting.general')
                                                        @include('Admin.setting.contact')
                                                        @include('Admin.setting.other')
                                                        @include('Admin.setting.theme')
                                                        @include('Admin.setting.email')
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- container -->
                                </div>
                                <!-- content -->
                                <!-- Footer Start -->
                                <footer class="footer">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-12 text-center">
                                                <script>
                                                    document.write(new Date().getFullYear())
                                                </script> © Karmic - Theme by <b>Syscorp</b>
                                            </div>
                                        </div>
                                    </div>
                                </footer>
                                <!-- end Footer -->
                            </div>
                            <script>
                                // JavaScript to handle tab clicks and show corresponding forms
                                document.addEventListener('DOMContentLoaded', function() {
                                    var tabs = document.querySelectorAll('.list-group-item');

                                    tabs.forEach(function(tab) {
                                        tab.addEventListener('click', function(event) {
                                            event.preventDefault();
                                            var target = this.getAttribute('href');
                                            var form = document.querySelector(target);
                                            var activeTab = document.querySelector('.list-group-item.active');

                                            // Hide all forms
                                            document.querySelectorAll('.tab-pane').forEach(function(pane) {
                                                pane.classList.remove('show', 'active');
                                            });

                                            // Remove active class from all tabs
                                            tabs.forEach(function(tab) {
                                                tab.classList.remove('active');
                                            });

                                            // Show the clicked form
                                            form.classList.add('show', 'active');
                                            this.classList.add('active');
                                        });
                                    });
                                });

                                // Automatically show the General Setting tab on page load
                                window.addEventListener('load', function() {
                                    var generalTab = document.getElementById('list-general-list');
                                    var generalForm = document.getElementById('list-general');

                                    // Remove 'active' class from all tabs
                                    document.querySelectorAll('.list-group-item').forEach(function(tab) {
                                        tab.classList.remove('active');
                                    });

                                    // Remove 'show active' class from all tab contents
                                    document.querySelectorAll('.tab-pane').forEach(function(pane) {
                                        pane.classList.remove('show', 'active');
                                    });

                                    // Add 'active' class to the General Setting tab
                                    generalTab.classList.add('active');

                                    // Show the General Setting form
                                    generalForm.classList.add('show', 'active');
                                });
                            </script>
                        @endsection
