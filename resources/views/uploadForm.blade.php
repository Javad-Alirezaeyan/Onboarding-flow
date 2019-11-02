<?php

?>

@extends("layouts.master")
@section('title', "Upload csv file")

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-block">
                    <h4 class="card-title">Upload source file</h4>
                    <h6 class="card-subtitle">Only .csv files are allowable <code>.csv</code> </h6>
                    @if (!$dataSourceIsFile)
                        <div class="alert alert-danger" >
                            The data source has been set to 'database'. So you can upload a file, but the application uses the database to draw the chart.
                            <br/>
                            To change the data source, set DATA_DRIVER in <code>.env </code> to csv
                        </div>
                    @endif
                    <file-upload></file-upload>
                </div>
            </div>

        </div>
    </div>

@endsection
