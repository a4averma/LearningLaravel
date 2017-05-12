@extends('layouts.app')

@section('content')
<div class="container">
    @if(!empty($message))
        <p class="alert alert-danger">{{$message}}</p>
    @endif
    <form method="post" action="{{route('subscribe')}}">
        {{ csrf_field() }}
        <div class="row">
                <div class="col-xs-12 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                Standard</h3>
                        </div>
                        <div class="panel-body">
                            <div class="the-price">
                                <h1>
                                    Rs. 3600<span class="subscript">/yr</span></h1>
                            </div>
                            <table class="table">
                                <tr>
                                    <td>
                                        1 Account
                                    </td>
                                </tr>
                                <tr class="active">
                                    <td>
                                        1 Project
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        100K API Access
                                    </td>
                                </tr>
                                <tr class="active">
                                    <td>
                                        100MB Storage
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Custom Cloud Services
                                    </td>
                                </tr>
                                <tr class="active">
                                    <td>
                                        Weekly Reports
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="panel-footer">
                            <div class="radio">
                                <label for="standard"><input type="radio" name="plan" id="standard" value="standard"> Standard</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-md-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                Premium</h3>
                        </div>
                        <div class="panel-body">
                            <div class="the-price">
                                <h1>
                                    Rs.7200<span class="subscript">/yr</span></h1>
                            </div>
                            <table class="table">
                                <tr>
                                    <td>
                                        5 Account
                                    </td>
                                </tr>
                                <tr class="active">
                                    <td>
                                        20 Project
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        300K API Access
                                    </td>
                                </tr>
                                <tr class="active">
                                    <td>
                                        500MB Storage
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Custom Cloud Services
                                    </td>
                                </tr>
                                <tr class="active">
                                    <td>
                                        Weekly Reports
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="panel-footer">
                            <div class="radio">
                                <label for="premium"><input type="radio" name="plan" id="premium" value="premium"> Premium</label>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <button type="submit" class="btn btn-primary">Pay</button>
            </div>
        </div>
    </form>
</div>
@endsection