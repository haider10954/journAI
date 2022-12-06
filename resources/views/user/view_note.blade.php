@extends('user.layout.layout')

@section('title' , 'journAI | View Note')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Journ AI</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item "><a href="javascript: void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript: void(0);">View Note</a></li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="text-muted">
                    <h6 class="mb-3 fw-semibold text-uppercase">Note Title</h6>
                    <p>Note Description It will be as simple as occidental in fact, it will be Occidental. To an English person, it will seem like simplified English, as a skeptical Cambridge friend of mine told me what Occidental is. The European languages are members of the same family. Their separate existence is a myth. For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ in their grammar, their pronunciation and their most common words.</p>

                    <h6 class="mb-3 fw-semibold text-uppercase">AI Analytics</h6>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <!-- Labels Example -->
                                <div class="progress progress_bar">
                                    <div class="progress-bar progress_bar_inner" role="progressbar" style="width: 90%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Neutral 25%</div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <!-- Labels Example -->
                                <div class="progress progress_bar">
                                    <div class="progress-bar progress_bar_inner" role="progressbar" style="width: 50%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Annoyance 50%</div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <!-- Labels Example -->
                                <div class="progress progress_bar">
                                    <div class="progress-bar progress_bar_inner" role="progressbar" style="width: 30%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">disappointed 30%</div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <!-- Labels Example -->
                                <div class="progress progress_bar">
                                    <div class="progress-bar progress_bar_inner" role="progressbar" style="width: 60%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">disgust 60%</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="text-muted">
                    <h6 class="mb-3 fw-semibold text-uppercase">AI Suggestions</h6>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <!-- Labels Example -->
                                <div class="progress progress_bar">
                                    <div class="progress-bar progress_bar_inner" role="progressbar" style="width: 90%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Neutral 25%</div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <!-- Labels Example -->
                                <div class="progress progress_bar">
                                    <div class="progress-bar progress_bar_inner" role="progressbar" style="width: 50%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">Annoyance 50%</div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <!-- Labels Example -->
                                <div class="progress progress_bar">
                                    <div class="progress-bar progress_bar_inner" role="progressbar" style="width: 30%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">disappointed 30%</div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <!-- Labels Example -->
                                <div class="progress progress_bar">
                                    <div class="progress-bar progress_bar_inner" role="progressbar" style="width: 60%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">disgust 60%</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
