@extends('new')
@section('content')
<div class="row state-overview">
    <a href="{{url('admin/stats/users')}}">
        <div class="col-lg-3 col-sm-6">
          <section class="panel">
              <div class="symbol terques">
                  <i class="fa fa-users"></i>
              </div>
              <div class="value">
                  <h1 class="count">
                      {{$weekly}}
                  </h1>
                  <p>{{trans('shop.new_users')}}</p>
              </div>
          </section>
        </div>
    </a>
    <a href="{{url('admin/stats/products')}}">
        <div class="col-lg-3 col-sm-6">
          <section class="panel">
              <div class="symbol red">
                  <i class="fa fa-tags"></i>
              </div>
              <div class="value">
                  <h1 class=" count2">
                      {{$productsweekly}}
                  </h1>
                  <p>{{trans('shop.products')}}</p>
              </div>
          </section>
        </div>
    </a>
    <a href="#">
        <div class="col-lg-3 col-sm-6">
            <section class="panel">
              <div class="symbol yellow">
                  <i class="fa fa-shopping-cart"></i>
              </div>
              <div class="value">
                  <h1 class=" count3">
                      0
                  </h1>
                  <p>{{trans('shop.new_order')}}</p>
              </div>
            </section>
        </div>
    </a>
    <div class="col-lg-3 col-sm-6">
      <section class="panel">
          <div class="symbol blue">
              <i class="fa fa-bar-chart-o"></i>
          </div>
          <div class="value">
              <h1 class=" count4">
                  0
              </h1>
              <p>Total Profit</p>
          </div>
      </section>
  </div>
</div>
<div class="row">
  <div class="col-lg-8">
      <!--timeline start-->
      <section class="panel">
          <div class="panel-body">
                  <div class="text-center mbot30">
                      <h3 class="timeline-title">{{trans('shop.timeline')}}</h3>
                  </div>

                  <div class="timeline">
                    @if(!empty($activities))
                      @foreach($activities as $a)
                      @if($a->type=="add")
                      <article class="timeline-item alt">
                          <div class="timeline-desk">
                              <div class="panel">
                                  <div class="panel-body">
                                      <span class="arrow-alt"></span>
                                      <span class="timeline-icon green"></span>
                                      <span class="timeline-date">{{ Carbon::createFromTimestamp(strtotime($a->created_at))->diffForHumans() }}</span>
                                      <p><a href="#">{{$a->user['name']}}</a> {{$a->text}}</p>
                                  </div>
                              </div>
                          </div>
                      </article>
                      @elseif($a->type=="edit")
                      <article class="timeline-item ">
                          <div class="timeline-desk">
                              <div class="panel">
                                  <div class="panel-body">
                                      <span class="arrow-alt"></span>
                                      <span class="timeline-icon red"></span>
                                      <span class="timeline-date">{{ Carbon::createFromTimestamp(strtotime($a->created_at))->diffForHumans() }}</span>
                                      <p><a href="#">{{$a->user['name']}}</a> {{$a->text}}</p>
                                  </div>
                              </div>
                          </div>
                      </article>
                      @endif
                      @endforeach
                  @else
                    <p>No data</p>
                  @endif

                  </div>

                  <div class="clearfix">&nbsp;</div>
              </div>
      </section>
      <!--timeline end-->
  </div>
  <div class="col-lg-4">
      <section class="panel">
          <div class="panel-body">
              <div class="task-thumb-details">
                  <h1>{{trans('shop.online_users')}}</h1>
              </div>
          </div>
          <table class="table table-hover personal-task">
              <tbody>
              @if(!$users->isEmpty())
                        @foreach($users as $u)
                        @if($u->user_id!=Auth::user()->id)
                        <tr>
                            <td>{{$u->user->name}}</td>
                            <td>
                                <i class="fa fa-circle  pull-right" style="font-size:9px;color:green;margin-top: 5px;"></i>
                            </td>
                        </tr>
                         @else
                         
                        @endif
                        @endforeach
                @else
                 <td>{{trans('shop.no_users_online')}}</td>
                <td></td>
                @endif
              </tbody>
          </table>
      </section>
                      
    </div>
  </div>
@endsection
