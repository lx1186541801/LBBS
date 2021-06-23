@if (count($topics))
	<ul class="list-unstyled">
		@foreach($topics as $topic)
			<li class="media">
				<div class="media-left">
					<a href="{{ route('users.show', $topic->user_id) }}">
						<img src="{{ $topic->user->avatar }}" title="{{ $topic->user->name }}" class="media-object img-thumbnail mr-3" style="width: 52px; height: 52px;">
					</a>
				</div>

				<div class="media-body">
					
					<div class="media-heading mt-0 mb-1">
					
						<a href="{{ route('topics.show', $topic->id) }}" title="{{ $topic->title }}">
							{{ $topic->title }}
						</a>
						<a href="{{ route('topics.show', $topic->id) }}" class="float-right">
							<span class="badge badge-secondary badge-pill">{{ $topic->reply_count }}</span>
						</a>

					</div>

					<small class="media-body meta text-secondary">
			            <a class="text-secondary" href="#" title="{{ $topic->category->name }}">
		              		<i class="far fa-folder"></i>
		              		{{ $topic->category->name }}
			            </a>

						<span> · </span>
						<a href="{{ route('users.show', $topic->user_id) }}" class="text-secondary" title="{{ $topic->user->name }}">
							<i class="far fa-user"></i>
							{{ $topic->user->name }}
						</a>

						<span> · </span>
						<i class="far fa-clock"></i>
						<span class="timeage" title="最后活跃于:{{ $topic->updated_at }}">{{ $topic->updated_at->diffForHumans() }}</span>
					</small>

				</div>
			</li>

			@if ( ! $loop->last)
				<hr>
			@endif

		@endforeach

	</ul>
@else
	<div class="empty-block">暂无数据^~^</div>
@endif