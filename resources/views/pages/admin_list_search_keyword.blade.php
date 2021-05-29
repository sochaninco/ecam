@extends('layouts.app_admin')
@section('content')
    <div class="row">
        <div class="col-lg-12 no-padding">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Search Keyword</li>
                </ol>
            </nav>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <a href="{{url('add_search_keyword')}}" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Add Keyword</a>
            <div class="panel panel-default">
                <div class="panel-heading">
                    List all your slide
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                            <tr>
                                <th> Type</th>
                                <th> Keyword</th>
                                <th> Link To </th>
                                <th class="nosort">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($searchKeywords as $keyword)
                            <tr class="even gradeC">
                                <td>
                                    @if($keyword->type == 0)
                                        Search Keyword
                                    @elseif($keyword->type ==1)
                                        Online Exhibition
                                    @endif
                                </td>
                                <td>
                                    {{$keyword->keyword}}
                                </td>
                                <td>
                                    @if($keyword->type == 1)
                                        <?php
                                            $shopInfo = \App\PageShops::where('user_id',$keyword->shop)->first();
                                        ?>
                                        Shop : {{$shopInfo->shop_name}}
                                    @else
                                        @if($keyword->link_to == 0)
                                        Search Page
                                        @elseif($keyword->link_to == 1)
                                            Category Page
                                        @elseif($keyword->link_to == 2)
                                            Sub Category
                                        @endif
                                    @endif
                                </td>
                                {{--<td>{{$category->cost}}</td>--}}
                                <td class="center">
                                    <a href="{{url('edit_search_keyword/'.$keyword->id)}}" class="btn btn-info"><i class="fa fa-edit"></i> </a>
                                    <a href="{{url('delete_search_keyword/'.$keyword->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this slide?');"><i class="fa fa-times"></i>
                                    </a>
                                    {{--<button type="button" class="btn btn-danger"><i class="fa fa-times"></i>--}}
                                    {{--</button>--}}
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->
@endsection