@extends('layouts.app')
@section('title', $user->name .'的个人信息')

@section('content')
	<div class="row">
		<div class="col-lg-3 col-md-3 hidden-sm hidden-xs user-info">
			<div class="card">
				<img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="card-img-top">

				<div class="card-body">
					<h5><strong>个人简介</strong></h5>
					<p>{{ $user->introduction }}</p>
					<hr>
					<h5><strong>注册于</strong></h5>
					<p>{{ $user->created_at->diffForHumans() }}</p>
				</div>
			</div>
		</div>


		<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
			<div class="card">
				<div class="card-body">
					<h1 class="mb-0" style="font-size: 22px;">{{ $user->name }} <small>{{ $user->email }}</small></h1>
				</div>
			</div>
			
			<hr>
			{{-- user pubilsh --}}
			<div class="card">
				<div class="card-body">
					<ul class="nav nav-tabs">
						<li class="nav-item">
							<a href="{{ route('users.show', $user->id) }}" class="nav-link bg-transparent @if (Request::input('tab') != 'replies') active @endif">Ta 的话题</a>
							
						</li>
						<li class="nav-item">
							<a href="{{ route('users.show', [$user->id, 'tab' => 'replies']) }}" class="nav-link bg-transparent  @if (Request::input('tab') == 'replies') active @endif">Ta 的回复</a>
						</li>
					</ul>

					@if (Request::input('tab') == 'replies')
						@include('users._replies', ['replies' => $user->replies()->recent()->paginate(5)])
					@else
						@include('users._topics', ['topics' => $user->topics()->recent()->paginate(5)])
					@endif

				</div>
			</div>
		</div>
	</div>

@stop