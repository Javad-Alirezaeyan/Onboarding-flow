

@extends("layouts.master")
@section('title', "Analysis")

@section('content')
    <div class="card">
        <div class="card-block">
            <h4 class="card-title">Analysis based the Retention chart</h4>
            <h6 class="card-subtitle"> In this analysis, the first and last step has been ignored </h6>
            <div class="table-responsive">
                <analysis-data></analysis-data>
            </div>
        </div>
    </div>

@endsection


